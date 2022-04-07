<?php
    declare (strict_types = 1);
    namespace App\Controller;

    
    class MotusController{
        public string $word;
        public array $letterWord = [];
        public array $findLetterWord = [];
        public SelectWord $selecWord;
        
        /*
        
        beginParti(){SelecWordController} -> safe cookie
        
        // Appel du constructeur SelectWord -> Instancie loadWorld et les mettent dans $words 
        $this->selectWord = new selectWord();

        // Appel method getWord -> return un mot 
        $this->word = $this->selectWord->getWord();

        $this->cookie() -> setcookie
        */
        
        public function beginParti(){
            // Appel du constructeur SelectWord -> Instancie loadWorld et les mettent dans $words 
            $this->selectWord = new selectWord();

            // Appel method getWord -> return un mot 
            $this->word = $this->selectWord->getWord();

            // Set les cookies
            $this->cookie();
        }

        // SelectWordController
        public function cookie(){
            if(empty($_COOKIE['findWord'])){
                setcookie('findWord',$this->word,time()+60*60*24);
            }
            if(empty($_COOKIE['try'])){
                setcookie('try','0',time()+60*60*24);
            }
            echo $_COOKIE['findWord'].',';
            echo '<br>'.$_COOKIE['try'];
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

        public function firstFindLetter(){
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
            if(empty($_GET['write'])){
                exit;
            }
            $try = $_GET['write'];
            if (strlen($try) != strlen($_COOKIE['findWord'])) {
                echo "<br>Trop de lettre";
                exit;
            }
            echo "<br>";
            for ($i=0; $i < strlen($try);$i++){
                if($_COOKIE['findWord'][$i] == $try[$i]){
                    echo " ".$_COOKIE['findWord'][$i];
                    $findLetterWord[$i] = $try[$i];
                }
                if ($_COOKIE['findWord'][$i] != $try[$i]) {
                    echo " _";
                }
            }
            echo "<br>";
            print_r($findLetterWord);
            if (count($findLetterWord) != strlen($_COOKIE['findWord'])) {
                // $numberTry => 1 
                $numberTry = intval($_COOKIE['try'])+1;
                setcookie('try',strval($numberTry));
                if ($_COOKIE['try'] >= 6) {
                    echo "<br>perdu, le mot a trouver était : ".$_COOKIE['findWord'].'<br> Revenez demain !';
                }
            }
        }

        public function nextFindLetter(){
            for ($i=0; $i < strlen($_COOKIE['findWord']); $i++) { 
                if($i == 0){
                   echo $_COOKIE['findLetter'][$i];
                }
                if($_COOKIE['findLetter'][$i] == null){
                    echo " _";
                }
                if ($_COOKIE['findLetter'][$i] != null) {
                    echo " ".$_COOKIE['findLetter'][$i];
                }
            }
        }


        public function render(){
            echo "welcome </br></br>";
          }
        }
?>