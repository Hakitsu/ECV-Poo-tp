<?php

declare(strict_types=1);

namespace App\Controller;

// ce n'est pas un controller
class LoadWords
{
    public const FILE_PATH = __DIR__.'/../../Model/Mot.json';
    public array $words = [];

    // method = function
    // charge les mots
    public function loadWords(): void
    {
        if (empty($this->words)) {
            $this->words = json_decode(file_get_contents(self::FILE_PATH), true);
        }
    }
}
