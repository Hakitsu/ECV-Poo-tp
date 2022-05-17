<?php

declare(strict_types=1);

namespace App\Controller;

// ça manque de quoi proposer la saisie, comme un input
class MotusController
    {
        public string $word;

        public function beginParti(): void
        {
            // Appel du constructeur SelectWord -> Instancie loadWorld et les mettent dans $words
            $this->selectWord = new selectWord();

            // Appel method getWord -> return un mot
            $this->word = $this->selectWord->getWord();

            // Set les cookies
            $this->cookie();
            header('location:http://localhost:8000/');
        }

        // SelectWordController
        public function cookie(): void
        {
            setcookie('findWord', $this->word, time() + 60 * 60 * 24);
            setcookie('try', '0', time() + 60 * 60 * 24);
        }

        public function firstFindLetter(): void
        {
            // ne jamais utiliser une fonction dans l'expression d'un for.
            // ça coute cher en cpu
            for ($i = 0; $i < \strlen($_COOKIE['findWord']); ++$i) {
                if (0 === $i) {
                    echo $_COOKIE['findWord'][$i];
                }
                if (0 !== $i) {
                    echo ' _';
                }
            }
        }

        // dommage que la logique soit mélangée à l'affichage.
        // ce n'est pas très propre :/
        public function checkLetter(): void
        {
            if (empty($_GET['write'])) {
                exit;
            }
            $try = $_GET['write'];

            if (isset($_COOKIE['findLetter'])) {
                $letterIsFinding = json_decode($_COOKIE['findLetter'], true);
            }
            if (\strlen($try) !== \strlen($_COOKIE['findWord'])) {
                echo '<br>Mot invalide : lettre manquant / en trop';
                exit;
            }
            for ($i = 0; $i < \strlen($try); ++$i) {
                if ($_COOKIE['findWord'][$i] === $try[$i]) {
                    echo '<span style="color: lime">'.$_COOKIE['findWord'][$i].' </span>';
                    $findLetterWord[$i] = $try[$i];
                    if (!isset($letterIsFinding[$i])) {
                        $letterIsFinding[$i] = $findLetterWord[$i];
                    }
                }
                if ($_COOKIE['findWord'][$i] !== $try[$i]) {
                    if (strpos($_COOKIE['findWord'], $try[$i])) {
                        echo '<span style="color: orange" >'.$try[$i].' </span>';
                    } else {
                        echo '<span>'.$try[$i].' </span>';
                    }
                }
            }
            echo '<br>';
            setcookie('findLetter', json_encode($letterIsFinding), time() + 60 * 60 * 24);

            if (\count($letterIsFinding) !== \strlen($_COOKIE['findWord'])) {
                // $numberTry => 1
                $numberTry = (int) ($_COOKIE['try']) + 1;
                setcookie('try', (string) $numberTry);

                if ($_COOKIE['try'] >= 6) {
                    echo '<br>perdu, le mot a trouver était : '.$_COOKIE['findWord'].'<br> Revenez demain ! <br>';
                }
            } else {
                echo '<br>Bravo, le mot a trouver était : '.$_COOKIE['findWord'].'<br> Revenez demain !';
            }
        }

        // essai d'éviter les else autant que possible en inversant les tests pour éviter ce genre d'imbrications.
        public function letterFinding(): void
        {
            // echo str_pad($_COOKIE['findWord'][0],strlen($_COOKIE['findWord']),"_",STR_PAD_RIGHT);
            if (isset($_COOKIE['findLetter'])) {
                $letterFinding = json_decode($_COOKIE['findLetter'], true);
                for ($i = 0; $i < \strlen($_COOKIE['findWord']); ++$i) {
                    if (0 === $i) {
                        echo $_COOKIE['findWord'][$i];
                    } elseif (isset($letterFinding[$i]) && $_COOKIE['findWord'][$i] === $letterFinding[$i]) {
                        echo ' '.$letterFinding[$i];
                    } else {
                        echo ' _';
                    }
                }
                echo '<br>';
            } else {
                for ($i = 0; $i < \strlen($_COOKIE['findWord']); ++$i) {
                    if (0 === $i) {
                        echo $_COOKIE['findWord'][$i];
                    }
                    if (0 !== $i) {
                        echo ' _';
                    }
                }
            }
        }

        public function render(): void
        {
            if (!isset($_COOKIE['findWord']) && !isset($_COOKIE['try'])) {
                $this->beginParti();
            }
            if (isset($_COOKIE['try']) && 0 === $_COOKIE['try']) {
                $this->firstFindLetter();
            } else {
                $this->letterFinding();
            }
            $this->checkLetter();
        }
    }
