var xvals = [590, 660];
var popoverfollowing = 0;
var tooltip_x = 0;
var tooltip_y = 0;
var user_name_message = "Enter your 10-digit mobile number<br />Example: 480-555-1234";
var password_message1 = "Forgot your password?<br />We can text you a new one!";
var password_message2 = "We'll only make you type it once.<br />So type carefully!";
var default_user_name = "phone";
var default_password = "!@%^*&^%$";

var popover_mode = "login";

$(document).ready(function(){
  $("#SubmitPopoverForm").submit(function (e) {
    e.preventDefault();
    
    user_name = DigitsOnly($("#popover_user_name").val());
    password = $("#popover_password").val();
    
    // pre-validation
    errors = ValidatePhoneFields(user_name, password);
    if (errors.length > 0)
    {
      // if there are any errors, show them in a tooltip
      error_text = errors.join("<br />");
      SubmitError(error_text);
      return false;
    }
    
    if (user_name.length == 11) { user_name = user_name.substring(1); }
    
    // Validates... send form to server
    url = popover_mode == "login" ? "/sessions/login_ajax/" : "/sessions/register_ajax/";
    $.post(url, {user_name: user_name, password: password},
       function(data){
         if (data.message == "success")
         {
           window.location = base_url;
         } else
         {
           SubmitError(data.message);
         }
       }, "json"
    );
    
    
    return false;
  });
  
	$('.headerLogin').click(function(e) {
	  e.preventDefault();
	  popoverfollowing = 0;
	  popover_mode = "login";
	  $("#popover_login").val("Login");
	  UpdatePopoverPosition();
		$('#popover').show();
	});
	$('.headerRegister').click(function(e) {
	  e.preventDefault();
	  popoverfollowing = 1;
	  popover_mode = "register";
	  $("#popover_login").val("Register");
	  UpdatePopoverPosition();
		$('#popover').show();
	});
	if ($("#popover_user_name").val() == "") {
    $("#popover_user_name").val(default_user_name);
  }
	if ($("#popover_password").val() == "") {
    $("#popover_password").val(default_password);
  }
	if ($("#user_name").val() == "") {
    $("#user_name").val(default_user_name);
  }
	if ($("#password").val() == "") {
    $("#password").val(default_password);
  }
  UpdateTooltip(tooltip_x, tooltip_y, $("#tooltip_text").html());
  UpdatePopoverPosition();
  
  $("#popover_user_name").focus(function () { 
    tooltip_x = $(this).offset().left + $(this).width()/2;
    tooltip_y = $(this).offset().top + 22;
    UpdateTooltip(tooltip_x, tooltip_y, user_name_message);
    $("#tooltip").show();
    if ($("#popover_user_name").val() == default_user_name)
    {
      $("#popover_user_name").val("");
    }
  });

  $("#popover_user_name").blur(function () { 
    $("#tooltip").hide();
    if ($("#popover_user_name").val() == "")
    {
      $("#popover_user_name").val(default_user_name);
    }
  });

  $("#popover_password").focus(function () { 
    tooltip_x = $(this).offset().left + $(this).width()/2;
    tooltip_y = $(this).offset().top + 22;
    if (popover_mode == "login")
    {
      UpdateTooltip(tooltip_x, tooltip_y, password_message1);
    } else
    {
      UpdateTooltip(tooltip_x, tooltip_y, password_message2);
    }
    $("#tooltip").show();
    if ($("#popover_password").val() == default_password)
    {
      $("#popover_password").val("");
    }
  });

  $("#popover_password").blur(function () { 
    $("#tooltip").hide();
    if ($("#popover_password").val() == "")
    {
      $("#popover_password").val(default_password);
    }
  });
  
  
});


function UpdateTooltip(x, y, str)
{
  if (str && str.length > 0)
  {
    $("#tooltip_text").html(str);
  }
  $("#tooltip").css({"left":x-$("#tooltip").width()/2,"top":y});
}

function UpdatePopoverPosition()
{
  w = $(window).width() > 960 ? ($(window).width()-960)/2 : 0;
  $("#popover").css({"left": w + xvals[popoverfollowing]});
  $("#popover").offset({top: $("#popover").offset().top, left: w + xvals[popoverfollowing]});
}

function ValidatePhoneFields (phone, pw)
{
  errors = [];
  digitsonly = DigitsOnly(phone);
  if (digitsonly.length == 11 && digitsonly.charAt(0) == "1")
  {
    digitsonly = digitsonly.substring(1);
  }
  if (digitsonly.length != 10)
  {
    errors.push("Phone must be a 10-digit number");
  }
  
  if (pw.length < 6)
  {
    errors.push("Password must be at least 6 characters");
  } else
  if (pw.length > 30)
  {
    errors.push("Does your password really need <br />to be that long?");
  } else
  if (pw == default_password)
  {
    errors.push("Type in your own password!");
  }
  
  return errors;
}

function DigitsOnly (str)
{
  digitsonly = "";
  digits = "1234567890";
  
  for (i=0; i<str.length; i++)
  {
    if (digits.indexOf(str.charAt(i)) > -1)
    {
      digitsonly += "" + str.charAt(i);
    }
  }
  
  return digitsonly;
}

function SubmitError (error_text)
{
  btn = $("#popover_login");
  tooltip_x = btn.offset().left + btn.outerWidth()/2;
  tooltip_y = btn.offset().top + 26;
  btn.focus();
  btn.blur(function() { $("#tooltip").hide(); });
  $("#tooltip").show();
  UpdateTooltip(tooltip_x, tooltip_y, error_text);
}

$(window).resize(function () {
  UpdatePopoverPosition();
  $("#tooltip").hide();
});
