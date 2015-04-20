<?php
	session_start();
	if($_SESSION['sid']==session_id())
	{
?>
<html>
<head>
<!--<link rel="stylesheet" type="text/css" href="doctorhome.css" />-->
<title>Take Leaves</title>
	<script type = "text/javascript">
	
		function init()
		{
			//alert("D_id, <?php echo $_SESSION['D_id']; ?> ");
		}
	</script>
</head>

<body onload = "init()">
<img id="defImg" src="medical.jpg" />
</br></br>
<div id="docTakeLeave">
<form action="takeleave1.php" method="post">
<label>From	: </label><input type="date" id="fromDate" name="fromDate" value="yyyy/mm/dd" />
<label>To	: </label><input type="date" id="toDate" name="toDate" value="yyyy/mm/dd" />
</br><input id="submitBtn" type="submit" value="Submit" />
</form>
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