<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 8px;
        }

        .form-control {
            margin-bottom: 15px;
        }

        img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <?php
    require(__DIR__ . "/../../Tools/dbcon.php");

    if (isset($_POST['register'])) {
        // Samle inn data fra $_POST
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $phone_number = $_POST['phone_number'];

        $user = array(
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'password' => $password,
            'phone_number' => $phone_number
        );

        $sql = "INSERT INTO users (firstname, lastname, email, password, phone_number)
                VALUES (:firstname, :lastname, :email, :password, :phone_number)";

        // Gjør klar SQL-spørringen
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
        $stmt->bindParam(':lastname', $lastname, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':phone_number', $phone_number, PDO::PARAM_STR);

        try {
        $stmt->execute();
        } catch (PDOException $e) {
        echo $e ->getMessage();
        }

        if ($pdo->lastInsertId()) {
        // Registrering vellykket, send bruker til index.php
            header("Location: ../index.php");
            exit();
        } else {
            echo "Noe gikk galt";
        }
    }
    ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <img src="../../images/phpReg.png" alt="Registrer bilde" class="img-fluid mb-4">

                <!-- Registration Form -->
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
            </div>
        </div>
    </div>
</body>
</html>