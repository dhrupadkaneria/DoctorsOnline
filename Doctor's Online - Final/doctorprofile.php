<?php
	session_start();
	if($_SESSION['sid']==session_id())
	{
		$did = $_SESSION['D_id'];
?>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>HOME PAGE</title>
    <!--  ootstrap Style -->
	
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!--  Font-Awesome Style -->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" />
    <!--  Animation Style -->
    <link href="assets/css/animate.css" rel="stylesheet" />
    <!--  Pretty Photo Style -->
    <link href="assets/css/prettyPhoto.css" rel="stylesheet" />
    <!--  Google Font Style -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <!--  Custom Style -->
    <link href="assets/css/style.css" rel="stylesheet" />

	<style type="text/css">
		.mydropdown-menu
		{
		background:#C2E2FF; 
		color:black; 
		}
		table#pending 
		{
		width:600px; 
		font-weight: bold;
		text-align:center;
		color:white;
		}
		table#pendingLeaves
		{
		width:300px; 
		font-weight: bold;
		text-align:center;
		color:white;
		}
	</style>
	<script type="text/javascript">
			function init()
			{
				
				viewPendingAppointments();
				viewLeave();
			}
			function viewLeave()
			{
				var xmlhttp=new XMLHttpRequest();
				xmlhttp.onreadystatechange=function()
				{
					if (xmlhttp.readyState==4 && xmlhttp.status==200)
					{
						document.getElementById("pendingLeave").innerHTML = xmlhttp.responseText;
					}
				}
				xmlhttp.open("GET", "doctor-pendingLeave.php", true);
				xmlhttp.send();
			}
			function viewPendingAppointments()
			{
				var xmlhttp=new XMLHttpRequest();
				xmlhttp.onreadystatechange=function()
				{
					if (xmlhttp.readyState==4 && xmlhttp.status==200)
					{
						document.getElementById("pending").innerHTML = xmlhttp.responseText;
					}
				}
				xmlhttp.open("GET", "doctor-pending.php", true);
				xmlhttp.send();
			}
			function updateProfile()
			{
				var result = confirm("Do you really want to Update ?");
				if(result)
				{
					var phno = document.getElementById("phno").value;
					var address = document.getElementById("address").value;
					var pwd = document.getElementById("pwd").value;
					var ccno = document.getElementById("ccno").value;
					var xmlhttp1=new XMLHttpRequest();
					xmlhttp1.onreadystatechange=function()
					{
						if (xmlhttp1.readyState==4 && xmlhttp1.status==200)
						{
							if(xmlhttp1.responseText == "1")
							{
								alert("Saved Successfully");
								//window.location.href = "patient-profile.php";
							}
							else if(xmlhttp1.responseText == "0")
							{
								alert("Saving Unsuccessfull");
							}
						}
					}
					xmlhttp1.open("GET", "doctor-saveprofile.php?phno=" + phno + "&address=" + address + "&pwd=" + pwd+"&ccno="+ccno, true);
					xmlhttp1.send();
				}
			}
			
			function editprofile()
			{
				/*var pid = document.getElementById("pid").value;
				window.location.href = "patient-editprofile.php";*/
				<?php $conn = mysql_connect('localhost','root',''); $db = mysql_select_db('doctorsonline',$conn); $fetch = mysql_query("SELECT * FROM `doctor` WHERE D_id = '$did'"); $row = mysql_fetch_array($fetch); ?>
			}
			function schedule()
			{
				//window.location.href = "Dipti/bookAppointment.html";
			}
		</script>
		<script src="jquery-2.1.3.min.js"></script>
		<script src ="Appointment.js"></script>
</head>
<body onload="init()">
    <!--<div id="pre-div">
        <div id="loader">
        </div>
    </div>-->
    <!--/. PRELOADER END -->
    <div class="navbar navbar-default navbar-fixed-top move-me ">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a class="navbar-brand" href="#">
                  <!--  <img src="assets/img/logo.png" class="navbar-brand-logo " alt="" />-->

                </a>
            </div>
            <div class="navbar-collapse collapse move-me">
                <ul class="nav navbar-nav navbar-right">
                    <li >
                        <a href="#home">Home</a>
                    </li>
                    <li >
                        <a href="#about">Leave</a>
                    </li>
                    <li >
                        <a href="#edit-profile" onclick="editprofile()">Profile</a>
                    </li>
                    <li >
                        <a href="#contact">Contact us</a>
					</li>
                    <li >
                        <a href="logout.php">Logout </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
    <!--./ NAV BAR END -->
    <div id="home" >
        <div class="overlay">
            <div class="container">
                <div class="row ">
                    <div class="col-lg-9 col-md-9 head-text">
                        <h1 id="divDisp" >Pending Appointments</h1>
                   <div style="position:absolute;left:10%">
		<span  class="sub-head "></span>
			<span> This section shows the pending appointments for you:</span><br/>
			<div id = "pending"></div>
		</div>
                    </div>
                </div>
				
            </div>

        </div>


    </div>
    <!--./ HOME SECTION END -->
    <div id="about" >
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 sub-head">
                    <h2  data-wow-delay="0.3s" class="wow rollIn animated" ><strong>Take Leave</strong></h2>
                </div>
            </div>

		
		<div id="docTakeLeave" >
			<form action="takeleave1.php" method="post">
			<table>
				<tr>
					<td style="padding-bottom: 1em"><label style="color:black">From :</label></td>
					<td style="padding-bottom: 1em"><input type="date" id="fromDate" name="fromDate" style="color:black"/></td>
				</tr>
				
				<tr>
					<td style="padding-bottom: 1em"><label style="color:black">To  :</label></td>
					<td style="padding-bottom: 1em"><input type="date" id="toDate" name="toDate" style="color:black"/></td>
				</tr>
			</table>
				<input id="submitBtn" type="submit" value="Submit" class="btn btn-success btn-lg"/>
			</form>
		</div>
		<div style="position:absolute; right:10%">
			<span><h3>Pending Leaves</h3></span>
			<h2><div id = "pendingLeave" ></div></h2><br/><br/>
		</div>
			<br/><br/><br/><br/><br/><br/>
		</div>
	</div>
	  <p class="sub-head"></p>
	    <p class="sub-head"></p> <p class="sub-head"></p> <p class="sub-head"></p> 
		
    <!--./ DONARS TESTIMONIALS END -->
  <div id="edit-profile" class="pad-top-botm" >
        <div class="container">
           <div class="row text-center ">
                <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">
                    <h2 data-wow-delay="0.3s" class="wow rollIn animated"><strong>Edit Profile</strong></h2>     
                </div>
            </div>
			         <div class="col-lg-8 col-md-6" style="padding-left:300px">
                        <div class="div-trans text-center">
                                   <div class="col-lg-12 col-md-12 col-sm-12" >
                                <div class="form-group">
                                    <label class="form-control"><?php echo $row['D_name'];?></label>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="phno" id="phno" required="required" placeholder="Phone Number" value="<?php echo $row['D_phno'];?>">
                                </div>
								  <div class="form-group">
                                    <label class="form-control"><?php echo $row['D_email'];?></label>
                                </div>
								  <div class="form-group">
                                    <input type="text" class="form-control" name="address" id="address" required="required" placeholder="Address" value="<?php echo $row['D_address']; ?>">
                                </div>  
								 <div class="form-group">
                                    <label class="form-control"><?php echo $row['D_specialization'];?></label>
                                </div>
								<div class="form-group">
                                    <input type="password" class="form-control" name="pwd" id="pwd" required="required" placeholder="Password" value="<?php echo $row['D_pwd']; ?>">
                                </div>
								<div class="form-group">
                                    <input type="text" class="form-control" name="ccno" id="ccno" required="required" placeholder="Credit Card Number" value="<?php echo $row['D_ccno']; ?>">
                                </div>
                                <div class="form-group">
                                    <input type="button" class="btn btn-success btn-block btn-lg" value = "Save" onclick="updateProfile()"/>
                                </div>
							</div>
                        </div>
                    </div>
   </div>
    </div>
	
    <!--./ HELP SECTION END -->
    <div id="contact" >
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">
                    <h2 data-wow-delay="0.3s" class="wow rollIn animated"><strong>CONTACT US </strong></h2>
                    <p class="sub-head">   </p>

                    <p class="sub-head  wow rotateIn animated" data-wow-delay="0.4s"><strong>ADDRESS :</strong> University of Texas at Dallas , TX, USA</p>
                </div>
            </div>
            <div class="row  text-center wow rotateIn animated" data-wow-delay="0.4s">
                <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">
                 <a href="http://www.facebook.com" target="_blank" >   <img src="assets/img/Social/facebook.png" alt="" /></a>
                  <a href="http://www.google.com" target="_blank">   <img src="assets/img/Social/google-plus.png" alt="" /></a>
                  <a href="http://www.twitter.com" target="_blank">   <img src="assets/img/Social/twitter.png" alt="" /></a>
                    </div>
                </div>
            <div class="row pad-top-botm">
                <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">
                    <form>
                        <div class="form-group">
                            <input type="text" class="form-control wow rotateIn animated" data-wow-delay="0.5s" required="required" placeholder="Your Name">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control wow rotateIn animated" required="required" data-wow-delay="0.6s" placeholder="Your Email">
                        </div>
                        <div class="form-group">
                            <textarea name="message"  required="required" data-wow-delay="0.7s" class="wow rotateIn animated form-control" style="min-height: 150px;" placeholder="Message"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-block btn-lg wow rotateIn animated " data-wow-delay="0.8s">SUBMIT REQUEST</button>
                        </div>

                    </form>
                </div>

            </div>
            
        </div>
    </div>
    <!--./ CONTACT SECTION END -->
    <div id="footser-end">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                   &copy; 2014 yourdomian.com | by <a href="http://www.binarytheme.com/" style="color:#fff;" target="_blank" >binarytheme.com</a>
                    
                </div>
            </div>

        </div>
    </div>
    <!--./ FOOTER SECTION END -->
    <!--  Jquery Core Script -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!--  Core Bootstrap Script -->
    <script src="assets/js/bootstrap.js"></script>
     <!--  WOW Script -->
    <script src="assets/js/wow.min.js"></script>
    <!--  Scrolling Script -->
    <script src="assets/js/jquery.easing.min.js"></script>
    <!--  PrettyPhoto Script -->
    <script src="assets/js/jquery.prettyPhoto.js"></script>
    <!--  Custom Scripts -->
    <script src="assets/js/custom.js"></script>
   
</body>
</html>
<?php
	}
	else
	{
		header("location:login.html");
	}
?>