<?php
Class Loader
{
    static function go($class_name)
    {

        $array_paths = [
            '/models/',
            '/core/',
            '/core/lib/',
            '/controllers/',
            '/config/',
        ];

        foreach ($array_paths as $path) {

            $path = ROOT . $path . $class_name . '.php';

            if (is_file($path)) {
                require_once $path;
            }
        }

    }
}