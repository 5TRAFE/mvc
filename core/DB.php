<?php
Class DB{
    

    private function __construct()
    {
    }

    public static function getConnection()
    {
        $params = [
            'host' => 'localhost',
            'db' => 'Eshop',
            'user' => 'root',
            'password' => ''
        ];
        $dsn = "mysql:host={$params['host']};dbname={$params['db']}";
        $db = new PDO($dsn, $params['user'], $params['password'],  [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

        return $db;
    }
}