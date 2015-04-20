<?php

	session_start();
	$pid = $_SESSION['P_id'];
	$username = "root";
	$password = "";
	$hostname = "localhost";

	$aDate = $_GET['adate'];
	$dName = $_GET['dname'];
	$sTime = $_GET['stime'];
	$eTime = $_GET['etime'];

	$conn = mysql_connect($hostname,$username,$password);
	$db = mysql_select_db('doctorsonline',$conn);

	$subquery =mysql_query("select D_id from doctor where D_name = '$dName'");
	$subr = mysql_fetch_array($subquery);
	$doc_id=$subr['D_id'];

	$query = "delete from appointment where A_date = '$aDate' and D_id = '$doc_id' and S_time = '$sTime' and E_time = '$eTime' and P_id = '$pid';";
	$fetch = mysql_query($query);
	mysql_close($conn);

?>