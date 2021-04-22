<?php
namespace APP\Core;
use APP\Core\User;

class AppCore
{
    private $request;
    
    public $template;
    
    public function handle()
    {
        $this->request = new Request();
        $contollerName = $this->request->getControllerName();
        $actionName = $this->request->getActionName();
        $params = $this->request->getParams();
        $controllerClass = "\APP\Controllers\\".$contollerName;
        if(!class_exists($controllerClass))
        {
            header("HTTP/1.0 404 Not Found");
            exit();
        }
        $controller = new $controllerClass($this->request);
        call_user_func_array(array($controller, $actionName), $params);
        $this->template = $controller->getTemplateVars();
        $this->template->title = $controller->getTitle();
        $this->template->description = $controller->getDescription();
        $template = new Template();
        $template->render($contollerName, $actionName, $this->template, $this->request);
    }
}