<?php include(__DIR__ . "/../layout/header.php"); ?>

<?php
require_once(__DIR__ . "/../../Controllers/TimeSlotController.php");

    //Må vær logget inn
    if (!isset($_SESSION["user"]["logedIn"]) || !$_SESSION["user"]["logedIn"]) {
        header("Location: ../index.php");
        exit;
    }
    //Admin-tilgang
    if ($_SESSION["user"]["role"] !== "tutor"){
        $_SESSION["msg"] = "Som student har du ikke tilgang til denne siden";
        header("location: ../user/deniedAccess.php");
        exit;
    }
$timeSlots = TimeSlot::getAllTimeSlots();

?>
<div class="container mt-4">
    <div class="row">
        <?php foreach ($timeSlots as $timeSlot): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-header">
                        Veileder: <?= htmlspecialchars($timeSlot->tutor_fname) ?> <?= htmlspecialchars($timeSlot->tutor_lname) ?>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Dato: <?= htmlspecialchars($timeSlot->date) ?></li>
                        <li class="list-group-item">Start tid: <?= htmlspecialchars($timeSlot->start_time) ?></li>
                        <li class="list-group-item">Slutt tid: <?= htmlspecialchars($timeSlot->end_time) ?></li>
                        <li class="list-group-item">Sted: <?= htmlspecialchars($timeSlot->location) ?></li>
                        <li class="list-group-item">Tema: <?= htmlspecialchars($timeSlot->description) ?></li>
                        <?php if ($timeSlot->booked_by): ?>
                            <li class="list-group-item">Booket av: <?= htmlspecialchars($timeSlot->student_fname) ?> <?= htmlspecialchars($timeSlot->student_lname) ?></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include(__DIR__ . "/../layout/footer.php"); ?>
