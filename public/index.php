<?php

define('BASE_PATH', dirname(__DIR__));
define('CORE_PATH', BASE_PATH . '/Core');

session_start();
require_once BASE_PATH . '/Bootstrap.php';
$bootstrap = new APP\Bootstrap();
$bootstrap->start();