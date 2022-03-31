<?php

declare(strict_types=1);

namespace App\Infra\Memory;

use App\Elo\Player;

interface ConnectorInterface
{
    public static function addPlayer(Player $player);

    public static function findPlayer(string $name): Player;
}
