<?php
	//Start session
	session_start();
	
	//Check whether the session variable SESS_MEMBER_ID is present or not
	if(!isset($_SESSION['PBB_SCHOOL']) || (trim($_SESSION['PBB_LEVEL']) == '')) {
		header("location: index.php");
		exit();
	}
?>