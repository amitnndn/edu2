<!DOCTYPE html>
	<head>
		<title>Home</title>
	</head>
	<body>
		<?php
			session_start();
			if($_SESSION['is_loggedin']){
		?>
			<ahref ></a>


		<?php
			}
			else{
				echo "you are not logged in";
			}
		?>
