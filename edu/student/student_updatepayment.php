<?php 
	session_start();
	if(isset($_SESSION['logged_in']))	{
		if($_SESSION['logged_in'] == 1)	{
			$role = $_SESSION['role'];
			if($role == 1 || $role == 2 || $role == 4)	{
?>
<!DOCTYPE html>
<html>
<head>
<?php include_once('../head.php');?>
</head>
<title>
Update Payment
</title>
<link href="http://localhost/htdocs/fd1/css/jquery-dtpicker.css" rel="stylesheet">
<script type="text/javascript" src="http://localhost/htdocs/fd1/js/jquery-dtpicker.js"></script>
<script type="text/javascript">
function ajaxlist(value,id)	{
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
	 var batchid = value;
	 var studentid = id;
	 var queryString = "?batch_id="+batchid+"&student_id="+id;
	 ajaxRequest.open("GET","student_updatepay.php" + queryString, true);
	 ajaxRequest.send(null);
}
function validate()	{
	x = parseInt(document.foo.total_fee.value);
	y = parseInt(document.foo.feepaid.value);
	z = parseInt(document.foo.fee_remaining.value);
	a = parseInt(document.foo.fee_paid.value);
	b = parseInt(document.foo.payment_method.value);
	c = document.foo.date.value;
	if(a > z)	{
		alert("Amount Paid Cannot be Greater than Balance");
		return false;
	}if(b == 0)	{
		alert("Please select a payment method");
		return false;
	}if(c == null || c == "")	{
		alert("Please select a Payment Date");
		return false;
	}
}
</script>
<body>
<?php include_once('../header.php');
	$id = $_GET['id'];
	include_once('../database.php');
	$s = mysql_query("select * from student where id=$id;");
	while($inf = mysql_fetch_array($s))	{	
		$name = $inf['first_name'];
	}
?>
<div id="#message1">
<div style="margin-left: 225px; background-color: #fcfcfc; margin-right: 725px;">
<form name='foo' style="padding: 25px" action="student_updatefee.php?id=<?php echo $id;?>" method="post" onsubmit='return validate()'>
<fieldset>
<legend>
Update Payment of <?php echo $name;?>
</legend>
<table>
<?php 
	$sql = mysql_query("select * from batch_students where student_id = $id;");
	echo "<tr><td>Batch:&nbsp </td><td>";
	echo "<select name='batch_id' onchange='ajaxlist(this.value,$id)'>\n<option value='0'>---Select a Batch---</option>";
	while($info = mysql_fetch_array($sql))	{
		$sql1 = mysql_query("select * from batch where id=".$info['batch_id'].";");
		while($info1 = mysql_fetch_array($sql1))	{
			echo "<option value='".$info1['id']."'>".$info1['batch_name']."</option>";
		}
	}
	echo "</select>\n";
	echo "</td></tr>";
?>
<tr><td>Payment Date:&nbsp</td><td><input type='text' id='dp1' name='date'></td></tr>
<script type="text/javascript">
	$('#dp1').datepicker({format: 'yyyy-mm-dd'});
</script>
<table id="ajaxDiv"></table>
</table>
</fieldset>
</form>
</div>
</div>
<?php include_once("../footer.php");?>
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