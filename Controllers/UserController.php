<?php 
    session_start();

    require_once(__DIR__ . "/../Tools/Validate.php");
    require_once(__DIR__ . "/../Tools/dbcon.php");
    require_once(__DIR__ . "/../Models/User.php");

    if(isset($_POST["logIn"])){

        $email = Validate::sanitize($_POST["email"]);
        $password = Validate::sanitize($_POST["password"]);

        $sql = "SELECT users.id, users.firstname AS fname, users.lastname AS lname, email, phone_number, users.password, role_name 
        FROM users 
        INNER JOIN roles ON users.role_id = roles.role_id  WHERE email = :email";

        $sp = $pdo -> prepare($sql);

        $sp -> bindParam(":email", $email, PDO::PARAM_STR);

        try{
            #Sjekker om sql statement er skrevet korrekt
            $sp -> execute();
        } catch (PDOException $e){
            Logger::loggEvent("PDOException: " . $e -> getMessage());
        }

        $user = $sp -> fetch(PDO::FETCH_OBJ);

        if(!$user == null && password_verify($password, $user -> password)){
            $_SESSION['user']['id'] = $user -> id;
            $_SESSION['user']['email'] = $user -> email;
            $_SESSION['user']['fname'] = $user -> fname;
            $_SESSION['user']['lname'] = $user -> lname;
            $_SESSION['user']['phone'] = $user -> phone_number;
            $_SESSION['user']['role'] = $user -> role_name;
            $_SESSION['user']['logedIn'] = true;
            
            header("Location: ../Views/timeSlot/calender.php");
            exit();
        } else {
            echo "Feil brukernavn eller passord";
        }
        
    }
    if (isset($_POST["register"])) {

        $user = new User();
        $errorMessage = "";

        $emailValid = Validate::validateEmail($_POST["email"]);
        $phoneValid = Validate::validateMobileNr($_POST["phone_number"]);
        $passwordValid = Validate::validatePassword($_POST["password"]);

        $user -> firstname = Validate::sanitize($_POST["firstname"]);
        $user -> lastname = Validate::sanitize($_POST["lastname"]);
        $user -> email = Validate::sanitize($_POST["email"]);
        $user -> phone_number = Validate::sanitize($_POST["phone_number"]);
        $user -> password = password_hash(Validate::sanitize($_POST["password"]), PASSWORD_DEFAULT);

        if (!$emailValid) {
            $errorMessage .= "<p class='alert alert-danger'>Eposten er ikke gyldig.</p>";
        }
        if (!$phoneValid) {
            $errorMessage .= "<p class='alert alert-danger'>Telefonnummeret er ikke gyldig. Det må være 8 sifre.</p>";
        }
        if (!$passwordValid) {
            $errorMessage .= "<p class='alert alert-danger'>Passordet er ikke gyldig. Det må være over 7 tegn, inneholde minst en stor bokstav, en liten bokstav og et tall (0-9).</p>";
        }

        if ($errorMessage == ""){
            $registrationResult = User::registerUser($user);
        } else{
            $_SESSION['errorMessage'] = $errorMessage;
            header("Location: register.php");
            exit();
        }
    
        if ($registrationResult) {
            $_SESSION['registerMsg'] = "Du har registrert deg!"; // Melding som sier at registrering var vellyket
            header("Location: ../index.php");
            exit();
        } else {
            echo "Registrering feilet. Prøv igjen";
        }
    
    } 
    if (isset($_REQUEST["logOut"])) {
        // Code for user logout
        unset($_SESSION["user"]);
        session_destroy();
    
        session_start();
        $_SESSION['logOutMsg'] = "Du er nå logget ut";
        header("location: ../index.php");
        exit;
    }
    ?>