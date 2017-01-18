$(document).ready(function(){
	var loginData = {};
	var email = $('#login-email');
	var password = $('#login-pwd');
	
	email.blur(function(){
		
		var emailValidationMsg = $('#login-email-validation-msg');
		var pattern = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/;
		if(email.val().length < 1)
		{
			email.css({'border' : '2px solid red'})
			emailValidationMsg.html("Email cannot be empty");	
		}
		else if(!pattern.test(email.val()))
		{
			email.css({'border' : '2px solid red'})
			emailValidationMsg.html("Please enter a valid email id");
		}
		else
		{
			loginData.email_id = email.val();
			email.css({'border' : '2px solid green'});
			emailValidationMsg.html("");
		}
	});

	password.blur(function(){
		var passwordValidationMsg = $('#login-pwd-validation-msg');
		if(password.val().length < 1)
		{
			password.css({"border" : "solid 2px red"});
			passwordValidationMsg.html("Please enter the password");
		}
		else
		{
			loginData.password = password.val();
			password.css({'border' : '2px solid green'});
			passwordValidationMsg.html("");	
		}
	});

	$('#login-button').on('click', function(){
		$.ajax({
				url:"http://dedications:81/dedications/insite/api/login",
				type:'POST',
				data:loginData,
				headers: { 'Content-Type': 'application/x-www-form-urlencoded'},
				success: function(data){
					console.log(data);
					if(data == 0)
					{
						$('#invalid-login').html("Invalid email id or password");	
					}
					else
					{
						window.location.href = "home.php";
					}	
				},

				error: function()
				{
					console.log('helo');
					$('#email-validation-msg').html("");	
				}
			});
	})
});