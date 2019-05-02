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

$tfile = fopen("/home/sana/temp.dat","r");
$temp = fgets($tfile);

$bfile = fopen("/home/sana/pulse.dat","r");
$bpm = fgets($bfile);
fclose($tfile);
fclose($bfile);

$t=time();
$fname = 'ecg'.$pid.date("d-m-Y-h-i-sa",$t);

$sfile = '/home/sana/ecg.dat';
$dfile = '/home/sana/data/'.$fname;
echo $dfile.'<br>';
echo copy($sfile, $dfile).'<br>';

$sql = "INSERT INTO health_info (pid, temperature, bpm, ecg_file, time)
	VALUES ('$pid', '$temp', '$bpm', '$fname', NOW() )";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully<br>";
    echo "<a href='/home.html'>back</a>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
