<?php include(__DIR__ . "/../layout/header.php")?>

<?php
    require(__DIR__ . "/../../Controllers/UserController.php");

    if (!$_SESSION["user"]["logedIn"]){
        header("location: ../index.php");
        exit;
    }
echo '<div class="container mt-8">
        <div class="card" style="width: 15rem;">
            <div class="card-body">
                <h5 class="card-title">Min profil</h5>
                <h6 class="card-subtitle mb-2 text-muted">User ID: ' . htmlspecialchars($_SESSION["user"]["id"]) . '</h6>
                <p class="card-text">Email: ' . htmlspecialchars($_SESSION["user"]["email"]) . '</p>
                <p class="card-text">Navn: ' . htmlspecialchars($_SESSION["user"]["fname"]) . " " . htmlspecialchars($_SESSION["user"]["lname"]) . '</p>
                <p class="card-text">Telefonnummer: ' . htmlspecialchars($_SESSION["user"]["phone"]) . '</p>
                <p class="card-text">Rolle: ' . htmlspecialchars($_SESSION["user"]["role"]) . '</p>
                
            </div>
        </div>
      </div>';
?>

<?php include(__DIR__ . "/../layout/footer.php")?>
