<?php
session_start();

require_once(__DIR__ . "/../Models/TimeSlot.php");
require_once(__DIR__ . "/../Models/Week.php");
require_once(__DIR__ . "/../Tools/Validate.php");

#Calender endre uke
if(isset($_GET["changeWeek"])){
    $year =  $_GET["currentYear"];
    switch ($_GET["changeWeek"]) {
        case "nextWeek":
            $weekNumber = $_GET["weekNumber"];
            if ($weekNumber > 52){
                $year ++;
                $weekNumber = 1;
            }
            break;
        case "prevWeek":
            $weekNumber = $_GET["weekNumber"];
            if ($weekNumber < 1){
                $year --;
                $weekNumber = 52;
            }
            break;
        case "searchWeek":
            #for å forhindre at bruker kan søke på ukenummer høyere en mulig eller lavere (0 < weekNumber < 53)
            switch ($weekNumber = $_GET["weekNumber"]){
                case $weekNumber < 1:
                    $weekNumber = 1;
                    break;
                case $weekNumber > 52:
                    $weekNumber = 52;
                    break;
                default:
                    $weekNumber = $_GET["weekNumber"];
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

#Show info om time slot
if (isset($_GET["showTimeSlotInfo"])){
    header("location: show.php");
    exit;
}

#Book og unbook timeslot
if (isset($_POST["bookTimeSlot"])){
    TimeSlot::bookTimeSlot($_POST["timeSlotId"], $_SESSION["user"]["id"]);
    header("location: ../timeSlot/calender.php");
    exit;
}

if (isset($_POST["unBookTimeSlot"])){
    TimeSlot::unBookTimeSlot($_POST["timeSlotId"]);
    header("location: ../timeSlot/calender.php");
    exit;
}
?>