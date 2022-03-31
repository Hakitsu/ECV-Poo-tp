<?php

declare(strict_types=1);

namespace App\Elo;

class WaitingPlayerFactory
{
    public static function createFromPlayer(Player $player): WaitingPlayer
    {
        return new WaitingPlayer($player->level, $player->name);
    }
}
