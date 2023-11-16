<?php 
    class Validate{
        public static function sanetize(string $text){
            $text = strip_tags($text);
            $text = htmlspecialchars($text);
            return $text;
        }

        #Under er valideringsmetoder

        public static function validateEmail($email){
            if(filter_var($email,FILTER_VALIDATE_EMAIL)){
                return true; 
            } else {
                return false;
            }
        }


        #Krav: Norsk mobilnummer
        public static function validateMobilNr($mobilNr){
            #prepWork
            $mobilNr = str_replace(" ","",$mobilNr);
            #La bruker skrive +47 (landskode Norge) men ingen andre landskoder
            if(str_starts_with($mobilNr,  "+47") ){
                $mobilNr = str_replace("+47","",$mobilNr);
            }

            if (preg_match('/^[0-9]{8}+$/',$mobilNr)){
                return true;
            } else {
                return false;
            }

        }

        #Krav: Minst 2 tall, en stor bokstav, et spesialtegn og minst 9 tegn
        public static function validatePassword($password){
            $validate = true;
            
            $digits = "/\d/"; // \d er spesialtegn som representerer alle tall
            #returnerer antall tall som er i passordet
            $amountOfNumbers = preg_match_all($digits,$password); 
            
            #Alle spesialtegn
            $allSpecialChars = "/[\'^£$%&*()}{@#~?><>,|=_+¬-]/";

            #Sjekker lengde kriteriet
            if(!strlen($password) >= 9){
                $validate = false;
            }

            #Sjekker om antall tall kriteriet er oppfylt
            if ($amountOfNumbers < 2){
                $validate = false;
            }

            #Sjekker om minst en stor bokstav kriteriet er oppfylt, sjekker også om det er minst en liten bokstav
            if(!preg_match('@[A-Z]@', $password) || !preg_match('@[a-z]@',$password)){
                $validate = false;
            }

            #Sjekker om minst et spesial tegn kriteriet er oppfylt
            if (!preg_match($allSpecialChars,$password)){
                $validate = false;
            }

            return $validate;
        }
    }
?>