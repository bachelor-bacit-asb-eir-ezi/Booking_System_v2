<?php
require_once(__DIR__.'/Day.php');
/**
 * Week klassen har som hensikt å være en uke
 * Den skal inneholde alle dager i uken, ukenummere til uken og hvilket år uken tilhører
 * 
 * @param weekNumber er uken ummeret til uken du vil lage
 * @param year er årstallet som uken tilhører
 * 
 */
class Week
{
    #Disse attributene skal være readonly derfor er de private og blir satt av constructor og gettere lar de bli lest andre plasser
    private $weekNumber;
    private $year; //For å finne ut hvilket år uken tilhører
    private $daysInWeek;

    function __construct($weekNumber,$year)
    {
        $this->weekNumber = $weekNumber;
        $this->year = $year;
        $this->daysInWeek = $this->fillListByWeekNumber($weekNumber);
    }

    private function fillListByWeekNumber($weekNumber){
        $days = array();
        //Finn første dag i uka
        $dayOfWeek = $this -> getFirstDateOfWeek($weekNumber);
        // Loop through the dates +6 (7 days total)
        $dayNameArray = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
        for ($i = 0; $i < 7; $i++) {
            $days[] = new Day($dayNameArray[$i], $dayOfWeek->format('Y-m-d'));
            $dayOfWeek->modify("+1 day");
        }
        //returner liste
        return $days;
    }

    public function getWeekNumber(){
        return $this->weekNumber;
    }

    public function getYear(){
        return $this->year;
    }

    public function getDaysInWeek(){
        return $this->daysInWeek;
    }

    public function getDayInWeekByDate($date){
        $days = $this ->daysInWeek;
        foreach($days as $day){
            if ($day -> getDate() == $date){
                return $day;
            }
        }
    }
    
    public function getFirstDateOfWeek($weekNumber){ 
        $date = new \DateTime(); 
        $date->setISODate($this->year, $weekNumber); 
        return $date;
    }

    #plasserer timeslots inne i alle dagene assosiert med uken
    /*public function insertTimeSlots($timeSlots){
        foreach($timeSlots as $timeSlot){
            //$timeSlotTime = $timeSlot -> start_time;

            #Finner basert på time må ha minutter satt til 00 for å fungere
            $timeSlotTime = strval($timeSlot -> start_time);
            $explodedTimeSlotTime = explode(":",$timeSlotTime);
            $modifiedTime = $explodedTimeSlotTime[0] . ":00:00";

            $timeSlotDate = $timeSlot -> date;
            $day = $this -> getDayInWeekByDate($timeSlotDate);
            if(!$day == null){
                array_push($day -> timeArray[$modifiedTime], $timeSlot);
            }
        }
    }*/

    public function insertTimeSlots($timeSlots){
        foreach($timeSlots as $timeSlot){
            $timeSlotDate = $timeSlot -> date;
            $day = $this -> getDayInWeekByDate($timeSlotDate);
            if(!$day == null){
                array_push($day -> timeArray, $timeSlot);
            }
        }
    }
}
?>