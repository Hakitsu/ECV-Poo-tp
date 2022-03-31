<?php

declare(strict_types=1);

use App\EventsListener\IsAuthenticated;
use App\EventsListener\IsAdmin;
use App\EventsListener\IsDebug;
use App\Infra\EventsDispatcher\Dispatcher;
use App\Infra\EventsDispatcher\Events\RouterEvent;
use App\Infra\EventsDispatcher\Events\ControllerEvent;
use App\Infra\EventsDispatcher\Events\ContentEvent;
use App\Routing\Router;

session_start();

//$_SESSION['user'] = null;
//$_SESSION['user'] = ['isAdmin' => false];
$_SESSION['user'] = ['isAdmin' => true];

spl_autoload_register(function($fqcn) {
    $path = str_replace('\\', '/', $fqcn);
    require_once (__DIR__.'/../'.$path.'.php');
});

define('APP_ENV', 'dev');

$eventDispatcher = new Dispatcher();
$eventDispatcher->addListeners(new IsAuthenticated(), new IsAdmin(), new IsDebug());

$router = Router::getFromGlobals();

$eventDispatcher->dispatch($routerEvent = new RouterEvent($router));
$router = $routerEvent->router;

$controller = $router->getController();

$eventDispatcher->dispatch($controllerEvent = new ControllerEvent($controller, $router));
$controller = $controllerEvent->controller;

ob_start();
$controller->render();
$content = ob_get_clean();

$eventDispatcher->dispatch($contentEvent = new ContentEvent($content));
$content = $contentEvent->content;

echo $content;
