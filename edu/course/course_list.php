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
<h2 style="text-align: center">COURSE LIST</h2><hr style="margin-right: 100px; margin-left: 100px">
<div class="row-fluid">
<div class="span12">
<div id="container" style="margin-left: 100px; margin-right: 100px;">
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
<thead>
	<th style="text-align: center;">Course Name</th>
	<th style="text-align: center;">Fees</th>
	<th style="text-align: center;">Action</th>

</thead>
<tbody> 
<?php 
	$i = 0;
	include_once("../database.php");
	$sql = mysql_query("select * from courses;");
	while($info = mysql_fetch_array($sql))	{
		$is = $info['id'];
		echo "<tr><td style='text-align: center;'><a href=\"#myModal".$info['id']."\" role=\"button\" data-toggle=\"modal\">".$info['name']."</a></td><td style='text-align: center;'>Rs. ".$info['fee']."</td><td style='text-align: center;'><a href='course_view.php?id=".$info['id']."'>Edit</a>&nbsp|&nbsp<a href='course_addbatch.php?id=".$info['id']."'>Add a Batch</a></td></tr>";
?>	

<?php 
	}
?>
</tbody>
</table>
</div>
</div>
</div>
<?php 
	$sql1 = mysql_query("select * from courses;");
	while($info1 = mysql_fetch_array($sql1))	{
		$data2 = array();
		$name = array();		
?>
		<div id="myModal<?php echo $info1['id'];?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
		<h3 id="myModalLabel"><?php echo $info1['name']."'s Reports"?></h3>
		</div>
		<div class="modal-body">
		<?php 
			$sql2 = mysql_query("select * from batch where course_id = ".$info1['id'].";");
			while($info2 = mysql_fetch_array($sql2))	{
				$sql3 = mysql_query("select * from payments where batch_id=".$info2['id'].";");
				$name[] = $info2['batch_name'];
				$totalfee = 0;
				$totalfees = 0;
				$feecollected = 0;
				$feeremaining = 0;
				while($info3 = mysql_fetch_array($sql3))	{
					$totalfees += $info3['fees_total'];
					$feecollected += $info3['fees_paid'];
					$feeremaining += $info3['fees_remaining'];
				}
				$data2[] = $totalfees;
			}
			$sql4 = mysql_query("select * from payments where course_id = ".$info1['id'].";");
			while($info4 = mysql_fetch_array($sql4))	{
				$totalfee += $info4['fees_total'];	
			}
			$sql5 = mysql_query("select * from batch where course_id = ".$info1['id'].";");
			$n = mysql_num_rows($sql5);
		?>
		<div id="container<?php echo $info1['id'];?>" style="min-width: 310px;margin-left:100px; max-width:500px;"></div>
		</div>
		<div class="modal-footer">
		<a href=" " data-dismiss="modal" aria-hidden="true">Close</a>
		</form>
		</div>
		</div>
		<script type="text/javascript">
			$(function () {
				$('#container<?php echo $info1['id'];?>').highcharts({
				    chart: {
				        plotBackgroundColor: null,
				        plotBorderWidth: null,
				        plotShadow: false
				    },
				    title: {
				        text: 'Revenue Analysis'
				    },
				    tooltip: {
					    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
				    },
				    plotOptions: {
				        pie: {
				            allowPointSelect: true,
				            cursor: 'pointer',
				            dataLabels: {
				                enabled: true,
				                color: '#000000',
				                connectorColor: '#000000',
				                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
				            }
				        }
				    },
				    series: [{
				        type: 'pie',
				        name: 'Percentage',
				        data: [
				               <?php for($i=0;$i<$n;$i++)	{
				            	 	$val = ($data2[$i]/$totalfee)*100;
				            	 	if($i == ($n - 1))	{
				            	 		echo "[ '".$name[$i]."' , ".$val." ]";
				            	 	}
				            	 	else	{
				            	 		echo "[ '".$name[$i]."' , ".$val." ] ,";		
				            	 	}
				            	 }
				            	?>
				
				        ]
				    }]
				});
			});
			</script>
		
<?php  }?>	
<?php include_once("../footer.php");?>
</html>
<?php 
			}
			else	{
				echo "Access Denied. Redirecting in 3 seconds.";
				header("refresh:3;url=course_list.php");		
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