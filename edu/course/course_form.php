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
<title>Course Form
</title>
<?php include_once("../head.php");?>
<script type="text/javascript">
$(document).ready(function(){
	$("#alertMe2").on('click',function(){
			x = document.foo.course_name.value;
			y = document.foo.course_fee.value;
			if(x==null || x=="")	{
				alert("Course Name cannot be empty");
				return false;
			}
			if(y==null || y=="")	{
				alert("Course Fee cannot be empty");
				return false;
			}
	});
});
</script>
</head>
<body>
<?php 
	include_once("../header.php");
?>
<div id="padding" style="margin-left: 225px; background-color: #fcfcfc; margin-right: 725px;">
<form name="foo" action="course_submit.php" method="post" style="margin-left: 25px; margin-right: 25px;">
<fieldset>
<table>
<legend>
Course Entry
</legend>
<tr><td>
Name:</td><td><input type="text" name="course_name"><br></td></tr>
<tr><td>Fee:</td><td><input type="text" name="course_fee"><br></td></tr>

</table>
<tr><td><button type="submit" class="btn btn-primary" style="margin-left: 100px;" id="alertMe2" >Submit</button></td></tr>
</fieldset>
</form>
</div>
<?php  include_once('../footer.php');?>
</body>
</html>
<?php 
			}
			else	{
				echo "Access Denied.";
				header("refresh:3;url=course_list.php");	
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