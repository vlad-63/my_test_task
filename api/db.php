<?php

/*
 * Connect to MySQL
 */

class DB
{
    protected static $instance = null;

    public static function instance()
    {
        if (self::$instance === null)
        {
            $paramsPath = 'db_params.php';
            $params = include($paramsPath);
            $dsn = "mysql:host={$params['host']};dbname={$params['dbname']};charset={$params['charset']}";
            $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            ];
            self::$instance = new PDO($dsn, $params['user'], $params['password'], $opt);
        }
        return self::$instance;
    }

    public static function run($sql, $args = [])
    {
            if (!$args)
            {
                 return self::instance()->query($sql);
            }
        $stmt = self::instance()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }

}