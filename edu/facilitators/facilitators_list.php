<?php 
	session_start();
	if(isset($_SESSION['logged_in']))	{
		if($_SESSION['logged_in'] == 1)	{
			$role = $_SESSION['role'];
			if($role == 1 || $role == 2 || $role == 3 || $role == 4)	{
?>
<!DOCTYPE html>
<html>
<head>
<?php include_once("../head.php");?>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
<title>
Details
</title>
</head>
<?php 
include_once("../header.php");
?>
<h2 style="text-align: center">FACILITATOR LIST</h2><hr style="margin-right: 100px; margin-left: 100px">
<div class="row-fluid">
<div class="span12">
<div id="container" style="margin-left: 100px; margin-right: 100px;">
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
<thead>
	<th style="text-align: center;">Name</th>
	<th style="text-align: center;">Contact</th>
	<th style="text-align: center;">Action</th>

</thead>
<tbody> 
<?php 
	$i = 0;
	include_once("../database.php");
	$sql = mysql_query("select * from facilitators;");
	while($info = mysql_fetch_array($sql))	{
		$is = $info['id'];
		echo "<tr><td style='text-align: center;'><a href='#myModal".$info['id']."' role=\"button\" data-toggle=\"modal\">".$info['first_name']." ".$info['last_name']."</a></td><td style='text-align: center;'>".$info['phone']."</td><td style='text-align: center;'><a href='facilitators_edit.php?id=".$info['id']."'>Edit</a>&nbsp|&nbsp<a href='facilitators_addtobatch.php?id=".$info['id']."'>Add to Batch</a></td></tr>";
		
	}
?>	
</tbody>
</table>
</div>
</div>
</div>
<?php 
	$sql1 = mysql_query("select * from facilitators;");
	while($info1 = mysql_fetch_array($sql1))	{
		
?>
		<div id="myModal<?php echo $info1['id'];?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
		<h3 id="myModalLabel"><?php echo trim($info1['first_name'])."'s Reports"?></h3>
		</div>
		<div class="modal-body">
		<h4>Batches Handled:</h4>
			<?php	
				$sql2 = mysql_query("select * from batch where facilitator_id=".$info1['id'].";");
				while($info2 = mysql_fetch_array($sql2))	{
					echo $info2['batch_name']."<br>";
				}
			?>
		</div>
		<div class="modal-footer">
		<a href=" " data-dismiss="modal" aria-hidden="true">Close</a>
		</div>
		</div>
		
<?php }?>

<?php include_once("../footer.php");?>
</html>
<?php 
			}
			else	{
				echo "Access Denied.";
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