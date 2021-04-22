<?php
namespace APP\Core;

class Config
{
    public static function getConfig()
    {
        
        $config;
        if(file_exists(BASE_PATH."/config/config.dev.php"))
        {
            $config = require BASE_PATH."/config/config.dev.php";
        }
        else 
        {
            $config = require BASE_PATH."/config/config.php";
        }
        
        if(
            is_array($config) 
            && array_key_exists("publicUrl", $config)
            && array_key_exists("dbHost", $config)
            && array_key_exists("dbName", $config)
            && array_key_exists("dbUserName", $config)
            && array_key_exists("dbUserPassword", $config)
        )
        {
            return json_decode(json_encode($config), FALSE);
        }
        else
        {
            die("Not valid config.");
        }
    }
}