<?php 
    require(__DIR__ . "/../Tools/Validate.php");
    require(__DIR__ . "/../Tools/dbcon.php");

    session_start();

    if(isset($_POST["logIn"])){

        $email = Validate::sanitize($_POST["email"]);
        $password = Validate::sanitize($_POST["password"]);

        $sql = "SELECT users.id, users.name, email, phone_number, users.password FROM users WHERE email = :email";

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
            //$_SESSION['user']['role'] = cheackUserRole($user -> user_id, $pdo);
            $_SESSION['user']['logedIn'] = true;
            
            header("Location: ../Views/user/home.php");
            exit();
        } else {
            echo "Feil brukernavn eller passord";
        }
    }

    if(isset($_REQUEST["logOut"])){
        unset($_SESSION["user"]);
        session_destroy();

        session_start();
        $_SESSION['logOutMsg'] = "Du er nå logget ut";
        header("location: ../startPage.php");
        exit;
    }
?>