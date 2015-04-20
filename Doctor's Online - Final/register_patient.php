<?php
    $name = $_POST["name"];
	$phone = $_POST["phone"];
	$email = $_POST["email"];
	$password = $_POST["password"];
	$location = $_POST["address"];
	$gender = $_POST["gender"];
	$dob = $_POST["dob"];

	$conn = mysql_connect('localhost','root','');
	$db = mysql_select_db('doctorsonline',$conn);
	$fetch = mysql_query("INSERT INTO patient(P_name, P_phno, P_email, P_pwd, P_address, P_gender, P_dob) VALUES ('$name','$phone','$email','$password','$location','$gender','$dob');");
	if($fetch == 1)
	{
		session_start();
		$_SESSION['sid']=session_id();
		$_SESSION['P_name'] = $name;
		//$_SESSION['P_id'] = $pid;
		header("Location: login.html");
	}
	else
	{
		echo "<script>alert('Username already exists');window.location.href = 'register_patient.html';</script>";
	}
	
	/*$db_con = mysql_connect("localhost","root", "");
			if(!$db_con)  die("Connetion to database failed!");
			mysql_select_db("doctorsonline", $db_con);
	
	$query = "INSERT INTO patient VALUES (NULL,'$name','$phone','$email','$password','$location','$gender','$dob');";

	if($name!='') 
	{
		$resul=mysql_query($query);
		session_start();
		$_SESSION['sid'] = session_id();
		//$_SESSION['P_id'] = $row["P_id"];
		$_SESSION['P_name'] = $name;
		header("Location: patient-profile.php");
	}
	*/
	
	/*	Handle error reporting
	if(!$result)
		die( "ERROR IN REGISTRATION. CONTACT ADMINISTRATOR");
	else
		echo "REGISTRATION SUCCESSFUL";*/
   

?>