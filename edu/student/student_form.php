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
<title>
Student Form
</title>
<script type="text/javascript">
	$(document).ready(function(){
		$('#alertMe2').on('click',function(){
			x = document.foo.first_name.value;
			y = document.foo.last_name.value;
			z = document.foo.phone.value;
			a = document.foo.email.value;
			if(x==null || x=="")	{
				alert("First Name Cannot be Empty");
				return false;
			}if(y==null || y=="")	{
				alert("Last Name Cannot be Empty");
				return false;
			}if(z==null || z=="")	{
				alert("Phone Number Cannot be Empty");
				return false;
			}if(a==null || a=="")	{
				alert("Email Cannot be Empty");
				return false;
			}if(!validaidateEmail(a))	{
				alert("Invalid Email Address");
				return false;
			}
		});
	});
	 function validaidateEmail($email) {
		  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		  if( !emailReg.test( $email ) ) {
		    return false;
		  } else {
		    return true;
		  }
		}
	</script>
</head>
<body>
<?php 
	include_once("../header.php");
?>
<div id="padding" style="margin-left: 225px; background-color: #fcfcfc; margin-right: 725px">
<form name="foo" action="student_submit.php" method="post" style="margin-left: 25px; margin-right: 25px;">
<fieldset>
<table>
<legend>
Student Registration
</legend>
<tr><td>First Name:</td><td><input type="text" name="first_name"></td></tr>
<tr><td>Last Name:</td><td><input type="text" name="last_name"></td></tr>
<tr><td>Phone:</td><td><input type="text" name="phone"></td></tr>
<tr><td>Email:</td><td><input type="text" name="email"></td></tr>
<tr><td>Address:</td><td><textarea name="address"></textarea></td>
<tr><td><button type="submit" class="btn btn-primary" id="alertMe2" >Submit</button></td></tr>
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
				header("refresh:3;url=student_list.php");	
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