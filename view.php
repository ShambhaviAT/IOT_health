<?php
$pid = $_POST['pid'];

echo 'pid='.$pid.'<br>';

$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "healthCare";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

$sql = 'SELECT * FROM patient WHERE pid='.$pid;
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
	echo "valid pid<br>";
}else{
	echo "invalid pid<br>";
        echo "<a href='/home.html'>back</a>";
	exit(0);
}

$sql = "SELECT pid, temperature, bpm, ecg_file, time FROM health_info WHERE pid=".$pid;

$result = mysqli_query($conn, $sql);
if( !$result ){
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    exit(1);
}

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
	echo "time: " . $row["time"]. "<br>";
        //echo "pid: " . $row["pid"]. "<br>";
	echo "Temperature: " . $row["temperature"]. "<br>";
	echo "Puse Rate: " . $row["bpm"]. "<br>";
	//echo "ecg_file: " . $row["ecg_file"]. "<br>";
	echo "<a href=/viewgraph.php?filename=".$row["ecg_file"]." target=_blank>click here</a><br><br>";
    }
echo "<a href=/home.html>back</a>";
} else {
    echo "0 results";
}


mysqli_close($conn);
?>
