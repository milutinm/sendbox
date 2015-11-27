<?php
/**
 * Author: Milutin Milovanovic
 * Date: 27/11/15
 * Time: 00:55
 */

namespace app;

//error_reporting(E_ALL);
//ini_set("display_errors", 1);

define('BASE_DIR', dirname(getcwd()));

// define auto loader for MVC
function class_autoload($class)
{
   $filename = BASE_DIR . '/'. str_replace('\\', '/', $class) . '.php';
    require_once($filename);
}
spl_autoload_register('\app\class_autoload');


// get which controler and action to call
// TODO set with mode rewrite
$controller = isset($_GET['c']) ? $_GET['c'] : 'parser';
$action     = isset($_GET['a']) ? $_GET['a'] : 'index';

$controller = '\app\controller\\'.$controller;
$action     = $action.'Action';

// Loading controller
// TODO check if exists
$controllerClass = new $controller();

// call action
echo $controllerClass->$action();
