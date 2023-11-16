<?php 
require_once(__DIR__ . '/../tools/dbcon.php');


class TimeSlot{

    public $tutorId;
    public $date;
    public $startTime;
    public $endTime;
    public $location;
    public $description;


    public static function saveTimeSlot(TimeSlot $timeslot){
        
        global $pdo;
        
        $sql = "INSERT INTO time_slots (tutor_id, date, start_time, end_time, location, description, created_at)
        VALUES (:tutor_id, :date, :start_time, :end_time, :location, :description, now())";

        $query = $pdo -> prepare($sql);
        $query -> bindParam(":tutor_id", $timeslot -> tutorId);
        $query -> bindParam(":date", $timeslot -> date);
        $query -> bindParam(":start_time", $timeslot -> startTime);
        $query -> bindParam(":end_time", $timeslot -> endTime);
        $query -> bindParam(":location", $timeslot -> location);
        $query -> bindParam(":description", $timeslot -> description);

        try{
            #Sjekker om sql statement er skrevet korrekt
            $query -> execute();
        } catch (PDOException $e){
            echo $e; //Bør logges istedenfor skrevet ut, sikkerhets risiko
        }
    }

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