<?php 
	session_start();
	$user = $_SESSION['username'];
	$role = $_SESSION['role'];
	$id = $_GET['id'];
?>
<!DOCTYPE html>
<html>
<head>
<?php include_once("../head.php");?>
<title>
Update <?php echo $user;?>'s Profile
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
</head>
<body>
<?php include_once("../header.php");?>


<div id="padding" style="margin-left: 225px; background-color: #fcfcfc; margin-right: 525px;">
<form name='foo' action="user_update.php?id=<?php echo $id?>" method="post" style="margin-left: 25px; margin-right: 25px;">
<?php 
	include_once("../database.php");
	$sql = mysql_query("select * from users where id=$id;");
	while($info = mysql_fetch_array($sql))	{
		$name = $info['name'];
		$email = $info['email'];
		$phone = $info['phone'];
		$username = $info['username'];
		$sql2 = mysql_query("select * from roles where id=".$role.";");
		while($info2 = mysql_fetch_array($sql2))	{
			$r = $info2['desc'];
		}
	}
?>
<fieldset>
<legend>
Update <?php echo $name;?>'s details
</legend>
<table>
<tr><td>Name:</td><td><input type="text" value="<?php echo $name;?>" name="name"></td></tr>
<tr><td>Email:</td><td><input type="text" value="<?php echo $email;?>" name="email"></td></tr>
<tr><td>Phone:&nbsp</td><td><input type="text" value="<?php echo $phone;?>" name="phone"></td></tr>
<tr><td>Role:</td><td><input type="text" value="<?php echo $r;?>" readOnly="true" ></td></tr>
<tr><td>User Name:&nbsp</td><td><input type="text" value="<?php echo $username;?>" readonly="true"></td></tr>
<tr><td></td><td><a href="change_password.php?id=<?php echo $id;?>">Change Password</a></td></tr>
<tr><td></td><td><input type="submit" value="Update" class="btn btn-primary" id="alertMe2"></td></tr>
</table>
</fieldset>
</form>
</div>
<?php include_once("../footer.php");?>
</body>
</html>