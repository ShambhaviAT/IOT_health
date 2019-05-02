<?php
//echo $_POST["uname"];
//echo $_POST["passwd"];
if( !$_POST["name"] || !$_POST["age"] || !$_POST["gender"] || !$_POST["addr"] || !$_POST["city"] || !$_POST["ph"] )
	header('Location:/new.html'); //echo "invalid"	
else
	//echo "done";
	$servername = "localhost";
	$username = "root";
	$password = "password";
	$dbname = "healthCare";
	
	$name   = $_POST["name"];
	$age    = $_POST["age"];
	$gender = $_POST["gender"];
	$addr   = $_POST["addr"];   
	$city   = $_POST["city"];
	$ph     = $_POST["ph"];

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
	}

	$sql = "INSERT INTO patient (name, age, gender, address, city, phone, date, time)
		VALUES ('$name', '$age', '$gender', '$addr','$city', '$ph',CURDATE(), CURTIME() )";

	if (mysqli_query($conn, $sql)) {
		$last_id = mysqli_insert_id($conn);
    		echo "New record created successfully.<br><h1> PID is: " . $last_id . "</h1><br><br>";
    		echo "<a href='/home.html'>back</a>";
	} else {
    		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}

	mysqli_close($conn);
?>
