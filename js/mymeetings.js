
if(localStorage.getItem('userInfo') != null){
var userInfo = JSON.parse(localStorage.getItem('userInfo'));
}else{
	localStorage.clear();
	window.location = baseURL+'getstarted';
}
var meetings = {};
var upcomingMeetings = [];
var pastMeetings = [];
var offset = new Date().getTimezoneOffset();
function getMeetings(){
		$.ajax({
		url: apiLinks+'meetings?appId='+userInfo.id,
		type: 'GET',
		dataType: 'json',
		headers: {appId:userInfo.id,accessKey:'letsnamaste_8428ecd711065166a86d03e902cebdd1'},
		success: function(data) {
			if(data.data != ''){
				meetings = data.data;
				var currentTime = Math.floor(Date.now() / 1000);
				$.each(meetings,function(i,j){
					$.ajax({
						url: apiLinks+'consumers/'+j.consumer_id,
						type: 'GET',
						dataType: 'json',
						headers: {appId:userInfo.id,accessKey:'letsnamaste_8428ecd711065166a86d03e902cebdd1'},
						success: function(data) {
							var consumerData = data.data;
							console.log('currentTime',currentTime,'meeting_date',j.meeting_date);
							if(currentTime < j.meeting_date){
								var upcomingMeeting = {start_time:j.start_time + (offset * -1),
														end_time:j.end_time + (offset * -1),
														meeting_date: j.meeting_date,
														duration:j.duration,
														consumerName:consumerData.name,
														consumeremail:consumerData.email,
														consumerContactno: consumerData.phone_number,
														eventType: 'private',
														link: j.url,
														title: j.title
													}
								upcomingMeetings.push(upcomingMeeting);
							}else{
								var pastMeeting ={start_time:j.start_time,
														end_time:j.end_time,
														meeting_date: j.meeting_date,
														duration:j.duration,
														consumerName:consumerData.name,
														consumeremail:consumerData.email,
														consumerContactno: consumerData.phone_number,
														eventType: 'private',
														title: j.title
													}
								pastMeetings.push(pastMeeting);
							}
						},
						error: function(data){
							console.log('error',data);
						}
					});
				});
				getUpcomingEvents();
			}
		},
		error: function(data){
			console.log('error',data);
		}
	});
}

function getTime(time){
	var min = time%60;
	var hr 		= parseInt(time/60);
	if(hr > 12){
		hr = hr-12;
		ap = 'p.m.';
	}else{
		ap = 'a.m.';
	}
	var meetingTime = hr+':'+min+' '+ap;
	return meetingTime;
}

function getUpcomingEvents(){
	console.log('getUpcomingEvents',upcomingMeetings == '');
	var upcomingUI = '';

	setTimeout(function(){
		if(upcomingMeetings == ''){
			upcomingUI = '<div data-component="empty-state" class="_1cnet___empty_state-Container__cls1"><img src="https://calendly.com/packs/media/images/scheduled_events/empty_state/no-events-2ed89b6c6379caebda4e779dd1db762c.svg" width="120" height="120" alt=""/><div class="hNSDX___empty_state-Title__cls1">No Upcoming Events</div></div>';
			$('.meetings-container').html(upcomingUI);
		}else{
			$.each(upcomingMeetings,function(i,j){
				var startTime = getTime(j.start_time);
				var endTime   = getTime(j.end_time);
				var meetingDate = new Date(j.meeting_date*1000);
				var meetingDate = moment(meetingDate).format('Do MMMM YYYY');
				var description = '';
				if(j.hasOwnProperty('description') !=  false){
					description = '<label class="KAR6l___entry-EntryLabel__cls1">Description</label><div class="mbm _3cQHZ___questions-Item__cls1"><div>'+j.description+'</div></div>';
				}
				upcomingUI += '<div aria-expanded="true" data-component="event-list-item" class="_25_1W___item-Container__cls1"><div class="KdzeU___index-Container__cls1 _3akPd___index-Container__isTabletUp"><div class="Grr8w___index-SecondaryInfo__cls1 svKvo___index-SecondaryInfo__isTabletUp"><span data-component="event-time" class="md55Z___event_time-Container__cls1">'+startTime+' - '+endTime+'</span><span data-component="event-time" class="md55Z___event_time-Container__cls1">'+meetingDate+'</span><span data-component="event-marker" class="_1w24D___marker-Container__cls1" style="background-color: rgb(238, 83, 83);"></span></div><div class="_1hKm7___index-PrimaryInfo__cls1 xPFE____index-PrimaryInfo__isTabletUp"><div data-component="event-name" class="_1kp4t___index-Container__cls1"><div><strong>'+j.consumerName+'</strong><span class="_2qDx3___elements-PublisherLabelContainer__cls1"> with you</span></div><div>Event Title<strong> '+j.title+'</strong></div></div></div></div><div class="E-HVd___expandable-Container__cls1 _2ecIx___expandable-Container__isTabletUp"><div class="q-ZUn___expandable-SecondaryInfo__cls1 hp_o7___expandable-SecondaryInfo__isTabletUp"></div><div data-component="buffers"></div></div><div class="_3jFOF___expandable-PrimaryInfo__cls1 _3H_qx___expandable-PrimaryInfo__isTabletUp"><div data-component="invitee-email" class="emOPE___entry-EntryContainer__cls1"><label class="KAR6l___entry-EntryLabel__cls1">Email</label><span class="_3AGxN___invitee_email-ToggleIcon__cls1 icon-edit u_Fd-___Icon__cls1 _1nLYz___Icon__cls1"></span><div>'+j.consumeremail+'</div></div><div data-component="location" class="emOPE___entry-EntryContainer__cls1"><label class="KAR6l___entry-EntryLabel__cls1"> Contact Number </label><div><div>'+j.consumerContactno+'</div></div></div><div data-component="location" class="emOPE___entry-EntryContainer__cls1"><label class="KAR6l___entry-EntryLabel__cls1">Meeting URL:</label><div><div><a href="'+j.link+'">'+j.link+'</a></div></div></div><div data-component="entry" class="emOPE___entry-EntryContainer__cls1"><label class="KAR6l___entry-EntryLabel__cls1">Invitee time zone</label><div>India Standard Time</div></div><div data-component="entry" class="emOPE___entry-EntryContainer__cls1">'+description+'</div></div></div></div>';
			});
			$('.meetings-container').html(upcomingUI);
		}
	},1000);

}

function getPastEvents(){
	var pastUI = '';
		if(pastMeetings == ''){
			upcomingUI = '<div data-component="empty-state" class="_1cnet___empty_state-Container__cls1"><img src="https://calendly.com/packs/media/images/scheduled_events/empty_state/no-events-2ed89b6c6379caebda4e779dd1db762c.svg" width="120" height="120" alt=""/><div class="hNSDX___empty_state-Title__cls1">No Previous Events</div></div>';
			$('.meetings-container').html(upcomingUI);
		}else{
			setTimeout(function(){
				$.each(pastMeetings,function(i,j){
				var startTime = getTime(j.start_time);
				var endTime   = getTime(j.end_time);
				var meetingDate = new Date(j.meeting_date*1000);
				var meetingDate = moment(meetingDate).format('Do MMMM YYYY');
				pastUI += '<div aria-expanded="true" data-component="event-list-item" class="_25_1W___item-Container__cls1"><div class="KdzeU___index-Container__cls1 _3akPd___index-Container__isTabletUp"><div class="Grr8w___index-SecondaryInfo__cls1 svKvo___index-SecondaryInfo__isTabletUp"><span data-component="event-time" class="md55Z___event_time-Container__cls1">'+startTime+' - '+endTime+'</span><span data-component="event-time" class="md55Z___event_time-Container__cls1">'+meetingDate+'</span><span data-component="event-marker" class="_1w24D___marker-Container__cls1" style="background-color: rgb(238, 83, 83);"></span></div><div class="_1hKm7___index-PrimaryInfo__cls1 xPFE____index-PrimaryInfo__isTabletUp"><div data-component="event-name" class="_1kp4t___index-Container__cls1"><div><strong>'+j.consumerName+'</strong><span class="_2qDx3___elements-PublisherLabelContainer__cls1"> with you</span></div><div>Event Title<strong> '+j.title+'</strong></div></div></div></div><div class="E-HVd___expandable-Container__cls1 _2ecIx___expandable-Container__isTabletUp"><div class="q-ZUn___expandable-SecondaryInfo__cls1 hp_o7___expandable-SecondaryInfo__isTabletUp"></div><div data-component="buffers"></div></div><div class="_3jFOF___expandable-PrimaryInfo__cls1 _3H_qx___expandable-PrimaryInfo__isTabletUp"><div data-component="invitee-email" class="emOPE___entry-EntryContainer__cls1"><label class="KAR6l___entry-EntryLabel__cls1">Email</label><span class="_3AGxN___invitee_email-ToggleIcon__cls1 icon-edit u_Fd-___Icon__cls1 _1nLYz___Icon__cls1"></span><div>'+j.consumeremail+'</div></div><div data-component="location" class="emOPE___entry-EntryContainer__cls1"><label class="KAR6l___entry-EntryLabel__cls1"> Contact Number </label><div><div>'+j.consumerContactno+'</div></div></div><div data-component="entry" class="emOPE___entry-EntryContainer__cls1"><label class="KAR6l___entry-EntryLabel__cls1">Invitee time zone</label><div>India Standard Time</div></div><div data-component="entry" class="emOPE___entry-EntryContainer__cls1"></div></div></div></div></div>';
				});
					$('.meetings-container').html(pastUI);
			},500);
		}
}