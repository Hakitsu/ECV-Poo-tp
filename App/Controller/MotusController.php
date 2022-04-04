<?php
    declare (strict_types = 1);
    namespace App\Controller;

    
    class MotusController{
        private const FILE_PATH = __DIR__ . '/../../Model/Mot.json';
        private static array $words = [];
        public string $word;
        public array $letterWord = [];

        // DataLoadingController 
        
        //
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
            
            // PIF 
            $this->word = self::$words[mt_rand(0,count(self::$words)-1)]['name'];
            echo '</br>';

            return $this->word;
        }
        
        // SelectWordController
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

        // SPLIT en array->lettre 
        // pour chaque lettre qui possède -> On affiche un " _ "

        public function numberLetter(){
            for ($i=0; $i < strlen($_COOKIE['findWord']);$i++){
                $letterTab[$i] = $_COOKIE['findWord'][$i];
            }
            print_r($letterTab);
            echo "<br><br><br>";
            return $letterTab;
        }

        public function findLetter(){
            for ($i=0; $i < strlen($_COOKIE['findWord']); $i++) { 
                if($i == 0){
                   echo $_COOKIE['findWord'][$i];
                }
                if($i != 0){
                    echo " _";
                }
            }
        }

        public function checkLetter(){
            $try = $_GET['write'];
            if(empty($try)){
                exit;
            }
            echo "<br>";
            for ($i=0; $i < strlen($try);$i++){
                if($_COOKIE['findWord'][$i] == $try[$i]){
                    echo " ".$_COOKIE['findWord'][$i];
                }
                if ($_COOKIE['findWord'][$i] != $try[$i]) {
                    echo " _";
                }
            }
            
        }


        public function render(){
            echo "welcome </br></br>";
          }
        }
?>