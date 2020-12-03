<?php
include("db.php");
$id=$_POST['id'];

$sql=mysqli_query($conn,"SELECT * FROM div_teachers where id='$id'");
$row=mysqli_fetch_array($sql);

//json_encode(array("statusCode"=>200)

echo json_encode($row);
?>