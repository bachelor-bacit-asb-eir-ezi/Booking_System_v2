<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logg inn</title>
</head>
<body>
    <?php 
        require "../controllers/userController.php";

        #Hvis session med logOutMsg eksisterer: fjern den men lagre melding i variabel
        if (isset($_SESSION["logOutMsg"])) {
            $logOutMsg = $_SESSION["logOutMsg"];
            unset($_SESSION["logOutMsg"]);
        }

    ?>
    <form method="POST">
        <label for="email">Email</label>
        <input type="text" name="email">

        <label for="password">Passord</label>
        <input type="password" name="password">

        <input type="submit" name="logIn" value="Logg Inn">
    </form>
    <?php 
        if(isset($logOutMsg)){
            echo $logOutMsg;
        }
    ?>
</body>
</html>