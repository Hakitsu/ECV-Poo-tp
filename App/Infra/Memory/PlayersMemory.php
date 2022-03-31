<?php

declare(strict_types=1);

namespace App\Infra\Memory;

use App\Elo\Player;

class PlayersMemory implements ConnectorInterface
{
    private static array $players = [
        ['level' => 800, 'name' => 'jade'],
        ['level' => 400, 'name' => 'greg']
    ];

    public static function addPlayer(Player $player)
    {
        return;
    }

    public static function findPlayer(string $name): Player
    {
        $players = array_filter(self::$players, function($player) use($name) {
            return $player['name'] === $name;
        });

        //$players = array_filter(self::$players, fn($player) => $player->name === $name);

        if (count($players) > 1) {
            throw new \RuntimeException("More than one player found for $name");
        }

        if (count($players) === 0) {
            throw new \RuntimeException("No player found for $name");
        }

        $player = reset($players);
        return new Player($player['elo'], $player['name']);
//
//        if (null !== $player = (self::$players[$name] ?? null)) {
//            return new Player($player['elo'], $name);
//        }
//
//        throw new \RuntimeException("Player $name not found");
    }
}
