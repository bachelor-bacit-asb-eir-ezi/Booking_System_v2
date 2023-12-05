<?php
$folder = __DIR__ . "/../misc/";
class Logger{

    public static function loggEvent($event){
        global $folder;
        if(file_exists($folder . "log.txt")){
            $file =  fopen($folder . "log.txt", "a+") or die("Kunne ikke åpne log fil");
            $text = "Log: " . date("d.m.Y H:i") . " hendelse: " . $event . "\n";
            #skriver innhold til slutten av filen
            fwrite($file, $text);
            fclose($file);
        } else {
            echo "fil eksisterer ikke";
        }
    }
}
?>