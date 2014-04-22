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
Add a Student to Course
</title>
<script type="text/javascript" src="../jquery.tokeninput.js"></script>
<link rel="stylesheet" href="../token-input.css">
<script type="text/javascript">
	$(document).ready(function() {
		var request;
		$('#foo').submit(function(event) {
			var $form = $(this);
			var $inputs = $form.find('input, select, textarea');
			var serializeddata = $form.serialize();
			$inputs.prop("disabled",true);
			request = $.ajax({
				url:"http://localhost/htdocs/edu/form.php",
				type: "post",
				data: serializeddata
			});
			request.done(function(response, textStatus, jqXHR){
				console.log("It worked!");
			});
			request.fail(function (jqXHR, textStatus, errorThrown){
		        // log the error to the console
		        console.error(
		            "The following error occured: "+
		            textStatus, errorThrown
		        );
		    });
			request.always(function(){
				$inputs.prop("disabled",false);
			});
			event.preventDefault();
			$('#myModal').modal('hide');
		});
		$('#alertMe2').on('click', function(){
			x = document.course_form.student_id.value;	
		if(x==null || x=="")	{
			alert("Batch Name Cannot be Empty");
			return false;
		}
		return true;
		});
		$('#alertMe2').on('click',function(){
			x = document.foo.first_name.value;
			y = document.foo.last_name.value;
			z = document.foo.phone.value;
			a = document.foo.email.value;
			b = document.foo.address.value;
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
			}if(b==null || b=="")	{
				alert("Address Cannot be Empty");
				return false;
			}
		});
	});
</script>
</head>
<body>
<?php 
	include_once('../header.php');
	$id = $_GET['id'];
?>
<div id="padding" style="margin-left: 225px; background-color: #fcfcfc; margin-right: 400px;">
<form name="course_form" action='test.php?id=<?php echo $id;?>' method='post' style="margin-left: 25px; margin-right: 25px; padding-bottom: 25px;">
<fieldset>
<legend>
Add Student to Course
</legend>
<table>
<tr><td>Student Name:&nbsp</td><td>
<input type="text" id="demo-input-prevent-duplicates" name="student_id" />
<?php 
	include_once("../database.php");
	$sql = mysql_query("select * from courses where id=$id;");
	while($info = mysql_fetch_array($sql))	{
?>
<input type="hidden" name="course_id" readonly="true" value="<?php echo $info['id']; }?>"> 
<script type="text/javascript">
        $(document).ready(function() {
            $("#demo-input-prevent-duplicates").tokenInput("http://localhost/htdocs/edu/studentlist.php", {
                preventDuplicates: true
            });
        });
</script>
</td><td>
<a href="#myModal" role="button" data-toggle="modal">&nbspClick to Create a Student</a></td></tr>
<tr><td></td><td><button type='submit' class='btn btn-primary' id="alertMe">Submit</button></td></tr>
</table>
</fieldset>
</form>
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
<h3 id="myModalLabel">Create a Student</h3>
</div>
<form id="foo" name="foo">
<div class="modal-body">
<table>
<tr><td>First Name:&nbsp</td><td><input type="text" name="first_name"></td></tr>
<tr><td>Last Name:</td><td><input type="text" name="last_name"></td></tr>
<tr><td>Phone:</td><td><input type="text" name="phone"></td></tr>
<tr><td>Email:</td><td><input type="text" name="email"></td></tr>
<tr><td>Address:</td><td><textarea name="address"></textarea></td></tr>
<tr><td><input class="btn btn-primary" name="commit"  type="submit" value="Submit" id="alertMe2"/>
</table>
</div>
<div class="modal-footer">
<a href=" " data-dismiss="modal" aria-hidden="true">Close</a>
</form>
</div>
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