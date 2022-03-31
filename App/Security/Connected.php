<?php

declare(strict_types=1);

namespace App\Security;

class Connected
{
    public array $protectedRoutes = [
        'players/add'
    ];

    public function knowEvent($event){
        return $event === 'security';
        
    }

    public function notify($data){
        if ($_SESSION['is_connected'] !== true && in_array($data::getPath(), $this->protectedRoutes))
        {
            header('HTTP 1/1 401 Unauthorized');
            die;
        }
        
        return $data;
    }
}