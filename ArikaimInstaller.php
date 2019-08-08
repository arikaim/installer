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
    /**
     * Locations
     *
     * @var array
     */
    protected $locations = [
        'arikaim-template'  => 'arikaim/view/templates',
        'arikaim-module'    => 'arikaim/modules',
        'arikaim-extension' => 'arikaim/extensions',
        'arikaim-library'   => 'arikaim/view/library',
        'arikaim-component'  => 'arikaim/view/components',    
    ];

    /**
     * Get install path
     *
     * @param PackageInterface $package
     * @return string
     */
    public function getInstallPath(PackageInterface $package)
    {
        $package_name = $package->getPrettyName();
        $type = $package->getType();
        $extra = $package->getExtra();
        $path = (isset($extra['path']) == true) ? DIRECTORY_SEPARATOR . $extra['path'] : "";
           
        if (isset($this->locations[$type]) == false) {
            throw new \InvalidArgumentException("Not spupported package type: '$type' ");               
        }
        return $this->locations[$type] . $path;
    }

    /**
     *  Return trye if package type is supported
     *
     * @param string $packageType
     * @return boolean
     */
    public function supports($package_type)
    {
        return array_key_exists($package_type,$this->locations);
    }
}
