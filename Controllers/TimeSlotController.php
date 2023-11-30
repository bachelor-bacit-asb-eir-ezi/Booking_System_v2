<?php
session_start();

require_once(__DIR__ . "/../Models/TimeSlot.php");
require_once(__DIR__ . "/../Models/Week.php");
require_once(__DIR__ . "/../Tools/Validate.php");

#Calender endre uke
if(isset($_GET["changeWeek"])){
    $year =  $_GET["currentYear"];
    $weekNumber = $_GET["weekNumber"];

    $week = new Week($weekNumber,$year);
    $timeSlots = TimeSlot::getTimeSlots($weekNumber,$year);
    $week -> insertTimeSlots($timeSlots);
} else{
    $weekNumber = date("W");
    $year = date("Y");
    
    $week = new Week($weekNumber,$year);
    $timeSlots = TimeSlot::getTimeSlots($weekNumber,$year);
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

if (isset($_POST["delete"])){
    $id = Validate::sanitize($_POST["delete"]);
    TimeSlot::delTimeSlot($id);
    header("location: ../timeSlot/calender.php");
    exit;
}
?>