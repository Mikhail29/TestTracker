<?php

namespace APP\Controllers;
use APP\Core\BaseController;
use APP\Models\TasksModel;

class IndexController extends BaseController
{
    public function indexAction()
    {
        $model = new TasksModel();
        $tasksPerPage = 3;
        $realPage = $this->request->get("page", 1) - 1;
        $page = $this->request->get("page", 1);
        $offset = $realPage * 3;
        $sort = $this->request->get("sort", "id");
        $order = $this->request->get("order", "asc");
        $tasks = $model->find($offset, 3, $sort, $order);
        $show_pages = 5;
        $count = $model->getCount();
        
        $paginator = $this->get_paginations($page, $show_pages, 3, $count);
        
        $this->setTemplateVar("tasks", $tasks);
        $this->setTemplateVar("paginator", $paginator);
    }
}