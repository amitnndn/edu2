<?php 
	session_start();
	if(isset($_SESSION['logged_in']))	{
		if($_SESSION['logged_in'] == 1)	{
			$role = $_SESSION['role'];
			if($role == 1 || $role == 2 || $role == 4)	{
?>
<!DOCTYPE html>
<html>
<head>
<?php include_once("../head.php");?>
<title>
Course Report
</title>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
</head>
<body>
<?php include_once("../header.php");?>
<h1 style="text-align: center;">COURSE REPORTS</h1><hr>

<div id="container" style="min-width: 310px; height: 400px; margin: 0 100px 0 225px; max-width:500px; border-color: #fcfcfc; float:left;"></div>
<div id="container1" style="float: left;min-width: 400px; height: 400px; margin: 0 auto; max-width:500px;"></div><br><br>
<div id="clear" style="clear: both;"></div>
<div style="text-align:center"><a href="date_reports.php">Generate Reports Based on Dates</a></div>
<?php 
	include_once('../database.php');
	$data1a = array();
	$i = 0;
	$j = 0;
	$k = 0;
	$count = 1;
	$sqla = mysql_query("select * from courses");
    $n = mysql_num_rows($sqla);
        	for($i = 0 ; $i<$n ;$i++)	{
        		while($infoa=mysql_fetch_array($sqla))	{
        			$data1a[] = $infoa['name'];
        			$sql2a = mysql_query("select * from course_taken where course_id=".$infoa['id'].";");
        			$data2a[] = mysql_num_rows($sql2a);
      		}
        }
    $ds1 = json_encode($data1a);
    $ds2 = json_encode($data2a);
    $totalfee = 0;
	 $sql = mysql_query("select * from payments;");
	 while($info = mysql_fetch_array($sql))	{
	 	$totalfee += $info['fees_total'];
	 }
	 $sql1 = mysql_query("select * from courses;");
	 $n = mysql_num_rows($sql1);
	 while($info1 = mysql_fetch_array($sql1))	{
	 	$names[] = $info1['name'];
	 }
	 $sql = mysql_query("select * from courses;");
	 while($info = mysql_fetch_array($sql))	{
	 	$sql3 = mysql_query("select * from payments where course_id=".$info['id'].";");
		$totalfees = 0;
		$fee_recieved = 0;
		$fee_remainings = 0;
		while($info3 = mysql_fetch_array($sql3))	{	
				$totalfees 	+= $info3['fees_total'];
				$fee_recieved += $info3['fees_paid'];
				$fee_remainings += $info3['fees_remaining'];
		}
		$data2[] = $totalfees;
	 }
        
    
?>
<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Course Reports'
        },
        xAxis: {
            categories: <?php echo $ds1; ?>
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Number of Students'
            },
            stackLabels: {
                enabled: true,
                style: {
                    fontWeight: 'bold',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                }
            }
        },
      
        tooltip: {
            formatter: function() {
                return '<b>'+ this.x +'</b><br/>'+
                    this.series.name +': '+ this.y +'<br/>'+
                    'Total: '+ this.point.stackTotal;
            }
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: false,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                }
            }
        },
        series: [{
            name: 'Students',
            data: <?php echo $ds2?>
        }]
    });
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
                   <?php for($i=0;$i<$n;$i++)	{
                	 	$val = ($data2[$i]/$totalfee)*100;
                	 	if($i == ($n - 1))	{
                	 		echo "[ '".$names[$i]."' , ".$val." ]";
                	 	}
                	 	else	{
                	 		echo "[ '".$names[$i]."' , ".$val." ] ,";		
                	 	}
                	 }
                	?>

            ]
        }]
    });
});
</script>
<?php 
include_once("../footer.php");
?>
</body>
</html>
<?php 
			}
			else	{
				echo "Access Denied. Redirecting in 3 seconds.";
				header("refresh:3;url=../student/student_list.php");	
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