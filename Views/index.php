<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logg inn</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="../CSS/startPage.css">
</head>
<body>
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card">
        <div class="card-body">

            <img src="../images/hanau.png" alt="PHP Elephant" class="img-crop mb-3">


            <?php
            require(__DIR__ . "/../Controllers/UserController.php");

            #Hvis session med logOutMsg eksisterer: fjern den men lagre melding i variabel
            if (isset($_SESSION["logOutMsg"])) {
                $logOutMsg = $_SESSION["logOutMsg"];
                unset($_SESSION["logOutMsg"]);
            }
            if (isset($_SESSION["registerMsg"])) {
                $registerMsg = $_SESSION["registerMsg"];
                unset($_SESSION["registerMsg"]);
            }
            ?>
            <form method="POST" class="p-4">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" class="form-control">
                </div>

                <div class="form-group">
                    <label for="password">Passord</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>

                <div class="form-group">
                    <input type="submit" name="logIn" value="Logg Inn" class="btn btn-primary btn-block">
                </div>
            </form>

            <a href="./user/register.php" class="btn btn-link">Registrer deg</a>

            <?php
            if(isset($logOutMsg)){
                echo "<div class='alert alert-warning'>$logOutMsg</div>";
            }
            if(isset($registerMsg)){
                echo "<div class='alert alert-primary'>$registerMsg</div>";
            }
            ?>
        </div>
    </div>
</div>
</body>
</html>




