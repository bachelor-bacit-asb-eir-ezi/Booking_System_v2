<?php include(__DIR__ . "/../layout/header.php")?>

<?php 
    require_once(__DIR__ . "/../../Controllers/TimeSlotController.php");

    if ($_SESSION["user"]["role"] !== "tutor"){
        $_SESSION["msg"] = "Du har ikke tilgang til den siden";
        header("location: ../user/home.php");
        exit;
    }
?>

<form method="POST">
    <label for="date">Dato:</label>
    <input required name="date" type="date">

    <label for="startTime">Start tid:</label>
    <input required name="startTime" type="time">

    <label for="location">Sted:</label>
    <input required name="location" type="text">

    <label for="description">Tema:</label>
    <input required name="description" type="text">
    
    <label for="submit"></label>
    <input name="createTimeSlot" type="submit" value="Opprett">
</form>

<?php include(__DIR__ . "/../layout/footer.php")?>