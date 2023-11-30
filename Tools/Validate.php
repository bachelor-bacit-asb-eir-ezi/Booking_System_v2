<?php 
    class Validate{
        public static function sanitize(string $text){
            $text = strip_tags($text);
            $text = htmlspecialchars($text);
            return $text;
        }

    }
?>
