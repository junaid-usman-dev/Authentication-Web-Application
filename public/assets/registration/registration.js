
jQuery(document).ready(function(){
	jQuery.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} });

    //--------------------------------------------------------------------------------------------------
    //
    //
    //
    //                  Signup or user registration 
    //
    //
    //
    //--------------------------------------------------------------------------------------------------



	// Start password format validation
	//----------------------------------------------------------
	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	var username_format = '^[a-z0-9_]{3,15}$'; // regex for uername

	var myInput = document.getElementById("password");
	var letter = document.getElementById("letter");
	var capital = document.getElementById("capital");
	var number = document.getElementById("number");
	var length = document.getElementById("length");

	// Password Bool
	var uper = false;
	var lower = false;
	var num = false;
	var len = false;
	// Other Bool
	var empty_flag = false;
	var email_flag = false;
	var pass_flag = false;
	var username_flag = false;


	// When the user clicks on the password field, show the message box
	myInput.onfocus = function() {
	    document.getElementById("message").style.display = "block";
	}

	// When the user clicks outside of the password field, hide the message box
	myInput.onblur = function() {
	    document.getElementById("message").style.display = "none";
	}

	// When the user starts to type something inside the password field
	myInput.onkeyup = function() {
		// Validate lowercase letters
		var lowerCaseLetters = /[a-z]/g;
		if(myInput.value.match(lowerCaseLetters)) {
			letter.classList.remove("invalid");
			letter.classList.add("valid");
			lower = true;
		} else {
			letter.classList.remove("valid");
			letter.classList.add("invalid");
			lower = false;
		}

		// Validate capital letters
		var upperCaseLetters = /[A-Z]/g;
		if(myInput.value.match(upperCaseLetters)) {
			capital.classList.remove("invalid");
			capital.classList.add("valid");
			uper = true;
		} else {
			capital.classList.remove("valid");
			capital.classList.add("invalid");
			uper = false
		}

		// Validate numbers
		var numbers = /[0-9]/g;
		if(myInput.value.match(numbers)) {
			number.classList.remove("invalid");
			number.classList.add("valid");
			num = true;
		} else {
			number.classList.remove("valid");
			number.classList.add("invalid");
			num = false;
		}

		// Validate length
		if(myInput.value.length >= 8) {
			length.classList.remove("invalid");
			length.classList.add("valid");
			len = true;
		} else {
			length.classList.remove("valid");
			length.classList.add("invalid");
			len = false;
		}
	}
	//----------------------------------------------------------
	// End password foramt validation
	//----------------------------------------------------------

	//----------------------------------------------------------
	// Start signup button clicked
	//----------------------------------------------------------
	jQuery("#signupBtn").click(function(event){
		event.preventDefault();
		// alert ("Hello World!!!");
		var name = jQuery("#username").val();
		var f_name = jQuery("#fname").val();
		var l_name = jQuery("#lname").val();
		var email_d = jQuery("#email").val();
		var pwd = jQuery("#password").val();

		var nameee = document.getElementById("username");

		console.log ("Button Pressed.");

			// Condition : check fields are empty are not
		if(name != '' && f_name != '' && l_name != '' && email_d != '' && pwd != '')
		{
			jQuery('#error_empty').css("display","none");
			jQuery('#error_empty').empty();
			// username format
			if(nameee.value.match(username_format))
			{
				console.log('valid username format.');
				username_flag = true;
				// jQuery("#error_username").empty();
				jQuery("#error_username").css("display","none");				
			} else {
				console.log('Error! Username format (xxxxx_2001).');
				username_flag = false;
				jQuery("#error_username").css("display","block");
				jQuery("#error_username").text('Error! Username format (xxxxx_2001).');				
			}
			// end username format
			//--------------------------------------------------------
			//       Email Format
			//--------------------------------------------------------
			// Condition : check email format is correct or not
			if ( re.test(email_d) )
			{	
				console.log("valid email foramt.");
				email_flag = true;
				jQuery("#error_email").empty();
				jQuery("#error_email").css("display","none");
			}
			else
			{
				console.log("Erorr: incorrect email format.");
				jQuery("#error_email").css("display","block");
				jQuery("#error_email").text('Erorr: incorrect email format.');
			}
			//--------------------------------------------------------
			//       Password Format
			//--------------------------------------------------------
			// Condition : check password format is correct or not
			if ( uper == true && lower == true && num == true && len == true )
			{
				console.log ("valid password format.");
				pass_flag = true;
				jQuery("#error_pwd").css("display","none");
				jQuery("#error_password").empty();	
				jQuery("#error_letter").empty();
				jQuery("#error_capital").empty();
				jQuery("#error_number").empty();
				jQuery("#error_length").empty();
			}
			else
			{
				// Error: incorrect password format
				console.log ("Error: incorrect password format.");
				jQuery("#error_pwd").css("display","block");
				jQuery("#error_password").text('Error: incorrect password format');
				if (uper == false)
				{
					jQuery("#error_capital").text('A capital(upercase) letter is missing');
				}
				if (lower == false)
				{
					jQuery("#error_letter").text('A lowercase letter is missing');
				}
				if  (num == false)
				{
					jQuery("#error_number").text('A number is missing');
				}
				if (len == false)
				{
					jQuery("#error_length").text('Mninmum 8 characters are required.');
				}
				else
				{
					console.log ("something bad happened with password format.");
				}
			}
		}
		else
		{
			console.log('Error: some field data are empty.');
			jQuery("#error_empty").css('display','block');
			jQuery("#error_empty").text('Error: some field data are empty.');
		}

		if ( email_flag == true && pass_flag == true && username_flag == true )
		{
			// Ajax Signup Calling
			console.log ("Ajax Signup Calling!!!");
			jQuery.ajax({
				url: "/store",
				type: "POST",
				data: {'username':name, 'fname':f_name, 'lname':l_name, 'email':email_d, 'password':pwd},
				success: function(response)
				{
					console.log(response.success);
					if ( (response.success == null || response.success == undefined) )
					{
						// console.log("success is null");
						jQuery("#success").empty();
						jQuery('#error').html(response.error);
					}
					else  
					{
						// console.log("success is not null");
						jQuery("#error").empty();
						jQuery('#success').html(response.success);						
					}
				}
			});
			$("form").trigger("reset");
		}
		else
		{
			console.log ("Error: Something bad happened.");
		}
	}); // close signup button
	//----------------------------------------------------------
    // End signup button clicked
    
    //--------------------------------------------------------------------------------------------------
    //
    //
    //
    //                  end signup or user registration 
    //
    //
    //
    //--------------------------------------------------------------------------------------------------





    //--------------------------------------------------------------------------------------------------
    //
    //
    //
    //                  start signin or user registration 
    //
    //
    //
    //--------------------------------------------------------------------------------------------------
	jQuery("#login").click(function(event){
		event.preventDefault();
		// alert("hello world");
		console.log("Button Pressed.");
		var user = jQuery("#user").val();
		var pass = jQuery("#pass").val();
		
		var error = false;

		if(user != '' && pass != '')
		{
			error = false;
			console.log ("Ajax Signin Calling !!!!");
			jQuery.ajax({
				url: "/home",
				type: "POST",
				data: {'username':user, 'password':pass },
				success: function(response)
				{
					console.log(response.success);
					if ( (response.success == null || response.success == undefined) )
					{
						// console.log("success is null");
						jQuery("#login_success").empty();
						jQuery('#error_creditional').html(response.error);
					}
					else  
					{
						// console.log("success is not null");
						jQuery("#error_creditional").empty();
						jQuery('#login_success').html(response.success);
						// console.log("Success : "+response.success);						
						// console.log("Flag : "+response.flag);
						location.href = '/'						
					}
				}
			});
		}
		else
		{
			console.log('some field data are empty');
			jQuery("#error_creditional").text('Error: some field data are empty.');
			error = true;
		}

	}); // close signin button
    //--------------------------------------------------------------------------------------------------
    //
    //
    //
    //                  end signin  
    //
    //
    //
    //--------------------------------------------------------------------------------------------------

}); // close ready function 




//--------------------------------------------------------------------------------------------------
//
//
//
//                  signin and signup now buttons 
//
//
//
//--------------------------------------------------------------------------------------------------
jQuery("#sign_up_now").click(function(event){
	event.preventDefault();
	console.log("Sign up now.");
	jQuery(".signin").css("display","none");
	jQuery(".signup").css("display","block");

});
jQuery("#sign_in_now").click(function(event){
	event.preventDefault();
	console.log("Sign in now.");
	jQuery(".signin").css("display","block");
	jQuery(".signup").css("display","none");
});
//--------------------------------------------------------------------------------------------------
//
//
//
//                  end signin and signup now buttons 
//
//
//
//--------------------------------------------------------------------------------------------------