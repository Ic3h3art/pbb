<?php
include("db.php");
if($_POST['id'])
{
	//var dataString = 'id='+ ID +'&schoolid='+schoolid+'&cname='+cname+'&sg='+sg+'&step='+step+'&months='+months;

$id=($_POST['id']);
$schoolid=($_POST['schoolid']);
$cname=($_POST['cname']);
$sg=($_POST['sg']);
$step=($_POST['step']);
$months=($_POST['months']);
	
//SELECT * FROM div_teachers d;
//id, schoolid, fullname, sg, step, months, schoollevel
$sql = "update div_teachers set sg='$sg',step='$step',months='$months' where id='$id'";
mysqli_query($conn,$sql) or die("Error in Updating");
}
?>


