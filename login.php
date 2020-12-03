

<?php
//Start session
session_start();
 
//Include database connection details
require_once('db.php');
 
//Array to store validation errors
$errmsg_arr = array();
 
//Validation error flag
$errflag = false;
 
 
//Sanitize the POST values
$username = ($_POST['username']);
$password = ($_POST['password']);
$level = ($_POST['level']);
 
//Input Validations
if($username == '') {
$errmsg_arr[] = 'Username missing';
$errflag = true;
}
if($password == '') {
$errmsg_arr[] = 'Password missing';
$errflag = true;
}
 
//If there are input validations, redirect back to the login form
if($errflag) {
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();
header("location: index.php");
exit();
}
 
//Create query
///user_name, user_pw, user_school, user_type, user_logcnt, user_level
$qry="SELECT * FROM div_users WHERE user_name='$username' AND user_pw='$password' AND user_level='$level'";
$result=mysqli_query($conn,$qry) or die('Error Query User');
 
//Check whether the query was successful or not
if($result) {
if(mysqli_num_rows($result) > 0) {
//Login Successful
session_regenerate_id();
$member = mysqli_fetch_assoc($result) or die('Query User');
$_SESSION['PBB_SCHOOL'] = $member['user_name'];
$_SESSION['PBB_PASS'] = $member['user_pw'];
$_SESSION['PBB_LEVEL'] = $member['user_level'];
$_SESSION['PBB_COUNT'] = $member['user_logcnt'];
session_write_close();
$logcnt = $member['user_logcnt'];

///http://localhost/inventory/tableedit.php#page=changepw	
if($logcnt == 0)	
	header("location: tableedit.php#page=changepw");
else
	header("location: tableedit.php");
exit();
}else {
//Login failed
$errmsg_arr[] = 'user name and password not found';
$errflag = true;
if($errflag) {
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();
header("location: index.php");
exit();
}
}
}else {
die("Query failed");
}
?>