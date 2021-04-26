<?php

namespace APP\Core;

class Request
{
    private $controllerName = "Index", $actionName = "index", $params = array(), $requestString;
    
    function __construct()
    {
        $requestString = "/index/index";
        if(array_key_exists("_url", $_GET))
        {
            $requestString = filter_var($_GET["_url"], FILTER_SANITIZE_URL);
        }
        $requestString = preg_replace("/^\//", "", $requestString);
        $this->requestString = $requestString;
        $requestString = strtolower($requestString);
        $requestParts = explode("/", $requestString);
        unset($requestString);
        if(count($requestParts) > 0)
        {
            $this->controllerName = $requestParts[0];
            unset($requestParts[0]);
        }
        if(count($requestParts) > 0)
        {
            $this->actionName = $requestParts[1];
            unset($requestParts[1]);
        }
        if(count($requestParts) > 0)
        {
            $this->params = $requestParts;
        }
        unset($requestParts);
    }
    
    public function getRequestString()
    {
        return isset($_GET["_url"]) && !empty(filter_var($_GET["_url"], FILTER_SANITIZE_URL)) ? filter_var($_GET["_url"], FILTER_SANITIZE_URL) : "";
    }
    
    public function getControllerName()
    {
        return ucfirst($this->controllerName)."Controller";
    }
    
    public function getActionName()
    {
        return $this->actionName."Action";
    }
    
    public function getParams()
    {
        return $this->params;
    }
    
    public function buildLink($link = "")
    {
        $link = preg_replace("/^\//", "", $link);
        $config = Config::getConfig();
        
        return $config->publicUrl.$link;
    }
    
    public function get($key, $default=null)
    {
        if(array_key_exists($key, $_GET))
        {
            return filter_var($_GET[$key], FILTER_SANITIZE_URL);
        }
        else 
        {
            return $default;
        }
    }
    
    public function getAllGetParams()
    {
        $get_params = array();
        foreach($_GET as $key => $value)
        {
            $get_params[filter_var($key, FILTER_SANITIZE_URL)] = filter_var($value, FILTER_SANITIZE_URL);
        }
        return $get_params;
    }
    
    public function post($key, $default=null)
    {
        if(array_key_exists($key, $_POST))
        {
            return filter_input(INPUT_POST, $key);
        }
        else 
        {
            return $default;
        }
    }
    
    public function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }
    
    public function redirect($link = "")
    {
        $link = preg_replace("/^\//", "", $link);
        $config = Config::getConfig();
        
        $link = $config->publicUrl.$link;
        header("HTTP/1.1 301 Moved Permanently"); 
        header("Location: {$link}");
        exit(); 
    }
    
    public function redirectTemporary($link = "")
    {
        $link = preg_replace("/^\//", "", $link);
        $config = Config::getConfig();
        
        $link = $config->publicUrl.$link;
        header("HTTP/1.1 302 Found"); 
        header("Location: {$link}");
        exit(); 
    }
    
    public function addMessage($text = "", $class="alert alert-success")
    {
        $_SESSION["messages"][] = array("class" => $class, "message" => $text);
    }
    
    public function getMessages()
    {
        $messages = $_SESSION["messages"];
        $_SESSION["messages"] = array();
        return $messages;
    }
    
    public function show404()
    {
        header("HTTP/1.0 404 Not Found");
        exit();
    }
}