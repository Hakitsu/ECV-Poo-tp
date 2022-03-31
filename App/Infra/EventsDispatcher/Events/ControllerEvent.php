<?php

declare(strict_types=1);

namespace App\Infra\EventsDispatcher\Events;

use App\Controller\Controller;
use App\Infra\EventsDispatcher\Event;
use App\Routing\Router;

class ControllerEvent extends Event
{
    public function __construct(public Controller $controller, public Router $router)
    {
    }
}
// interface Design{
//     public function callDesign() : string;
// }

// class designIs implements Design
// {
//     public function callDesign(): string
//     {
//         return "Je suis"; 
//     }
// }


// class decorator implements Design
// {
//     protected $design;
//     public function __construct(Design $design)
//     {
//         return $this->design = $design;
//     }

//     public function callDesign(): string
//     {
//         return $this->design->callDesign();
//     }
// }

// class dev extends decorator
// {
//     public function callDesign(): string
//     {
//         return parent::callDesign().'dev';
//     }
// }

// class notDev extends decorator
// {
//     public function callDesign(): string
//     {
//         return parent::callDesign().'pas dev';
//     }
// }

// function echoCode(design $Design){
//     echo $Design->callDesign();
// }

// $is = new designIs();
// $dev = new dev($is);
// echo $dev; 

// // mettre le decorateur ICI
// // mettre un decorateur USER
// // mettre un decorateur ADMIN
// // mettre un if  admin : déco ADMIN ? déco USER