<?php

spl_autoload_register(function ($class) {
    $path = str_replace("APP\\", "", $class);
    $path = str_replace("\\", DIRECTORY_SEPARATOR, $path);
    $path = BASE_PATH.DIRECTORY_SEPARATOR.$path.".php";
    if ( file_exists( $path ) ) 
    {
	    include_once( $path );
	}
});