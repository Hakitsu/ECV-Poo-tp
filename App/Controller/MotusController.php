<?php
    declare (strict_types = 1);
    namespace App\Controller;

    
    class MotusController{
        public string $word;
        public array $letterWord = [];
        public array $findLetterWord = [];
        public array $letterIsFinding = [];
        public array $wordUse = [];
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
            header("location:http://localhost:8000/");
        }

        // SelectWordController
        public function cookie(){
            setcookie('findWord',$this->word,time()+60*60*24);
            setcookie('try','0',time()+60*60*24);
        }

        // SPLIT en array->lettre 
        // pour chaque lettre qui possède -> On affiche un " _ "

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

            if (isset($_COOKIE['findLetter'])) {
                $letterIsFinding = json_decode($_COOKIE['findLetter'], true);
            }
            if (strlen($try) != strlen($_COOKIE['findWord'])) {
                echo "<br>Mot invalide : lettre manquant / en trop";
                exit;
            }
            for ($i=0; $i < strlen($try);$i++){
                if($_COOKIE['findWord'][$i] == $try[$i]){
                    echo   '<span style="color: lime">'.$_COOKIE['findWord'][$i]." </span>";
                    $findLetterWord[$i] = $try[$i];
                    if (!isset($letterIsFinding[$i])) {
                        $letterIsFinding[$i] = $findLetterWord[$i];
                    }
                }
                if ($_COOKIE['findWord'][$i] != $try[$i]) {
                    if(strpos($_COOKIE['findWord'],$try[$i])){
                        echo '<span style="color: orange" >'.$try[$i]." </span>";
                    }else {
                        echo '<span>'.$try[$i]." </span>";
                    }
                }
            }
            echo "<br>";
            setcookie('findLetter',json_encode($letterIsFinding),time()+60*60*24);

            if (count($letterIsFinding) != strlen($_COOKIE['findWord'])) {
                //$numberTry => 1 
                $numberTry = intval($_COOKIE['try'])+1;
                setcookie('try',strval($numberTry));


                if ($_COOKIE['try'] >= 6) {
                    echo "<br>perdu, le mot a trouver était : ".$_COOKIE['findWord'].'<br> Revenez demain ! <br>';
                }
            }else {
                echo "<br>Bravo, le mot a trouver était : ".$_COOKIE['findWord'].'<br> Revenez demain !';
            }
        }

        public function letterFinding(){
            //echo str_pad($_COOKIE['findWord'][0],strlen($_COOKIE['findWord']),"_",STR_PAD_RIGHT);
            if (isset($_COOKIE['findLetter'])) {
                $letterFinding = json_decode($_COOKIE['findLetter'], true);
                for ($i=0; $i < strlen($_COOKIE['findWord']); $i++) { 
                    if($i == 0){
                        echo $_COOKIE['findWord'][$i];
                    }
                    elseif(isset($letterFinding[$i]) && $_COOKIE['findWord'][$i] == $letterFinding[$i]){
                        echo " ".$letterFinding[$i];;
                    }
                    else{
                        echo " _";
                    }
                }
                echo "<br>";
            }else{
                for ($i=0; $i < strlen($_COOKIE['findWord']); $i++) { 
                    if($i == 0){
                        echo $_COOKIE['findWord'][$i];
                    }
                    if($i != 0){
                        echo " _";
                    }
                }
            }
        }

        public function render(){
            if(!isset($_COOKIE['findWord']) && !isset($_COOKIE['try'])){ $this->beginParti(); }
            if(isset($_COOKIE['try']) && $_COOKIE['try']==0) {
                $this->firstFindLetter();
            }else{
                $this->letterFinding();
            }
            $this->checkLetter();
          }
        }
?>