$(document).ready(function(){

//schedule
$("#b1").click(function()
{
 var city = $("#city").val();
 
	 var aptdate = $("#doc_date").val();
	if(city == "" || aptdate == "")
	{
		alert("City and Appointment Date are required");
		return;
	}
	//alert(aptdate);
	var now= new Date();
	 var dob= new Date(aptdate);
	if(now > dob.getTime())
	{
		alert("Select future dates");
		return;
	}
	var special = $("#specialization option:selected").text();
				//alert(special);
	 $.ajax({
				type:"GET",
				url:"GetSchedule.php",
				data:{"city":city,"aptdate":aptdate,"special":special},
				success:function(data)
				{
				$("#getschedule").html(data);	// display data in that paragraph
				},
				
				error:function(){alert("GetSchedule : error accessing database")},
				});	
});
		
		$("#bookBtn").click(function(){
			//alert("here1");			
			var aptdate = $("#doc_date").val();
			
			var radios = document.getElementsByName('bookApt');

 			var docName;
 			var time;
  			for (var i = 0; i < radios.length; i++)
			{
				if (radios[i].checked)
				{
					var confirmed = confirm("Do you want to book the appointment you selected?");
					if(!confirmed){exit();}
					docName = document.getElementById(i).firstChild.childNodes[0].nodeValue;
					time = document.getElementById(i).childNodes[1].childNodes[0].nodeValue;
					
					//Pass them to php file to book the appointment
					
					var xmlhttp2=new XMLHttpRequest();
					xmlhttp2.onreadystatechange=function()
					{
						if (xmlhttp2.readyState==4 && xmlhttp2.status==200)
						{
							//alert(xmlhttp.responseText);
							alert("Your appointment is successfully booked.");
							location.reload();
							
						}
					}
					xmlhttp2.open("GET", "Appointment.php?dname="+docName+"&date="+aptdate+"&time="+time, true);
					xmlhttp2.send();
					
					/*$.ajax({
					type:"GET",
					url:"Appointment.php",
					data:{"dname":docName,"date":aptdate,"time":time},
					success:function(data)
					{
						// WHAT TO DO HERE ???
						//alert(data);
						alert("Your appointment is successfully Booked.");
						init();
						
					},
					error:function(){alert("Check BookIt : error accessing database");},
					});*/
     		return;
			}
   		}
   		alert("You need to select a time slot to book an appointment.");
		});
		/*$("#b3").click(function(){
			
			
			 var time = $("#Apttime").val();
			 var date = $("#Aptdate").val();
			 var dname = $("#dname").val();
			 var pname =$("#pname").val();
			 
			 $.ajax({
			type:"GET",
			url:"Appointment.php",
			data:{"dname":dname,"date":date,"pname":pname,"time":time},
			success:function(data)
			{
			$("#aptmsg").html(data);	// display data in that paragraph
			},
			
			error:function(){alert("Appointment : error accessing database")},
			});	
				
		});*/
		
		//update appointment : html page: EditAppointment.html
		// first check for doctor's availability
		$("#check").click(function()
		{
			var name= $("#docname").val();
			var aptdate =$("dt1").val()
			$.ajax({
				type:"GET",
				url:"searchdoctor.php",
				data:{"name":name,"date":aptdate},
				sucess:function(data)
				{
					$("#displaydata2").html(data);
					$("#editAppointment").show();
				},
				error:function(){alert("Check SearchDoc : error accessing database")},
				
				
			});
			
			
		});
		
		
		// get appointmnt details
		
		$("#getapt").click(function()
		{
			$.ajax({
			type:"GET",
			url:"AppointmentDetailsPatient.php",
			data:{"p_id":$("#pid").val(), "aptdate":$("#aptdate").val()},
			success:function(data)
			{
				$("#displaydata1").html(data);	// display data in that paragraph
			},
			
			error:function(){alert("AptDetailsPatient : error accessing database")}
			/*var pid= $("#pid").val();
			var aptdate =$("#aptdate").val();
			$.ajax({
				type:"GET",
				url:"AppointmentDetailsPatient.php",
				data:{"p_id":pid,"aptdate":aptdate},
				sucess:function(data)
				{
					$("#displaydata1").html(data);
					
				},
				error:function(){alert("error accessing database")},
				
				
			});*/

		});
	});
});

function init_refresh()
			{
				/*alert("Welcome, <?php echo $_SESSION['P_name']; ?> ");*/
				//alert("P_id, <?php echo $_SESSION['P_id']; ?> ");
				
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