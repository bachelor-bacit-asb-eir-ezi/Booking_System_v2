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
        echo "<div class='calendercolumn'>";
        echo "<div class='day'></div>";
            /*for ($i = 7; $i < 24; $i++){
                if ($i < 10){
                    echo "<div class='time'>0$i:00</div>";
                } else {
                    echo "<div class='time'>$i:00</div>";
                }
            }*/
        echo "</div>";
        foreach ($week -> getDaysInWeek() as $day){
            echo "<div class='calenderColumn'>";
            echo "<div class='day'> ";
            echo $day -> getDayName() . "<br>";
            echo $day -> getDate() ."<br>";
            echo "</div>";
            foreach($day -> timeArray as $time){
                #sjekker om flere veildeningstimer i samme time og dag, eller tom-
                switch (count($time)){
                    case (0):
                        # Tom time
                        echo "<div class='timeSlotStyle'>";
                        break;
                    case (1):
                        # En veiledningstime -->
                        if ($time[0] -> booked_by != null) {# Booket time
                            echo "<div id='" . $time[0] -> timeslot_id . "' class='timeSlotStyle timeSlot occupiedTimeSlot'>";
                        }else{ #Ledig time
                            echo "<div id='" . $time[0] -> timeslot_id . "' class='timeSlotStyle timeSlot availebleTimeSlot'>";
                        }
                        echo "<form method='GET' action='show.php?timeslotId=". $time[0] -> timeslot_id . "' id='" . $time[0] -> timeslot_id . "timeSlotForm'>";
                            echo "<input type='hidden' name='timeSlotId' value='" . $time[0] -> timeslot_id . "'>";
                        echo "</form>";
                        break;
                    default:
                        #flere veiledningstimer
                        echo "<div class='timeSlotStyle multipleTimeSlot'>";
                        echo "<form method='GET'>";
                        echo "<select name='timeSlotId'>";
                        foreach ($time as $timeSlot) {
                            if ($timeSlot->booked_by !== null) {  # Booket time 
                                echo "<option class='occupiedTimeSlot' value='" . $timeSlot->timeslot_id . "'>";
                            } else { #Ledig time
                                echo "<option class='availebleTimeSlot' value='" . $timeSlot->timeslot_id . "'>";
                            }
                            echo $timeSlot->tutor_id . ":" . $timeSlot->description . "</option>";
                        }
                        echo "</select>
                            <input type='submit' name='showTimeSlotInfo' value='Vis valgte'>
                            </form>";
                        break;
                    }
                    echo "</div>";
            }
        echo "</div>";
        }
    echo "</div>";
?>
<script>
    //Gjør timeSlot i kalender klikkbare
    $('.timeSlot').click(function(){
        $('#' +this.id+'timeSlotForm').submit();
    });
</script>

<?php include(__DIR__ . "/../layout/footer.php")?>