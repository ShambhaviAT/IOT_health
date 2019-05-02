<?php
$filename = $_GET['filename'];
$pathname = "/home/sana/data/".$filename;

$file = fopen($pathname, "r");

$index = 0;
$data = array();
while(! feof($file))
{
	//echo str_replace(PHP_EOL,'',fgets($file));
	$data[ $index ] = str_replace(PHP_EOL,'',fgets($file));
	$index++;
}

//echo json_encode($data, JSON_NUMERIC_CHECK);

fclose($file);
?>

<!DOCTYPE html>
<html>
<head>
<title>HighChart</title>
<link rel="stylesheet" href="hc/bootstrap.min.css">
<script type="text/javascript" src="hc/jquery.js"></script>
<script src="hc/highcharts.js"></script>
<script src="hc/moment.min.js"></script>
<script src="hc/moment-timezone-with-data-2012-2022.min.js"></script>
 
</head>
<body>
 
<script type="text/javascript">
$(function () {
	 
	$('#container').highcharts({
	chart: {
	type: 'line'
},
	time: {
	timezone: 'America/New_York'
},
	title: {
	text: 'ECG'
},
	xAxis: {
	title: {
	text: 'Time'
},
	type: 'integer',
},
	yAxis: {
	title: {
	text: 'Amplitude'
}
},
	series: [{
	name: 'Time',
	data: <?php echo json_encode($data, JSON_NUMERIC_CHECK);?>
}]
});
});
 
</script>
<!--script src="charts/js/highcharts.js"></script>
<script src="charts/js/modules/exporting.js"></script--!>
 
<div class="container">
<br/>
<h2 class="text-center">BLDEA CET ECG using raspberryPi</h2>
<div class="row">
<div class="col-md-20 col-md-offset-1">
<div class="panel panel-default">
<div class="panel-heading">Dashboard</div>
<div class="panel-body">
<div id="container"></div>
</div>
</div>
</div>
</div>
</div>
</body>
</html>
