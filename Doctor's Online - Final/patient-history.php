<?php
	session_start();
	$pid = $_SESSION["P_id"];
	
	$conn = mysql_connect('localhost','root','');
	$db = mysql_select_db('doctorsonline',$conn);
	$fetch = mysql_query("SELECT * FROM appointment, doctor WHERE appointment.P_id = '$pid' and doctor.D_id = appointment.D_id and appointment.A_date < CURDATE()order by appointment.A_date, appointment.S_time desc");
	
	if(mysql_num_rows($fetch)==0)
	{echo "<h4>There are no past appointments.</h4>";}
	else
	{
		
	//echo "<br/><br/><label style='color:black'>Past Appointments</label>";
	echo "<table style=' border: 4px solid black' id='history' rules='rows'>";
	echo "<tr><td>Date</td><td>Doctor Name</td><td>Start Time</td><td>End Time</td></tr>";
    while($row = mysql_fetch_array($fetch))
    {
		echo "<tr><td>".($row['A_date'])."</td><td>".($row['D_name'])."</td><td>".($row['S_time'])."</td><td>".($row['E_time'])."</td></tr>";
    }
    echo "</table>";
	}
	
?>