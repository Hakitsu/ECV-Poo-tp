<?php
declare (strict_types = 1);

namespace  APP\Routing;

use App\Controller\Error404;
use App\Controller\Welcome;

    class router{
    
    private array $routes = [
        '/' => Welcome::class,
        //'/' => \App\Controller\Welcome::class,
        '/404' => Error404::class
    ];

    private static $path;

    private static ?Router $router = null;

    private function __construct()
    {
        self::$path = $_SERVER['PATH_INFO'] ?? '/'; 
    }

    public static function getFromGlobals()
    {
        if(self::$router === null){
            self::$router = new self();
        }

        return new self;
    }

    public function getController()
        {
            $controllerClass = $this->routes[self::$path] ?? $this->routes['/404'];
            //appel classe inconnue -> déclenche spl_autoload_register
            $controller = new $controllerClass();
            $controller->render();
            $controller->getWordJson();
            $controller->cookie();
        }
    }
?>