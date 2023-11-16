<?php
require_once(__DIR__ . "/../Models/TimeSlot.php");
require_once(__DIR__ . "/../Models/Week.php");
require_once(__DIR__ . "/../Tools/Validate.php");

session_start();

#Calender endre uke
if(isset($_POST["changeWeek"])){
    $year =  $_POST["currentYear"];
    switch ($_POST["typeOfChange"]) {
        case "nextWeek":
            $weekNumber = $_POST["weekNumber"];
            $weekNumber++;
            if ($weekNumber > 52){
                $year ++;
                $weekNumber = 1;
            }
            break;
        case "prevWeek":
            $weekNumber = $_POST["weekNumber"];
            $weekNumber--;
            if ($weekNumber < 1){
                $year --;
                $weekNumber = 52;
            }
            break;
        case "searchWeek":
            #for å forhindre at bruker kan søke på ukenummer høyere en mulig eller lavere (0 < weekNumber < 53)
            switch ($weekNumber = $_POST["weekNumber"]){
                case $weekNumber < 1:
                    $weekNumber = 1;
                    break;
                case $weekNumber > 52:
                    $weekNumber = 52;
                    break;
                default:
                    $weekNumber = $_POST["weekNumber"];
                    break;
            }
            break;
    }
    $week = new Week($weekNumber,$year);
    $timeSlots = TimeSlot::getTimeSlots($weekNumber);
    $week -> insertTimeSlots($timeSlots);
} else {
    $weekNumber = date("W");
    $year = date("Y");

    $week = new Week($weekNumber,$year);
    $timeSlots = TimeSlot::getTimeSlots($weekNumber);
    $week -> insertTimeSlots($timeSlots);
}

#Create Timeslot
if (isset($_POST["createTimeSlot"])){
    $timeSlot = new TimeSlot();

    $timeSlot -> tutorId = $_SESSION["user"]["id"];

    $timeSlot -> date = Validate::sanitize($_POST["date"]);
    $timeSlot -> startTime = Validate::sanitize($_POST["startTime"]);
    $timeSlot -> endTime = date('h:i:s', strtotime($timeSlot -> startTime)+3600);
    $timeSlot -> location = Validate::sanitize($_POST["location"]);
    $timeSlot -> description = Validate::sanitize($_POST["description"]);

    TimeSlot::saveTimeSlot($timeSlot);

    unset($timeSlot);
    header("location: calender.php");
    exit;
}
?>