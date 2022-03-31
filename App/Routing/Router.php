<?php

declare(strict_types=1);

namespace App\Routing;

use App\Controller\Controller;
use App\Controller\Elo;
use App\Controller\Error404;
use App\Controller\Login;
use App\Controller\Logout;
use App\Controller\Toto;
use App\Controller\Welcome;
use App\Controller\NewPlayer;

class Router
{
    private array $routes = [
        '/' => Welcome::class,
        '/bidule' => Toto::class,
        '/404' => Error404::class,
        '/elo' => Elo::class,
        '/players/add' => NewPlayer::class,
        '/login' => Login::class,
        '/logout' => Logout::class
    ];

    private static string $path;

    private static ?Router $router = null;
    private static ?array $user = null;

    private function __construct()
    {
        self::$path = $_SERVER['PATH_INFO'] ?? '/';
        self::$user = $_SESSION['user'] ?? null;
    }

    public static function getFromGlobals(): Router
    {
        if (self::$router === null) {
            self::$router = new self();
        }

        return self::$router;
    }

    public function getController(): Controller
    {
        $controllerClass = $this->routes[self::$path] ?? $this->routes['/404'];
        $controller = new $controllerClass();

        if (!$controller instanceof Controller) {
            throw new \LogicException("controller $controllerClass should implement ".Controller::class);
        }

        return $controller;
    }

    public static function getUser(): ?array
    {
        return self::$user;
    }
}
