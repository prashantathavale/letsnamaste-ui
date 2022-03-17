if(localStorage.getItem('userInfo') != null){
var userInfo = JSON.parse(localStorage.getItem('userInfo'));
window.userInfo = JSON.parse(localStorage.getItem('userInfo'));
window.userAccountInfo = JSON.parse(localStorage.getItem('userAccountInfo'));
window.eventIntervals = [];
window.deleteIntervals = [];
}else{
	localStorage.clear();
	window.location = baseURL+'getstarted';
}
var weedDays = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
var url = window.location.href;
var eventId = getURLParameter('eventId',window.location.href);
var eventIntervalsList = '';
var intervalsList = [];

function updateSymbol(e){
  var selected = $(".currency-selector option:selected");
  $(".currency-symbol").text(selected.data("symbol"))
  $(".currency-amount").prop("placeholder", selected.data("placeholder"))
  $('.currency-addon-fixed').text(selected.text())
}


var editFlag = 0;
if(url.indexOf('eventId') > -1){
	window.eventData = JSON.parse(localStorage.getItem('eventData'));
	geteventIntervalsList();
	editFlag = 1;
}

function createEvent(createEventparams){
	$.ajax({
		url: apiLinks+'events',
		type: 'POST',
		data: createEventparams,
		dataType: 'json',
		headers: {appId:userInfo.id,accessKey:'letsnamaste_8428ecd711065166a86d03e902cebdd1'},
		success: function(data) {
			console.log('createEvent data',data);
			$(".create_button").notify("Event created successfully","success",{ position:"top center"});
			for(var key in intervalsList){
 				intervalsList[key].event_id = data.data.event_id;
			}
			editEventInterval(intervalsList);
		},
		error: function(data){
			console.log('error',data);
		}
	});
}


function showDefaultavailability(){
		var eventsData = {};
		var availableDays = 'Monday,Tuesday,Wednesday,Thursday,Friday'.split(',');
		var defaultStartTime = 540;
		var defaultEndTime = 1080;
		if(userAccountInfo.hasOwnProperty('default_available_days')){
			availableDays = userAccountInfo.default_available_days.split(',');
		}
		if(userAccountInfo.hasOwnProperty('default_available_start_time')){
			defaultStartTime = userAccountInfo.default_available_start_time;
		}
		if(userAccountInfo.hasOwnProperty('default_available_end_time')){
			defaultEndTime = userAccountInfo.default_available_end_time;
		}
		for(var i=0; i<=weedDays.length; i++){
			if(availableDays.indexOf(weedDays[i]) > -1){
				intervalsList[weedDays[i]] = {interval_type:'applicableday',start_date:0,end_date:0,start_time:defaultStartTime,end_time:defaultEndTime,day_of_weeks:weedDays[i],default:1};
				$('.range[data-value="'+weedDays[i]+'"] span').html(getTimeinMins(defaultStartTime)+' - '+getTimeinMins(defaultEndTime));
				$('input[value="'+weedDays[i]+'"]').prop('checked',true);
			}
		}
		addAllEvents();
}


function createEventInterval(createEventparams){
	for(var key in createEventparams) {
		$.ajax({
			url: apiLinks+'eventIntervals',
			type: 'POST',
			data: createEventparams[key],
			dataType: 'json',
			headers: {appId:userInfo.id,accessKey:'letsnamaste_8428ecd711065166a86d03e902cebdd1'},
			success: function(data) {
				console.log('createEventInterval',data);
				if(createEventparams.hasOwnProperty('default') && createEventparams.default == 1){
					var eventInterval = data.data;
					$('.range[data-value="'+eventInterval.day_of_weeks+'"]').attr('data-interval',eventInterval.interval_id);
				}else{
					localStorage.removeItem('eventData');
					window.location = baseURL+'myevents';
				}
			},
			error: function(data){
				console.log('createEventInterval error312313',data);
			}
		});
	}

}

function showEditavailability(evenInterval,eventDate,existingEvent){
	var forDate = eventAt = '';
	var isUnavailable = 0;
	console.log('eventDate',eventDate);
	var unavailable = '';
	if(existingEvent == 1){
		clickedDate = new Date(eventDate.start);
		unavailable = '<div class="option-buttons"><button class="button unavailable-button option-button">I am unavailable</button></div>';
	}else{
		clickedDate = new Date(eventDate);
	}
	if(typeof evenInterval == 'undefined'){
		evenInterval = intervalsList[moment(clickedDate).format('YYYY_MM_DD')];
	}
	if(evenInterval != undefined && evenInterval.hasOwnProperty('start_time') && evenInterval.hasOwnProperty('end_time')){
		var interval_startTime 	= getTimeinMins(evenInterval.start_time);
		var interval_endTime 	= getTimeinMins(evenInterval.end_time);
	}
		eventAt = moment(clickedDate).format('Do MMMM');
		forDate = '<button class="button js-apply-button forDate"> Apply to '+eventAt+' only </button>';
		var forAllday 	= '<button class="button js-apply-button forAllday"> Apply to all '+evenInterval.day_of_weeks+'s </button>';
	var clickedDay 	= evenInterval.day_of_weeks;
	var editForm = '<div class="popup-overlay"><div class="close-overlay js-close"></div><div class="edit-day interval-popup popup"><div class="popup-content three-buttons"><div class="center centered mbm"><h3 class="popup-title">Edit Availability</h3></div><div class="js-intervals-region"><div><div class="mbs range-list"><div class="head js-header"><div class="label">From</div><div class="label">To</div></div><div class="js-intervals-container"><div class="range-item"><input class="js-time-input start_time" type="text" name="from" placeholder="hh:mm am"><div class="dash"></div><input class="js-time-input end_time" type="text" name="to" placeholder="hh:mm am"><div class="error-message error-message-time js-error-message"></div></div></div></div></div></div>'+unavailable+'<div class="js-copy-region"></div></div><div class="popup-buttons-container"><div class="column popup-buttons">'+forDate+forAllday+'<div class="ptm row"><div class="col1of3 text-right"><span class="h4 js-close muted no-color-change pointer">Cancel</span></div></div></div></div></div></div>';
		$('#popup-region').html(editForm);
		$('.unavailable-button').on('click',function(){
			$('.unavailable-button').prop('disabled',true);
			$('.range-list').replaceWith('<div class="muted mtm"><div class="unavailable-box"><span>Unavailable</span></div></div>');
			$('.unavailable-button').css({'background-color':'#F6F6F6'});
			isUnavailable = 1;
		});
		$('.forAllday').on('click',function(){
			if(isUnavailable == 1){
				if(intervalsList.hasOwnProperty(clickedDay) != false){
					if(intervalsList[clickedDay].hasOwnProperty('interval_id')){
						deleteIntervals.push(intervalsList[clickedDay]);
					}
					removeEvents(clickedDay);
					$('.js-close').click();
				}
			}else{
				if(getTime($('.start_time').val()) == false || getTime($('.end_time').val()) == false){
					$('.error-message-time').text('Insert valid time.');
				}else{
					console.log('forAllday',intervalsList);
					intervalsList[clickedDay] 				= evenInterval;
					intervalsList[clickedDay].start_time 	= getTime($('.start_time').val());
					intervalsList[clickedDay].end_time 		= getTime($('.end_time').val());
					addEvents({applicableday:intervalsList[clickedDay]});
					$('.js-close').click();
				}
			}
		});
		$('.forDate').on('click',function(){
			if((isUnavailable == 0) && (getTime($('.start_time').val()) == false || getTime($('.end_time').val()) == false)){
				$('.error-message-time').text('Insert valid time.');
			}else{
				if(calendar.getEventById('applicableday_'+moment(clickedDate).format('DD_MM')) != null){
					calendar.getEventById('applicableday_'+moment(clickedDate).format('DD_MM')).remove();
				}
				if(isUnavailable == 1){
					console.log('inside');
					if(intervalsList.hasOwnProperty(moment(clickedDate).format('YYYY_MM_DD')) != false){
						if(intervalsList[moment(clickedDate).format('YYYY_MM_DD')].hasOwnProperty('interval_id')){
							deleteIntervals.push(intervalsList[moment(clickedDate).format('YYYY_MM_DD')]);
						}
						calendar.getEventById('applicableday_'+moment(clickedDate).format('DD_MM')).remove();
					}else{
						if(intervalsList.hasOwnProperty(clickedDay) != false && intervalsList[clickedDay].hasOwnProperty('interval_id')){
							intervalsList[moment(clickedDate).format('YYYY_MM_DD')] 				= evenInterval;
							intervalsList[moment(clickedDate).format('YYYY_MM_DD')].interval_type 	= 'applicabledate';
							intervalsList[moment(clickedDate).format('YYYY_MM_DD')].start_date 		= moment(clickedDate).unix();
							intervalsList[moment(clickedDate).format('YYYY_MM_DD')].end_date 		= moment(clickedDate).unix();
							intervalsList[moment(clickedDate).format('YYYY_MM_DD')].start_time 		= 0;
							intervalsList[moment(clickedDate).format('YYYY_MM_DD')].end_time 		= 0;
							delete intervalsList[moment(clickedDate).format('YYYY_MM_DD')].interval_id;
							calendar.getEventById('applicableday_'+moment(clickedDate).format('DD_MM')).remove();
						}
					}
					$('.js-close').click();
				}else{
					intervalsList[moment(clickedDate).format('YYYY_MM_DD')] 				= evenInterval;
					intervalsList[moment(clickedDate).format('YYYY_MM_DD')].interval_type 	= 'applicabledate';
					intervalsList[moment(clickedDate).format('YYYY_MM_DD')].start_date 		= moment(clickedDate).unix();
					intervalsList[moment(clickedDate).format('YYYY_MM_DD')].end_date 		= moment(clickedDate).unix();
					intervalsList[moment(clickedDate).format('YYYY_MM_DD')].start_time 		= getTime($('.start_time').val());
					intervalsList[moment(clickedDate).format('YYYY_MM_DD')].end_time 		= getTime($('.end_time').val());

					calendar.addEvent({id: 'applicableday_'+moment(clickedDate).format('DD_MM'),
										start: moment(clickedDate).format('YYYY-MM-DD')+'T'+getEventTimeinMins(getTime($('.start_time').val())),
										end:moment(clickedDate).format('YYYY-MM-DD')+'T'+getEventTimeinMins(getTime($('.end_time').val())),
										allDay: false,
										displayEventTime:true
											});

					$('.js-close').click();
				}
			}
		});
		$('.js-close').on('click',function(){
			$('.popup-overlay').remove();
		});
}

function editcurrentDay(dayStartTime,dayEndTime,day){
	intervalsList[day].start_time = dayStartTime;
	intervalsList[day].end_time = dayEndTime;
	$('.range[data-value="'+day+'"] span').html(getTimeinMins(dayStartTime)+' - '+getTimeinMins(dayEndTime));
}

function editallDays(dayStartTime,dayEndTime){
	for(var key in intervalsList) {
		intervalsList[key].start_time = dayStartTime;
		intervalsList[key].end_time = dayEndTime;
		$('.range[data-value="'+key+'"] span').html(getTimeinMins(dayStartTime)+' - '+getTimeinMins(dayEndTime));
	}
}

function geteventIntervalsList(){
	$.ajax({
		url: apiLinks+'eventIntervals/getEventIntervalsByEventId',
		type: 'POST',
		data: {event_id:eventData.event_id},
		dataType: 'json',
		headers: {appId:userInfo.id,accessKey:'letsnamaste_8428ecd711065166a86d03e902cebdd1'},
		success: function(data) {
			console.log('eventIntervalsList data',data.data,data.data == '');
			var eventIndex = [];
			var eventsData = {};
			if(data.data == ''){
				var availableDays = 'Monday,Tuesday,Wednesday,Thursday,Friday'.split(',');
				var defaultStartTime = 540;
				var defaultEndTime = 1080;
				if(userAccountInfo.hasOwnProperty('default_available_days')){
					availableDays = userAccountInfo.default_available_days.split(',');
				}
				if(userAccountInfo.hasOwnProperty('default_available_start_time')){
					defaultStartTime = userAccountInfo.default_available_start_time;
				}
				if(userAccountInfo.hasOwnProperty('default_available_end_time')){
					defaultEndTime = userAccountInfo.default_available_end_time;
				}
				for(var i=0; i<=weedDays.length; i++){
					if(availableDays.indexOf(weedDays[i]) > -1){
						intervalsList[weedDays[i]] = {event_id:eventData.event_id,interval_type:'applicableday',start_date:0,end_date:0,start_time:defaultStartTime,end_time:defaultEndTime,day_of_weeks:weedDays[i],default:1};
						eventIndex.push(i);
						$('.range[data-value="'+weedDays[i]+'"] span').html(getTimeinMins(defaultStartTime)+' - '+getTimeinMins(defaultEndTime));
						$('input[value="'+weedDays[i]+'"]').prop('checked',true);
					}
				}
				eventsData = {applicableday:eventIndex};
			}else{
				eventIntervalsList = data.data;
				$.each(eventIntervalsList,function(i,j){
					if(j.interval_type == 'applicableday'){
					intervalsList[j.day_of_weeks] = {interval_id:j.interval_id,event_id:eventData.event_id,interval_type:'applicableday',start_date:0,end_date:0,start_time:j.start_time,end_time:j.end_time,day_of_weeks:j.day_of_weeks};
						eventIndex.push(Object.keys(weedDays).find(key => weedDays[key] === j.day_of_weeks));
						$('.range[data-value="'+j.day_of_weeks+'"] span').html(getTimeinMins(j.start_time)+' - '+getTimeinMins(j.end_time));
						$('.range[data-value="'+j.day_of_weeks+'"]').attr('data-interval',j.interval_id);
						$('input[value="'+j.day_of_weeks+'"]').prop('checked',true);
						$('input[value="'+j.day_of_weeks+'"]').attr('data-interval',j.interval_id);
					}
					if(j.interval_type == 'applicabledate'){
						intervalsList[moment(j.start_date * 1000).format('YYYY_MM_DD')] = {interval_id:j.interval_id,event_id:eventData.event_id,interval_type:'applicabledate',start_date:j.start_date,end_date:j.end_date,start_time:j.start_time,end_time:j.end_time,day_of_weeks:j.day_of_weeks};
							console.log('j.start_time',j.start_time,j.start_time == 'undefined',j.start_time == undefined);
							if(j.start_time != j.end_time && (j.start_time != 0 && j.end_time != 0)){
								calendar.addEvent({id: 'applicableday_'+moment(j.start_date * 1000).format('DD_MM'),
												start: moment(j.start_date * 1000).format('YYYY-MM-DD')+'T'+getEventTimeinMins(j.start_time),
												end:moment(j.start_date * 1000).format('YYYY-MM-DD')+'T'+getEventTimeinMins(j.end_time),
												allDay: false,
												displayEventTime:true
											});
							}
					}
				});
				eventsData = {applicableday:eventIndex};
			}
			addAllEvents();

		},
		error: function(data){
			console.log('error',data);
		}
	});
}

function removeEvents(params){
		var date = new Date();
		var today = date.getTime();
		if(params == weedDays[date.getDay()]){
			calendar.getEventById('applicableday_'+moment(date).format('DD_MM')).remove();
		}
		for(var i=0;i<120;i++){
			var nextday = new Date(today+86400000);
			today = nextday.getTime();
			if(params == weedDays[nextday.getDay()]){
				calendar.getEventById('applicableday_'+moment(nextday).format('DD_MM')).remove();
			}
		}
}

function addEvents(params){
	if(params.hasOwnProperty('applicableday') != false){
		var date = new Date();
		var today = date.getTime();
		var applicableday = params.applicableday.day_of_weeks;
		if(applicableday == weedDays[date.getDay()]){
			calendar.addEvent({groupIdid: 'applicableday_'+moment(date).format('DD_MM'),
				start: moment(date).format('YYYY-MM-DD')+'T'+getEventTimeinMins(intervalsList[weedDays[date.getDay()]].start_time),
				end:moment(date).format('YYYY-MM-DD')+'T'+getEventTimeinMins(intervalsList[weedDays[date.getDay()]].end_time),
				allDay: false,
				displayEventTime:true
			});
		}
		for(var i=0;i<120;i++){
			var nextday = new Date(today+86400000);
			today = nextday.getTime();
			if(applicableday == weedDays[nextday.getDay()]){
				if(calendar.getEventById('applicableday_'+moment(nextday).format('DD_MM')) != null){
					calendar.getEventById('applicableday_'+moment(nextday).format('DD_MM')).remove();
				}
				calendar.addEvent({id: 'applicableday_'+moment(nextday).format('DD_MM'),
					start: moment(nextday).format('YYYY-MM-DD')+'T'+getEventTimeinMins(intervalsList[weedDays[nextday.getDay()]].start_time),
					end:moment(nextday).format('YYYY-MM-DD')+'T'+getEventTimeinMins(intervalsList[weedDays[nextday.getDay()]].end_time),allDay: false,
					displayEventTime:true
				});
			}
		}
	}
	calendar.render();
}


function addAllEvents(){
	console.log('addEvents',intervalsList);
	var availableDays = Object.keys(intervalsList);
	console.log('availableDays',availableDays);
	var eventIndex = [];
		var date = new Date();
		var today = date.getTime();
		if(availableDays.indexOf(weedDays[date.getDay()]) > -1 && intervalsList[weedDays[date.getDay()]].hasOwnProperty('start_time') && intervalsList[weedDays[date.getDay()]].hasOwnProperty('end_time')){
			calendar.addEvent({id: 'applicableday_'+moment(date).format('DD_MM'),
				start: moment(date).format('YYYY-MM-DD')+'T'+getEventTimeinMins(intervalsList[weedDays[date.getDay()]].start_time),
				end:moment(date).format('YYYY-MM-DD')+'T'+getEventTimeinMins(intervalsList[weedDays[date.getDay()]].end_time),
				allDay: false,
				displayEventTime:true
			});
		}
		for(var i=0;i<120;i++){
			var nextday = new Date(today+86400000);
			today = nextday.getTime();
			if(availableDays.indexOf(weedDays[nextday.getDay()]) > -1 && availableDays.indexOf(moment(nextday).format('YYYY_MM_DD')) == -1 ){
				calendar.addEvent({id: 'applicableday_'+moment(nextday).format('DD_MM'),
					start: moment(nextday).format('YYYY-MM-DD')+'T'+getEventTimeinMins(intervalsList[weedDays[nextday.getDay()]].start_time),
					end:moment(nextday).format('YYYY-MM-DD')+'T'+getEventTimeinMins(intervalsList[weedDays[nextday.getDay()]].end_time),
					allDay: false,
					displayEventTime:true
				});
			}
			if(availableDays.indexOf(moment(nextday).format('YYYY_MM_DD')) > -1 && intervalsList[moment(nextday).format('YYYY_MM_DD')].start_time == undefined && intervalsList[moment(nextday).format('YYYY_MM_DD')].end_time == undefined){
				//calendar.getEventById('applicableday_'+moment(nextday).format('DD_MM')).remove();
			}
		}
		calendar.render();
}

function editEvent(createEventparams){
	$.ajax({
		url: apiLinks+'events/'+eventId,
		type: 'PUT',
		data: createEventparams,
		dataType: 'json',
		headers: {appId:userInfo.id,accessKey:'letsnamaste_8428ecd711065166a86d03e902cebdd1'},
		success: function(data) {
			$(".create_button").notify("Event Updated successfully","success",{ position:"top center"});
			editEventInterval(intervalsList);
		},
		error: function(data){
			console.log('error',data);
		}
	});
}

function editEventInterval(createEventparams){
	if(isEmpty(deleteIntervals) == false){
		for(var key in deleteIntervals){
			$.ajax({
				url: apiLinks+'eventIntervals/'+deleteIntervals[key].interval_id,
				type: 'DELETE',
				data: createEventparams[key],
				dataType: 'json',
				headers: {appId:userInfo.id,accessKey:'letsnamaste_8428ecd711065166a86d03e902cebdd1'},
				success: function(data) {
					console.log('deleteIntervals data',data);
				},
				error: function(data){
					console.log('deleteIntervals error',data);
				}
			});
		}
	}
	for(var key in createEventparams){
		if(createEventparams[key].hasOwnProperty('interval_id')){
			console.log('here edit');
			$.ajax({
				url: apiLinks+'eventIntervals/'+createEventparams[key].interval_id,
				type: 'PUT',
				data: createEventparams[key],
				dataType: 'json',
				headers: {appId:userInfo.id,accessKey:'letsnamaste_8428ecd711065166a86d03e902cebdd1'},
				success: function(data) {
					console.log('editEventInterval data',data)
				},
				error: function(data){
					console.log('editEventInterval error',data);
				}
			});
		}else{
			if(createEventparams[key].hasOwnProperty('event_id') == false){
				createEventparams[key].event_id = eventData.event_id;
			}
			console.log('here create');
			$.ajax({
				url: apiLinks+'eventIntervals',
				type: 'POST',
				data: createEventparams[key],
				dataType: 'json',
				headers: {appId:userInfo.id,accessKey:'letsnamaste_8428ecd711065166a86d03e902cebdd1'},
				success: function(data) {
					console.log('createEventInterval',data);
						var eventInterval = data.data;
						$('.range[data-value="'+eventInterval.day_of_weeks+'"]').attr('data-interval',eventInterval.interval_id);
				},
				error: function(data){
					console.log('createEventInterval error',data);
				}
			});
		}
	}
	setTimeout(function(){
		localStorage.removeItem('eventData');
		window.location = baseURL+'myevents';
	},4000);
}

function getTime(meetingTime){
	if(meetingTime.indexOf(':') == -1){
		return false;
	}
	var meetingTime = meetingTime.split(':');
	if(meetingTime[1].indexOf('PM') > -1){
		if(meetingTime[0] == 12){
			meetingTime[0] = 12*60;
		}else{
			meetingTime[0] = (12+parseInt(meetingTime[0]))*60;
		}
	}else{
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