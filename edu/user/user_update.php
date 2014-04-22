<?php
	include_once("../database.php");
	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$id = $_GET['id'];
	$sql = mysql_query("update users set name ='$name', email = '$email', phone='$phone' where id = $id;");
	if($sql)	{
		echo "Update successful. You will be redirected in 2 seconds.";
		header("refresh:2;url=profile.php?id=$id");
	}
	else	{
		mysql_error();
	}
?>
	