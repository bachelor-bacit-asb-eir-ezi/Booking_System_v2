<?php 
    class Validate{
        public static function sanitize(string $text){
            $text = strip_tags($text);
            $text = htmlspecialchars($text);
            return $text;
        }

        public static function validateEmail(string $email){
            if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                return false;
            } else{
                return true;
            }
        }
        
        public static function validateMobileNr(string $mobilNr){
            if (preg_match('/^[0-9]{8}+$/',$mobilNr)){
                return true;
            } else{
                return false;
            }
        }
        
        public static function validatePassword(string $password){
            if(strlen($password) <= 7 ){
                return false;
            }
            if(!preg_match('@[A-Z]@', $password) || !preg_match('@[a-z]@', $password) || !preg_match('@[0-8]@',$password)){
                return false;
            }
            return true;
        }
    
    }
?>
