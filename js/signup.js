var socialAuth = 0;

String.prototype.capitalize = function() {
    return this.charAt(0).toUpperCase() + this.slice(1);
}


function signUpform(){
	console.log('here signUpform');
	var signUpformUI = '<form class="js-form" novalidate="" autocomplete="off" method="post"><div class="field js-email-field"><h5>Enter your email to get started.</h5><input class="email-input" name="email" type="email" placeholder="email address" ><div class="error-message error-message-email js-error-message"></div></div><div class="field js-name-field"><h5>Enter your full name.</h5><input  class="signup-name" name="name" type="text" placeholder="John Doe" required><div class="error-message js-error-message error-fullname"></div></div><div class="field js-password-field"><h5 style="padding: 5px;">Choose a password with at least 8 characters. (should include alphabets, numbers and special characters)</h5><input class="signup-password" name="password" type="password" minlength="8" placeholder="password" autocomplete="off"><div class="error-message js-error-message error-password"></div><div id="password-strength-status"></div></div><button class="button js-loading-hide js-signup-button" type="submit" value="Continue">Continue</button><div class="button hidden js-loading-show spinner"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div><div class="bounce4"></div></div></form>';
	$('.text-left').html(signUpformUI);

	$('.signup-password').keyup(function(){
		checkPasswordStrength('.signup-password');
	});

			$('.js-signup-button').on('click',function(){
				console.log('click js-signup-button');
				var signupName = $('.signup-name').val().capitalize();
				var signUpemail = $('.email-input').val();
				$('.js-signup-button').remove();
				if(signupPassword.length > 7 && signupName != '' && signUpemail.indexOf('@') > 2){
					signupInfo = {email:signUpemail,signupName:signupName,signupPassword:signupPassword}
					$('.js-loading-show').removeClass('hidden');
					$(".js-email-input").prop("readonly", true);
					createCustomer(signupInfo);
				}else{
					if(signupPassword.length < 7){
						$('#password-strength-status').text('Password Must be greater than 8 characters.');
					}
					if(signupName == ''){
						$('.error-fullname').text('Full name can not be empty');
					}
					$('.js-loading-show').addClass('hidden');
					$('.text-left form').append('<input class="button js-loading-hide js-signup-button" type="submit" value="Continue">');
				}
			});


}

function validateFormData(){
	console.log('validateFormData');
	var signupName = $('.signup-name').val().capitalize();
	var signUpemail = $('.email-input').val();
	$('.js-signup-button').remove();
	if(signupPassword.length > 7 && signupName != '' && signUpemail.indexOf('@') > 2){
		signupInfo = {email:signUpemail,signupName:signupName,signupPassword:signupPassword}
		$('.js-loading-show').removeClass('hidden');
		$(".js-email-input").prop("readonly", true);
		createCustomer(signupInfo);
	}else{
		if(signupPassword.length < 7){
			$('#password-strength-status').text('Password Must be greater than 8 characters.');
		}
		if(signupName == ''){
			$('.error-fullname').text('Full name can not be empty');
		}
		$('.js-loading-show').addClass('hidden');
		$('.text-left form').append('<input class="button js-loading-hide js-signup-button" type="submit" value="Continue">');
	}
}

function createcustomergoogleAuth(idToken){
	$.ajax({
		url: customerAPI+'customers/googleAuth',
		type: 'POST',
		data: {token:idToken,method:'googleAuth'},
		headers: {accessKey:'letsnamaste_8428ecd711065166a86d03e902cebdd1'},
		dataType: 'json',
		success: function(data) {
			if(data != ''){
				var userInfo = data.data;
				console.log('createcustomergoogleAuth',userInfo);
				localStorage.setItem("userInfo", JSON.stringify(userInfo));
				createApp(userInfo.id);
				socialAuth = 1;
				$('.sign-up-text').text('Please wait for a while');
			}
		},
		error: function(data){
			console.log('createcustomergoogleAuth error',data);
		}
	});
}

function createCustomer(signupInfo){
	var email = btoa(signupInfo.email);
	var signupName  = signupInfo.signupName;
	var signupName  = signupName.substr(0,1).toUpperCase()+signupName.substr(1);;
	var fields = {user_name:email,full_name: signupName, email: signupInfo.email,password: signupInfo.signupPassword};
	$.ajax({
		url: customerAPI+'customers',
		type: 'POST',
		data: {user_name:email,full_name: signupInfo.signupName, email: signupInfo.email,password: signupInfo.signupPassword},
		headers: {accessKey:'letsnamaste_8428ecd711065166a86d03e902cebdd1'},
		dataType: 'json',
		success: function(data) {
			if(data != ''){
				var userInfo = data.data;
				console.log('userInfo',userInfo);
				localStorage.setItem("userInfo", JSON.stringify(userInfo));
				createApp(data.data.id);
				$('.sign-up-text').text('Please wait for a while');
			}
		},
		error: function(data){
			var error = JSON.parse(data.responseText).error;
			if(error.details.hasOwnProperty('email')){
				$('.error-message-email').text('This email already exists. Please try with different email ID or click on login.');
			}
			$('.js-loading-show').addClass('hidden');
			$('.text-left form').append('<input class="button js-loading-hide js-signup-button" type="submit" value="Continue"> Click here to <a href="login">Log in</a>');
			console.log('error',data);
		}
	});
}


function onSignIn(googleUser) {
  var profile = googleUser.getBasicProfile();
  var id_token = googleUser.getAuthResponse().id_token;
  console.log('id_token: ' + id_token); // Do not send to your backend! Use an ID token instead.
  console.log('Name: ' + profile.getName());
  console.log('Image URL: ' + profile.getImageUrl());
  console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
}

function createApp(id){
	console.log('id',id);
	$('.sign-up-text').text('Initializing default events');
	$.ajax({
		url: apiLinks+'apps',
		type: 'POST',
		dataType: 'json',
		headers: {appId:id,accessKey:'letsnamaste_8428ecd711065166a86d03e902cebdd1'},
		success: function(data) {
			console.log('createApp',data);
			var accountInfo = JSON.parse(localStorage.getItem("userInfo"));
					createAccount(accountInfo);
		},
		error: function(data){
			console.log('error',data);
		}
	});
}

function createAccount(userInfo){
	var fields = {username:userInfo.user_name,full_name: userInfo.full_name, email: userInfo.email};
	$('.sign-up-text').text('Done');
	$.ajax({
		url: apiLinks+'accounts',
		type: 'POST',
		data: fields,
		headers: {appId:userInfo.id,accessKey:'letsnamaste_8428ecd711065166a86d03e902cebdd1'},
		dataType: 'json',
		success: function(data) {
			if(socialAuth == 0){
				window.location = baseURL+'verification';
			}else{
				window.location = baseURL+'myevents';
			}
		},
		error: function(data){
			console.log('error',data);
		}
	});
}