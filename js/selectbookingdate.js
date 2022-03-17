localStorage.clear();

var daysOfWeek = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
var eventId = getURLParameter('eventId',window.location.href);
if(localStorage.getItem('eventInfo') == null){
	window.appId = getURLParameter('appId',window.location.href);
}else{
	window.appId = JSON.parse(localStorage.getItem('eventInfo')).uid;
}
var intervalsList = userDetails = {};
if(localStorage.getItem('meetingsList') == null){
	getmeetingList();
}
function getmeetingList(){
	$.ajax({
		url: apiLinks+'meetings?appId='+appId+'&apiKey=e1b6ae754adbc6e081991db9a0c35ec5091af408',
		type: 'GET',
		dataType: 'json',
		headers: {appId:appId,accessKey:'letsnamaste_8428ecd711065166a86d03e902cebdd1'},
		success: function(data) {
			if(data.hasOwnProperty('data') != ''){
				window.meetingsList = data.data;
				localStorage.setItem('meetingsList',JSON.stringify(meetingsList));
			}
			console.log('getmeetingList',data);
		},
		error: function(data){
			console.log('getmeetingList error',data);
		}
	});
}

function getuser(){
	$.ajax({
		url: apiLinks+'accounts/'+appId,
		type: 'GET',
		dataType: 'json',
		headers: {appId:appId,accessKey:'letsnamaste_8428ecd711065166a86d03e902cebdd1'},
		success: function(data) {
			if(data.hasOwnProperty('data') != ''){
				userDetails = data.data;
				localStorage.setItem('userAccountInfo',JSON.stringify(userDetails));
				console.log('getuser',userDetails);
				if(userDetails.hasOwnProperty('avatar_url')){
					$('.profile-info-avatar').attr('src',userDetails['avatar_url']);
				}
				if(userDetails.hasOwnProperty('full_name')){
					$('.profile-info-name').text(userDetails['full_name']);
				}
			}
		},
		error: function(data){
			console.log('getuser error',data);
		}
	});
}

function geteventdetails(){
	$('.booking-back-button').attr('href',baseURL+'bookevent?appId='+appId);
	$.ajax({
		url: apiLinks+'events/'+eventId,
		type: 'GET',
		dataType: 'json',
		headers: {appId:appId,accessKey:'letsnamaste_8428ecd711065166a86d03e902cebdd1'},
		success: function(data) {
			window.meetingDetails = data.data;
			$('.profile-info-event-type-name').text(meetingDetails.title);
			$('.meeting-duration').text(meetingDetails.duration_in_minute+' Mins');
			$('.rich-text-view').text(meetingDetails.description);
			localStorage.setItem('meetingDetails',JSON.stringify(meetingDetails));
			getIntervalList(eventId);
			console.log('geteventdetails',data);
		},
		error: function(data){
			console.log('error1',data);
		}
	});

}

function getIntervalList(eventId){
	$.ajax({
		url: apiLinks+'eventIntervals/getEventIntervalsByEventId',
		type: 'POST',
		data: {event_id: eventId},
		dataType: 'json',
		headers: {appId:appId,accessKey:'letsnamaste_8428ecd711065166a86d03e902cebdd1'},
		success: function(data) {
			window.getIntervalList = data.data;
			console.log('getIntervalList',getIntervalList,isEmpty(getIntervalList));
			$.each(getIntervalList,function(i,j){
				if(j.interval_type == 'applicableday'){
					intervalsList[j.day_of_weeks] = {interval_type:'applicableday',start_time:j.start_time,end_time:j.end_time};
				}
				if(j.interval_type == 'applicabledate'){
					var intervalDate = new Date(j.start_date *1000);
					intervalsList[moment(intervalDate).format('YYYY_MM_DD')] = {interval_type:'applicabledate',start_time:j.start_time,end_time:j.end_time};
				}
			});
			if(isEmpty(getIntervalList) == true){
				var default_available_days = userDetails.default_available_days;
				var default_available_days = default_available_days.split(',');
				$.each(daysOfWeek,function(i,j){
					if(default_available_days.indexOf(j) > -1){
						intervalsList[j] = {interval_type:'applicableday',start_time:userDetails.default_available_start_time,end_time:userDetails.default_available_end_time};
					}
				});
			}
			addAllevents(intervalsList);
		},
		error: function(data){
			console.log('error1',data);
		}
	});
}

function addAllevents(intervalsList){
	var availableDays = Object.keys(intervalsList);
	var date = new Date();
	var today = date.getTime();
	if(availableDays.indexOf(daysOfWeek[date.getDay()]) > -1 && intervalsList[daysOfWeek[date.getDay()]].hasOwnProperty('start_time') && intervalsList[daysOfWeek[date.getDay()]].hasOwnProperty('end_time')){
		calendar.addEvent({id: 'applicableday_'+moment(date).format('DD_MM'),
			start: moment(date).format('YYYY-MM-DD')+'T'+getEventTimeinMins(intervalsList[daysOfWeek[date.getDay()]].start_time),
			end:moment(date).format('YYYY-MM-DD')+'T'+getEventTimeinMins(intervalsList[daysOfWeek[date.getDay()]].end_time),
			allDay: false,
			displayEventTime:true
		});
	}
	for(var i=0;i<120;i++){
		var nextday = new Date(today+86400000);
		today = nextday.getTime();
		if(availableDays.indexOf(daysOfWeek[nextday.getDay()]) > -1 && availableDays.indexOf(moment(nextday).format('YYYY_MM_DD')) == -1 ){
			calendar.addEvent({id: 'applicableday_'+moment(nextday).format('DD_MM'),
				start: moment(nextday).format('YYYY-MM-DD')+'T'+getEventTimeinMins(intervalsList[daysOfWeek[nextday.getDay()]].start_time),
				end:moment(nextday).format('YYYY-MM-DD')+'T'+getEventTimeinMins(intervalsList[daysOfWeek[nextday.getDay()]].end_time),
				allDay: false,
				displayEventTime:true
			});
		}
		if(availableDays.indexOf(moment(nextday).format('YYYY_MM_DD')) > -1 && intervalsList[moment(nextday).format('YYYY_MM_DD')].start_time != undefined && intervalsList[moment(nextday).format('YYYY_MM_DD')].end_time != undefined){
			console.log('here in dates',moment(nextday).format('YYYY_MM_DD'),intervalsList[moment(nextday).format('YYYY_MM_DD')]);
			calendar.addEvent({id: 'applicableday_'+moment(nextday).format('DD_MM'),
				start: moment(nextday).format('YYYY-MM-DD')+'T'+getEventTimeinMins(intervalsList[moment(nextday).format('YYYY_MM_DD')].start_time),
				end:moment(nextday).format('YYYY-MM-DD')+'T'+getEventTimeinMins(intervalsList[moment(nextday).format('YYYY_MM_DD')].end_time),
				allDay: false,
				displayEventTime:true
			});
		}
	}
}

function showbookingform(){
	var bookingButton = 'Schedule Event';
	var chargeMSG = '';
	var currency = '₹';
	$('.booking-back-button').prop('href',window.location.href);
	if(meetingDetails.charge_type == 'paid'){
		bookingButton = 'Pay Now';
		if(meetingDetails.hasOwnProperty('currency')){
			currency = meetingDetails.currency;
		}
		chargeMSG = '<div><span class="_1f-R-___index-LabelText__cls1"> You will be charged '+meetingDetails.amount+' '+currency+' For this meeting. Click Pay now to complete meeting book </span></div>'
	}
	var bookingform = '<div class="_1dX2m___ContentWrapper__cls1 _1W4fH___ContentWrapper__isTabletUp"><div class="H2Xvx___DetailsForm__cls1"><h2>Enter Details</h2><form autocomplete="off" autocorrect="off" novalidate="" method="POST"><div class="mbl"><fieldset class="_3rBcz___Fieldset__cls1"><div class="_2py84___invitee_inputs-TextField__cls1"><label class="_3Hc0u___index-Label__cls1"><span class="_1f-R-___index-LabelText__cls1">Name *</span><div class="O2xxi___TextInput__cls1"><input aria-invalid="false" maxlength="155" name="full_name" required="" autocorrect="off" autocomplete="off" type="text" kind="text" class="_3KAjx___index-Component__cls1 cunsumer_name" value=""><div class="error-message error-message-name js-error-message"></div></div></label></div><div class="_2py84___invitee_inputs-TextField__cls1"><label class="_3Hc0u___index-Label__cls1"><span class="_1f-R-___index-LabelText__cls1">Email *</span><div class="O2xxi___TextInput__cls1"><input aria-invalid="false" maxlength="255" name="email" required="" autocorrect="off" autocomplete="off" type="email" kind="email" class="_3KAjx___index-Component__cls1 cunsumer_email" value=""><div class="error-message error-message-email js-error-message"></div></div></label></div></fieldset><div class="_3OtL2___index-AddButtonContainer__cls1"></div><div class="mbm"><div class="location-label">Phone Number *</div><div class="phone-field location-label-phone-field"><div><label class="_2_8TY___text-Label__cls1"><div class="O2xxi___TextInput__cls1"><div class="phone-field-wrapper"><input aria-invalid="false" maxlength="255" name="phone_number" autocorrect="off" autocomplete="off" type="tel" kind="tel" class="_3KAjx___index-Component__cls1 cunsumer_phoneno" id="cunsumer_phoneno"><div class="error-message error-message-phoneno js-error-message"></div></div></div></label></div></div></div><fieldset class="mtm _3rBcz___Fieldset__cls1"><div class="question mbm"><div><label class="_3Hc0u___index-Label__cls1"><span class="_1f-R-___index-LabelText__cls1">Please share anything that will help prepare for our meeting.</span><div class="O2xxi___TextInput__cls1"><textarea aria-invalid="false" maxlength="10000" name="question_0" autocorrect="off" autocomplete="off" type="textarea" class="_3KAjx___index-Component__cls1 cunsumer_description _31seb___index-Component__kind-textarea"></textarea></div></label></div></div></fieldset></div>'+chargeMSG+'<button class="MOKW6___Button__cls1 Vhorz___styles-Container__cls1 _8XRb1___styles-Container__size-large _1-5mC___styles-Container__decoration-primary _2Ty7q___styles-Container__responsive _2UclO___styles-Container__onlyChild _1Qg-r___BareButton__cls1 _2zIir___index-UnstyledButton__cls1" type="submit"><div class="OPKSe___styles-TextContainer__cls1">'+bookingButton+'</div></button><div class="button hidden js-loading-show spinner"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div><div class="bounce4"></div></div></form></div></div>';
	$('._11234___MainPanel__cls1').html(bookingform);

	$('._2zIir___index-UnstyledButton__cls1').on('click',function(){
		var consumerName = $('.cunsumer_name').val();
		var cumsumerEmail = $('.cunsumer_email').val();
		var consumerPhoneno = $('.cunsumer_phoneno').val();
		$('._2zIir___index-UnstyledButton__cls1').remove();
		var isMobileno = IsMobileNumber('cunsumer_phoneno');
		if(consumerName != '' && cumsumerEmail.indexOf('@') > -1 && isMobileno == true){
			if(meetingDetails.charge_type == 'paid'){
				window.open(baseURL+'payment_sample','paymentwindow','_blank');
				bc.onmessage = function (ev) {
					if(ev.data.action == 'paid'){
						createConsumer(consumerName,cumsumerEmail,consumerPhoneno);
					}else{
						window.location.reload();
					}
				}
			}else{
				createConsumer(consumerName,cumsumerEmail,consumerPhoneno);
			}
			$('.js-loading-show').removeClass('hidden');
		}else{
			if(consumerName == ''){
				$('.error-message-name').text('Name should not be empty');
			}
			if(cumsumerEmail == '' || cumsumerEmail.indexOf('@') == -1){
				$('.error-message-email').text('Please enter valid email address');
			}
			if(consumerPhoneno == '' || consumerPhoneno.length <= 9){
				$('.error-message-phoneno').text('Please enter valid Phone Number');
			}
			$('.js-loading-show').addClass('hidden');
			$('.H2Xvx___DetailsForm__cls1 form').append('<button class="MOKW6___Button__cls1 Vhorz___styles-Container__cls1 _8XRb1___styles-Container__size-large _1-5mC___styles-Container__decoration-primary _2Ty7q___styles-Container__responsive _2UclO___styles-Container__onlyChild _1Qg-r___BareButton__cls1 _2zIir___index-UnstyledButton__cls1" type="submit"><div class="OPKSe___styles-TextContainer__cls1">'+bookingButton+'</div></button>');
		}
	});
}


function createConsumer(consumerName,cumsumerEmail,consumerPhoneno){
	console.log('consumerName',consumerName);
	var meetingDate = new Date(date);
	var now = Date.now();
	meetingDate = moment(meetingDate).format('YYYY_MM_DD');
	$.ajax({
		url: apiLinks+'consumers',
		type: 'POST',
		data:{name:consumerName,email:cumsumerEmail,phone_number:consumerPhoneno},
		dataType: 'json',
		headers: {appId:appId,accessKey:'letsnamaste_8428ecd711065166a86d03e902cebdd1'},
		success: function(data) {
			console.log('createConsumer',data);
			createGroup(meetingDetails.event_id+"cus"+data.data.consumer_id+"d"+meetingDetails.duration_in_minute+"ts"+now,
				meetingDate,
				data.data.consumer_id);
			// createMeeting(data.data.consumer_id);
		},
		error: function(data){
			console.log('error',data);
		}
	});
}


function createGroup(sessionid,meetingDate,consumeId){
	$.ajax({
		url: 'https://api.cometondemand.net/api/v2/createGroup',
		type: 'POST',
		data:{GUID: sessionid,name: 'LestNamaste_'+appId+'_'+meetingDetails.event_id+'_'+meetingDate,"type": "0"},
		dataType: 'json',
		headers: {'api-key':avCallapikey,'content-type':'application/x-www-form-urlencoded'},
		success: function(data) {
			console.log('createGroup data',data);
			var groupdata = data.success;
			var sessionId = hashGenerator(sessionid+'LestNamaste_'+appId+'_'+meetingDetails.event_id+'_'+meetingDate);
			// joinGroup(groupdata,consumeId);
			createMeeting(consumeId,groupdata,sessionId);
		},
		error: function(data){
			console.log('error',data);
		}
	});
}

function joinGroup(groupdata,consumeId){
	$.ajax({
		url: 'https://api-us.cometchat.io/v2.0/groups/'+groupdata.guid+'/members',
		type: 'POST',
		data:JSON.stringify({participants: ["superhero1"]}),
		dataType: 'json',
		headers: {'appid':avCallAppId,'apikey':avCallapikey,'content-type':'application/json','accept':'application/json'},
		success: function(data) {
			console.log('joinGroup data',data);
			var joinGroupDAta = data.data;
			initiateAVcall(groupdata,consumeId);
			//window.location = baseURL+'confirmbooking?eventId='+event_id+'&appId='+appId;
		},
		error: function(data){
			console.log('error',data);
		}
	});
}

function initiateAVcall(groupdata,consumeId){
	var consumeId = consumeId;
	$.ajax({
		url: 'https://api-us.cometchat.io/v2.0/users/superhero1/calls',
		type: 'POST',
		data:JSON.stringify({receiver:groupdata.guid,receiverType: "group",type: "video",status:"initiated",metadata: {test:'test'}}),
		dataType: 'json',
		headers: {'appid':avCallAppId,'apikey':avCallapikey,'content-type':'application/json','accept':'application/json'},
		success: function(data) {
			console.log('initiateAVcall data',data);
			var initiateAVcall = data.data;
			console.log('step4:',initiateAVcall.data.entities.on.entity.sessionid);
			var sessionId = initiateAVcall.data.entities.on.entity.sessionid;
			createMeeting(consumeId,groupdata,sessionId);
			//window.location = baseURL+'confirmbooking?eventId='+event_id+'&appId='+appId;
		},
		error: function(data){
			console.log('error',data);
		}
	});
}


function createMeeting(consumeId,groupdata,sessionId){
	var meetingDetails = JSON.parse(localStorage.getItem('meetingDetails'));
	var meetingTime = time.split(':');
	var meetingDate = new Date(date);
	var offset = new Date().getTimezoneOffset();
	var now = Date.now();
	/*var consumerdescription = $('.cunsumer_description').val() != '' ? $('.cunsumer_description').val() : '';*/
	meetingTime[0] = parseInt(meetingTime[0]);
	if(meetingTime[1].indexOf('p.m.') > -1){
		if(meetingTime[0] == 12){
			meetingTime[0] = 12*60;
		}else{
			meetingTime[0] = (12 + meetingTime[0])*60;
		}
	}else{
		meetingTime[0] = meetingTime[0]*60;
	}
	var meetingTime = meetingTime[0] + offset;
	meetingDate = moment(meetingDate).format('YYYY-MM-DD')+'T'+getEventTimeinMins(meetingTime)+'Z';
	console.log('meetingDate1',meetingDate);
	var meeting_date = new Date(meetingDate) / 1000;
	var urlParam = btoa(JSON.stringify({guid:groupdata.guid,sessid:sessionId}));
	$.ajax({
		url: apiLinks+'meetings',
		type: 'POST',
		data:{event_id:meetingDetails.event_id,consumer_id:consumeId,title:meetingDetails.title,url:baseURL+"meetingCall?urlParam="+urlParam,state:"active",duration:meetingDetails.duration_in_minute,start_time:meetingTime,end_time:meetingTime+meetingDetails.duration_in_minute,meeting_date:meeting_date/*,description:consumerdescription*/},
		dataType: 'json',
		headers: {appId:appId,accessKey:'letsnamaste_8428ecd711065166a86d03e902cebdd1'},
		success: function(data) {
			var meetingbookingdetails = data.data;
			console.log('meetingbookingdetails',meetingbookingdetails);
			localStorage.setItem('meetingbookingdetails',JSON.stringify(meetingbookingdetails));
			window.location = baseURL+'confirmbooking?eventId='+meetingDetails.event_id+'&appId='+appId;
			// createGroup(meetingDetails.event_id+"cus"+consumeId+"d"+meetingDetails.duration_in_minute+"ts"+now,meetingbookingdetails.meeting_id,meetingDetails.event_id);
		},
		error: function(data){
			console.log('error',data);
		}
	});
}


function getEventTimeinMins(time){
	var min = time%60;
	var hr 	= parseInt(time/60);
	if(hr < 10){
		hr = '0'+hr;
	}
	if(min < 10){
		min = '0'+min;
	}
	var meetingTime = hr+':'+min+':00';

	return meetingTime;
}

function getTimeinMins(time){
	var min = time%60;
	var hr 		= parseInt(time/60);
	console.log('hr',hr);
	if(hr < 10){
		hr = '0'+hr;
	}
	if(min < 10){
		min = '0'+min;
	}
	var meetingTime = hr+':'+min;
	return meetingTime;
}

function getTimeslots(start_time,end_time){
	var slots = (end_time - start_time)/60;
	return slots;
}


function getTimeinMins(time){
	var min = time%60;
	var hr 	= parseInt(time/60);
	var ap  = 'a.m.';
	if(hr == 12){
		ap = 'p.m.';
	}
	if(hr > 12){
		hr = hr - 12;
		ap = 'p.m.';
	}
	if(hr < 10){
		hr = '0'+hr;
	}
	if(min < 10){
		min = '0'+min;
	}
	var meetingTime = hr+':'+min+' '+ap;
	return meetingTime;
}

function showTimegrid(day,weekDay){
	var userAccountInfo = JSON.parse(localStorage.getItem('userAccountInfo'));
	window.date = day;
	var start_time 	= 540;
	var end_time	= 1080;
	var currentHr	= (new Date().getHours()*60)+120;
	var timeslotUI 	= '';
	var today = new Date();
	var selectedDay = new Date(date);
	if(isEmpty(intervalsList) == false){
		console.log('weekDay',weekDay)
		if(intervalsList[weekDay].hasOwnProperty('start_time') != false){
			start_time = intervalsList[weekDay].start_time;
		}
		if(intervalsList[weekDay].hasOwnProperty('end_time') != false){
			end_time = intervalsList[weekDay].end_time;
		}
	}else{
		if(isEmpty(userAccountInfo) == false){
			start_time 	= userAccountInfo.default_available_start_time;
			end_time	= userAccountInfo.default_available_end_time;
		}
	}
	if(today.getDate() === selectedDay.getDate()){
		if(currentHr >= start_time){
			start_time = currentHr;
		}
	}
	var timeslots 	= getTimeslots(start_time,end_time);
	var startTime 	= getTimeinMins(start_time);
	for(var i=0; i <=timeslots; i++){
			timeslotUI += '<div class="_2ncP2___styles-Spot__cls1"><button data-container="time-button" tabindex="0" data-start-time="'+startTime+'" class="L7WF9___styles-TimeButton__cls1 _2vImR___styles-SpotButton__cls1 _1Qg-r___BareButton__cls1 _2zIir___index-UnstyledButton__cls1" type="button"><div class="SNauV___time_button-Wrapper__cls1 _1VKKS___time_button-Wrapper__timeNotation-12h"><div class="stlMU___time_button-Time__cls1">'+startTime+'</div></div></button><button tabindex="-1" data-container="confirm-button" class="_1Xg-U___styles-ConfirmButton__cls1 _2vImR___styles-SpotButton__cls1 _1Qg-r___BareButton__cls1 _2zIir___index-UnstyledButton__cls1" type="button">Confirm</button></div>';
			if(start_time <= end_time){
				start_time = start_time + 60;
				startTime 	= getTimeinMins(start_time);
			}else{
				break;
			}
	}
	var timeGrid = '<div class="spotpicker-times"><h2 class="spotpicker-times-title">Select a Time</h2><div class="spotpicker-times-subtitle">'+day+'</div><div class="spotpicker-times-duration">Duration: 30 min</div><div class="spotpicker-items-list"><div class="spot-list">'+timeslotUI+'</div></div></div>';

	$('.selectTime').html(timeGrid);
	$('.L7WF9___styles-TimeButton__cls1').on('click',function(){
		window.time = $(this).attr('data-start-time');
		console.log('time',time)
		showbookingform();
	});
}