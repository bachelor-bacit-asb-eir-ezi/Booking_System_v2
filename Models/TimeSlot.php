<?php 
require_once(__DIR__ . '/../tools/dbcon.php');


class TimeSlot{

    public static function getTimeSlots($weekNumber){
        $day = date($weekNumber);
        $weekStart = date('Y-m-d', strtotime('-'.$day.' days'));
        $weekEnd = date('Y-m-d', strtotime('+'.(6-$day).' days'));

        global $pdo;

        $sql = "SELECT timeslot_id, name AS tutor_name, time_slots.date, start_time, end_time, location, description, booked_by 
        FROM time_slots 
        INNER JOIN users ON tutor_id = users.id 
        WHERE time_slots.date >= :weekStart AND time_slots.date <= :weekEnd;";

        $query = $pdo -> prepare($sql);
        $query -> bindParam(":weekStart", $weekStart);
        $query -> bindParam(":weekEnd", $weekEnd);

        try{
            #Sjekker om sql statement er skrevet korrekt
            $query -> execute();
        } catch (PDOException $e){
            echo $e; //Bør logges istedenfor skrevet ut, sikkerhets risiko
        }

        #Så lenge den henter rows skal while løkken kjøre, stopper når det ikke er flere rows å hente
        while ($row = $query->fetch(PDO::FETCH_OBJ)) {
            $timeslots[] = $row; 
        }
        return $timeslots;
    }
}
?>