<?php
    $name = $_POST["name"];
	$phone = $_POST["phone"];
	$email = $_POST["email"];
	$password = $_POST["password"];
	$location = $_POST["location"];
	$specialisation = $_POST["specialisation"];
	$cc_no = $_POST["cc_no"];
	$ava=$_POST["days"];
	$ftime=$_POST["Ftime"];
	$ttime=$_POST["Ttime"];
	
	$size=sizeof($ava);
	$conn = mysql_connect('localhost','root','');
	$db = mysql_select_db('doctorsonline',$conn);
	$fetch = mysql_query("INSERT INTO doctor(D_name, D_phno, D_email, D_pwd, D_address, D_specialization, D_ccno) VALUES ('$name','$phone','$email','$password','$location','$specialisation','$cc_no');");

	$doc_id=mysql_query("select D_id from doctor where D_email='$email';");
	$row = mysql_fetch_array($doc_id);
	
	$i=0;
	while($i<$size)
	{
		
		$q="insert into availability(D_id,D_days,S_time,E_time)VALUES(".$row['D_id'].",'".$ava[$i]."',".$ftime[$i].",".$ttime[$i].");";
		
		mysql_query($q);
		$i+=1;
	}
	
		

if($fetch == 1)
	{
		session_start();
		$_SESSION['sid']=session_id();
		$_SESSION['D_name'] = $name;
		//$_SESSION['D_id'] = $did;
		header("Location: login.html");
	}
	else
	{
		echo "<script>alert('Username already exists');window.location.href = 'login.html';</script>";
	}
	
	
	/*$db_con = mysql_connect("localhost","root", "");
			if(!$db_con)  die("Connetion to database failed!");
			mysql_select_db("doctorsonline", $db_con);
	
	$query = "INSERT INTO doctor VALUES (567567,'$name','$phone','$email','$password','$location','$specialisation','$cc_no');";
	
	
	if($name!='') 
		$resul=mysql_query($query);*/
	
	/*	Handle error reporting
	if(!$result)
		die( "ERROR IN REGISTRATION. CONTACT ADMINISTRATOR");
	else
		echo "REGISTRATION SUCCESSFUL";*/
   

?>