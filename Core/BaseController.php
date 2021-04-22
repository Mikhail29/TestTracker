<?php
namespace APP\Core;

class BaseController
{
    private $title = "Тест сайт", $description = "Тест сайт", $templateData;
    protected $request;
    
    function __construct($request)
    {
        $this->request = $request;
        $this->templateData = new \STDClass();
    }
    
    public function setTitle($title = "Тест сайт")
    {
        $this->title = $title;
    }
    
    public function setDescription($description = "Тест сайт")
    {
        $this->description = $description;
    }
    
    public function getTitle()
    {
        return $this->title;
    }
    
    public function getDescription()
    {
        return $this->description;
    }
    
    public function setTemplateVar($key, $value)
    {
        $this->templateData->{$key} = $value;
    }
    
    public function getTemplateVars()
    {
        return $this->templateData;
    }
}