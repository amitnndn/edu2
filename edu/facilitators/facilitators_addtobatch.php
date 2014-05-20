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
<script type="text/javascript" src="../jquery.tokeninput.js"></script>
<link rel="stylesheet" href="../token-input.css">
<title>
Add to Batch
</title>
</head>
<body>
<?php include_once('../header.php');?>
<div id="padding" style="margin-left: 225px; background-color: #fcfcfc; margin-right: 500px;">
<form action="facilitators_addbatch.php?id=<?php echo $_GET['id']?>" method="post" style="margin-left: 25px; margin-right: 25px;">
<fieldset>

<?php 
	include_once('../database.php');
	$id = $_GET['id'];
	$sql = mysql_query("select * from batch;");
	$sql1 = mysql_query("select * from facilitators where id=$id");
	while($info1 = mysql_fetch_array($sql1))	{
		$name = $info1['first_name'];
	}
?>
<legend>
Add <?php echo $name;?> to a Batch
</legend>
<table>
<tr><td>Batch:&nbsp</td><td>
<input type="text" id="demo-input-prevent-duplicates" name="batch_id" />
<script type="text/javascript">
        $(document).ready(function() {
            $("#demo-input-prevent-duplicates").tokenInput("/edu/batchlist.php", {
                preventDuplicates: true
            });
        });
</script>
<tr><td><br></td></tr>
<tr><td></td><td><input type="submit" class="btn btn-primary" value="Update"></td></tr>
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
				header("refresh:3;url=facilitators_list.php");
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