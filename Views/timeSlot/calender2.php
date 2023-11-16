<?php include(__DIR__ . "/../layout/header.php")?>
<?php
    require(__DIR__ . "/../../Controllers/TimeSlotController.php");
    
    if (!$_SESSION["user"]["logedIn"]){
        header("location: ../startPage.php");
        exit;
    }

    global $week;

    echo "<b>" . $week -> getWeekNumber() . "</b>";
    echo "<div class='d-flex justify-content-center'>";
    echo "<form method='POST' class='mx-5 mb-3'>";
        echo "<input type='hidden' name='weekNumber' value='". $week -> getWeekNumber() . "'>";
        echo "<input type='hidden' name='currentYear' value='" . $week -> getYear() . "'>";
        echo "<input type='hidden' name='typeOfChange' value='prevWeek'>";
        echo "<input type='submit' name='changeWeek' value='previous'>";
    echo "</form>";
    echo "<form method='POST' class='mx-5 mb-3'>";
        echo "<label for='weekNumber'> Søk etter uke: </label>";
        echo "<input type='int' name='weekNumber' min='1' max='52'>";
        echo "<input type='hidden' name='currentYear' value='" . $week -> getYear() . "'>";
        echo "<input type='hidden' name='typeOfChange' value='searchWeek'>";
        echo "<input type='submit' name='changeWeek' value='Søk'>";
    echo "</form>";
    echo "<form method='POST' class='mx-5 mb-3'>";
        echo "<input type='hidden' name='weekNumber' value='". $week -> getWeekNumber() . "'>";
        echo "<input type='hidden' name='currentYear' value='" . $week -> getYear() . "'>";
        echo "<input type='hidden' name='typeOfChange' value='nextWeek'>";
        echo "<input type='submit' name='changeWeek' value='next'>";
    echo "</form>";
    echo "</div>";
    echo "<div id='calender'>";
        foreach ($week -> getDaysInWeek() as $day){
            $dateDay = DateTime::createFromFormat("Y-m-d", $day -> getDate());
            $formatedDate = $dateDay->format("d-m-Y");

            echo "<div class='calenderColumn'>";
            echo "<div class='cell'>" . $day -> getDayName() . "<br>" . $formatedDate . "</div>";

            $timeSlots = $day -> timeArray;

            foreach ($timeSlots as $timeSlot){
                $time = DateTime::createFromFormat("H:i:s" , $timeSlot -> start_time);
                $formatedTime = $time->format("H:i");
                if ($timeSlot -> booked_by !== null){
                    echo "<div class='timeSlotStyle availebleTimeSlot cell'>" . $formatedTime . "<br>" . $timeSlot -> tutor_name;
                        echo "<form method='GET' action='show.php?timeslotId=". $timeSlot -> timeslot_id . 
                                "' id='" . $timeSlot -> timeslot_id . "timeSlotForm'>";
                            echo "<input type='hidden' name='timeSlotId' value='" . $timeSlot -> timeslot_id . "'>";
                            echo "<input type='submit' name='getTimeSlotInfo' value='Vis'>";
                        echo "</form>";
                    echo "</div>"; 
                } else {
                    echo "<div class='timeSlotStyle occupiedTimeSlot cell'>" . $formatedTime . "<br>" . $timeSlot -> tutor_name;
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
    echo "</div>";
?>

<?php include(__DIR__ . "/../layout/footer.php")?>