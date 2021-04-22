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
        $realPage = $this->request->get("task_page", 0);
        $offset = $realPage * 3;
        $tasks = $model->find($offset, 3);
        $this->setTemplateVar("tasks", $tasks);
    }
}