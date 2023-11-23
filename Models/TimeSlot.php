<?php 
require(__DIR__ . '/../tools/dbcon.php');
require(__DIR__ . '/../tools/Validate.php');


class TimeSlot{
    #La sin info
    public $tutorId;
    public $tutorName;

    #annen info
    public $date;
    public $startTime;
    public $endTime;
    public $location;
    public $description;

    #Student som booket sin info: USIKER PÅ OM DEN TRENGS PGA PDO OBJECT
    public $studentId; 
    public $studentName;


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
            echo "En feil oppstod";
            error_log($e);
        }
    }

    public static function getTimeSlots($weekNumber,$year){
        #Finner dato, bruker mandag som første dag og søndag som site dag
        $weekStart = new DateTime();
        $weekStart->setISODate($year, $weekNumber, 1); 

        $weekEnd = clone $weekStart;
        $weekEnd->modify('+6 days');

        #Gjør de til string for at de skal bli akseptert i bindparem
        $weekStart =  $weekStart -> format("Y-m-d");
        $weekEnd = $weekEnd -> format("Y-m-d");

        global $pdo;

        $sql = "SELECT timeslot_id, tutor_id, name AS tutor_name, time_slots.date, start_time, end_time, location, description, booked_by 
        FROM time_slots 
        INNER JOIN users ON tutor_id = users.id
        WHERE time_slots.date >= :weekStart AND time_slots.date <= :weekEnd
        ORDER BY date, start_time;";

        $query = $pdo -> prepare($sql);
        $query -> bindParam(":weekStart", $weekStart);
        $query -> bindParam(":weekEnd", $weekEnd);

        try{
            #Sjekker om sql statement er skrevet korrekt
            $query -> execute();
        } catch (PDOException $e){
            echo "En feil oppstod";
            error_log($e);
        }
        $timeslots = array();
        #Så lenge den henter rows skal while løkken kjøre, stopper når det ikke er flere rows å hente
        while ($row = $query->fetch(PDO::FETCH_OBJ)) {
            $timeslots[] = $row; 
        }
        return $timeslots;
    }

    public static function getTimeSlotDetails($id){
        global $pdo;

        $sanetizedID = Validate::sanitize($id);

        $sql = "SELECT timeslot_id, 
                users_a.name AS tutor_name, 
                tutor_id, date, 
                start_time, 
                end_time, 
                location, 
                description, 
                booked_by, 
                users_b.name AS student_name 
            FROM time_slots 
            INNER JOIN users AS users_a 
                ON users_a.id = tutor_id 
            LEFT JOIN users AS users_b 
                ON booked_by = users_b.id
            WHERE timeslot_id = :timeslot_id";

        $query = $pdo -> prepare($sql);
        $query -> bindParam(":timeslot_id", $sanetizedID);

        try{
            #Sjekker om sql statement er skrevet korrekt
            $query -> execute();
        } catch (PDOException $e){
            echo "En feil oppstod";
            error_log($e);
        }

        $timeslot = $query -> fetch(PDO::FETCH_OBJ);

        return $timeslot;
    }

    #Book timeSlot
    public static function bookTimeSlot($timeSlotId, $studentId){
        global $pdo;

        $sql = "UPDATE time_slots SET booked_by = :student_id WHERE timeslot_id = :timeSlotsId";

        $query = $pdo -> prepare($sql);

        $query -> bindParam(":student_id", $studentId);
        $query -> bindParam(":timeSlotsId", $timeSlotId);

        try{
            #Sjekker om sql statement er skrevet korrekt
            $query -> execute();
        } catch (PDOException $e){
            echo "En feil oppstod";
            error_log($e);
        }
    }

    #UnBook timeSlot
    public static function unBookTimeSlot($timeSlotId){
        global $pdo;

        $sql = "UPDATE time_slots SET booked_by = null WHERE timeslot_id = :timeSlotsId";

        $query = $pdo -> prepare($sql);

        $query -> bindParam(":timeSlotsId", $timeSlotId);

        try{
            #Sjekker om sql statement er skrevet korrekt
            $query -> execute();
        } catch (PDOException $e){
            echo "En feil oppstod";
            error_log($e);
        }
    }
}
?>