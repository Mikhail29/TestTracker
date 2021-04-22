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
            $this->request->show404();
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
                    $this->request->redirectTemporary();
                }
            }
        }
    }
    
    public function logoutAction()
    {
        if(!User::isLogged())
        {
            $this->request->show404();
        }
        User::logout();
        $this->request->redirectTemporary();
    }
}