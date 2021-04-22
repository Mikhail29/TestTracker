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
                $this->request->redirect();
            }
        }
    }
    
    public function editAction()
    {
        if(!User::isLogged())
        {
            header("HTTP/1.0 404 Not Found");
            exit();
        }
    }
    
    public function toogleCompleteAction($task_id)
    {
        if(!User::isLogged())
        {
            header("HTTP/1.0 404 Not Found");
            exit();
        }
    }
    
    public function deleteAction($task_id)
    {
        if(!User::isLogged())
        {
            header("HTTP/1.0 404 Not Found");
            exit();
        }
        $model = new TasksModel();
        $model->delete("id", $task_id);
        $this->request->redirectTemporary();
    }
}