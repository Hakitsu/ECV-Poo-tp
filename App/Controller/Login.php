<?php

declare(strict_types=1);

namespace App\Controller;

class Login implements Controller
{
    public function render()
    {
        $_SESSION['is_connected'] = true;
    }
}
