<?php

session_start();

require_once '../config/config.php';
require_once CORE_PATH . '/MyAutoLoader.php';

$path = array();

if (isset($_GET["path"])) {
	$fullPath = $_GET["path"];
	$path = explode('/', $fullPath);
}

$controller = isset($path[0]) ? $path[0] : LANDING_PAGE;
$method = isset($path[1]) && isset($path[1][0]) ? $path[1] : 'index';

$className = ucfirst($controller);

// Fully qualified class name
$fqclassName = '\controller\\' . $className;

if ( ! class_exists($fqclassName)) { 
    $object = new \controller\NotFound(); 
} else {
    $object = new $fqclassName($method); 
} 
