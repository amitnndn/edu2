<?php 
    session_start();
    $_SESSION['db_name'] = "clients";
    include_once("database.php");
    $subdomain = array_shift(explode(".",$_SERVER['HTTP_HOST']));
    $db_name = $subdomain."_edu";
    $query = "select * from clients where dbname = '$db_name'";
    $sql = mysql_query($query);
    if($sql){
        $n = mysql_num_rows($sql);
        if($n > 1){
            header("Location:edu.com");
        }    
        else{
            $_SESSION['db_name'] = $db_name;
            //mysql_select_db($db_name);
        }
    }
    if(isset($_SESSION['logged_in']))	{
		if($_SESSION['logged_in']==1)	{
			header("Location:home.php");
		}
	}
	else	{
?>
<!DOCTYPE html>
<html>
<head>
<?php include_once('head.php')?>
<title>
Login
</title>
<style>
#myform	{
	padding: 25px 25px 25px 25px;
	margin: 175px 400px 150px 400px;
	position: relative;
	background-color: #fcfcfc;
}
</style>
</head>
<body>
<div id='myform'>
	<div id='ajaxDiv'></div>
    <form class="form-horizontal" action="login_verify.php" method="POST">
    <fieldset>
    <div id="legend" style="text-align:center">
    <legend class="">Login</legend>
    </div>
    <div class="control-group">
    <!-- Username -->
    <label class="control-label" for="username">Username:</label>
    <div class="controls">
    <input type="text" id="username" name="username" placeholder="" class="input-xlarge">
    </div>
    </div>
     
    <div class="control-group">
    <!-- Password-->
    <label class="control-label" for="password">Password:</label>
    <div class="controls">
    <input type="password" id="password" name="password" placeholder="" class="input-xlarge">
    </div>
    </div>
     
     
    <div class="control-group">
    <!-- Button -->
    <div class="controls">
    <button class="btn btn-primary" onclick="listamount()">Login</button>
    </div>
    </div>
    </fieldset>
    </form>
    <?php include_once('footer.php')?>
</div>
</body>
</html>
<?php }?>