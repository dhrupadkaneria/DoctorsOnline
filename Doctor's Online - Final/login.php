<?php

	$email = $_POST['username'];
	$password = $_POST["password"];
	$type = $_POST["user"];
	$conn = mysql_connect('localhost','root','');
	$db = mysql_select_db('doctorsonline',$conn);
	if($type == 'patient')
	{
		$fetch = mysql_query("SELECT P_pwd, P_id, P_name FROM patient WHERE P_email = '$email'");
		$row = mysql_fetch_assoc($fetch);
		if($row["P_pwd"] == $password)
		{
			//echo " P Successful";
			session_start();
			$_SESSION['sid'] = session_id();
			$_SESSION['P_id'] = $row["P_id"];
			$_SESSION['P_name'] = $row["P_name"];
			header("Location: patientprofile.php");
		}
		else
		{
			header("Location: login.html");
		}
	}
	else if($type == 'doctor')
	{
		$fetch = mysql_query("SELECT D_pwd, D_id, D_name FROM doctor WHERE D_email = '$email'");
		$row = mysql_fetch_assoc($fetch);
		if($row["D_pwd"] == $password)
		{
			//echo "D Successful";
			session_start();
			$_SESSION['sid'] = session_id();
			$_SESSION['D_id'] = $row["D_id"];
			$_SESSION['D_name'] = $row["D_name"];
			header("Location: doctorprofile.php");
		}
		else
		{
			header("Location: login.html");
		}
	}

	else
		{
			header("Location: login.html");
		}
?>