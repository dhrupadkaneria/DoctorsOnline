<?php
	session_start();
	if($_SESSION['sid']==session_id())
	{
?>

<html>
<head>
	<title>Profile Page</title>
	<script type = "text/javascript">
		function init()
		{
			alert("D_id, <?php echo $_SESSION['D_id']; ?> ");
		}
		function takeLeave()
		{
			window.location.href = "takeleave.php";
		}
		function editProfile()
		{
			window.location.href = "doctor-editprofile.php";
		}
		function viewPendingAppointments()
		{
			var xmlhttp=new XMLHttpRequest();
				xmlhttp.onreadystatechange=function()
				{
					if (xmlhttp.readyState==4 && xmlhttp.status==200)
					{
						//alert(xmlhttp.responseText);
						document.getElementById("pending").innerHTML = xmlhttp.responseText;
					}
				}
				xmlhttp.open("GET", "doctor-pending.php", true);
				xmlhttp.send();
		}
		function viewPastAppointments()
		{
			var xmlhttp=new XMLHttpRequest();
				xmlhttp.onreadystatechange=function()
				{
					if (xmlhttp.readyState==4 && xmlhttp.status==200)
					{
						//alert(xmlhttp.responseText);
						document.getElementById("history").innerHTML = xmlhttp.responseText;
					}
				}
				xmlhttp.open("GET", "doctor-history.php", true);
				xmlhttp.send();
		}
	</script>
</head>

<body onload = "init()">
<div id="docTasks">
	<!--<a href="TakeLeave.html">Take Leave</a><br/><br/>
	<a href="ViewPatients.html">Patients</a><br/><br/>
	<a href="ViewAppointments.html">My Appointments</a><br/><br/>-->
	<br/><br/>
	<input type="button" value="Take Leave" onclick="takeLeave()"/><br/><br/>
	<input type="button" value="View Patients" onclick="viewPatients()"/><br/><br/>
	<input type="button" value="View Pending Appointments" onclick="viewPendingAppointments()"/><br/><br/>
	<input type="button" value="View Past Appointments" onclick="viewPastAppointments()"/><br/><br/>
	<input type="button" value="Edit Profile" onclick="editProfile()"/><br/><br/>
	<a href="logout.php">Log Out</a><br/><br/>
	<div id="pending"></div>
	<div id="history"></div>
</div>

</body>
</html>
<?php
	}
	else
	{
		header("location:login.html");
	}
?>