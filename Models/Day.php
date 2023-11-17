<?php

/**
 * Day klassen inneholder informajsonen om hver enkelt dag som applikasjonen trenger
 * 
 * @see denne funksjonen er sterkt tilknyttet Week klassen, og timeslot siden det er inne i denne funksjonen TimeSlot blir lagret
 * 
 * @param string $dayName er ukedagen til dagen (eksempel: mandag, tirsdag osv...)
 * @param date $date er datoen til dagen (eksempel: 2023.10.05)
 * 
 */

class Day
{
  #bruker private på dayname of date siden disse skal ikke kunne bli endret etter at Day objekt er lagt
    private $dayName;
    private $date;
    public $timeArray; 

    function __construct($dayName,$date) {
        $this->dayName = $dayName;
        $this->date = $date;
        $this -> timeArray = array();
      }

      public function getDayName(){
        return $this->dayName;
      }

      public function getDate(){
        return $this->date;
      }
}
?>