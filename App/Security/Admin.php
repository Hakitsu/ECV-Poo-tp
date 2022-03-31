<?php

declare(strict_types=1);

namespace App\Security;

class Admin
{
    public array $protectedRoutes = [
        'players/add'
    ];

    public function knowEvent($event){
        return $event === 'security';

    }

    public function notify($data){
        if ($_SESSION['admin'] !== true && in_array($data::getPath(), $this->protectedRoutes))
        {
            header('HTTP 1/1 403 forbidden');
            die;
        }
        
        return $data;
    }
}