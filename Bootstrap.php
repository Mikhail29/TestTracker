<?php

namespace APP;

class Bootstrap 
{
    public function start()
    {
        require_once BASE_PATH."/Core/Autoloader.php";
        
        $app = new Core\AppCore();
        
        $app->handle();
    }
}