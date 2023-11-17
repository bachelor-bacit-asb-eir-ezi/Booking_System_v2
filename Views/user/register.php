<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <form method="post" action="/register/process" class="col-md-6 offset-md-3 bg-white p-4 shadow rounded">
            <h2 class="text-center mb-4">Bruker Registrering</h2>

            <div class="mb-3">
                <label for="firstname" class="form-label">Fornavn:</label>
                <input type="text" name="firstname" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="lastname" class="form-label">Etternavn:</label>
                <input type="text" name="lastname" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="phone_number" class="form-label">Telefon nummer:</label>
                <input type="text" name="phone_number" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Passord:</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="confirm_password" class="form-label">Gjenta Passord:</label>
                <input type="password" name="confirm_password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Registrer</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-cHjH21L7gP2E94LTYW7+1nUj65hbb/jqB5N2Xr+ckG6gnc7/5Pd7Qbvm4zjukY" crossorigin="anonymous"></script>
</body>
</html>
