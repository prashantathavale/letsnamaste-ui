function getevetsDetails(){
	window.eventId = getURLParameter('eventId',window.location.href);
	window.evenTitle = getURLParameter('event',window.location.href);
	window.uid = getURLParameter('appId',window.location.href);
	var eventInfo = {eventId: eventId,evenTitle:evenTitle, uid:uid};
	localStorage.setItem("eventInfo", JSON.stringify(eventInfo));
	getEvents(eventInfo);
	getuser(uid);
}

function getuser(uid){
	$.ajax({
		url: apiLinks+'accounts/'+uid,
		type: 'GET',
		dataType: 'json',
		headers: {appId:uid,accessKey:'letsnamaste_8428ecd711065166a86d03e902cebdd1'},
		success: function(data) {
			if(data.hasOwnProperty('data') != ''){
				var userDetails = data.data;
				console.log(userDetails.about_me,userDetails.hasOwnProperty('about_me'));
				$('.profile-info-name').text(userDetails.full_name);
				$('.profile-info-email').text(userDetails.email);
				if(userDetails.hasOwnProperty('avatar_url')){
					$('.profile-info-avatar').attr('src',userDetails['avatar_url']);
				}
				if(userDetails.hasOwnProperty('about_me')){
					$('._2O7ma___dossier-Description__cls1 p').text(userDetails.about_me);
				}else{
					$('._2O7ma___dossier-Description__cls1 p').text('Welcome to my scheduling page. Please follow the instructions to schedule event.');
				}

				if(userDetails.hasOwnProperty('facebook_url')){
					$('.profile-socialInfo-list').append('<li><a href="'+userDetails.facebook_url+'"><img class="social-icon" src="'+baseURL+'images/facebook.svg"/></a></li>');
				}
				if(userDetails.hasOwnProperty('linkedin_url')){
					$('.profile-socialInfo-list').append('<li><a href="'+userDetails.linkedin_url+'"><img class="social-icon" src="'+baseURL+'images/linkedin.svg"/></a></li>');
				}
				if(userDetails.hasOwnProperty('twitter_url')){
					$('.profile-socialInfo-list').append('<li><a href="'+userDetails.twitter_url+'"><img class="social-icon" src="'+baseURL+'images/twitter.svg"/></a></li>');
				}
				if(userDetails.hasOwnProperty('youtube_url')){
					$('.profile-socialInfo-list').append('<li><a href="'+userDetails.youtube_url+'"><img class="social-icon" src="'+baseURL+'images/youtube.svg"/></a></li>');
				}
				if(userDetails.hasOwnProperty('instagram_url')){
					$('.profile-socialInfo-list').append('<li><a href="'+userDetails.instagram_url+'"><img class="social-icon" src="'+baseURL+'images/instagram.svg"/></a></li>');
				}
				if(userDetails.hasOwnProperty('ticktock_url')){
					$('.profile-socialInfo-list').append('<li><a href="'+userDetails.ticktock_url+'"><img class="social-icon" src="'+baseURL+'images/tiktok.svg"/></a></li>');
				}
				if(userDetails.hasOwnProperty('website_url')){
					$('.profile-socialInfo-list').append('<li><a href="'+userDetails.website_url+'"><img class="social-icon" src="'+baseURL+'images/global.svg"/></a></li>');
				}

			}
			console.log('getuser',data);
		},
		error: function(data){
			console.log('getuser error',data);
		}
	});
}

function getEvents(eventInfo){
	$.ajax({
		url: apiLinks+'events?appId='+eventInfo.uid,
		type: 'GET',
		dataType: 'json',
		headers: {appId:eventInfo.uid,accessKey:'letsnamaste_8428ecd711065166a86d03e902cebdd1'},
		success: function(data) {
			if(data != ''){
				var eventsList = data.data;
				var events = '';
				$.each(eventsList,function(i,j){
					events += '<a href="'+baseURL+'selectbookingdate?eventId='+j.event_id+'&appId='+uid+'" data-id="event-type" class="_22u8l___styles-Link__cls1 _27zyT___styles-Link__isTabletUp"><div class="_2TjfR___styles-Header__cls1"><div data-id="event-type-marker" class="_1ALVO___styles-Marker__cls1" style="background-color: rgb(238, 83, 83);"></div><div data-id="event-type-header-title" class="_3CEQy___styles-Title__cls1">'+j.title+'</div><div data-id="event-type-arrow" class="_2aoc____styles-Arrow__cls1"></div></div><div data-id="event-type-description" class="_1FN_0___styles-Description__cls1">'+j.description+'</div></a>';
				});
				$('._3K3OL___styles-Bricks__cls1').append(events);
			}
			console.log('getEvents',data);
		},
		error: function(data){
			console.log('error',data);
		}
	});
}