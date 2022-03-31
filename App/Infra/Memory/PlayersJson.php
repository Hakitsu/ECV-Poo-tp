<?php

declare(strict_types=1);

namespace App\Infra\Memory;

use App\Elo\Player;

class PlayersJson implements ConnectorInterface
{
    private const FILE_PATH = __DIR__ . '/../../../var/db.json';
    private static array $players = [];

    private static function loadFile()
    {
        if (empty(self::$players)) {
            self::$players = json_decode(file_get_contents(self::FILE_PATH), true);
        }

        return self::$players;
    }

    public static function addPlayer(Player $player)
    {
        self::loadFile();
        self::$players[] = $player;

        file_put_contents(self::FILE_PATH, json_encode(self::$players));
    }

    public static function findPlayer(string $name): Player
    {
        self::loadFile();

        $players = array_filter(self::$players, function($player) use($name) {
            return $player['name'] === $name;
        });

        if (count($players) > 1) {
            throw new \RuntimeException("More than one player found for $name");
        }

        if (count($players) === 0) {
            throw new \RuntimeException("No player found for $name");
        }

        $player = reset($players);
        return new Player($player['elo'], $player['name']);
    }
}
