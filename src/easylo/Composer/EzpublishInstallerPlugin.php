<?php

namespace easylo\Composer;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

class EzpublishInstallerPlugin implements PluginInterface
{
    public function activate(Composer $composer, IOInterface $io)
    {
        $installer = new EzpublishInstaller($io, $composer);
        $composer->getInstallationManager()->addInstaller($installer);
    }
}