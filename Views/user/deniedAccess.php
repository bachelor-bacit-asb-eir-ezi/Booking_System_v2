<?php include(__DIR__ . "/../layout/header.php")?>
<?php 
session_start();

if (!$_SESSION["user"]["logedIn"]){
    header("location: ../index.php");
    exit;
}
?>

<h1>Ingen tilgang</h1>

<?php 
if(isset($_SESSION["msg"])){
    $msg = $_SESSION["msg"];
    unset($_SESSION["msg"]);
}
if(isset($msg)){
    echo $msg;
    unset($msg);
}
?>
<br>
<a class="btn btn-info" href="timeSlot/calender.php">Gå til kalender</a>
<?php include(__DIR__ . "/../layout/footer.php")?>