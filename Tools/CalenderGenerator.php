<?php
require_once(__DIR__ . "/../Controllers/TimeSlotController.php");

global $week;


foreach ($week -> getDaysInWeek() as $day){
    $dateDay = DateTime::createFromFormat("Y-m-d", $day -> getDate());
    $formatedDate = $dateDay->format("d-m-Y");

    echo "<div class='calenderColumn'>";
    echo "<div class='cell'>" . $day -> getDayName() . "<br>" . $formatedDate . "</div>";

    $timeSlots = $day -> timeArray;

    foreach ($timeSlots as $timeSlot){
        $time = DateTime::createFromFormat("H:i:s" , $timeSlot -> start_time);
        $formatedTime = $time->format("H:i");
        if ($timeSlot -> booked_by === null){
            echo "<div class='timeSlotStyle availebleTimeSlot cell'>" . $formatedTime . "<br>" . $timeSlot -> tutor_fname . " " . $timeSlot -> tutor_lname;
                echo "<form method='GET' action='show.php?timeslotId=". $timeSlot -> timeslot_id . 
                        "' id='" . $timeSlot -> timeslot_id . "timeSlotForm'>";
                    echo "<input type='hidden' name='timeSlotId' value='" . $timeSlot -> timeslot_id . "'>";
                    echo "<input type='submit' name='getTimeSlotInfo' value='Vis'>";
                echo "</form>";
            echo "</div>"; 
        } elseif($timeSlot -> booked_by === $_SESSION["user"]["id"] || $timeSlot -> tutor_id === $_SESSION["user"]["id"]) {
            echo "<div class='timeSlotStyle occupiedTimeSlot cell'>" . $formatedTime . "<br>" . $timeSlot -> tutor_fname . " " . $timeSlot -> tutor_lname;
                echo "<form method='GET' action='show.php?timeslotId=". $timeSlot -> timeslot_id . 
                        "' id='" . $timeSlot -> timeslot_id . "timeSlotForm'>";
                    echo "<input type='hidden' name='timeSlotId' value='" . $timeSlot -> timeslot_id . "'>";
                    echo "<input type='submit' name='getTimeSlotInfo' value='Vis'>";
                echo "</form>";
            echo "</div>"; 
        }
    }
echo "</div>";
}