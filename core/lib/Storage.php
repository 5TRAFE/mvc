<?php
Class Storage {
    private static $container = [];

    public static function set($key, $value)
    {
        if(!isset(self::$container[$key]))
            self::$container[$key] = $value;
        else
            trigger_error('Variable '. $key .' already defined', E_USER_WARNING);
        return false;
    }

    public static function get($key)
    {
        if(isset(self::$container[$key])) {
            return self::$container[$key];
        }
        if($key == 'get'){
            return false;
        }
        trigger_error('Variable '. $key .' not defined', E_USER_WARNING);
        return false;
    }


}