<?php

declare(strict_types=1);

namespace App\Controller;

class Logout implements Controller
{
    public function render()
    {
        session_destroy();
    }
}
