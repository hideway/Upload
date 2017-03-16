<?php

namespace Config;

class Config {

    private static $_config;

    public static function load(){
        if(is_null(self::$_config)){
            self::$_config = [];
            self::$_config['app'] = require 'app.php';
            self::$_config['database'] = require 'database.php';
        }
        return self::$_config;
    }

}