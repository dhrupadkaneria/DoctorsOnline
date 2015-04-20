<?php
//@author dsd140330@utdallas.edu
// this page inserts appointment record into database
//first it checks whether doctor is available in that time and then makes an entry in appointment table


// database connectivity
	session_start();
	$pid = $_SESSION['P_id'];
	$username = "root";
	$password ="";
	$hostname ="localhost";
	$con = mysql_connect($hostname,$username,$password);
	$db = mysql_select_db('doctorsonline',$con);

	//first check wether doctor is available this time
	
	$apt_time = $_GET['time'];
	$doc_name =$_GET['dname'];
	$dt = $_GET['date'];
	
	$subquery =mysql_query("select D_id from doctor where D_name = '$doc_name'");
	$subr = mysql_fetch_array($subquery);
	$doc_id=$subr['D_id'];
	
	$fetch = mysql_query("INSERT INTO appointment(D_id, P_id, A_date, S_time, E_time) VALUES ('$doc_id','$pid','$dt','$apt_time','$apt_time'+100);");
	
	echo "Booked successfully";
	/*echo "doctor $doc_name";
	echo"Appt time $apt_time";
	echo "date $dt";
	echo"patient name $pname";*/
	
	// get id from name : doctor
	/*$subquery =mysql_query("select D_id from doctor where D_name like '%$doc_name%'");
	$subr = mysql_fetch_array($subquery);
	$doc_id=$subr['D_id'];

	//check whether he has appointment on this time.
	$q1=mysql_query("select * from appointment where D_id=$doc_id AND A_date='$dt' AND S_time=$apt_time");

	if(mysql_num_rows($q1)!=0)
	{
		echo "Sorry,Doctor is not available on this time Please select different time";
		exit();
		}

		// now check for the leave
		$q2 =mysql_query("select S_date as s,E_date  as e from leaves where D_id=$doc_id AND '$dt'>=S_date and'$dt'<=E_date");
	
	if(mysql_num_rows($q2)!=0)
	{
		$r=mysql_fetch_array($q2);
		echo"Doctor is on leave for the period ".$r['s'] ."to". $r['e'];
		exit();
		
	}
	
	// check whether he is available
	$q3=mysql_query("select count(*) as count from availability where D_id=$doc_id AND D_days=DAYNAME('$dt')");
	$q13 = mysql_fetch_array($q3);
	if($q13['count']==0)
	{
		echo "Doctor is not available on this day </br> Check his availabilty Schedule to book and appointment";
		exit();
	}
	
	else 
	{
		// insert data into database.
		
		// get patient's id from name
		$subquery2 = mysql_query("select P_id, P_email from patient where P_name like '%$pname%'");
		$subr2 = mysql_fetch_array($subquery2);
		$pid = $subr2['P_id'];
		
		$query =mysql_query("insert into appointment(D_id,P_id,A_date,S_time,E_time) VALUES($doc_id,$pid,'$dt',$apt_time,$apt_time+100)");
		if($query== FALSE)
		{
			echo "data is not inserted properly";
		}			
		else
		{
			echo "Appointment scheduled Correctly";
			
			$to = $subr2['P_email'];
		
			$subject = 'Regarding Appointment schedule';
			$message ='To '.$pname.' ,<p>Your appointment is scheduled on '.$dt.' with'. $doc_name.'at'. $apt_time;
			 echo $to ."</br>".$subject."</br>".$message;
			

			
		$mailresult= mail($to, $subject, $message); 
		//var_dump($mailresult);
		if($mailresult)
		{
			echo "Email has been sent";
			exit();
		}
			else
				echo"ERROR";
		}
		
	}
	*/


	
?>
