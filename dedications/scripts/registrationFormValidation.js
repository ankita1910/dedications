$(document).ready(function(){

	var regData = {};

	$("#r-name").blur(function(){
		var name = $('#r-name');
		if(name.val().length < 1)
		{
			name.css({'border' : '2px solid red'})
			$('#name-validation-msg').html("Name cannot be empty");	
		}
		else
		{
			regData.first_name = name.val();
			name.css({'border' : '2px solid green'})
			$('#name-validation-msg').html("");	
		}
	});
	$("#l-name").blur(function(){
		var name = $('#l-name');
		if(name.val().length < 1)
		{
			name.css({'border' : '2px solid red'})
			$('#name-validation-msg').html("Name cannot be empty");	
		}
		else
		{
			regData.last_name = name.val();
			name.css({'border' : '2px solid green'})
			$('#name-validation-msg').html("");	
		}
	});

	$("#r-email").blur(function(){
		var pattern = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/;
		var email = $('#r-email');
		if(email.val().length < 1)
		{
			email.css({'border' : '2px solid red'})
			$('#email-validation-msg').html("Email cannot be empty");	
		}
		else if(!pattern.test(email.val()))
		{
			email.css({'border' : '2px solid red'})
			$('#email-validation-msg').html("Please enter a valid email id");
		}
		else
		{	
			$.ajax({
				url:"http://dedications:81/dedications/insite/api/email-validation",
				data:{
					'email_id' : email.val()
				},
				type:"POST",
				headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				success: function(loginData){
					if(loginData != 0)
					{
						$('#email-validation-msg').html("Email alredy exists");	
						email.css({'border' : '2px solid red'})
					}
					else
					{
						regData.email_id = email.val();
						email.css({'border' : '2px solid green'})
						$('#email-validation-msg').html("");
					}	
				},
				error: function()
				{
					$('#email-validation-msg').html("");	
				}
			});
		}
	});

	$("#r-password").blur(function(){
		var pwd = $('#r-password');
		var cPwd = $('#r-cpassword');
		var pwdValidationMsg = $('#pwd-validation-msg');
		var cPwdValidationMsg = $('#c-pwd-validation-msg');
		if(pwd.val().length < 1)
		{
			pwd.css({'border' : '2px solid red'})
			pwdValidationMsg.html("Passward cannot be empty");	
		}
		else if(cPwd.val().length > 1 && cPwd.val() != pwd.val())
		{
			pwd.css({'border' : '2px solid red'})
			pwdValidationMsg.html("Passward did not match");	
		}
		else
		{
			regData.password = pwd.val();
			pwd.css({'border' : '2px solid green'})
			pwdValidationMsg.html("");
			if(cPwd.val().length > 1)
			{
				cPwd.css({'border' : '2px solid green'})
				cPwdValidationMsg.html("");			
			}	
		}
	});

	$("#r-cpassword").blur(function(){
		var pwd = $('#r-password');
		var cPwd = $('#r-cpassword');
		var pwdValidationMsg = $('#pwd-validation-msg');
		var cPwdValidationMsg = $('#c-pwd-validation-msg');

		if(cPwd.val().length < 1)
		{
			cPwd.css({'border' : '2px solid red'})
			cPwdValidationMsg.html("Passward cannot be empty");	
		}
		else if(pwd.val().length > 1 && cPwd.val() != pwd.val())
		{
			cPwd.css({'border' : '2px solid red'})
			cPwdValidationMsg.html("Passward did not match");	
		}
		else
		{
			cPwd.css({'border' : '2px solid green'})
			cPwdValidationMsg.html("");	
			pwd.css({'border' : '2px solid green'})
			pwdValidationMsg.html("");
		}
	});
	$("#r-mobile").blur(function(){
		var pattern = /^[789]\d{9}$/;
		var checkZerosPattern = /0{5,}/
		var mobile = $('#r-mobile');
		if(mobile.val().length < 1)
		{
			mobile.css({'border' : '2px solid red'})
			$('#mobile-no-validation-msg').html("Mobile number cannot be empty");	
		}
		else if(pattern.test(mobile.val()) && !checkZerosPattern.test(mobile.val()))
		{
			regData.mobile_no = mobile.val();
			mobile.css({'border' : '2px solid green'})
			$('#mobile-no-validation-msg').html("");	
		}
		else
		{
			mobile.css({'border' : '2px solid red'})
			$('#mobile-no-validation-msg').html("Please enter a valid ten digit mobile number");	 
		}
	});

	$('#register-user').on('click', function(){
		var url = "http://dedications:81/dedications/insite/api/register"
		$.ajax({
			url:url,
			type:'POST',
			data:regData,
			headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
			success: function(data){
				console.log(data);
				if(data == 0)
				{
					console.log('Registration failed');
				}
				else
				{
					window.location.href = "home.php";
				}	
			},

			error: function()
			{
				console.log('helo');	
			}
		})
	})
});