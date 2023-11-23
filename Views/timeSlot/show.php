<?php include(__DIR__ . "/../layout/header.php")?>

<?php
require_once(__DIR__ . "/../../Controllers/TimeSlotController.php");

if (!$_SESSION["user"]["logedIn"]){
    header("location: ../index.php");
    exit;
}

#Må gjøres: sjekk om bruker er student som booket time

$timeSlot = TimeSlot::getTimeSlotDetails($_GET["timeSlotId"]);


echo "<div>
    <form>";
    echo "<label for='date'>Dato:</label>";
    echo "<input class='form-control' name='date' readonly type='text' value='". $timeSlot->date ."'>";

    echo "<label for='startTime'>Start tid:</label>";
    echo "<input class='form-control' name='startTime' readonly type='text' value='". $timeSlot->start_time ."'>";

    echo "<label for='endTime'>Slutt tid:</label>";
    echo "<input class='form-control' name='endTime' readonly type='text' value='". $timeSlot->end_time ."'>";

    echo "<label for='tutor'>Veileder tilstede:</label>";
    echo "<input class='form-control' name='tutor' readonly type='text' value='". $timeSlot->tutor_name ."'>";

    echo "<label for='location'>Sted:</label>";
    echo "<input class='form-control' name='location' readonly type='text' value='". $timeSlot->location ."'>";

    echo "<label for='description'>Tema i fokus:</label>";
    echo "<input class='form-control' name='description' readonly type='text' value='". $timeSlot->description ."'>";

    if($timeSlot -> booked_by !== null){
        echo "<label for='bookedBy'>Booket av:</label>";
        echo "<input class='form-control' name='bookedBy' readonly type='text' value='". $timeSlot->student_name ."'>";
    }
    echo "</form>";

    if($timeSlot -> booked_by === null){
        echo "<form method='POST'>";
            echo "<input name='timeSlotId' type='hidden' value='" . $timeSlot -> timeslot_id . "'>";
            echo "<input type='submit' name='bookTimeSlot' value='Book veilednings time'>";
        echo "</form>";
    }elseif($timeSlot -> booked_by === $_SESSION["user"]["id"]){
        echo "<form method='POST'>";
            echo "<input name='timeSlotId' type='hidden' value='" . $timeSlot -> timeslot_id . "'>";
            echo "<input type='submit' name='unBookTimeSlot' value='Unbook veilednings time'>";
        echo "</form>";
    }

    echo "</div>";
?>

<?php include(__DIR__ . "/../layout/footer.php")?>