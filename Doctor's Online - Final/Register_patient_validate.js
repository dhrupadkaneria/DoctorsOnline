var validateField = function(fieldElem, infoMessage, validateFn) {
	// TODO: Implement validateField.
	
	fieldElem.next().removeClass();
	fieldElem.next().text(infoMessage);
	fieldElem.next().css("display", "inline");
	fieldElem.next().css("visibility", "visible");
	fieldElem.next().css("Display","inline");
	fieldElem.blur(function(){validateFn(fieldElem)});
};

function nameVal(fieldElem)
{
	if(fieldElem.val().length>0)
	{
		var val=true;
		
		for(i = 0; i < fieldElem.val().length; ++i)
		{
			var charc = fieldElem.val().charAt(i).charCodeAt(0);
			if(!((charc > 64 && charc < 91) || charc==32||(charc > 96 && charc < 123)))
				val= false;
		}
		
		if(val)
		{
			fieldElem.next().removeClass();
			fieldElem.next().text("");
		}
		else
		{
			fieldElem.next().removeClass().addClass("error");
			fieldElem.next().text("Enter Valid name");
		}
	}
	else
	{
		fieldElem.next().removeClass();
		fieldElem.next().css("display","none");
		fieldElem.next().css("visibility","hidden");
	}
	return;
};

function cityVal(fieldElem)
{
	if(fieldElem.val().length>0)
	{
		var val=true;
		
		for(i = 0; i < fieldElem.val().length; ++i)
		{
			var charc = fieldElem.val().charAt(i).charCodeAt(0);
			if(!((charc > 64 && charc < 91) || charc==32||(charc > 96 && charc < 123)))
				val= false;
		}
		
		if(val)
		{
			fieldElem.next().removeClass();
				fieldElem.next().text("");
		}
		else
		{
			fieldElem.next().removeClass().addClass("error");
			fieldElem.next().text("Enter Valid City");
		}
	}
	else
	{
		fieldElem.next().removeClass();
		fieldElem.next().css("display","none");
		fieldElem.next().css("visibility","hidden");
	}
	return;
};

function phoneNumberVal(fieldElem)
{
	
	if(fieldElem.val().length>0)
	{
		
		var reg = /^\d+$/;
		var val=reg.test(fieldElem.val());
		if(val)
		{
			
			fieldElem.next().removeClass();
				fieldElem.next().text("");
		if(fieldElem.val().length!=10)
		{
			fieldElem.next().removeClass().addClass("error");
			fieldElem.next().text("10 Digit phone number is required");
		}
		}
		else
		{
			fieldElem.next().removeClass().addClass("error");
			fieldElem.next().text("Only Digits allowed for Phone Numbers");
		}
		
	}
	else
	{
		fieldElem.next().removeClass();
		fieldElem.next().css("display","none");
		fieldElem.next().css("visibility","hidden");
	}
	return;
};




function passwordVal(fieldElem)
{
	if(fieldElem.val().length<=8)
	{
		fieldElem.next().removeClass().addClass("error");
		fieldElem.next().text("Password should be greater than 8 characters");
	}
	else
	{
		fieldElem.next().removeClass();
			fieldElem.next().text("");
	}
	
	if(fieldElem.val()==0)
	{
		fieldElem.next().removeClass();
		fieldElem.next().css("display","none");
		fieldElem.next().css("visibility","hidden");
	}
	return;
};

	function emailVal(fieldElem)
{
	if(fieldElem.val().length>0)
	{
    var allowed = /^([a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$)/;
    if(!allowed.test(fieldElem.val()))
	{
		fieldElem.next().removeClass().addClass("error");
		fieldElem.next().text("Invalid email address")
	}
	else
	{
			fieldElem.next().removeClass();
				fieldElem.next().text("");
	}
	}
	

	if(fieldElem.val()==0)
	{
		fieldElem.next().removeClass();
		fieldElem.next().css("display","none");
		fieldElem.next().css("visibility","hidden");
	}
	return;
	
};

$(document).ready(function() {
	// TODO: Use validateField to validate form fields on the page.
	var infomsg1= "";
	var infomsg2= ""
	var infomsg3= "";
	var infomsg4= "";
	var infomsg5= "";
	var infomsg6= "";
	
	
$('<span class="info" style="VISIBILITY:hidden;display:none"></span>').insertAfter($('#name'));
$('#name').focusin(function(){	
	validateField($('#name'),infomsg1,nameVal)
});

$('<span class="info" style="VISIBILITY:hidden;display:none"></span>').insertAfter($('#address'));
$('#address').focusin(function(){	
	validateField($('#address'),infomsg6,cityVal)
});

$('<span class="info" style="VISIBILITY:hidden;display:none"></span>').insertAfter($('#phone'));
$('#phone').focusin(function(){	
	validateField($('#phone'),infomsg2,phoneNumberVal)
});

$('<span class="info" style="VISIBILITY:hidden;display:none"></span>').insertAfter($('#password'));
$('#password').focusin(function(){
	validateField($('#password'),infomsg3,passwordVal);
});

$('<span class="info" style="VISIBILITY:hidden;display:none"></span>').insertAfter($('#email'));
$('#email').focusin(function(){
	validateField($('#email'),infomsg4,emailVal);
});




});
