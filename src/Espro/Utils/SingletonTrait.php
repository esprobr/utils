<?php
namespace Espro\Utils;

/**
 * Trait SingletonTrait
 * @package Espro\Utils
 */
trait SingletonTrait
{
    /**
     * @var SingletonTrait
     */
    protected static $instance = null;

    /**
     * @return SingletonTrait
     */
    public static function getInstance()
    {
        if(is_null(self::$instance)) {
            $args = func_get_args();
            $class = __CLASS__;
            self::$instance = new $class(...$args);
        }
        return self::$instance;
    }
}