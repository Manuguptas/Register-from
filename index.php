<?php
session_start();
if(isset($_SESSION["users"])){
    header(("Location: WelcomeSite.php"));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta author="Manu gupta">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="styleDB.css" class="css">
  <title>register-form</title>
</head>

<body class="container">
<!-- ============================================================================================= -->
<?php
  if (isset($_POST["submit"])) {
    $name = $_POST["names"];
    $lname = $_POST["lname"];
    $gmail = $_POST["gmail"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    $errors = array();
    if (empty($name) or empty($lname) or empty($gmail)) {
      array_push($errors, "All fields are required");
    }
    if (!filter_var($gmail, FILTER_VALIDATE_EMAIL)) {
      array_push($errors, "Email is not valid");
    }

    if(strlen($password)<8){
      array_push($errors, "Password must be at least 8 charactes");
    }

    if($password !== $cpassword){
      array_push($error, "Password does not match");
    }

    // ======================================================
    require_once "db-connect.php";
    $sql = "SELECT * FROM users WHERE gmail = '$gmail'";
    $result = mysqli_query($connt, $sql);
    $rowCount = mysqli_num_rows($result);
    if ($rowCount > 0) {
      array_push($errors, "Email already exists!");
    }

    // =============================================================
    if (count($errors) > 0) {
      foreach ($errors as $error) {
        echo "<div class='alert alert-danger'>$error</div>";
      }
    } else {
      $sql = "INSERT INTO users (names, lname, gmail,password) VALUES(?, ?, ?,?)";
      $stmt = mysqli_stmt_init($connt);
      $preparestmt = mysqli_stmt_prepare($stmt, $sql);
      if ($preparestmt) {
        mysqli_stmt_bind_param($stmt, "ssss", $name, $lname, $gmail,$password);
        mysqli_stmt_execute($stmt);
        echo "<div class='alert alert-success'>You are registered successfully.</div>";
      } else {
        die("Something went worng");
      }
    }
  }
  ?>

  <!-- ================================================================================= -->
  <form class="row g-3" action="index.php" method="post">
    <div class="col-md-4">
      <label for="validationDefault01" class="form-label">First name</label>
      <input type="text" class="form-control" id="validationDefault01" placeholder="Frist Name" name="names">
    </div>
    <div class="col-md-4">
      <label for="validationDefault02" class="form-label">Last name</label>
      <input type="text" class="form-control" id="validationDefault02" placeholder="Last Name" name="lname">
    </div>
    <div class="col-md-4">
      <label for="validationDefaultUsername" class="form-label">Email</label>
      <div class="input-group">
        <span class="input-group-text" id="inputGroupPrepend2">Email</span>
        <input type="text" class="form-control" id="validationDefaultUsername" aria-describedby="inputGroupPrepend2" name="gmail">
      </div>
    </div>

    <div class="col-md-4">
      <label for="validationDefault02" class="form-label">Password</label>
      <input type="text" class="form-control" id="validationDefault02" placeholder="Passwored" name="password">
    </div>

    <div class="col-md-4">
      <label for="validationDefault02" class="form-label">Confirm Password</label>
      <input type="password" class="form-control" id="validationDefault02" placeholder="confirm Passwored" name="cpassword">
    </div>

    <div class="col-12">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" require>
        <label class="form-check-label" for="invalidCheck2">
          Agree to terms and conditions
        </label>
      </div>
    </div>
    <div class="col-12">
      <button class="btn btn-primary" type="submit" name="submit">Submit form</button>
    </div>
  </form>


  <div class="container"><p>Already register! &nbsp; <a href="login.php">Login here</a> </p></div>
</body>

</html>