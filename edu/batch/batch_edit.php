<?php 
	session_start();
	if(isset($_SESSION['logged_in']))	{
		if($_SESSION['logged_in'] == 1)	{
			$role = $_SESSION['role'];
			if($role == 1 || $role == 2)	{
?>
<!DOCTYPE html>
<html>
<head>
<?php include_once("../head.php");?>
<link href="http://localhost/htdocs/fd1/css/jquery-dtpicker.css" rel="stylesheet">
<script type="text/javascript" src="http://localhost/htdocs/fd1/js/jquery-dtpicker.js"></script>
<title>
Batch Form
</title>
<script type="text/javascript">
$(document).ready(function() {
		 $('#alertMe').on('click', function(){
			x = document.batch_form.batch_name.value;			
		if(x==null || x=="")	{
			alert("Batch Name Cannot be Empty");
			return false;
		}
			y = parseInt(document.batch_form.start_time.value);
			z = parseInt(document.batch_form.end_time.value);
		if(z<=y)	{
			alert("Start time Cannot be Less than End time");
			return false;
		}
		if(y==z)	{
			alert("Start time and End time Cannot be equal");
			return false;
		}
			a = document.batch_form.start_date.value;
			b = document.batch_form.end_date.value;
		if(a==null || b == null || a == "" || b=="")	{
			alert("Date(s) is(are) empty");
			return false;
		}
			c = document.batch_form.course.value;
		if(c=='0')	{
			alert("Please Select a Course");
			return false;
		}
		return true;
});
});
</script>
</head>
<body>
<?php include_once("../header.php");?>
<div id="padding" style="margin-left: 225px; background-color: #fcfcfc; margin-right: 525px;">
<form name='batch_form' action="batch_submit.php" method="post" style="margin-left: 25px; margin-right: 25px;">
<fieldset>
<table>
<legend>
Batch Edit
</legend>
<?php 
	$id = $_GET['id'];
	include_once("../database.php");
	$sql = mysql_query("select * from facilitators,batch,courses where batch.id=$id and batch.course_id = courses.id and facilitators.id = batch.facilitator_id;");
	//$sql = mysql_query("select * from courses;");
	while($info = mysql_fetch_array($sql))	{
?>
<tr><td>Batch Name:&nbsp</td><td><input type="text" name="batch_name" value="<?php echo $info['batch_name'];?>"></td></tr>
<tr><td>Courses:</td><td>
		<?php 
				echo "\n<input type='text' readonly='true' value='".$info['name']."'>";
		?></td></tr>
<tr><td>Facilitator:&nbsp</td><td>
<select name='facilitator_id'>
	<?php 
		$sql1 = mysql_query("select * from facilitators;");
		echo "<option value='0'>---Select a Facilitator---</option>";
		while($info1 = mysql_fetch_array($sql1))	{
			echo "<option value='".$info1['id']."'>".$info1['first_name']." ".$info1['last_name']."</option>";
		}
	?>
</select>
<?php 
	$sql2 = mysql_query("select * from facilitators where id=".$info['facilitator_id'].";");
	while($info2 = mysql_fetch_array($sql2))	{
		echo "Present Facilitator is ".$info2['first_name']." ".$info2['last_name'].".";	
	}
?>
<tr><td>Start Date:</td><td><input type="text" id="dp1" name="start_date" value="<?php echo $info['start_date'];?>">
<script type="text/javascript">
	$('#dp1').datepicker({format: 'yyyy-mm-dd'});
</script></td></tr>
<tr><td>End Date:</td><td><input type="text" id="dp2" name="end_date" value="<?php echo $info['end_date'];?>"><script type="text/javascript">
	$('#dp2').datepicker({format: 'yyyy-mm-dd'});
</script></td></tr>
<tr><td>Timings:</td><td><span><select name="start_time" style="width: 100px;">
<?php 
	$i=5;
	$l = $info['start_time'];
	if($l<=12)	{			
		for($j = $i;$j<=12;$j++)
		{	if($j == $l)	{
				echo "<option value='$j' selected='selected'>";
				echo $j.":00 AM";
				echo "</option>\n";
			}
			else {
				echo "<option value='$j'>";
				echo $j.":00 AM";
				echo "</option>\n";
			}
		}
	}
	else	{
		for($j = 1;$j<12;$j++)
		{	$k = 12 + $j;
			if($k == $l)	{
				echo "<option value= '$k' selected='selected'>";
				echo $j.":00 PM";
				echo "</option>\n";
			}
			else	{
				$k = 12 + $j;
				echo "<option value= '$k'>";
				echo $j.":00 PM";
				echo "</option>\n";
			}
		}
	}
?>
</select>&nbsp to 
<select name="end_time" style="width: 100px">
<?php 
	$i=5;
	$l = $info['end_time'];
	if($l<=12)	{			
		for($j = $i;$j<=12;$j++)
		{	if($j == $l)	{
				echo "<option value='$j' selected='selected'>";
				echo $j.":00 AM";
				echo "</option>\n";
			}
			else {
				echo "<option value='$j'>";
				echo $j.":00 AM";
				echo "</option>\n";
			}
		}
	}
	else	{
		for($j = 1;$j<12;$j++)
		{	$k = 12 + $j;
			if($k == $l)	{
				echo "<option value= '$k' selected='selected'>";
				echo $j.":00 PM";
				echo "</option>\n";
			}
			else	{
				$k = 12 + $j;
				echo "<option value= '$k'>";
				echo $j.":00 PM";
				echo "</option>\n";
			}
		}
	}
}
?>
</select></span>
</td></tr>
<script type="text/javascript">
function confirms()	{
	var r = confirm("Do you really want to delete this course?");
	return r;
}
</script>
<tr><td><a id="delete" href="batch_delete.php?id=<?php echo $id;?>" onclick="return confirms()">Delete Batch</a>
<tr><td><button type="submit" id="alertMe" class="btn btn-primary" onSubmit="validate()" >Submit</button></td></tr>
</table>
</fieldset>
</form>
</div>
<?php include_once('../footer.php');?>
</body>
</html>
<?php 
			}
			else	{
				echo "Access Denied. Redirecting in 3 seconds.";
				header("refresh:3;url=batch_list.php");	
			}		
		}
		else 	{
			header('Location:../index.php');
		}
	}
	else	{
		header('Location:../index.php');
	}
?>