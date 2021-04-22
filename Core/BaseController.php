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
    
    public function get_paginations($active = 1, $count_show_pages, $itemsPerPage = 3, $cont_items)
    {
        $count_pages = 0;
        
        $i = 0;
        while($i < $cont_items)
        {
            $i += $itemsPerPage;
            $count_pages++;
        }

        if ($count_pages > 1) {
            $left = $active - 1;
            $right = $count_pages - $active;
            if ($left < floor($count_show_pages / 2)) $start = 1;
            else $start = $active - floor($count_show_pages / 2);
            $end = $start + $count_show_pages - 1;
            if ($end > $count_pages) {
              $start -= ($end - $count_pages);
              $end = $count_pages;
              if ($start < 1) $start = 1;
            }
            $first_page = $this->request->buildLink($this->request->getRequestString());
            $getParams = "";
            foreach($this->request->getAllGetParams() as $key => $value)
            {
                if($key != "page" && $key != "_url")
                {
                    $key= urlencode($key);
                    $value= urlencode($value);
                    if(empty($getParams))
                    {
                        $getParams = "?{$key}={$value}";
                    }
                    else 
                    {
                        $getParams .= "&{$key}={$value}";
                    }
                }
            }
            if(empty($getParams))
            {
                $page_template = $first_page.$getParams."?page=";
            }
            else
            {
                $page_template = $first_page.$getParams."&page=";
            }
            $first_page .= $getParams;
            ob_start();
            require BASE_PATH."/Views/assets/paginator.php";
    		$content = ob_get_clean();
    		return $content;
        }
        return "";
    }

}