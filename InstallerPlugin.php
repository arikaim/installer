<?php
/**
 * Arikaim
 *
 * @link        http://www.arikaim.com
 * @copyright   Copyright (c) 2017-2018 Konstantin Atanasov <info@arikaim.com>
 * @license     http://www.arikaim.com/license.html
 * 
 */
namespace Arikaim\Installer;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

/**
 * Installer plugin
 */
class InstallerPlugin implements PluginInterface
{
    /**
     * Activate plugin
     *
     * @param Composer $composer
     * @param IOInterface $io
     * @return void
     */
    public function activate(Composer $composer, IOInterface $io)
    {
        $installer = new ArikaimInstaller($io, $composer);
        $composer->getInstallationManager()->addInstaller($installer);
    }
}
