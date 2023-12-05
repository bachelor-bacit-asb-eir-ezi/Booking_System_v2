<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <?php
    require_once(__DIR__ . '/../../Controllers/UserController.php');
    ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <img src="../../images/phpReg.png" alt="Registrer bilde" class="img-fluid mb-4">

                <!-- Registrerings Form -->
                <form method="POST" action="">
                    <h2 class="mb-4">Registrer deg her!</h2>

                    <div class="mb-3">
                        <label for="firstname" class="form-label">Fornavn:</label>
                        <input required name="firstname" type="text" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="lastname" class="form-label">Etternavn:</label>
                        <input required name="lastname" type="text" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Epost:</label>
                        <input required name="email" type="email" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="phone_number" class="form-label">Telefonnummer:</label>
                        <input required name="phone_number" type="text" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Passord:</label>
                        <input required name="password" type="password" class="form-control">
                    </div>

                    <button name="register" type="submit" class="btn btn-primary">Registrer</button>
                </form>
                <?php
                    if(isset($_SESSION["errorMessage"])){
                        echo $_SESSION["errorMessage"];
                        unset($_SESSION["errorMessage"]);
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
