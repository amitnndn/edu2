<!DOCTYPE html>
	<head>
		<title>EDU App</title>
		<script src="https://code.jquery.com/jquery-2.1.0.js" type="text/javascript" ></script>
		<style type="text/css">
			body{
				max-width: 960px;
				margin: 0 auto;
			}
			.client_register{
				width: 40%;
				padding: 5px;
				background-color: lightgrey;
				-webkit-border-radius: 5px;
				-moz-border-radius: 5px;
				border-radius: 5px;
				height: 240px;
			}
			.first_name, .last_name, .email, .subdomain, .password, .phone{
				width: 50%;
			}
			.input_field{
				float: left;
				width: 66%;
				padding: 5px;
			}
			input{
				width: 74%;
			}
			.input_text{
				float: left;
				width: 20%;
				padding: 5px;
			}
			.clear{
				clear: both;
			}
			.submit{
				width: 25%;
				background-color: green;
				-webkit-border-radius: 5px;
				-moz-border-radius: 5px;
				border-radius: 5px;
				/* IE10 Consumer Preview */ 
				background-image: -ms-linear-gradient(top, #FFFFFF 0%, #43EF29 100%);

				/* Mozilla Firefox */ 
				background-image: -moz-linear-gradient(top, #FFFFFF 0%, #43EF29 100%);

				/* Opera */ 
				background-image: -o-linear-gradient(top, #FFFFFF 0%, #43EF29 100%);

				/* Webkit (Safari/Chrome 10) */ 
				background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, #FFFFFF), color-stop(1, #43EF29));

				/* Webkit (Chrome 11+) */ 
				background-image: -webkit-linear-gradient(top, #FFFFFF 0%, #43EF29 100%);

				/* W3C Markup, IE10 Release Preview */ 
				background-image: linear-gradient(to bottom, #FFFFFF 0%, #43EF29 100%);
			}
		</style>
	</head>
	<body>
		<?php
			$subdomain = array_shift(explode(".",$_SERVER['HTTP_HOST']));
			echo $subdomain;
			if($subdomain == "edu")	{
		?>
		<h1>Registration Form</h1>
		<form method="post" class="client_register">
			<div class="input_text">First Name:</div><div class="input_field"><input class="first_name" type="text" /></div><div class="clear"></div>
			<div class="input_text">Last Name: </div><div class="input_field"><input class="last_name" type="text"/></div><div class="clear"></div>
			<div class="input_text">Email: </div><div class="input_field"><input class="email" type="email"/></div><div class="clear"></div>
			<div class="input_text">Subdomain: </div><div class="input_field"><input class="subdomain" type="text"/>.edu.com</div><div class="clear"></div>
			<div class="input_text">Password: </div><div class="input_field"><input class="password" type="password"/></div><div class="clear"></div>
			<div class="input_text">Phone: </div><div class="input_field"><input class="phone" type="number" /></div><div class="clear"></div>
			<div class="input_text"></div><div class="input_field"><input type="submit" value="Register" class="submit"/></div>
		</form>
		<?php
			}
			else{
				echo "$subdomain.edu.com/edu";
				header("Location: edu");
			}
		?>
		<script type="text/javascript">
			$(document).ready(function(){
				$(".submit").on('click',function(e){
					e.preventDefault();
					var first_name = $(".first_name").val();
					var last_name = $(".last_name").val();
					var email = $(".email").val();
					var subdomain = $(".subdomain").val();
					var password = $(".password").val();
					var phone = $(".phone").val();
					var dbname = subdomain + "_edu";
				 	var final_subdomain = subdomain + ".edu.com";
				 	$.post("register_client.php",{first_name : first_name, last_name : last_name, dbname : dbname, phone : phone, email : email, subdomain : final_subdomain, password : password},function(data){
				 		alert(data);
				 		window.location = "http://"+final_subdomain;
				 	});
				});
			});
		</script>
	</body>
</html>
