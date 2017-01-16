<?php
$controller = isset($_REQUEST['controller']) ? strtolower($_REQUEST['controller']) : 'home';
$action     = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'index';

require_once __DIR__ . "/../../ctl/$controller.php";

$controller = ucwords($controller) . 'Controller';
$controller = new $controller($action);

call_user_func(array(
  $controller,
  $action
));
?>
