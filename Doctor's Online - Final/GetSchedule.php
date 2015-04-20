<?php
if(isset($_GET['city']))
{
   $city = $_GET['city'];
   $dt = $_GET['aptdate'];
   $special=$_GET['special'];
	$username = "root";
	$password ="";
	$hostname ="localhost";
	$con = mysql_connect($hostname,$username,$password);
	if(!$con)
	{
		echo'could not connect';
		exit;
	}
	$db = mysql_select_db('doctorsonline',$con);
	
	$query ="SELECT d.D_id as dId,d.D_name as name,d.D_Address as location, a.D_days as day,a.S_time as start,a.E_time as end ,d.D_specialization as Specialization from availability a, doctor d where d.D_id=a.D_id and d.D_Address like '$city%' and d.D_specialization like '%$special%' order by d.D_id ";
	
	
	
	$queryResult = mysql_query($query);
	if(mysql_num_rows($queryResult) == 0)
	{
		echo "<div style=position:relative; left:90%'>There are no records available for this combination. Please make other selection.</div>";
		exit();
	}
	
	$tableAvailability = "<h4>Availability on $dt</h4><table border='4' style='position:absolute; right:35%'>";
	$tableAvailability .= "<th>Doctor</th><th>Timings</th><th></th>";
	$tableSchedule = "<table border='4' width='650'>";
	$tableSchedule .= "<tr><th>Doctor's Name</th><th>Location</th><th>Available Day</th><th>Start_Time</th><th>End_time</th><th>Specialization</th></tr>";
	$prevId = "";
	$rowId = 0;
	while($r=mysql_fetch_array($queryResult))
	{
		
		$tableSchedule .= "<tr><td>".($r['name'])."</td><td>".($r['location'])."</td><td>".($r['day'])."</td><td>".($r['start'])."</td><td>".($r['end'])."</td><td>".($r['Specialization'])."</td></tr>";
	// check whether doctor is available on that day
	
		$doc_id = $r['dId'];
		$q3=mysql_query("select count(*) as count ,D_id as id from availability where D_id=$doc_id AND D_days=DAYNAME('$dt')");
		$q13 = mysql_fetch_array($q3);
		if($doc_id != $prevId)
		{
			$prevId = $doc_id;
		if($q13['count']==0)
		{
			$tableAvailability .= "<tr><td>".$r['name']."</td>";
			$tableAvailability .= "<td>Not Available</td></tr>";
			$rowId++;
		}
		else
		{
			$q4=mysql_query("SELECT D_id FROM leaves where DATE('$dt') BETWEEN S_date AND E_date AND D_id IN (select D_id as id from availability where D_id=$doc_id AND D_days=DAYNAME('$dt'))");
			
			if((mysql_num_rows($q4))!=0)
		{
			
					$tableAvailability .= "<tr><td>".$r['name']."</td>";
					$tableAvailability .= "<td>On Leave</td></tr>";
					$rowId++;
				
		}
		else
		{
		$q1 =mysql_query("SELECT S_time as s1,E_time as e2 FROM appointment where D_id=$doc_id AND A_date='$dt' ");
		$q2= mysql_query("select S_time as s2 , E_time as e2 from availability where D_id=$doc_id AND D_days=DAYNAME('$dt')");
		$r2=mysql_fetch_array($q2);	
			
			/*if(mysql_num_rows($q1)==0)
			{
				// that means no appointments allocated on that day	
				{
					$tableAvailability .= "<td>".($r2['s2']). " to ".($r2['e2'])."</td></tr>";					
				}
			}
		
			else
			{*/
			//if there are  any appointments then 
			$count = 0;
			$myarray =array();
			$bookAptLink = "</td><td><input type=\"radio\" name=\"bookApt\" value=\"$rowId\">Book</input>";
			while($r1=mysql_fetch_array($q1))			
			{
				$myarray[$count]=$r1['s1'];
			
				$count++;
				
			}
			$j=0;
			for($i=$r2['s2'];$i<=$r2['e2'];$i+=100)
			{
				if($j<$count)
				{	if($myarray[$j]==$i)
					{	$j=$j+1;
					}
					else 
					{
						$tableAvailability .= "<tr id=\"$rowId\"><td>".$r['name']."</td>";
						$tableAvailability .= "<td>".$i." ".$bookAptLink."</td></tr>";
						$rowId++;
					}
				}
				else
				{
					$tableAvailability .= "<tr id=\"$rowId\"><td>".$r['name']."</td>";
					$tableAvailability .= "<td>".$i." ".$bookAptLink."</td></tr>";
					$rowId++;
				}
			}
			//$tableAvailability .= "</td></tr>";
			//}
		}
		}
	}
	}
	$tableAvailability .= "</table>";
	$tableSchedule .= "</table>";
	echo $tableSchedule;
	echo "<hr/>";
	echo $tableAvailability;
	exit();
	 
}
?>
