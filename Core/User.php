<?php

namespace APP\Core;

class User
{
    public static function isLogged()
    {
        if(!array_key_exists("authToken", $_COOKIE))
        {
            return false;
        }
        $loginToken = hash("sha256", "appTestTracker".hash("sha256", "admin").hash("sha256", "123"));
        $cookieToken = $_COOKIE["authToken"];
        if($loginToken == $cookieToken)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    public static function login($login, $password)
    {
        $loginToken = hash("sha256", "appTestTracker".hash("sha256", $login).hash("sha256", $password));
        setcookie("authToken", $loginToken, time() + 60 * 60 * 24 * 30 * 12, "/");
    }
    
    public static function logout()
    {
        setcookie("authToken", "", 0, "/");
    }
}