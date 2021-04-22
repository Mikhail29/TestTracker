<?php

namespace APP\Core;
use APP\Core\User;

class Template
{
    public $template, $request, $userLogged;
    
    public function render($contollerName, $actionName, $template, $request)
    {
        $this->template = $template;
        $this->request = $request;
        $this->userLogged = User::isLogged();
        $controllerViewDir = strtolower(str_replace("Controller", "", $contollerName));
        $actionViewFile = strtolower(str_replace("Action", "", $actionName));
        ob_start();
        require_once BASE_PATH."/Views/controllers/{$controllerViewDir}/{$actionViewFile}.php";
        $this->template->controllerView = ob_get_clean();
        ob_start();
        require_once BASE_PATH."/Views/main.php";
        echo ob_get_clean();
    }
}