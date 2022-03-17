function verifyEmail(email){
	if(email == ''){
		return;
	}else{
		console.log('email',email);
		$.ajax({
			url: customerAPI+'customers/checkEmail',
			type: 'POST',
			data: JSON.stringify({email:email}),
			dataType: 'json',
			headers: {accessKey:'letsnamaste_8428ecd711065166a86d03e902cebdd1','Content-Type':'application/json'},
			success: function(data) {
				console.log('verifyEmail',data);
			},
			error: function(data){
				var error = data.responseJSON.error;
				console.log('verifyEmail error',error);
				if(error.code == 'ERR_CUSTOMER_NOT_FOUND'){
					window.location = baseURL+'signup?email='+$('.js-email-input').val();
				}
				if(error.code == 'ERR_BAD_REQUEST' && error.details.hasOwnProperty('email')){
					window.location = baseURL+'login?email='+$('.js-email-input').val();;
				}
			}
		});
	}
}