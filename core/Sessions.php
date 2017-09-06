<?php
class Sessions {

    private static $error = [];

    /**
     * @return array
     */
    public static function setSession(){
        self::$error = &$_SESSION;
    }

    public static function getErrors()
    {
        if(isset(self::$error['messages'])){

        return self::$error['messages'];

        }
        return [];
    }

    /**
     * @param array $error
     */
    public static function setError($error)
    {
        self::$error['messages']['errors'][] = $error;
    }

    public static function setMessage($error)
    {
        self::$error['messages']['message'][] = $error;
    }

    public static function unsetErrors()
    {
        unset(self::$error['messages']['errors']);
        unset(self::$error['messages']['message']);
    }


}