<?php

declare(strict_types=1);

namespace App\Controller;

use App\Elo\PlayerFactory;
use App\Infra\Memory\DbSelector;

class NewPlayer implements Controller
{
    public function render()
    {
        $player = PlayerFactory::createFromURL();
        DbSelector::getConnector()::addPlayer($player);
    }
}
