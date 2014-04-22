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
Edit User
</title>
<style rel="stylesheet">
#user_form	{
	padding: 25px;
	margin: 25px;
}
form	{
	margin-right: 725px;
}
</style>
<script type="text/javascript">
function listamount(id)	{
	 var ajaxRequest;  // The variable that makes Ajax possible!
		
	 try{
	   // Opera 8.0+, Firefox, Safari
	   ajaxRequest = new XMLHttpRequest();
	 }catch (e){
	   // Internet Explorer Browsers
	   try{
	      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
	   }catch (e) {
	      try{
	         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
	      }catch (e){
	         // Something went wrong
	         alert("Your browser broke!");
	         return false;
	      }
	   }
	 }
	 // Create a function that will receive data 
	 // sent from the server and will update
	 // div section in the same page.
	 ajaxRequest.onreadystatechange = function(){
	   if(ajaxRequest.readyState == 4){
	      var ajaxDisplay = document.getElementById('ajaxDiv');
	      ajaxDisplay.innerHTML = ajaxRequest.responseText;
	   }
	 }
	 // Now get the value from user and pass it to
	 // server script.
	 var user_id = id;
	 var queryString = "?id=" +user_id;
	 ajaxRequest.open("GET", "user_show.php" + 
	                              queryString, true);
	 ajaxRequest.send(null);
}
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
<div id="user_form">
<?php include_once('header.php')?>
<form name="foo" method="post" action="update_user.php">
<fieldset>
<legend>
Edit User
</legend>
<table>
<tr><td>Select a User:&nbsp</td><td><select name="user" onchange="listamount(this.value)">
	<option value='0'>---Select a User---</option>
	<?php 
		include_once("../database.php");
		$sql = mysql_query("select * from users;");
		while($info = mysql_fetch_array($sql))	{
			$id1 = $info['id'];
			$name = $info['name'];
	?>
	<option value="<?php echo $id1?>"><?php echo $name?></option>
	<?php }?>
</select></td></tr>
</table>
<table id="ajaxDiv"></table>
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