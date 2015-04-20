<?php
	session_start();
	$myDid = $_SESSION['D_id'];
	$conn = mysql_connect("localhost", "root", "") or die("Unable to connect to MySQL");
	mysql_select_db("doctorsonline", $conn) or die("Could not find database");

	$query="select * from leaves where D_id = $myDid and E_date > CURDATE();";
	
	$result = mysql_query($query, $conn) or die("Error while executing the query");
	
	
	if(mysql_num_rows($result) == 0)
	{
		echo "No Pending Leaves";
		return;
	}
	echo "<table style=' border: 4px solid black' id='pendingLeaves' rules='rows'>";
	echo "<tr><td>Start Date</td><td>End Date</td></tr>";
    while($row = mysql_fetch_array($result))
    {
		echo "<tr><td>".($row['S_date'])."</td><td>".($row['E_date'])."</td></tr>";
    }
    echo "</table>";
	mysql_close($conn);
?>