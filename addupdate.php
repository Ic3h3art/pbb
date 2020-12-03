<?php
include("db.php");
session_start();
//$_SESSION['PBB_SCHOOL']) || (trim($_SESSION['PBB_LEVEL'])
$schoolid = $_SESSION['PBB_SCHOOL'];
$schoollevel = $_SESSION['PBB_LEVEL']; 

if($_POST['teacherlist'])
{
	$id=$_POST['teacherlist'];
	$fullname=$_POST['fullname'];
	$sg=$_POST['sg'];
	$step=$_POST['step'];
	$months=$_POST['months'];
	//id, schoolid, fullname, sg, step, months, schoollevel
	mysqli_query($conn,"UPDATE div_teachers SET fullname='$fullname',sg='$sg',step='$step',months='$months'
	WHERE id='$id'") or die("UPDATE div_teacher SET fullname='$fullname',sg='$sg',step='$step',months='$months'
	WHERE id='$id'");
}
else
{
	$fullname=$_POST['fullname'];
	$sg=$_POST['sg'];
	$step=$_POST['step'];
	$months=$_POST['months'];
	//id, schoolid, fullname, sg, step, months, schoollevel
	if($fullname){
			mysqli_query($conn,"INSERT INTO div_teachers values ('0','$schoolid','$fullname','$sg','$step','$months','$schoollevel')");
	}
}




header("location: tableedit.php#page=addteacheredit");
?>