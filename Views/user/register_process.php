<?php
  require_once(__DIR__ . "/../../Controllers/UserController.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Samle inn data fra $_POST
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Gjør klar SQL-spørringen
    $stmt = $pdo->prepare("INSERT INTO users (firstname, lastname, email, phone_number, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$firstname, $lastname, $email, $phone_number, $password]);
}
?>

<form method="POST">
    <label for="firstname">Fornavn:</label>
    <input required name="firstname" type="text">

    <label for="lastname">Etternavn:</label>
    <input required name="lastname" type="text">

    <label for="email">Epost:</label>
    <input required name="email" type="email">

    <label for="phone_number">Telefonnummer:</label>
    <input required name="phone_number" type="text">

    <label for="password">Passord:</label>
    <input required name="password" type="password">

    <label for="submit"></label>
    <input name="register" type="submit" value="Registrer">
</form>

