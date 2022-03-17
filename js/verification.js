var userInfo = JSON.parse(localStorage.getItem('userInfo'));
function verifyCode(code){
	$.ajax({
		url: customerAPI+'customers/'+userInfo.id+'/activate',
		type: 'POST',
		data: {confirmation_code:code},
		dataType: 'json',
		headers: {accessKey:'letsnamaste_8428ecd711065166a86d03e902cebdd1'},
		success: function(data) {
			console.log('verifyCode',data);
			localStorage.clear();
			window.location = baseURL+'login';
		},
		error: function(data){
			console.log('error',data.responseJSON.error.message);
			var error = data.responseJSON.error;
			if(error.hasOwnProperty('message')){
				$('.error-message').text('Please enter valid verification code.');
			}
		}
	});
}