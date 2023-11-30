<?php 
    session_start();

    require(__DIR__ . "/../Tools/Validate.php");
    require(__DIR__ . "/../Tools/dbcon.php");
    require(__DIR__ . "/../Models/User.php");


    if(isset($_POST["logIn"])){

        $email = Validate::sanitize($_POST["email"]);
        $password = Validate::sanitize($_POST["password"]);

        $sql = "SELECT users.id, users.firstname, users.lastname, email, phone_number, users.password, role_name 
        FROM users 
        INNER JOIN roles ON users.role_id = roles.role_id  WHERE email = :email";

        $sp = $pdo -> prepare($sql);

        $sp -> bindParam(":email", $email, PDO::PARAM_STR);

        try{
            #Sjekker om sql statement er skrevet korrekt
            $sp -> execute();
        } catch (PDOException $e){
            echo "En feil oppstod";
            error_log($e);
        }

        $user = $sp -> fetch(PDO::FETCH_OBJ);

        if(!$user == null && password_verify($password, $user -> password)){
            $_SESSION['user']['id'] = $user -> id;
            $_SESSION['user']['email'] = $user -> email;
            $_SESSION['user']['name'] = $user -> name;
            $_SESSION['user']['phone'] = $user -> phone_number;
            $_SESSION['user']['role'] = $user -> role_name;
            $_SESSION['user']['logedIn'] = true;
            
            header("Location: ../Views/timeSlot/calender.php");
            exit();
        } else {
            echo "Feil brukernavn eller passord";
        }
        
    } elseif (isset($_POST["register"])) {
        $firstname = Validate::sanitize($_POST["firstname"]);
        $lastname = Validate::sanitize($_POST["lastname"]);
        $email = Validate::sanitize($_POST["email"]);
        $password = password_hash(Validate::sanitize($_POST["password"]), PASSWORD_DEFAULT);
        $phone_number = Validate::sanitize($_POST["phone_number"]);
    
        $registrationResult = $userModel->registerUser($firstname, $lastname, $email, $password, $phone_number);
    
        if ($registrationResult) {
            $_SESSION['registrationMsg'] = "Du har registrert deg!"; // Save a success message in the session
            header("Location: ../index.php");
            exit();
        } else {
            echo "Registrering feilet. Prøv igjen";
        }
    
    } elseif (isset($_REQUEST["logOut"])) {
        // Code for user logout
        unset($_SESSION["user"]);
        session_destroy();
    
        session_start();
        $_SESSION['logOutMsg'] = "Du er nå logget ut";
        header("location: ../index.php");
        exit;
    }
    ?>