<?php

declare(strict_types=1);

namespace App\Routing;

use App\Controller\MotusController;

class Router
{
    private array $routes = [
        '/' => MotusController::class,
    ];

    private static $path;

    private static ?Router $router = null;

    private function __construct()
    {
        self::$path = $_SERVER['PATH_INFO'] ?? '/';
    }

    public static function getFromGlobals()
    {
        if (null === self::$router) {
            self::$router = new self();
        }

        return new self();
    }

    public function getController(): void
    {
        $controllerClass = $this->routes[self::$path] ?? $this->routes['/'];
        // appel classe inconnue -> déclenche spl_autoload_register
        $controller = new $controllerClass();
        $controller->render();
    }
}
