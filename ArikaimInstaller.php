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

use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;

class ArikaimInstaller extends LibraryInstaller
{

    protected $locations = [
        'arikaim-template'  => 'arikaim/view/templates',
        'arikaim-module'    => 'arikaim/modules',
        'arikaim-extension' => 'arikaim/extensions',
        'arikaim-library'   => 'arikaim/view/library'    
    ];

    public function getInstallPath(PackageInterface $package)
    {
        $package_name = $package->getPrettyName();
        $type = $package->getType();
        if (isset($this->locations[$type]) == false) {
            throw new \InvalidArgumentException("Not spupported package type: '$type' ");               
        }
        $path = $this->locations[$package_name];
        return $path;
    }

    public function supports($packageType)
    {
        return array_key_exists($packageType,$this->locations);
    }
}
