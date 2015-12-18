<?php

namespace easylo\Composer;

use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;

class ExtensionInstaller extends LibraryInstaller
{
    /**
     * {@inheritDoc}
     */
    public function getInstallPath(PackageInterface $package)
    {
        $type = $package->getType();

        $prettyName = $package->getPrettyName() ;

        if (strpos($prettyName, '/') !== false) {
            list($vendor, $name) = explode('/', $prettyName);
        } else {
            $vendor = '';
            $name = $prettyName;
        }

        $installerPaths = $this->composer->getConfig()->get('installer-paths') ;

        $availableVars = $this->inflectPackageVars(compact('name', 'vendor', 'type'));

        if (!empty( $installerPaths )) {
                $customPath = $this->mapCustomInstallPaths($installerPaths, $prettyName, $type);
                if ($customPath !== false) {
                    return $this->templatePath($customPath, $availableVars);
                }
            }

       $this->initializeVendorDir();
       $basePath = ($this->vendorDir ? $this->vendorDir.'/' : '') . $package->getPrettyName();

       $targetDir = $package->getTargetDir();
       return $basePath . ($targetDir ? '/'.$targetDir : '');
        
    }

    /**
     * {@inheritDoc}
     */
    public function supports($packageType)
    {
        return 'library' === $packageType;
        //return 'ezpublish-extension' === $packageType;
    }

    /**
     * For an installer to override to modify the vars per installer.
     *
     * @param  array $vars
     * @return array
     */
    public function inflectPackageVars($vars)
    {
        return $vars;
    }
    
     /**
     * Replace vars in a path
     *
     * @param  string $path
     * @param  array  $vars
     * @return string
     */
    protected function templatePath($path, array $vars = array())
    {
        if (strpos($path, '{') !== false) {
            extract($vars);
            preg_match_all('@\{\$([A-Za-z0-9_]*)\}@i', $path, $matches);
            if (!empty($matches[1])) {
                foreach ($matches[1] as $var) {
                    $path = str_replace('{$' . $var . '}', $$var, $path);
                }
            }
        }

        return $path;
    }

     /**
     * Search through a passed paths array for a custom install path.
     *
     * @param  array  $paths
     * @param  string $name
     * @param  string $type
     * @return string
     */
    protected function mapCustomInstallPaths(array $paths, $name, $type)
    {
        foreach ($paths as $path => $names) {
            if (in_array($name, $names) || in_array('type:' . $type, $names)) {
                return $path;
            }
        }

        return false;
    }
}
