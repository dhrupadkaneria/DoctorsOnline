<?php

$from = $_POST["fromDate"];
$to = $_POST["toDate"];

session_start();
$docId = $_SESSION['D_id'];
//echo $from;
//echo $to;

#Query to add leave entry into the database
	$conn = mysql_connect("localhost", "root", '') or die("Unable to connect to MySQL");
	mysql_select_db("doctorsonline", $conn) or die("Could not find database");
	#should set session variable / cookie with doctor id;
	#$docId = $_SESSION["doctorId"];
	$query = "insert into leaves (`D_id`, `S_date`, `E_date`) values (" . $docId . ", '" . $from . "', '" . $to . "');";
	//$query = "insert into leaves (`D_id`, `S_date`, `E_date`) values (345678, '" . $from . "', '" . $to . "');";
	//echo $query;
	$fetch = mysql_query($query, $conn);
	//echo $fetch;
	mysql_close($conn);
	echo "alert('Dates Noted');";
	header('Location: doctorprofile.php');
?>