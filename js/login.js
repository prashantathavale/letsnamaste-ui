function userlogin(){

	var email = $('.js-email-input').val();
	var password = $('.js-password-input').val();
	console.log('email',email,'password',password);
	if(email != '' && password != ''){
		$.ajax({
			url: customerAPI+'customers/login',
			type: 'POST',
			data: {email:email,password:password},
			dataType: 'json',
			headers:{accessKey:accessKey},
			success: function(data) {
				console.log(data,typeof data,typeof data.error == undefined,typeof data == 'undefined')
				if(typeof data.error != 'undefined'){
					window.location = 'getstarted';
				}else{
					var userInfo = data.data;
					localStorage.setItem('userInfo',JSON.stringify(userInfo));
					window.location = 'myevents';
				}
			},
			error: function(data){
				console.log('error2121',data.responseJSON.error.code);
				var errorCode = data.responseJSON.error.code;
				if(errorCode == 'ERR_INVALID_EMAIL' || errorCode == 'ERR_INVALID_PASSWORD'){
					$('.error-message').text('Please check email and password.');
				}
				$('.js-loading-show').addClass('hidden');
				$(".js-email-input").prop("readonly", false);
				$('.text-left form').append('<button class="button js-loading-hide submit-email" onclick="userlogin()" value="Login Now">Login Now</button>');
			}
		});
	}
	console.log('rttyut',$('.js-email-input').val() != '');
	if($('.js-email-input').val() != ''){
		$('.submit-email').remove();
		$('.js-loading-show').removeClass('hidden');
		$(".js-email-input").prop("readonly", true);
	}

}

function loginform(){
	var loginformUI = '<div class="pbl"><small class="error-message mbs"></small><form class="js-form" method="post"><div class="field"><h5>Enter your email</h5><input class="js-email-input" name="email" type="email" placeholder="email address" value="" required></div><div class="field"><h5>Enter your Password</h5><input class="js-password-input" name="password" type="password" placeholder="password" value="" required></div><button class="button js-loading-hide submit-email" onclick="userlogin()"value="Login Now">Login Now</button><div class="button hidden js-loading-show spinner"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div><div class="bounce4"></div></div></form></div>';

	$('.text-left').html(loginformUI);
}

function logincustomergoogleAuth(idToken){
	$.ajax({
		url: customerAPI+'customers/googleAuth',
		type: 'POST',
		data: {token:idToken,method:'googleAuth'},
		headers: {accessKey:'letsnamaste_8428ecd711065166a86d03e902cebdd1'},
		dataType: 'json',
		success: function(data) {
			if(data != ''){
				var userInfo = data.data;
				console.log('logincustomergoogleAuth',userInfo);
				localStorage.setItem("userInfo", JSON.stringify(userInfo));
				window.location = baseURL+'myevents';
			}
		},
		error: function(data){
			console.log('logincustomergoogleAuth error',data);
		}
	});
}