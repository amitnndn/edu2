<?php
	include_once("../database.php");
	$id = $_GET['id'];
	$sql = mysql_query("select * from users where id = $id;");
	while($info = mysql_fetch_array($sql))	{
		echo "<input type='hidden' value='".$info['id']."' name='user_id'>";
		echo "<tr><td>Name:</td><td><input type='text' name='name' value ='".$info['name']."'></td></tr>";
		echo "<tr><td>Email: </td><td><input type='text' name='email' value='".$info['email']."'></td></tr>";
		echo "<tr><td>Phone: </td><td><input type='text' name='phone' value='".$info['phone']."'></td></tr>";
		echo "<tr><td>Username: </td><td><input type='text' name='username' value='".$info['username']."'></td></tr>";
		echo "<tr><td>Role: </td><td>";
		$sql1 = mysql_query("select * from roles;");
		echo "<select name='role'><option value='0'>---Select a Role---</option>";
		while($info1 = mysql_fetch_array($sql1))	{
			echo "<option value='".$info1['id']."'>".$info1['desc']."</option>";
		}
		echo "</select>";
		$sql2 = mysql_query("select * from roles where id = ".$info['roleid'].";");
		while($info2 = mysql_fetch_array($sql2))	{
			echo "&nbspPresent role is ".$info2['desc']."</td></tr>";
		}
		echo "<tr><td><a href='user_delete.php?id=$id'>Delete User</a></td></tr>";
		echo "<tr><td></td><input type = 'submit' value='Update' class='btn btn-primary'></td></td>";
	}
?>
	