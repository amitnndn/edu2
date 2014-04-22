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
<?php include_once('../head.php');?>
<title> 
Add Student to Course 
</title>
<script type="text/javascript">
function listamount(value,id)	{
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
	 var age = value;
	 var student_id = id;
	 var queryString = "?id=" + age +"&studentid="+student_id;
	 ajaxRequest.open("GET", "student_addcourse.php" + 
	                              queryString, true);
	 ajaxRequest.send(null);
}
$("#alertMe2").on('click',function(){
		x = document.foo.course_id.value;
		y = document.foo.batch_id.value;
		z = document.foo.amount_paid.value;
		alert(y);
		if(y == 0 )	{
			alert("Please select a batch");
			return false;
		}
});
</script>
</head>
<body>
<?php 
	include_once('../header.php');
	include_once('../database.php');
?>
<div id="padding" style="margin-left: 225px; background-color: #fcfcfc; margin-right: 725px">
<form name="foo" action="student_payconfirm.php" method="post" style="margin-left: 25px; margin-right: 25px;">
<fieldset>
<legend>
<?php 
	$id = $_GET['id'];
	$sql = mysql_query("select * from student where id=$id;");
	echo "Add ";
	while($info = mysql_fetch_array($sql))	{
		echo $info['first_name']." ";
	}
	echo "to a Course";
?>
</legend>
<table>
	<input type="hidden" value="<?php echo $id;?>" name="student_id">
	<tr><td>Course Name:&nbsp</td><td><select name='course_id' onchange='listamount(this.value,<?php echo $id;?>)'>
		<option value='0' selected='true'>---Select a Course---</option>
	<?php 
		$sql1 = mysql_query("select * from courses;");
		while($info1 = mysql_fetch_array($sql1))	{
			echo "<option value=".$info1['id'].">".$info1['name']."</option>";
		}
	?>
	</select></td></tr>
	<input type='hidden' value="<?php echo Date("Y-m-d");?>" name='date'> 
	<table id='ajaxDiv'></table>
	
	<div id='message'></div>
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