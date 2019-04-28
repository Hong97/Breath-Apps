<?php
date_default_timezone_set("Asia/Kuala_Lumpur");
error_reporting(E_ALL);
session_start();
ini_set('display_errors', 1);
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/PHPMailer-master/src/PHPMailer.php';
require __DIR__ . '/PHPMailer-master/src/SMTP.php';
require __DIR__ . '/PHPMailer-master/src/Exception.php';


// constant
define('PATH_ROOT', __DIR__);
define('URL_BASE', 'http://localhost/breath-apps');

// route
$route = isset($_GET['_r']) ? $_GET['_r'] : null;
$routeParts = explode('/', $route);

// controller
$controllerId = $route === null ? 'home' : $routeParts[0];
$actionsId = isset($routeParts[1]) ? $routeParts[1] : 'index';
$actionsId = $actionsId ? $actionsId : 'index';

$controllerClassName = classify($controllerId);
$controllerNamespace = 'app\\controllers';

$controllerClass = $controllerNamespace . '\\' . $controllerClassName . 'Controller';
if (class_exists($controllerClass)) {
	$methodName = 'action' . classify($actionsId);
	$controller = new $controllerClass;
	if (method_exists($controller, $methodName)) {
		call_user_func_array([$controller, $methodName], []);
		exit;
	} else {
		pageNotFound();
	}
} else {
	pageNotFound();
}

function classify($handlerString)
{
	$handlerStringParts = explode('-', $handlerString);
	foreach ($handlerStringParts as $index => $handlerStringPart)
	{
		$handlerStringParts[$index] = ucfirst($handlerStringPart);
	}
	return implode('', $handlerStringParts);;
}


// $controller = new \app\controllers\HomeController;
// $controller->actionIndex();

// print_r($_GET); 