<?php
require(__DIR__ . '/../tools/dbcon.php');

class User {

    public $id;
    public $firstname;
    public $lastname;
    public $email;
    public $password;
    public $phone_number;

    public static function registerUser(User $user)
    {
        global $pdo;

        $sql = "INSERT INTO users (firstname, lastname, email, password, phone_number)
                VALUES (:firstname, :lastname, :email, :password, :phone_number)";

        $query = $pdo->prepare($sql);

        $query->bindParam(':firstname', $user -> firstname);
        $query->bindParam(':lastname', $user -> lastname);
        $query->bindParam(':email', $user -> email);
        $query->bindParam(':password', $user -> password);
        $query->bindParam(':phone_number', $user -> phone_number);

        try{
            #Sjekker om sql statement er skrevet korrekt
            $query -> execute();
        } catch (PDOException $e){
            Logger::loggEvent("PDOException: " . $e -> getMessage());
        }

        if ($pdo->lastInsertId()) {
            // Registrering vellykket, send bruker til index.php
                return true;
            } else {
                return false;
            }
    }

}
?>
