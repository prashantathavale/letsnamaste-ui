if(localStorage.getItem('userInfo') != null){
var userInfo = JSON.parse(localStorage.getItem('userInfo'));
}else{
	localStorage.clear();
	window.location = baseURL+'getstarted';
}

function resetPassword(old_password,new_password){
	$.ajax({
		url: customerAPI+'customers/'+userInfo.id+'/changepassword',
		data: {old_password:old_password,new_password:new_password},
		type: 'POST',
		dataType: 'json',
		headers: {appId:userInfo.id,accessKey:'letsnamaste_8428ecd711065166a86d03e902cebdd1'},
		success: function(data) {
			console.log('resetPassword',data);
			window.location = 'profile';
		},
		error: function(data){
			var error = JSON.parse(data.responseText).error;
			if(error.hasOwnProperty('message')){
				$('.error-message-old-password').text('Please enter correct Password.');
			}
				$('.js-loading-show').addClass('hidden');
				$('.text-left form').append('<input class="button js-loading-hide js-reset-button" type="submit" value="Reset">');
			console.log('error',data);
		}
	});
}