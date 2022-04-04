<?php
    declare (strict_types = 1);
    namespace App\Controller;

    
    class Welcome{
        private const FILE_PATH = __DIR__ . '/../../mots/mot.json';
        private static array $words = [];
        public string $word;


        public function getWordJson(){
            {
                if (empty(self::$words)) {
                    self::$words = json_decode(file_get_contents(self::FILE_PATH), true);
                }
            }
            echo count(self::$words).'</br>';

            for($i=0;$i<count(self::$words);$i++){
                echo self::$words[$i]['name'].'</br>';
            }

            $this->word = self::$words[mt_rand(0,count(self::$words)-1)]['name'];
            echo '</br>';

            return $this->word;
        }
        
        public function cookie(){
            if(empty($_COOKIE['findWord'])){
                setcookie('findWord',$this->word);
            }
            if(empty($_COOKIE['try'])){
                setcookie('try','0');
            }
            echo $_COOKIE['findWord'].',';
            echo $_COOKIE['try'];
        }

            
        public function render(){
            echo "welcome </br></br>";
          }
        }
?>