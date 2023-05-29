<?php

session_start();

ini_set('show_errors', 'On');
ini_set('display_errors', 1);
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

function __autoload($className) {
    include_once $className . '.php';
}

?>
