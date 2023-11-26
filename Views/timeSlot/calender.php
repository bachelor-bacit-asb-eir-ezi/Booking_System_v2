<?php include(__DIR__ . "/../layout/header.php")?>
<?php
    require_once(__DIR__ . "/../../Controllers/TimeSlotController.php");
    
    if (!$_SESSION["user"]["logedIn"]){
        header("location: ../index.php");
        exit;
    }

    global $week;
    
    $curYear = Validate::sanitize($week -> getYear());
    $nextYear = $curYear;
    $prevYear = $curYear;

    $curWeek = Validate::sanitize($week -> getWeekNumber());
    $prevWeek = $curWeek - 1;
    $nextWeek = $curWeek + 1;

    if ($nextWeek > 52){
        $nextWeek = 1;
        $nextYear++;
    } 
    if ($prevWeek < 1){
        $prevWeek = 52;
        $prevYear --;
    } 

    echo "<b>" . $week -> getWeekNumber() . "</b>";
    echo "<div class='d-flex justify-content-center'>";
    echo "<form method='GET' class='mx-5 mb-3'>";
        echo "<input type='hidden' name='weekNumber' value='". $prevWeek . "'>";
        echo "<input type='hidden' name='currentYear' value='" . $prevYear . "'>";
        echo "<button type='submit' name='changeWeek' value='prevWeek' class='btn btn-secondary'>Forrige</button>";
    echo "</form>";
    echo "<form method='GET' class='mx-5 mb-3'>";
        echo "<label for='weekNumber'> Søk etter uke: </label>";
        echo "<input type='int' name='weekNumber' min='1' max='52'>";
        echo "<input type='hidden' name='currentYear' value='" . $curYear . "'>";
        echo "<button type='submit' name='changeWeek' value='searchWeek' class='btn btn-secondary'>Søk</button>";
    echo "</form>";
    echo "<form method='GET' class='mx-5 mb-3'>";
        echo "<input type='hidden' name='weekNumber' value='". $nextWeek . "'>";
        echo "<input type='hidden' name='currentYear' value='" . $nextYear . "'>";
        echo "<button type='submit' name='changeWeek' value='nextWeek' class='btn btn-secondary'>Neste</button>";
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
                if ($timeSlot -> booked_by === null){
                    echo "<div class='timeSlotStyle availebleTimeSlot cell'>" . $formatedTime . "<br>" . $timeSlot -> tutor_name;
                        echo "<form method='GET' action='show.php?timeslotId=". $timeSlot -> timeslot_id . 
                                "' id='" . $timeSlot -> timeslot_id . "timeSlotForm'>";
                            echo "<input type='hidden' name='timeSlotId' value='" . $timeSlot -> timeslot_id . "'>";
                            echo "<button type='submit'> Vis </button>";
                        echo "</form>";
                    echo "</div>"; 
                } elseif($timeSlot -> booked_by === $_SESSION["user"]["id"] || $timeSlot -> tutor_id === $_SESSION["user"]["id"]) {
                    echo "<div class='timeSlotStyle occupiedTimeSlot cell'>" . $formatedTime . "<br>" . $timeSlot -> tutor_name;
                        echo "<form method='GET' action='show.php?timeslotId=". $timeSlot -> timeslot_id . 
                                "' id='" . $timeSlot -> timeslot_id . "timeSlotForm'>";
                            echo "<input type='hidden' name='timeSlotId' value='" . $timeSlot -> timeslot_id . "'>";
                            echo "<button type='submit'> Vis </button>";
                        echo "</form>";
                    echo "</div>"; 
                }
            }
        echo "</div>";
        }
    echo "</div>";
?>

<script>
 function updateTimeSlotInCalender() 
    {
        var calender = document.getElementById("calender");
        var xhr = new XMLHttpRequest();

        // Get the current URL
        var currentUrl = window.location.href;

        // Use the URLSearchParams API to extract parameters from the URL
        var urlParams = new URLSearchParams(currentUrl.split("?")[1]);

        // Extract year and weekNumber from the URL parameters
        var currentYear = urlParams.get("currentYear");
        var weekNumber = urlParams.get("weekNumber");

        // Replace 'your_script.php' with the actual path to your PHP script
        var url = "../../Controllers/CalenderGenerator.php";

        // Parameters to be sent in the GET request
        var params = "changeWeek=true&currentYear=" + currentYear + "&weekNumber=" + weekNumber;
        xhr.open("GET", url + "?" + params, true);

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Handle the response if needed
                console.log(xhr.responseText);
                calender.innerHTML = xhr.responseText;
            }
        };

        xhr.send();
    }

    setInterval(updateTimeSlotInCalender, 5000);
</script>

<?php include(__DIR__ . "/../layout/footer.php")?>