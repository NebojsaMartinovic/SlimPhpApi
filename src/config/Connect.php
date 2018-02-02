<?php

require_once 'config.php';

class Connect{
    private static $_instance = null;

    private function __construct(){}

    public static function getInstance(){
        if(is_null(self::$_instance)){
            $dsn = 'mysql:host='.DBHOST.';dbname='.DBNAME;
            $options = array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );
            self::$_instance = new PDO($dsn,DBUSER,DBPASS,$options);
        }
        return self::$_instance;
    }
}
