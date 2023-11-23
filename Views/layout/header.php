<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="../../CSS/style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand " href="">UIA bookingsystem</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="btn btn-outline-secondary" href="../timeSlot/calender.php">Tidsluker</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-secondary" href="../timeSlot/create.php">Opprett tid</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-secondary" href="../user/home.php">Min profil</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-secondary" href="../timeSlot/show.php">Ledige/booket timer</a>
                </li>
                <form>
                    <a class="btn btn-outline-danger" href="../user/home.php?logOut" role="button">Logg ut</a>
                </form>


            </ul>


        </div>
    </div>
</nav>

</body>
</html>
