<?php

namespace APP\Controllers;
use APP\Core\BaseController;
use APP\Core\User;

class AuthController extends BaseController
{
    public function loginAction()
    {
        if(User::isLogged())
        {
            header("HTTP/1.0 404 Not Found");
            exit();
        }
        if($this->request->isPost())
        {
            $login = $this->request->post("login", false);
            $password = $this->request->post("password", false);
            if($login === false || $password === false)
            {
                $this->request->addMessage("Неверный логин или пароль.", "alert alert-danger");
            }
            else 
            {
                if($login != "admin" || $password != "123")
                {
                    $this->request->addMessage("Неверный логин или пароль.", "alert alert-danger");
                }
                else
                {
                    User::login($login, $password);
                    $this->request->redirect();
                }
            }
        }
    }
    
    public function logoutAction()
    {
        if(!User::isLogged())
        {
            header("HTTP/1.0 404 Not Found");
            exit();
        }
        User::logout();
        $this->request->redirect();
    }
}