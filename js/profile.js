if(localStorage.getItem('userInfo') != null){
var userInfo = JSON.parse(localStorage.getItem('userInfo'));
}else{
	localStorage.clear();
	window.location = baseURL+'login';
}

String.prototype.capitalize = function() {
    return this.charAt(0).toUpperCase() + this.slice(1);
}

function updateUser(controlParams){
	console.log('controlParams',controlParams);
  for (var propName in controlParams) {
    if (controlParams[propName] === null || controlParams[propName] === undefined || controlParams[propName] == '') {
      delete controlParams[propName];
    }
  }
	$.ajax({
		url: apiLinks+'accounts/'+userInfo.id,
		data: controlParams,
		type: 'PUT',
		dataType: 'json',
		headers: {appId:userInfo.id,accessKey:'letsnamaste_8428ecd711065166a86d03e902cebdd1'},
		success: function(data) {
			console.log('updateUser data',data);
			localStorage.setItem("userAcountInfo", JSON.stringify(data.data));
			$(".wrapper").notify("Updated successfully","success",{ position:"top center"});
			$('.error-message-mobileno').text('');
		},
		error: function(data){
			console.log('error',data);
		}
	});
}

function getUer(){
	$.ajax({
		url: apiLinks+'accounts/'+userInfo.id,
		type: 'GET',
		dataType: 'json',
		headers: {appId:userInfo.id,accessKey:'letsnamaste_8428ecd711065166a86d03e902cebdd1'},
		success: function(data) {
			window.userData = data.data;
			localStorage.setItem("userData", JSON.stringify(userData));
			localStorage.setItem('userAccountInfo',JSON.stringify(userData));
			console.log('getUer',userData);
			if(userData.hasOwnProperty('avatar_url')){
				$('._1UxlO___avatar-AvatarElement__cls1 img').attr('src',userData['avatar_url']);
			}
			console.log('facebook_url',userData.hasOwnProperty('facebook_url'),userData['facebook_url']);
			if(userData.hasOwnProperty('phone_number')){
				$('.profile-contact-no').val(userData['phone_number']);
			}
			if(userData.hasOwnProperty('facebook_url')){
				$('.profile-facebookURL').val(userData['facebook_url']);
			}
			if(userData.hasOwnProperty('linkedin_url')){
				$('.profile-linkedIn-url').val(userData['linkedin_url']);
			}
			if(userData.hasOwnProperty('twitter_url')){
				$('.profile-twitterURL').val(userData['twitter_url']);
			}
			if(userData.hasOwnProperty('youtube_url')){
				$('.profile-youtubeURL').val(userData.youtube_url)
			}
			if(userData.hasOwnProperty('instagram_url')){
				$('.profile-instagramURL').val(userData.instagram_url)
			}
			if(userData.hasOwnProperty('tiktok_url')){
				$('.profile-tiktokURL').val(userData.tiktok_url)
			}
			if(userData.hasOwnProperty('website_url')){
				$('.profile-websiteURL').val(userData.website_url)
			}
			if(userData.hasOwnProperty('about_me')){
				$('.profile-description').val(userData.about_me)
			}
			if(userData.hasOwnProperty('full_name')){
				$('.profile-name').val(userData.full_name);
			}
		},
		error: function(data){
			console.log('error',data);
		}
	});
}


function showDeletePopup(){
	var deleteMessage = '<div class="popup-overlay"><div class="close-overlay js-close"></div><div class="popup"><div class="popup-content"><div class="text-center"><h2 class="mbl">Delete Account</h2></div><div class="mbm"><small>You are about to delete your Letsnamaste account. This will go into effect immediately and you will no longer have access to your account data.</small></div></div><div class="popup-buttons"><div class="js-spinner spinner"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div><div class="js-popup-actions"><div class="col1of2"><button class="button js-confirm">Delete</button></div><div class="col1of2"><button class="button hollow js-close">Cancel</button></div></div></div></div></div>';
	$('#popup-region').append(deleteMessage);
	$('.js-close').on('click',function(){
		$('.popup-overlay').remove();
	});
	$('.js-confirm').on('click',function(){
		console.log('clicked')
		deleteApp();
	});
}

function deleteApp(){
	$.ajax({
		url: apiLinks+'apps/'+userInfo.id,
		type: 'DELETE',
		data: {uid:userInfo.id,full_name:userInfo.full_name,email:userInfo.email},
		dataType: 'json',
		headers: {appId:userInfo.id,accessKey:'letsnamaste_8428ecd711065166a86d03e902cebdd1'},
		success: function(data) {
			console.log('deleteApp data',data)
			deleteCustomer();
		},
		error: function(data){
			deleteCustomer();
			console.log('error',data);
		}
	});
}

function deleteCustomer(){
	$.ajax({
		url: customerAPI+'customers/'+userInfo.id,
		type: 'DELETE',
		dataType: 'json',
		headers: {appId:userInfo.id,accessKey:'letsnamaste_8428ecd711065166a86d03e902cebdd1'},
		success: function(data) {
			console.log('deleteCustomer data',data);
			localStorage.clear();
			window.location = baseURL+'getstarted';
		},
		error: function(data){
			localStorage.clear();
			window.location = baseURL+'getstarted';
			console.log('error',data);
		}
	});
}