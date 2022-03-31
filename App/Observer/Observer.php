<?php

declare(strict_types=1);

namespace App\Observer;

use App\Security\Admin;
use App\Security\Connected;

class Observer
{
    private array $listeners = [];
    
    public function __construct()
    {
        array_push($this->listeners,(new Connected()),(new Admin()));
    }

    public function dispatch($event, $data){
        foreach($this->listeners as $listener) {
            if($listener->knowEvent($event)){
               $listener->notify($data);
            }
        }
        return $data;
    }
    
}