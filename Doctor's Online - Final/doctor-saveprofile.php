<?php
	session_start();
	$did = $_SESSION['D_id'];
	$phno = $_GET['phno'];
	$address = $_GET['address'];
	$pwd = $_GET['pwd'];
	$ccno= $_GET['ccno'];
	$conn = mysql_connect('localhost','root','');
	$db = mysql_select_db('doctorsonline',$conn);
	$query = 'UPDATE doctor SET D_phno = "'.$phno.'", D_address = "'.$address.'", D_pwd = "'.$pwd.'",D_ccno="'.$ccno.'" WHERE D_id = "'.$did.'"';
	$fetch = mysql_query($query, $conn);
	echo $fetch;
?>