<?php
$mysqli_hostname = "localhost";
$mysqli_user = "jborja";
$mysqli_password = "jborja";
$mysqli_database = "jborja";
$conn = mysqli_connect($mysqli_hostname, $mysqli_user, $mysqli_password,$mysqli_database) 
or die("Opps some thing went wrong");
// mysqli_select_db($mysqli_database, $bd) or die("Opps some thing went wrong");

?>
