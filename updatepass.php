<?php
include("db.php");
session_start();
//$_SESSION['PBB_SCHOOL']) || (trim($_SESSION['PBB_LEVEL'])
$schoolid = $_SESSION['PBB_SCHOOL'];
$schoollevel = $_SESSION['PBB_LEVEL']; 

$newpassword = $_POST['newpassword'];

//user_name, user_pw, user_school, user_type, user_logcnt, user_level
//SELECT * FROM div_users d;
mysqli_query($conn,"UPDATE div_users SET user_logcnt = '10', user_pw = '$newpassword' ") or die("Error in Updating Password");
//echo "UPDATE div_users SET user_logcnt = '10' and user_pw = '$newpassword' ";
header("location: tableedit.php#page=school");
?>