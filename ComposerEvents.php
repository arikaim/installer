<?php
/**
 * Arikaim
 *
 * @link        http://www.arikaim.com
 * @copyright   Copyright (c)  Konstantin Atanasov <info@arikaim.com>
 * @license     http://www.arikaim.com/license
 * 
 */
namespace Arikaim\Installer;

use Composer\Script\Event;
use Composer\Installer\PackageEvent;
use Closure;

/**
 * Composer events
 */
class ComposerEvents
{   
    /**
     * On update callback
     *
     * @var Closure|null
     */
    protected static $onPackageUpdateCallback = null;

    /**
     * On install callback
     *
     * @var Closure|null
     */
    protected static $onPackageInstallCallback = null;

    /**
     * Set on update callback
     *
     * @param Closure $callback
     * @return void
     */
    public static function onPackageUpdate($callback): void
    {
        Self::$onPackageUpdateCallback = $callback;
    }

    /**
     * Set on install callback
     *
     * @param Closure $callback
     * @return void
    */
    public static function onPackageInstall($callback): void
    {
        Self::$onPackageInstallCallback = $callback;
    }

    /**
     * Composer post-package-install event
     *
     * @param PackageEvent $event
     * @return void
     */
    public static function postPackageInstall(PackageEvent $event)
    {      
        Self::callback(Self::$onPackageInstallCallback,$event);
    }
    
    /**
     * Composer post-package-update event
     *
     * @param PackageEvent $event
     * @return void
    */
    public static function postPackageUpdate(PackageEvent $event)
    {       
        Self::callback(Self::$onPackageUpdateCallback,$event);
    }

    /**
     * Callback helper
     *
     * @param Closure|null $callback
     * @param mixed $event
     * @return void
     */
    private static function callback($callback, $event): void
    {
        if (\is_callable($callback) == true) {
            $callback($event);
        }        
    }
}
