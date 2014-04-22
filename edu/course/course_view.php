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
$('.confirm').live('click', function(){
    return confirm("Do you want to delete this course?");
});
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
	$id = $_GET['id'];
?>
<div id="padding" style="margin-left: 225px; background-color: #fcfcfc; margin-right: 725px">
<form action="course_update.php?id=<?php echo $id;?>" method="post" style="margin-left: 25px; margin-right: 25px;">
<fieldset>
<table>
<legend>
Course Entry
</legend>
<?php 
	include_once("../database.php");
	$sql = mysql_query("select * from courses where id=$id");
	while($info = mysql_fetch_array($sql))	{
?>
<tr><td>
Name:&nbsp</td><td><input type="text" name="course_name" value="<?php echo $info['name'];?>"><br></td></tr>
<tr><td>Fee:</td><td><input type="text" name="course_fee" value="<?php echo $info['fee'];?>"><br></td></tr>
<?php echo "<tr><td><a href='course_delete?id=".$info['id']."' class='confirm'>Delete Couse</a>"?>
</table>
<?php }?>
<tr><td><button type="submit" class="btn btn-primary" style="margin-left: 100px;" >Update</button></td></tr>
</fieldset>
</form>
</div>
<?php  include_once('../footer.php');?>
</body>
</html>
<?php 
			}
			else	{
				echo "Access Denied. Redirecting in 3 seconds.";
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