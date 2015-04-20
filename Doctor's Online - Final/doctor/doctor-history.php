<?php
	session_start();
	$myDid = $_SESSION['D_id'];
	$conn = mysql_connect("localhost", "root", "") or die("Unable to connect to MySQL");
	mysql_select_db("doctorsonline", $conn) or die("Could not find database");
	
	$query = "select p.P_name as pName, p.P_dob as pDob, a.A_date as aDate, a.S_time as sTime, a.E_time as eTime from appointment a, patient p where p.P_id = a.P_id and CURDATE() > a.A_date and a.D_id = " . $myDid;
	
	$result = mysql_query($query, $conn) or die("Error while executing the query");
	
	echo "<br/><br/><label>Appointment History</label>";
	echo "<table border='1'>";
	echo "<tr><td>Name</td><td>DOB</td><td>Appointment Date</td><td>Start Time</td><td>End Time</td></tr>";
    while($row = mysql_fetch_array($result))
    {
		echo "<tr><td>".($row['pName'])."</td><td>".($row['pDob'])."</td><td>".($row['aDate'])."</td><td>".($row['sTime'])."</td><td>".($row['eTime'])."</td></tr>";
    }
    echo "</table>";
	mysql_close($conn);
?>