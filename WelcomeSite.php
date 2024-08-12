<?php
session_start();
if (!isset($_SESSION["users"])) {
    header(("Location: login.php"));
}
// =============================
// require_once "db-connect.php";
// $query = "SELECT * FROM USERS";

// $data = mysqli_query($connt, $query);
// $total = mysqli_num_rows($data);
// $result = mysqli_fetch_assoc($data);

// echo $result ;
// echo $total;
// session_start();

?>


<!-- ======================================================== -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styleDB.css" class="css">

    <title>welcome to our site</title>
</head>

<body>
    <div class="container centers">
        <h1>welcome to our site</h1>
        <a href="logout.php" class="btn btn-info">Logout</a>
    </div>

</body>

</html>