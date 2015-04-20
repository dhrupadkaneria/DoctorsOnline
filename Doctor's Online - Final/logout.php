<?php
    session_start();
	if($_SESSION['sid']==session_id())
	{
		session_destroy();
		header("location:login.html");
	}
?>