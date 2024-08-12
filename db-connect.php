<?php

$hostName = "localhost";
$dbUser = "root";
$dbpassword = "";
$dbName = "registration";
$connt = mysqli_connect($hostName, $dbUser, $dbpassword, $dbName);
if(!$connt){
    die ("Something went wrong;");
}
?>