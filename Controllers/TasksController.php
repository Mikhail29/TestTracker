<?php

namespace APP\Controllers;
use APP\Core\BaseController;
use APP\Models\TasksModel;
use APP\Core\User;

class TasksController extends BaseController
{
    public function createAction()
    {
        if($this->request->isPost())
        {
            $task["username"] = $this->request->post("username", false);
            $task["email"] = $this->request->post("email", false);
            $task["content"] = $this->request->post("content", false);
            $model = new TasksModel();
            if($model->insert($task))
            {
                $this->request->redirectTemporary();
            }
        }
    }
    
    public function editAction($task_id)
    {
        if(!User::isLogged())
        {
            $this->request->show404();
        }
        $model = new TasksModel();
        $task = $model->findFirst("id", $task_id);
        if($this->request->isPost())
        {
            $content = $this->request->post("content", false);
            if($task["content"] != $content)
            {
                $task = array();
                $task["admin_edit"] = 1;
            }
            else
            {
                $task = array();
            }
            $task["username"] = $this->request->post("username", false);
            $task["email"] = $this->request->post("email", false);
            $task["status"] = $this->request->post("status", false) === false ? 0 : 1;
            $task["content"] = $content;
            $model = new TasksModel();
            if($model->update("id", $task_id, $task))
            {
                $this->request->redirectTemporary();
            }
            $task["id"] = $task_id;
        }
        $this->setTemplateVar("task", $task);
    }
    
    public function deleteAction($task_id)
    {
        if(!User::isLogged())
        {
            $this->request->show404();
        }
        $model = new TasksModel();
        $model->delete("id", $task_id);
        $this->request->redirectTemporary();
    }
}