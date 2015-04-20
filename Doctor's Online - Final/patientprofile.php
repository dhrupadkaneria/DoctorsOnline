<?php
	session_start();
	if($_SESSION['sid']==session_id())
	{
		$pid = $_SESSION['P_id'];
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
	<!--Validation css-->
	 <link href="assets/css/validate.css" rel="stylesheet" />
    <!--  ootstrap Style -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!--  Font-Awesome Style -->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" />
    <!--  Animation Style -->
    <link href="assets/css/animate.css" rel="stylesheet" />
    <!--  Pretty Photo Style -->
    <link href="assets/css/prettyPhoto.css" rel="stylesheet" />
    <!--  Google Font Style -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type=
'text/css' />
    <!--  Custom Style -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
	<style type="text/css">
		.mydropdown-menu
		{
			background:#C2E2FF; 
			color:black; 
		}
		table#pending 
		{
			width:500px; 
			font-weight: bold;
			text-align:center;
			color:black;
		}
		table#history 
		{
			width:500px; 
			font-weight: bold;
			text-align:center;
			color:white;
		}
	</style>
	<script type="text/javascript">
			function init1()
			{
				/*alert("Welcome, <?php echo $_SESSION['P_name']; ?> ");*/
				//alert("P_id, <?php echo $_SESSION['P_id']; ?> ");
				var xmlhttp=new XMLHttpRequest();
				xmlhttp.onreadystatechange=function()
				{
					if (xmlhttp.readyState==4 && xmlhttp.status==200)
					{
						document.getElementById("history").innerHTML = xmlhttp.responseText;
					}
				}
				xmlhttp.open("GET", "patient-history.php", true);
				xmlhttp.send();
				pending();
				
			}
			
			function updateProfile()
			{
				var result = confirm("Do you really want to Update?");
				if(result)
				{
					var phno = document.getElementById("phno").value;
					var address = document.getElementById("address").value;
					var pwd = document.getElementById("pwd").value;
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
					xmlhttp1.open("GET", "patient-saveprofile.php?phno=" + phno + "&address=" + address + "&pwd=" + pwd, true);
					xmlhttp1.send();
				}
			}
			function pending()
			{
				//var pid = document.getElementById("pid");
				//alert(pid.value);
				var xmlhttp=new XMLHttpRequest();
				xmlhttp.onreadystatechange=function()
				{
					if (xmlhttp.readyState==4 && xmlhttp.status==200)
					{
						//alert(xmlhttp.responseText);
						document.getElementById("pending").innerHTML = xmlhttp.responseText;
					}
				}
				xmlhttp.open("GET", "patient-pending.php", true);
				xmlhttp.send();
			}
			function editprofile()
			{
				/*var pid = document.getElementById("pid").value;
				window.location.href = "patient-editprofile.php";*/
				<?php $conn = mysql_connect('localhost','root',''); $db = mysql_select_db
('doctorsonline',$conn); $fetch = mysql_query("SELECT * FROM `patient` 
WHERE P_id = '$pid'"); $row = mysql_fetch_array($fetch); ?>
			}
			
			function cancelApt()
			{			
				var aptdate = $("#doc_date").val();
				var radios = document.getElementsByName('cancelApt');
				if(radios.length == 0)
				{alert("You don't have any pending appointment."); return;}

  				for (var i = 0; i < radios.length; i++){
    			if (radios[i].checked){
    				var confirmed = confirm("Are you sure you want to cancel the selected appointment?");
					if(!confirmed){exit();}
     				
     				var aDate = document.getElementById(i).firstChild.childNodes[0].
nodeValue;
	     			var dName = document.getElementById(i).childNodes[1].childNodes[0].
nodeValue;
	     			var sTime = document.getElementById(i).childNodes[2].childNodes[0].
nodeValue;
	     			var eTime = document.getElementById(i).childNodes[3].childNodes[0].
nodeValue;

					var xmlhttp=new XMLHttpRequest();
					xmlhttp.onreadystatechange=function()
					{
						if (xmlhttp.readyState==4 && xmlhttp.status==200)
						{
							//alert(xmlhttp.responseText);
							alert("Your appointment is successfully deleted.");
							//init();
							location.reload();
						}
					}
					xmlhttp.open("GET", "DeleteAppointmentPatient.php?adate="+aDate+"&dname="+dName+"&stime="+sTime+"&etime="+eTime, true);
					xmlhttp.send();
					return;
					}
				}
				alert("You should select an appointment to cancel.");
			}
		</script>
		<script src="jquery-2.1.3.min.js"></script>
		<script src ="Appointment.js"></script>
		<Script src="Register_patient_validate.js"></script>
</head>
<body onload="init1()">
    <!--<div id="pre-div">
        <div id="loader">
        </div>
    </div>-->
    <!--/. PRELOADER END -->
    <div class="navbar navbar-default navbar-fixed-top move-me ">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" 
data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a class="navbar-brand" href="#">
                  <!--  <img src="assets/img/logo.png" class="navbar-brand-logo " alt="" 
/>-->

                </a>
            </div>
            <div class="navbar-collapse collapse move-me">
                <ul class="nav navbar-nav navbar-right">
                    <li >
                        <a href="#home">Home</a>
                    </li>
                    <li >
                        <a href="#about" onclick="pending()">Appointments</a>
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
                        <h1 id="divDisp" >Schedule an Appointment</h1>
                        <span >
                            <i class="fa fa-lightbulb-o " ></i> Get Schedule of  doctors 
nearby your location
							<form name="form1">
							<br/>
<table>
<tr style="padding-bottom: 5em"><td style="padding-bottom: 1em">City</td><td style=
"padding-bottom: 1em"> <input type ="text" name= "city" class="form-control" id="city" 
style="width:150px;color:black"/></td></tr>

<tr style="padding-bottom: 5em"><td  style="padding-bottom: 1em font-color:#000" >
Appointment Date</td>
<td style="padding-bottom: 1em"> <input type="Date" class="form-control" style="color:black" name="doc_date" 
id ="doc_date"/></td></tr>

<tr style="padding-bottom: 5em"><td  style="padding-bottom: 1em font-color:#000" >
Specialization</td>


<td style="padding-bottom: 1em"> 
	<select name="specialization" id ="specialization" class="mydropdown-menu"> 
		<option></option>
		<option value="Dentist">Dentist</option>
		<option value="ENT">ENT</option>
		<option value="Dermatologist">Dermatologist</option>
		<option value="Cardiology">Cardiology</option>
		<option value="Neurologist">Neurologist</option>
		<option value="General">General</option>
	</select>
</td></tr>

</table>

</br></br>
<input type="button"  value="Get Schedule of the  DOCTORS" id="b1" class="btn 
btn-success  btn-lg" />
</br></br>
<p id="getschedule" style="position:absolute;left:65%;top:15%"></p>
<input type="button" value="Book My Appointment" id = "bookBtn" class="btn btn-success  
btn-lg"/>
<div id ="msg"></div>
</br></br></br>
</form>
                        </span>
                       
                    </div>
                </div>
				
            </div>

        </div>


    </div>
    <!--./ HOME SECTION END -->
    <div id="about" class ="about-overlay"  style="color:black">
		
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-8 
col-sm-offset-2 sub-head ">
                    <h2  data-wow-delay="0.3s" class="wow rollIn animated" ><strong>
Appointment Details</strong></h2>
					
                </div>
            </div>
			<div style="position:absolute;right:10%">
		<span ><h3>Past Appointments</h3></span>
			<h2><div id = "history"></div></h2>
		</div>
		
		<div style="position:absolute;left:10%">
		<span><h3>Future Appointments</h3></span>
			<h2><div id = "pending"></div></h2><br/><br/>
			<input type="button" class="btn btn-success  btn-lg" value = "Cancel 
Appointment" onclick="cancelApt()"/>
		</div>
			<br/><br/><br/><br/><br/><br/>
		</div>

	</div>
	  
    <!--./ DONARS TESTIMONIALS END -->
  <div id="edit-profile" class="pad-top-botm" >
        <div class="container">
           <div class="row text-center ">
                <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-8 
col-sm-offset-2">
                    <h2 data-wow-delay="0.3s" class="wow rollIn animated"><strong>Edit 
Profile</strong></h2>     
                </div>
            </div>
			          <div class="col-lg-8 col-md-6 " style="padding-left:300px" >
                        <div class="div-trans text-center">
                            
                           
                            <div class="col-lg-12 col-md-12 col-sm-12" >
                                <div class="form-group">
                                    <label class="form-control"><?php echo $row['P_name'
];?></label>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="phno" 
id="phno" required="required" placeholder="Phone 
Number" value="<?php echo $row['P_phno'];?>">
                                </div>
								  <div class="form-group">
                                    <label class="form-control"><?php echo $row['P_email'
];?></label>
                                </div>
								  <div class="form-group">
                                    <input type="text" class="form-control" name=
"address" id="address" required="required" 
placeholder="Address" value="<?php echo $row[
'P_address']; ?>">
                                </div>   
								<div class="form-group">
                                    <input type="password" class="form-control" name=
"pwd" id="pwd" required="required" placeholder=
"Password" value="<?php echo $row['P_pwd']; ?>">
                                </div>
                                <div class="form-group">
                                    <input type="button" class="btn btn-success 
btn-block btn-lg" value = "Save" onclick=
"updateProfile()"/>
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
                <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-8 
col-sm-offset-2">
                    <h2 data-wow-delay="0.3s" class="wow rollIn animated"><strong>
CONTACT US </strong></h2>
                    <p class="sub-head"> </p>

                    <p class="sub-head  wow rotateIn animated" data-wow-delay="0.4s"
><strong>ADDRESS :</strong> University of Texas at Dallas , TX, USA
</p>
                </div>
            </div>
            <div class="row  text-center wow rotateIn animated" data-wow-delay="0.4s">
                <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-8 
col-sm-offset-2">
                 <a href="http://www.facebook.com">   <img src=
"assets/img/Social/facebook.png" alt="" /></a>
                  <a href="http://www.google.com"><img src=
"assets/img/Social/google-plus.png" alt="" /></a>
                  <a href="http://www.twitter.com"> <img src=
"assets/img/Social/twitter.png" alt="" /></a>
                    </div>
                </div>
            <div class="row pad-top-botm">
                <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-8 
col-sm-offset-2">
                    <form>
                        <div class="form-group">
                            <input type="text" class="form-control wow rotateIn animated"
 data-wow-delay="0.5s" required="required" placeholder="Your 
Name">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control wow rotateIn animated"
 required="required" data-wow-delay="0.6s" placeholder="Your 
Email">
                        </div>
                        <div class="form-group">
                            <textarea name="message"  required="required" data-wow-delay=
"0.7s" class="wow rotateIn animated form-control" style=
"min-height: 150px;" placeholder="Message"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-block 
btn-lg wow rotateIn animated " data-wow-delay="0.8s">SUBMIT 
REQUEST</button>
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
                   &copy; 2014 yourdomian.com | by <a href="http://www.binarytheme.com/" 
style="color:#fff;" target="_blank" >binarytheme.com</a>
                    
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