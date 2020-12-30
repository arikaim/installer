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
    protected static $onUpdateCallback = null;

    /**
     * On install callback
     *
     * @var Closure|null
     */
    protected static $onInstallCallback = null;

    /**
     * Set on update callback
     *
     * @param Closure $callback
     * @return void
     */
    public static function onUpdate($callback): void
    {
        Self::$onInstallCallback = $callback;
    }

    /**
     * Set on install callback
     *
     * @param Closure $callback
     * @return void
    */
    public static function onInstall($callback): void
    {
        Self::$onUpdateCallback = $callback;
    }

    /**
     * Composer post-package-install event
     *
     * @param PackageEvent $event
     * @return void
     */
    public static function postPackageInstall(PackageEvent $event)
    {
        $package = $event->getOperation()->getPackage();
        Self::callback(Self::$onInstallCallback,$package);
    }
    
    /**
     * Composer post-package-update event
     *
     * @param PackageEvent $event
     * @return void
    */
    public static function postPackageUpdate(PackageEvent $event)
    {
        $package = $event->getOperation()->getPackage();
        Self::callback(Self::$onUpdateCallback,$package);
    }

    /**
     * Callback helper
     *
     * @param Closure|null $callback
     * @param mixed $param
     * @return void
     */
    private static function callback($callback, $param): void
    {
        if (\is_callable($callback) == true) {
            $callback($param);
        }        
    }
}
