<?php
	session_start();
	$pid = $_SESSION['P_id'];
	$phno = $_GET['phno'];
	$address = $_GET['address'];
	$pwd = $_GET['pwd'];
	
	$conn = mysql_connect('localhost','root','');
	$db = mysql_select_db('doctorsonline',$conn);
	$query = 'UPDATE patient SET P_phno = "'.$phno.'", P_address = "'.$address.'", P_pwd = "'.$pwd.'" WHERE P_id = "'.$pid.'"';
	$fetch = mysql_query($query, $conn);
	echo $fetch;
?>