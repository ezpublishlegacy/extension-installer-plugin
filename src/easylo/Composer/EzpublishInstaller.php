<?php

namespace easylo\Composer;

use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;

class EzpublishInstaller extends LibraryInstaller
{
    /**
     * {@inheritDoc}
     */
    public function getPackageBasePath(PackageInterface $package)
    {
        error_log('$package->getExtra()::'.var_export($package->getExtra(),true) ,3, '/home/users/webrichard/tmp/log/PHP_errors.log' ) ;
        return '../ezpublish_legacy/extensions/'. $package->getPrettyName() ;
        /*$prefix = substr($package->getPrettyName(), 0, 23);
        if ('phpdocumentor/template-' !== $prefix) {
            throw new \InvalidArgumentException(
                'Unable to install template, phpdocumentor templates '
                .'should always start their package name with '
                .'"phpdocumentor/template-"'
            );
        }

        return 'data/templates/'.substr($package->getPrettyName(), 23);*/
    }

    /**
     * {@inheritDoc}
     */
    public function supports($packageType)
    {
        return 'ezpublish-extension' === $packageType;
    }
}