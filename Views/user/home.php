<?php include(__DIR__ . "/../layout/header.php")?>

<?php
    require(__DIR__ . "/../../Controllers/UserController.php");

    #Hvis unset ikke blir gjort før login check vil msg vises når ny bruker logger in
    if(isset($_SESSION["msg"])){
        $msg = $_SESSION["msg"];
        unset($_SESSION["msg"]);
    }

    if (!$_SESSION["user"]["logedIn"]) {
        header("location: startPage.php");
        exit;
    }
    echo $_SESSION["user"]["id"] . "<br>";
    echo $_SESSION["user"]["email"] . "<br>";
    echo $_SESSION["user"]["name"] . "<br>";
    echo $_SESSION["user"]["phone"] . "<br>";
?>

<form method="POST">
    <input type="submit" name="logOut" value="Logg ut">
</form>

<?php include(__DIR__ . "/../layout/footer.php")?>
