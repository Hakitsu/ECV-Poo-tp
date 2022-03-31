<?php

declare(strict_types=1);

namespace App\Controller;

use App\Elo\Encounter;
use App\Elo\Lobby;
use App\Infra\Memory\DbSelector;

class Elo implements Controller
{
    public function render()
    {
        $player1 = $_GET['player1'] ?? '';
        $player2 = $_GET['player2'] ?? '';

        try {
            $player1 = DbSelector::getConnector()::findPlayer($player1);
            $player2 = DbSelector::getConnector()::findPlayer($player2);
        } catch (\RuntimeException $e) {
            echo $e->getMessage();
            return;
        }

        echo sprintf(
            'Greg à %.2f%% chance de gagner face a Jade',
                Encounter::probabilityAgainst($player1, $player2) * 100
        ) . PHP_EOL;

        // Imaginons que greg l'emporte tout de même.
        Encounter::setNewLevel($player1, $player2, Encounter::RESULT_WINNER);
        Encounter::setNewLevel($player2, $player1, Encounter::RESULT_LOSER);

        echo sprintf(
            'les niveaux des joueurs ont évolués vers %s pour Greg et %s pour Jade',
            $player1->level,
            $player2->level
        );

        $lobby = new Lobby();
        $lobby->addPlayer($player1);
    }
}
