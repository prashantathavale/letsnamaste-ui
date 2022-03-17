if(localStorage.getItem('userInfo') != null){
var userInfo = JSON.parse(localStorage.getItem('userInfo'));
	if(localStorage.getItem('userAccountInfo') == null){
		userAccountInfo = {};
		getuserAccountInfo();
	}else{
		userAccountInfo = JSON.parse(localStorage.getItem('userAccountInfo'));
	}
}else{
	localStorage.clear();
	window.location = baseURL+'getstarted';
}

function showUserControl(){
	console.log('yrtyytyutrur',$('._2YyP1___user_menu-Menu__cls1').length,$('._2YyP1___user_menu-Menu__cls1').length == 0);
	if($('._2YyP1___user_menu-Menu__cls1').length == 0){
		$('.user_menu_Container').append('<div data-component="user-menu" class="_2YyP1___user_menu-Menu__cls1 _274nX___user_menu-Menu__isTabletUp _2lESb___Menu__cls1"><div class="_2JWjJ___Group__cls1"><a class="_1CV0a___Item__cls1 _3Oyvh___item-Container__cls1 _1Qg-r___BareButton__cls1 _2zIir___index-UnstyledButton__cls1" href="/account/settings/profile"><div class="_2m3B6___item-TextContainer__cls1"><span class="icon-person-fill u_Fd-___Icon__cls1 _1nLYz___Icon__cls1"></span>Account Settings</div></a><a class="_1CV0a___Item__cls1 _3Oyvh___item-Container__cls1 _1Qg-r___BareButton__cls1 _2zIir___index-UnstyledButton__cls1" href="/billing"><div class="_2m3B6___item-TextContainer__cls1"><span class="icon-credit-card u_Fd-___Icon__cls1 _1nLYz___Icon__cls1"></span>Billing</div></a><a class="_1CV0a___Item__cls1 _3Oyvh___item-Container__cls1 _1Qg-r___BareButton__cls1 _2zIir___index-UnstyledButton__cls1" href="/app/calendar_connections"><div class="_2m3B6___item-TextContainer__cls1"><span class="icon-calendar-fill u_Fd-___Icon__cls1 _1nLYz___Icon__cls1"></span>Calendar Connections</div></a><a class="_1CV0a___Item__cls1 _3Oyvh___item-Container__cls1 _1Qg-r___BareButton__cls1 _2zIir___index-UnstyledButton__cls1" href="/app/organization/users"><div class="_2m3B6___item-TextContainer__cls1"><span class="icon-people-fill u_Fd-___Icon__cls1 _1nLYz___Icon__cls1"></span>Users</div></a><button class="_1CV0a___Item__cls1 _3Oyvh___item-Container__cls1 _1Qg-r___BareButton__cls1 _2zIir___index-UnstyledButton__cls1" type="button"><div class="_2m3B6___item-TextContainer__cls1"><span class="icon-link-bold u_Fd-___Icon__cls1 _1nLYz___Icon__cls1"></span>Share Your Link</div></button><a class="_1CV0a___Item__cls1 _3Oyvh___item-Container__cls1 _1Qg-r___BareButton__cls1 _2zIir___index-UnstyledButton__cls1" href="/apps"><div class="_2m3B6___item-TextContainer__cls1"><span class="icon-apps u_Fd-___Icon__cls1 _1nLYz___Icon__cls1"></span>Apps</div></a></div><div class="_2JWjJ___Group__cls1"><a data-method="delete" class="_1CV0a___Item__cls1 _3Oyvh___item-Container__cls1 _1Qg-r___BareButton__cls1 _2zIir___index-UnstyledButton__cls1" href="/users/sessions"><div class="_2m3B6___item-TextContainer__cls1"><span class="icon-exit-door u_Fd-___Icon__cls1 _1nLYz___Icon__cls1"></span>Logout</div></a></div></div>');
	}
}
function createEventsList(){
	console.log(userInfo);
	$.ajax({
		url: apiLinks+'events?appId='+userInfo.id,
		type: 'GET',
		headers: {appId:userInfo.id,accessKey:'letsnamaste_8428ecd711065166a86d03e902cebdd1'},
		dataType: 'json',
		success: function(data) {
			console.log('data',data,data == '',data == null, data == 'null')
			if(data != 'null'){
				var evetsList = data.data;
				var events = '';
				$.each(evetsList,function(i,j){
					events += '<div class="grid-3-cell"><div class="event-type-card _3qII8___index-Container__cls1"><div data-id="event-type-card-cap" class="_28u4X___Cap__cls1" style="background-color: rgb(137, 137, 252);"></div><label class="event-type-card-control-container is-left" cui-tooltip="make changes in bulk"><div class="_2euq5___selection-Checkbox__cls1 _1aDbB___CheckboxInput__cls1 _2Vn_e___styles-Container__cls1"><input name="selection" type="checkbox" class="_ZaPM___styles-Input__cls1" value=""><div class="_1OAEh___styles-Body__cls1"><svg viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg" class="_17YbC___styles-Svg__cls1"><path d="M2 0h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm6.156 3.5L4.975 6.683.561 5.267 2.5 6.328 4.621 8.45l.354.354L9.217 4.56 8.156 3.5z" fill="currentColor" fill-rule="evenodd"></path></svg></div></div></label><button data-id="event-type-card-body" data-event-id="'+j.event_id+'" class="event-box js-drag-zone _1Ve-v___index-Body__cls1 _1Qg-r___BareButton__cls1 _2zIir___index-UnstyledButton__cls1 ui-sortable-handle" type="button"><h2 class="a6wbk___name-Title__cls1">'+j.title+'</h2><div class="_2i2He___duration-Container__cls1">'+j.duration_in_minute+' mins, Private One on One</div><div data-component="event-type-card-members" class="_3wvUy___index-EventTypeMemberships__cls1 _2y77p___memberships-Container__cls1"></div></button><div class="event-type-card-foot mWR6l___index-Container__cls1"><div class="event-type-card-foot-col1 _1XARo___index-Column1__cls1"><a title="selectbookingdate?event='+j.title+'&eventId='+j.event_id+'&appId='+userInfo.id+'" target="_blank" rel="noopener noreferrer" class="_3w3vl___Link__cls1 Y6Jkn___styles-Container__cls1 _1Qg-r___BareButton__cls1 _2zIir___index-UnstyledButton__cls1 event_link" href="selectbookingdate?event='+j.title+'&eventId='+j.event_id+'&appId='+userInfo.id+'">/'+j.title+'</a></div><div class="_1JtW1___index-Column2__cls1"><div class="_14RC-___group-Container__cls1"><div class="_2QT18___ButtonGroup__cls1"><button class="_1flJn___button-CopyButton__cls1 MOKW6___Button__cls1 Vhorz___styles-Container__cls1 _2ZYno___styles-Container__size-small R5pXI___styles-Container__decoration-outline MfRDm___styles-Container__wide _1Qg-r___BareButton__cls1 _2zIir___index-UnstyledButton__cls1" data-link="'+baseURL+'selectbookingdate?eventId='+j.event_id+'&appId='+userInfo.id+'" type="button"><div class="OPKSe___styles-TextContainer__cls1"><span class="_3MeR0___button-InitialState__cls1">Copy Link</span></div></button></div></div></div></div></div></div>'
				});
				$('.event-type-card-list').append(events);
				$('.event-box').on('click',function(e){
					$(this).attr('data-event-id');
					console.log('gfyfhnmbv',$(this).attr('data-event-id'));
					getEventDetails($(this).attr('data-event-id'));
				});
			}

			$('._1flJn___button-CopyButton__cls1').click(function (e) {
			   e.preventDefault();
			   var copyText = $(this).attr('data-link');

			   document.addEventListener('copy', function(e) {
			      e.clipboardData.setData('text/plain', copyText);
			      e.preventDefault();
			   }, true);

			   document.execCommand('copy');
			   console.log('copied text : ', copyText);
			 });

		},
		error: function(data){
			console.log('error createEventsList',data);
		}
	});

}

function getEventDetails(eventId){
	console.log(userInfo);
	$.ajax({
		url: apiLinks+'events/'+eventId,
		type: 'GET',
		headers: {appId:userInfo.id,accessKey:'letsnamaste_8428ecd711065166a86d03e902cebdd1'},
		dataType: 'json',
		success: function(data) {
			if(data != 'null'){
				console.log('data getEventDetails',data)
				localStorage.removeItem('eventData');
				localStorage.setItem('eventData',JSON.stringify(data.data));
				window.location =baseURL+'editevent?eventId='+eventId;
			}
		},
		error: function(data){
			console.log('error createEventsList',data);
		}
	});
}

function getuserAccountInfo(){
	$.ajax({
		url: apiLinks+'accounts/'+userInfo.id,
		type: 'GET',
		headers: {appId:userInfo.id,accessKey:'letsnamaste_8428ecd711065166a86d03e902cebdd1'},
		dataType: 'json',
		success: function(data) {
			if(data != 'null'){
				userAccountInfo = data.data;
				console.log('getuserAccountInfo userAccountInfo',userAccountInfo);
				localStorage.setItem('userAccountInfo',JSON.stringify(userAccountInfo));
		    	if(userAccountInfo.hasOwnProperty('avatar_url') != false){
		    		$('.avatar-element img').attr('src',userAccountInfo.avatar_url);
		    	}
				if(userAccountInfo.default_available_days == undefined){
					window.location.href = 'availability';
				}
			}
		},
		error: function(data){
			console.log('getuserAccountInfo',data);
		}
	});
}