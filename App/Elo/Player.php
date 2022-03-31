<?php

declare(strict_types=1);

namespace App\Elo;

class Player
{
    public function __construct(public int $level = 400, public ?string $name = 'anonymous')
    {
    }
}
