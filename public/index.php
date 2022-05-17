<?php

declare(strict_types=1);

spl_autoload_register(function ($fqcn): void {
    $path = str_replace('\\', '/', $fqcn);
    require_once __DIR__.'/../'.$path.'.php';
});

$router = APP\Routing\Router::getFromGlobals();
$router->getController();
