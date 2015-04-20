<?php
	session_start();
	if($_SESSION['sid']==session_id())
	{
		$did = $_SESSION['D_id'];
?>
<html>
	<head>
		<title>Doctor Edit Profile</title>
		<script type="text/javascript">
			function UpdateProfile()
			{
				var result = confirm("Do you really want to Update?");
				if(result)
				{
					var phno = document.getElementById("phno").value;
					var address = document.getElementById("address").value;
					var pwd = document.getElementById("pwd").value;
					var xmlhttp=new XMLHttpRequest();
					xmlhttp.onreadystatechange=function()
					{
						if (xmlhttp.readyState==4 && xmlhttp.status==200)
						{
							if(xmlhttp.responseText == "1")
							{
								alert("Saved Successfully");
								window.location.href = "doctor-profile.php";
							}
							else if(xmlhttp.responseText == "0")
							{
								alert("Saving Unsuccessfull");
							}
						}
					}
					xmlhttp.open("GET", "doctor-saveprofile.php?phno=" + phno + "&address=" + address + "&pwd=" + pwd, true);
					xmlhttp.send();
				}
			}
		</script>
	</head>
	<body>
		<?php
			//$pid = $_GET['pid'];
			$conn = mysql_connect('localhost','root','');
			$db = mysql_select_db('doctorsonline',$conn);
			$fetch = mysql_query("SELECT * FROM doctor WHERE D_id = '$did'");
			$row = mysql_fetch_array($fetch);
		?>
		<table border="0">
			<tr>
				<td>Name:</td>
				<td><?php echo $row['D_name']; ?></td>
			</tr>
			<tr>
				<td>Ph Number:</td>
				<td><input type = "text" id = "phno" value = "<?php echo $row['D_phno']; ?>"/></td>
			</tr>
			<tr>
				<td>Email:</td>
				<td><?php echo $row['D_email']; ?></td>
			</tr>
			<tr>
				<td>Address:</td>
				<td><input type = "text" id = "address" value = "<?php echo $row['D_address']; ?>"/></td>
			</tr>
			<tr>
				<td>Password:</td>
				<td><input type = "text" id = "pwd" value = "<?php echo $row['D_pwd']; ?>"/></td>
			</tr>
			<tr>
				<td>Specialization:</td>
				<td><?php echo $row['D_specialization']; ?></td>
			</tr>
			<tr>
				<td>CC Number:</td>
				<td><?php echo $row['D_ccno']; ?></td>
			</tr>
		</table>
		<input type="button" value="Save" onclick="UpdateProfile()"/>
	</body>
</html>
<?php
	}
	else
	{
		header("location:login.html");
	}
?>