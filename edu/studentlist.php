<?php 
	session_start();
	if(isset($_SESSION['logged_in']))	{
		if($_SESSION['logged_in'] == 1)	{
?>
<?php
	$data = array();
	include_once('database.php');
	$sql = mysql_query("select * from student;");
	while($info = mysql_fetch_array($sql))	{
		$id = $info['id'];
		$name = $info['first_name']." ".$info['last_name'];
		$buildjson = array('name' => "$name",'id'=>"$id");
 // Adds each array into the container array
 		array_push($data, $buildjson);
	}
	echo json_encode($data);
?>
<?php 
				
		}
		else 	{
			header('Location:../index.php');
		}
	}
	else	{
		header('Location:../index.php');
	}
?>