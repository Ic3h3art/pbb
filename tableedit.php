<?php
	require_once('auth.php');

include('db.php');

//if($_SESSION['PBB_COUNT'] == 0)
//	header("location: tableedit.php#page=changepw");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>PBB Monitoring System</title>
<script type="text/javascript" src="http://ajax.googleapis.com/
ajax/libs/jquery/1.5/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
$("#addteacher").show();
$("#updateteacher").hide();
	
	
$("#teacherlist").change(function(){


	
$.ajax({
				url: "pulldata.php",
				type: "POST",
				data: {
					id: $(this).val(),
			},
				cache: false,
				success: function(dataResult){
					//alert(JSON.stringify(dataResult));
					//alert(dataResult[]);
					//id, schoolid, fullname, sg, step, months, schoollevel
					dataResult = JSON.parse(dataResult);
					//alert(dataResult["fullname"]);
					//alert(dataResult["id"]);
					if(dataResult["id"]){
						//alert("test");
						$("#addeditteacher").val(dataResult["fullname"]);
						$("#addeditsg").val(dataResult["sg"]);
						$("#addeditstep").val(dataResult["step"]);
						$("#addeditmonths").val(dataResult["months"]);
					}		
				}
			});


//alert("test" + $(this).val());	
if($(this).val())
	{
		$("#addteacher").hide();
		$("#updateteacher").show();
	}
else
	{
		$("#addeditform").trigger('reset');
		$("#addteacher").show();
		$("#updateteacher").hide();
	}
});	
	
$(".edit_tr").click(function()
{
var ID=$(this).attr('id');

$("#laststep_"+ID).hide();
$("#laststep_input_"+ID).show();

$("#lastsg_"+ID).hide();
$("#lastsg_input_"+ID).show();
	
$("#lastmonth_"+ID).hide();
$("#lastmonth_input_"+ID).show();

}).change(function()
{
var ID=$(this).attr('id');
var schoolid=$("#lastsg_input_"+ID).val();
var cname=$("#laststep_input_"+ID).val();
var sg=$("#lastsg_input_"+ID).val();
var step=$("#laststep_input_"+ID).val();
var months=$("#lastmonth_input_"+ID).val();

var dataString = 'id='+ ID +'&schoolid='+schoolid+'&cname='+cname+'&sg='+sg+'&step='+step+'&months='+months;

$("#first_"+ID).html('<img src="images/load.gif" />');


if(months.length && sg.length && step.length>0)
{

$.ajax({
type: "POST",
url: "table_edit_ajax.php",
data: dataString,
cache: false,
success: function(html)
{
$("#lastsg_"+ID).html(sg);
$("#laststep_"+ID).html(step);
$("#lastmonth_"+ID).html(months);
$("#first_"+ID).html('');
$("#last_"+ID).html('');
}
});
}
else
{
alert('Enter something.');
}

});

$(".editbox").mouseup(function() 
{
return false
});

$(document).mouseup(function()
{
$(".editbox").hide();
$(".text").show();
});

});
</script>
<style>
	#addteacher {
		font: bolder;
		font-size: 18px;
	}	
	#updateteacher{
			font: bolder;
		font-size: 18px;
	}
body
{
font-family:Arial, Helvetica, sans-serif;
font-size:14px;
padding:10px;
}
.editbox
{
display:none
}
td
{
padding:7px;
border-left:1px solid #fff;
border-bottom:1px solid #fff;
}
table{
border-right:1px solid #fff;
}
.editbox
{
font-size:14px;
width:29px;
background-color:#ffffcc;

border:solid 1px #000;
padding:0 4px;
}
.edit_tr:hover
{
background:url(edit.png) right no-repeat #80C8E5;
cursor:pointer;
}
.edit_tr
{
background: none repeat scroll 0 0 #D5EAF0;
}
th
{
font-weight:bold;
text-align:left;
padding:7px;
border:1px solid #fff;
border-right-width: 0px;
}
.head
{
background: none repeat scroll 0 0 #91C5D4;
color:#00000;

}

</style>
<link rel="stylesheet" href="reset.css" type="text/css" media="screen" />

<link rel="stylesheet" href="tab.css" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css" href="tcal.css" />
<script type="text/javascript" src="tcal.js"></script> 
<link href="tabs.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">

var popupWindow=null;

function child_open()
{ 

popupWindow =window.open('printform.php',"_blank","directories=no, status=no, menubar=no, scrollbars=yes, resizable=no,width=950, height=400,top=200,left=200");

}
</script>
</head>

<body bgcolor="#dedede">
 
<h3>PBB Monitoring System</h3>
<span>
	<?php
	///SELECT * FROM div_schools d;
	///schools_id, school_name, school_level, school_class, school_div
	///$_SESSION['PBB_SCHOOL'] $_SESSION['PBB_LEVEL']
	$sqls=mysqli_query($conn,"SELECT * FROM div_schools where schools_id='".$_SESSION['PBB_SCHOOL']."' and school_level='".$_SESSION['PBB_LEVEL']."'");
		$rows=mysqli_fetch_array($sqls);
	
		$schoolid = $rows['schools_id'];
		$schoollevel = $rows['school_level'];
	
		echo "<h2>".$rows['school_name']."</h2>";
		echo "<h2>School ID: ".$rows['schools_id']."</h2>";
		echo "<h2>School Level: ".$rows['school_level']."</h2>";
	?>
		
</span>
<ol id="toc">
    <li><a href="#school"><span>School</span></a></li>
    <li><a href="#addteacheredit"><span>Add/Edit Teacher</span></a></li>
	<li><a href="#changepw"><span>Change Password</span></a></li>
	<li><a href="index.php"><span>Logout</span></a></li>
</ol>

<div class="content" id="school">
<font size="+6">Click the table rows to edit Salary Grade,Step or Number of Months in Service.</font><br><br>
<table width="100%">
<tr class="head">
<th>School ID</th>
<th>Complete Name</th>
<th>Salary Grade</th>
<th>Step</th>
<th>Months In Service</th>
	</tr>
<?php
$da=date("Y-m-d");

//SELECT * FROM div_teachers d;
//id, schoolid, fullname, sg, step, months, schoollevel
	
	
$sql=mysqli_query($conn,"SELECT * FROM div_teachers where schoolid = '$schoolid' AND schoollevel = '$schoollevel'");
$i=1;
while($row=mysqli_fetch_array($sql))
{
$id=$row['id'];
$schoolid=$row['schoolid'];
$cname=$row['fullname'];
$sg=$row['sg'];
$step=$row['step'];
$months=$row['months'];
//$sales=$row['sales'];

if($i%2)
{
?>
<tr id="<?php echo $id; ?>" class="edit_tr">
<?php } else { ?>
<tr id="<?php echo $id; ?>" bgcolor="#f2f2f2" class="edit_tr">
<?php } ?>
<td class="edit_td">
<span id="lastschoolid_<?php echo $id; ?>"  class="text"><?php echo $schoolid; ?></span>
<input type="text" value="<?php echo $schoolid; ?>"  class="editbox" id="lastschoolid_input_<?php echo $id; ?>"/>	
</td>
<td>
<span id="lastcname_<?php echo $id; ?>"  class="text"><?php echo $cname; ?></span>
<input type="text" value="<?php echo $cname; ?>"  class="editbox" id="lastcname_input_<?php echo $id; ?>"/>
</td>
<td>
<span id="lastsg_<?php echo $id; ?>" class="text">
<?php echo $sg; ?>
</span> 
<input type="text" value="<?php echo $sg; ?>"  class="editbox" id="lastsg_input_<?php echo $id; ?>"/>
</td>
<td>
<span id="laststep_<?php echo $id; ?>" class="text">
<?php echo $step; ?>
</span> 
<input type="text" value="<?php echo $step; ?>"  class="editbox" id="laststep_input_<?php echo $id; ?>"/>
</td>
<td>
<span id="lastmonth_<?php echo $id; ?>" class="text"><?php echo $months; ?></span>
<input type="text" value="<?php echo $months; ?>" class="editbox" id="lastmonth_input_<?php echo $id; ?>" />
<span id="first_<?php echo $id; ?>"></span>
</td>
</tr>

<?php
$i++;
}
?>

</table>

</div>
<div class="content" id="changepw">
<h1>Please Update Password</h1>
	<form action="updatepass.php" id="updatepass" method="post">
	<table align="center">
		<tr><td><strong>New Password:</strong></td><td><input type="password" name="newpassword"></td></tr>
		<tr><td><strong>Retype New Password:</strong></td><td><input type="password" name="retypepassword"></td></tr>
		<tr><td></td><td><input type="submit" value="Update Password"></td></tr>
	</table>
	</form>
</div>
<div class="content" id="addteacheredit">
	<h1>Select Add Teacher Option to Add Teacher or Select Teacher to be edited.<br />
	To Remove Teacher Select Teacher and Empty the Teacher Fullname</h1>
	
	<form action="addupdate.php" id="addeditform" method="post">
	<div style="margin-left: 48px;">
	Teacher List:<?php
	$name=mysqli_query($conn,"SELECT * FROM div_teachers where schoolid = '$schoolid' AND schoollevel = '$schoollevel'");
	
	echo '<select name="teacherlist" id="teacherlist" class="textfield1">';
	echo '<option value="" selected>Add Teacher Option</option>';
	 while($res= mysqli_fetch_assoc($name))
	{
		 //id, schoolid, fullname, sg, step, months, schoollevel
	echo '<option value="'.$res['id'].'">';
	echo $res['fullname'];
	echo'</option>';
	}
	echo'</select>';
	?>
	</div>
	<br />
	Teacher Fullname:<input id="addeditteacher" name="fullname" size="50" type="text" placeholder="LASTNAME, FIRSTNAME MIDDLENAME" />
		<br/><br/>
	Salary Grade:
		<select name="sg" id="addeditsg">
		<?php
			for($x = 0; $x <= 22; $x++)
			{
				echo "<option value='$x'>$x</option>";
			}
			
		?>
		</select>
		&nbsp;
		Step:
		<select name="step" id="addeditstep">
		<?php
			for($s = 0; $s <= 8; $s++)
			{
				echo "<option value='$s'>$s</option>";
			}
			
		?>
		</select>
		&nbsp;
		Months in service:
		<select name="months" id="addeditmonths">
		<?php
			for($m = 0; $m <= 12; $m++)
			{
				echo "<option value='$m'>$m</option>";
			}
			
		?>
		</select>
		<br />

	<div style="margin-top: 14px;">
		<input name="" id="addteacher" type="submit" value="Add Teacher" />
		<input name="" id="updateteacher" type="submit" value="Update Teacher" />
	</div>
</form>
</div>

</div>
<script src="activatables.js" type="text/javascript"></script>
<script type="text/javascript">
//activatables('page', ['school', 'changepw', 'addteacheredit', 'addproitem', 'addpro', 'editprice']);
activatables('page', ['school', 'changepw', 'addteacheredit']);	
</script>
</body>
</html>
