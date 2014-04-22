<?php 
	session_start();
	if(isset($_SESSION['logged_in']))	{
		if($_SESSION['logged_in'] == 1)	{
			$role = $_SESSION['role'];
			if($role == 1 || $role == 2 || $role == 3)	{
?>
<!DOCTYPE html>
<html>
<head>
<?php include_once("../head.php");?>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
<title>
Add to Batch
</title>
</head>
<body>
<?php include_once("../header.php");?>
<h3 style="text-align: center;">Reports within <?php echo $_POST['start_date'];?> - <?php echo $_POST['end_date'];?></h3><hr>
<div id="container1" style="min-width: 310px; height: 400px; margin: 0 auto; max-width:500px;"></div>
<?php
	include_once('../database.php');
	$startdate = strtotime($_POST['start_date']);
	$enddate = strtotime($_POST['end_date']);
	$sql = mysql_query("select * from courses;");
	$i = 0;
	$feespaid = array();
	$feestotal = array();
	$n = mysql_num_rows($sql);
	while($info = mysql_fetch_array($sql))	{
		$courseid = $info['id'];
		$sql1 = mysql_query("select * from payments where course_id = $courseid;");
		while($info1 = mysql_fetch_array($sql1))	{	
			$date = strtotime($info1['date']);
			if($date < $enddate || $date > $startdate)	{
				$feespaid[$i] += $info1['fees_paid'];
				$feestotal[$i] = $info1['fees_total'];
			}
		}
		$names[$i] = $info['name'];
		$totalfee += $feestotal[$i];
		$i++;
	}
?>
<script type="text/javascript">
$(function () {
$('#container1').highcharts({
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
               <?php for($j=0;$j<($i);$j++)	{
            	 	$val = ($feestotal[$j]/$totalfee)*100;
            	 	if($i == ($n - 1))	{
            	 		echo "[ '".$names[$j]."' , ".$val." ]";
            	 	}
            	 	else	{
            	 		echo "[ '".$names[$j]."' , ".$val." ] ,";		
            	 	}
            	 }
            	?>

        ]
    }]
});
});
</script>
</body>
</html>
<?php 
			}
			else	{
				echo "Access Denied. Redirecting in 3 seconds.";
				header("refresh:3;url=student_list.php");	
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