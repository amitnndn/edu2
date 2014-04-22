<?php
	include_once("database.php");
	include_once("createdatabase.php");
	$a = new database();
	$a->set_dbname("clients");
	$a->db_connect();
	$a->db_select();
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$subdomain = $_POST['subdomain'];
	$dbname = $_POST['dbname'];
	$phone = $_POST['phone'];
	$query = "insert into clients values(default,'$first_name','$last_name','$email','$subdomain','$password','$dbname');";	
	$response = $a->execute_query($query);
	if($response == 1){
		$file = 'c:\Windows\System32\drivers\etc\hosts';
		$handle = fopen($file,'a');
		$string = "\r\n 127.0.0.1 $subdomain";	
		fwrite($handle,$string);
		fclose($handle);
		$client_new = new duplicatetables();
		$client_new->create_db($dbname);
		$client_new->duplicate_tables("master_edu","$dbname");
		$a->db_disconnect();
		$a->set_dbname($dbname);
		$a->db_connect();
		$a->db_select();
		$name = $first_name." ".$last_name;
		$query = "insert into users values(default,'$name','$email','$phone','$email','$password',1);";
		$result = $a->execute_query($query);
		if($result == 1){
			echo "Success";
		}
		else{
			echo "ERROR 1 : ".$result;
		}
	}
	else{
		echo "ERROR 2 : ".$response;
	}
?>