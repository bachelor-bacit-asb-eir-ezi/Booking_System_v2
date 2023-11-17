<?php 
    session_start();

    require(__DIR__ . "/../Tools/Validate.php");
    require(__DIR__ . "/../Tools/dbcon.php");


    if(isset($_POST["logIn"])){

        $email = Validate::sanitize($_POST["email"]);
        $password = Validate::sanitize($_POST["password"]);

        $sql = "SELECT users.id, users.name, email, phone_number, users.password, role_name 
        FROM users 
        INNER JOIN roles ON users.role_id = roles.role_id  WHERE email = :email";

        $sp = $pdo -> prepare($sql);

        $sp -> bindParam(":email", $email, PDO::PARAM_STR);

        try{
            #Sjekker om sql statement er skrevet korrekt
            $sp -> execute();
        } catch (PDOException $e){
            echo $e; //Bør logges istedenfor skrevet ut, sikkerhets risiko
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
        // Code for user registration
        $firstname = Validate::sanitize($_POST["firstname"]);
        $lastname = Validate::sanitize($_POST["lastname"]);
        $email = Validate::sanitize($_POST["email"]);
        $password = password_hash(Validate::sanitize($_POST["password"]), PASSWORD_DEFAULT);
        $phone_number = Validate::sanitize($_POST["phone_number"]);
    
        $sql = "INSERT INTO users (firstname, lastname, email, password, phone_number) 
                VALUES (:firstname, :lastname, :email, :password, :phone_number)";
    
        $sp = $pdo->prepare($sql);
    
        $sp->bindParam(":firstname", $firstname, PDO::PARAM_STR);
        $sp->bindParam(":lastname", $lastname, PDO::PARAM_STR);
        $sp->bindParam(":email", $email, PDO::PARAM_STR);
        $sp->bindParam(":password", $password, PDO::PARAM_STR);
        $sp->bindParam(":phone_number", $phone_number, PDO::PARAM_STR);
    
        try {
            $sp->execute();
            echo "Registration successful!"; // You might want to redirect or handle this differently
        } catch (PDOException $e) {
            echo $e->getMessage(); // Log or handle the error appropriately
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