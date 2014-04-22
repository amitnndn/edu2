<?php 
	session_start();
	if(isset($_SESSION['logged_in']))	{
		if($_SESSION['logged_in']==1)	{
			$role = $_SESSION['role'];
			if($role == 1 || $role == 2 || $role == 3 || $role == 4)	{
?>
<!DOCTYPE html>
<html>
<head>
<?php include_once("head.php");?>
<title>
Home
</title>
<style rel="stylesheet">
#container	{
	padding: 25px;
	margin-left: 25px;
}
</style>
</head>
<body>
<?php include_once("header.php");?>
<div id="container">
Welcome <strong><?php echo $_SESSION['username'];?></strong>. Please select an option above to continue.
</div>
<?php include_once("footer.php");?>
</body>
</html>
<?php 
				
			}
			else	{
				
			}
		}
		else	{
			
		}
	}
	else	{
		
	}

?>