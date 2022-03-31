<?php

declare(strict_types=1);

namespace App\Elo;

class PlayerFactory
{
    public static function createFromURL(): Player
    {
        $name = $_GET['name'] ?? null;
        $elo = (int) ($_GET['elo'] ?? 400);

        return new Player($elo, $name);
    }
}
