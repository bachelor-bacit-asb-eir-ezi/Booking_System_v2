<?php
require(__DIR__ . '/../tools/dbcon.php');

class User
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function registerUser($firstname, $lastname, $email, $password, $phone_number)
    {
        $name = $firstname . ' ' . $lastname;
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (name, email, password, phone_number) 
                VALUES (:name, :email, :password, :phone_number)";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":password", $hashedPassword, PDO::PARAM_STR);
        $stmt->bindParam(":phone_number", $phone_number, PDO::PARAM_STR);

        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false; 
        }
    }
}
?>
