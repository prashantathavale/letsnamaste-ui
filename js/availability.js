if(localStorage.getItem('userInfo') != null){
var userInfo = JSON.parse(localStorage.getItem('userInfo'));
}else{
	localStorage.clear();
	window.location = baseURL+'getstarted';
}

function getTime(meetingTime){
	console.log('meetingTime',meetingTime);

	var meetingTime = meetingTime.split(':');
	if(meetingTime[1].indexOf('PM') > -1){
		if(meetingTime[0] == 12){
			meetingTime[0] = 12*60;
		}else{
			meetingTime[0] = (12+parseInt(meetingTime[0]))*60;
		}
	}else{
		console.log('meetingTime[0]',meetingTime[0]);
		meetingTime[0] = meetingTime[0]*60;
	}
	return meetingTime[0];
}

function getTimeinMins(time){
	var min = time%60;
	var hr 		= parseInt(time/60);
	var am = 'AM';
	if(hr > 12){
		hr = hr - 12;
		am = 'PM';
	}
	if(min < 10){
		min = '0'+min;
	}
	var meetingTime = hr+':'+min+' '+am;
	return meetingTime;
}

function setDefaultavailability(params){
	var start_time = params.start_time;
	var end_time = params.end_time;
	var available_days = params.availableDays.join();
	console.log('available_days',available_days);
	var fields = {default_available_days:available_days,default_available_start_time:start_time,default_available_end_time: end_time}
	$.ajax({
		url: apiLinks+'accounts/'+userInfo.id,
		type: 'PUT',
		data: fields,
		headers: {appId:userInfo.id,accessKey:'letsnamaste_8428ecd711065166a86d03e902cebdd1'},
		dataType: 'json',
		success: function(data) {
			console.log('data',data);
			var userAccountInfo = data.data;
			if(localStorage.getItem('userAccountInfo') != null){
				localStorage.setItem('userAccountInfo',JSON.stringify(userAccountInfo));
				window.location = baseURL+'myevents';
			}else{
				window.location = baseURL+'verification';
			}
		},
		error: function(data){
			console.log('error',data);
			localStorage.setItem("userDefaultTime", JSON.stringify(fields));
			window.location = baseURL+'verification';
		}
	});
}