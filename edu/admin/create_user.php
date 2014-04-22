<?php 
	session_start();
	if(isset($_SESSION['logged_in']))	{
		if($_SESSION['logged_in'] == 1)	{
			if($_SESSION['role'] == 1)	{
?>
<!DOCTYPE html>
<html>
<head>
<?php include_once('../head.php');?>
<title>
Create User
</title>
<script type="text/javascript">
	$(document).ready(function(){
		$('#alertMe2').on('click',function(){
			x = document.foo.name.value;
			z = document.foo.phone.value;
			a = document.foo.email.value;
			if(x==null || x=="")	{
				alert("Name Cannot be Empty");
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
<style rel="stylesheet">
#user_form	{
	padding: 25px;
	margin: 25px;
}
form	{
	margin-right: 725px;
}
</style>
</head>
<body>
<div id="user_form">
<?php include_once('header.php')?>
<form name="foo" method="post" action="create_user_confirm.php">
<fieldset>
<legend>
Create a User
</legend>
<table>
<tr><td>Name:</td><td><input type="text" name="name"></td></tr>
<tr><td>Email:</td><td><input type="text" name="email"</td></tr>
<tr><td>Phone:</td><td><input type="text" name="phone"></td></tr>
<tr><td>Username:&nbsp</td><td><input type="text" name="username"></td></tr>
<tr><td>Password:</td><td><input type="password" name="password"></td></tr>
<tr><td>Role:</td><td><select name="role">
<option value='0'>---Select a Role---</option>
<?php 
	include_once('../database.php');
	$sql = mysql_query("select * from roles;");
	while($info = mysql_fetch_array($sql))	{
		echo "<option value='".$info['id']."'>".$info['desc']."</option>";
	}
?>
</select></td></tr>
<tr><td><input type='submit' class='btn btn-primary' value='Submit' id="alertMe2"></td></tr>
</table>
</fieldset>
</form>
</div>
<?php include_once('../footer.php');?>
</body>
</html>
<?php 		}
			else	{
				echo "Access Denied.";
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