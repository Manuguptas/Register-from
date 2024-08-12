<?php
session_start();
if(isset($_SESSION["users"])){
    header(("Location: index.php"));
}
?>

<!DOCTYPE html>
 <html lang="en">

 <head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="styleDB.css" class="css">

   <title>login</title>
 </head>

 <body>
   <div class="container">
     <?php
      if (isset($_POST["login"])) {
        $gmail = $_POST["gmail"];
        $password = $_POST["password"];
        require_once "db-connect.php";
        $sql = "SELECT * FROM users WHERE gmail = '$gmail'";
        $result  = mysqli_query($connt, $sql);
        $users = mysqli_fetch_array($result, MYSQLI_ASSOC);
        if ($users) {
          session_start();
          $_SESSION["users"]="yes";
            header("Location: WelcomeSite.php");
          // if (password_verify($password, $users["password"])) {
          //   die();
          // } else {
          //   echo "<div class='alert alert-danger'> Password does not match</div>";
          // }
        } else {
          echo "<div class='alert alert-danger'> Email does not match</div>";
        }
      } 


      ?>
     <form class="row g-3" action="login.php" method="post">
       <div class="col-md-4">
         <label for="validationDefault01" class="form-label">Email</label>
         <input type="email" class="form-control" id="validationDefault01" name="gmail" placeholder="Email" require>
       </div>
       <div class="col-md-4">
         <label for="validationDefault02" class="form-label">Password</label>
         <input type="password" class="form-control" id="validationDefault02" name="password" placeholder="Password" require>
       </div>

       <div class="col-12">
         <button class="btn btn-primary" name="login" type="submit">Login</button>
       </div>
     </form>
   </div>

   <div class="container"><p>Not registered yet! &nbsp; <a href="index.php">register here</a> </p></div>
 </body>

 </html>