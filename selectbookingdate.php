<!DOCTYPE html>
<!-- saved from url=(0014)about:internet -->
<html lang="en" style="" class=" history no-touchevents localstorage">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Lets namaste</title>
	  <script src='js/library.js'></script>
	  <link href='fullcalendar/packages/core/main.css' rel='stylesheet' />
	  <link href='fullcalendar/packages/bootstrap/main.css' rel='stylesheet' />
	  <link href='fullcalendar/packages/timegrid/main.css' rel='stylesheet' />
	  <link href='fullcalendar/packages/daygrid/main.css' rel='stylesheet' />
	  <link href='fullcalendar/packages/list/main.css' rel='stylesheet' />
	  <link href='css/selectbookingdate.css' rel='stylesheet' />
	  <script src='js/config.js'></script>
	  <script src='js/selectbookingdate.js'></script>
	  <script src='fullcalendar/packages/core/main.js'></script>
	  <script src='fullcalendar/packages/interaction/main.js'></script>
	  <script src='fullcalendar/packages/bootstrap/main.js'></script>
	  <script src='fullcalendar/packages/daygrid/main.js'></script>
	  <script src='fullcalendar/packages/timegrid/main.js'></script>
	  <script src='fullcalendar/packages/list/main.js'></script>
	  <script src='fullcalendar/examples/js/theme-chooser.js'></script>
	  <script>
		var calendar = {};
		var events = [];
	  	document.addEventListener('DOMContentLoaded', function() {
	  		var calendarEl = document.getElementById('calendar');
	  		var someDate = new Date();
	  		var numberOfDaysToAdd = 120;
	  		var endDate = new Date(someDate.setDate(someDate.getDate() + numberOfDaysToAdd));
	  			calendar = new FullCalendar.Calendar(calendarEl, {
	  			plugins: [ 'interaction', 'dayGrid', 'timeGrid' ],
	  			initialView: 'pastAndFutureView',
	  			showNonCurrentDates: false,
	  			displayEventTime: false,
	  			fixedWeekCount: false,
	  			selectable: true,
	  			events: events,
	  			validRange: {
	  				start: new Date(),
	  				end: endDate.toISOString(),
	  				display: 'inverse-background'
	  			},
	  			eventClick: function(eventClickInfo){
	  				$('a.fc-day-grid-event').removeAttr('style');
	  				$(eventClickInfo.el).attr('style', 'background-color :#0048ff4f !important');
	  				var presentDay 		= new Date();
	  				var clickedDay 		= new Date(eventClickInfo.event.start);
	  				var weekDay    		= daysOfWeek[clickedDay.getDay()];
	  				var availableDays 	= Object.keys(intervalsList);
	  				var userAccountInfo = JSON.parse(localStorage.getItem('userAccountInfo'));
	  				if(isEmpty(intervalsList) == false && (availableDays.indexOf(weekDay) > -1 || availableDays.indexOf(moment(clickedDay).format('YYYY_MM_DD')) > -1)){
	  					if(presentDay.getDate() <= clickedDay.getDate()){
	  						$(".fc-state-highlight").removeClass("fc-state-highlight");
	  						if(availableDays.indexOf(weekDay) > -1 && availableDays.indexOf(moment(clickedDay).format('YYYY_MM_DD')) == -1){
	  							showTimegrid(moment(clickedDay).format('YYYY-MM-DD'),weekDay);
	  						}else{
	  							showTimegrid(moment(clickedDay).format('YYYY-MM-DD'),moment(clickedDay).format('YYYY_MM_DD'));
	  						}
	  					}else{
	  						if(presentDay.getMonth() < clickedDay.getMonth()){
	  							$(".fc-state-highlight").removeClass("fc-state-highlight");
	  							if(availableDays.indexOf(weekDay) > -1 && availableDays.indexOf(moment(clickedDay).format('YYYY_MM_DD')) == -1){
	  								showTimegrid(moment(clickedDay).format('YYYY-MM-DD'),weekDay);
	  							}else{
	  								showTimegrid(moment(clickedDay).format('YYYY-MM-DD'),moment(clickedDay).format('YYYY_MM_DD'));
	  							}
	  						}
	  						$(".fc-state-highlight").removeClass("fc-state-highlight");
	  						return;
	  					}
	  				}else{
	  					if(isEmpty(intervalsList)== true && userAccountInfo.hasOwnProperty('default_available_days') != false){
	  						var default_available_days = userAccountInfo.default_available_days;
	  						var default_available_days = default_available_days.split(',');
	  						if(default_available_days.indexOf(weekDay) > -1){
	  							if(presentDay.getDate() <= clickedDay.getDate()){
	  								$(".fc-state-highlight").removeClass("fc-state-highlight");
	  								showTimegrid(moment(clickedDay).format('YYYY-MM-DD'),weekDay);
	  							}else{
	  								if(presentDay.getMonth() < clickedDay.getMonth()){
	  									$(".fc-state-highlight").removeClass("fc-state-highlight");
	  									showTimegrid(moment(clickedDay).format('YYYY-MM-DD'),weekDay);
	  								}
	  								$(".fc-state-highlight").removeClass("fc-state-highlight");
	  								return;
	  							}
	  						}else{
	  							$('.spotpicker-times').remove();
	  							$(".fc-state-highlight").removeClass("fc-state-highlight");
	  							return;
	  						}
	  					}else{
	  						$('.spotpicker-times').remove();
	  						$(".fc-state-highlight").removeClass("fc-state-highlight");
	  						return;
	  					}
	  				}
	  			},
	  			dateClick: function(info) {
	  				console.log('info',info);
	  				var presentDay 		= new Date();
	  				var clickedDay 		= new Date(info.dateStr);
	  				var weekDay    		= daysOfWeek[clickedDay.getDay()];
	  				var availableDays 	= Object.keys(intervalsList);
	  				var userAccountInfo = JSON.parse(localStorage.getItem('userAccountInfo'));
	  				if(isEmpty(intervalsList) == false && (availableDays.indexOf(weekDay) > -1 || availableDays.indexOf(moment(clickedDay).format('YYYY_MM_DD')) > -1)){
	  					if(presentDay.getDate() <= clickedDay.getDate()){
	  						$(".fc-state-highlight").removeClass("fc-state-highlight");
	  						$(info.jsEvent.target).addClass("fc-state-highlight");
	  						if(availableDays.indexOf(weekDay) > -1 && availableDays.indexOf(moment(clickedDay).format('YYYY_MM_DD')) == -1){
	  							showTimegrid(info.dateStr,weekDay);
	  						}else{
	  							showTimegrid(info.date,moment(clickedDay).format('YYYY_MM_DD'));
	  						}
	  					}else{
	  						if(presentDay.getMonth() < clickedDay.getMonth()){
	  							$(".fc-state-highlight").removeClass("fc-state-highlight");
	  							$(info.jsEvent.target).addClass("fc-state-highlight");
	  						if(availableDays.indexOf(weekDay) > -1 && availableDays.indexOf(moment(clickedDay).format('YYYY_MM_DD')) == -1){
	  							showTimegrid(info.dateStr,weekDay);
	  						}else{
	  							showTimegrid(info.date,moment(clickedDay).format('YYYY_MM_DD'));
	  						}
	  						}
	  						$(".fc-state-highlight").removeClass("fc-state-highlight");
	  						return;
	  					}
	  				}else{
	  					if(isEmpty(intervalsList)== true && userAccountInfo.hasOwnProperty('default_available_days') != false){
	  						var default_available_days = userAccountInfo.default_available_days;
	  						var default_available_days = default_available_days.split(',');
	  						if(default_available_days.indexOf(weekDay) > -1){
			  					if(presentDay.getDate() <= clickedDay.getDate()){
			  						$(".fc-state-highlight").removeClass("fc-state-highlight");
			  						$(info.jsEvent.target).addClass("fc-state-highlight");
			  						showTimegrid(info.date,weekDay);
			  					}else{
			  						if(presentDay.getMonth() < clickedDay.getMonth()){
			  							$(".fc-state-highlight").removeClass("fc-state-highlight");
			  							$(info.jsEvent.target).addClass("fc-state-highlight");
			  							showTimegrid(info.date,weekDay);
			  						}
			  						$(".fc-state-highlight").removeClass("fc-state-highlight");
			  						return;
			  					}
	  						}else{
			  					$('.spotpicker-times').remove();
			  					$(".fc-state-highlight").removeClass("fc-state-highlight");
			  					return;
	  						}
	  					}else{
		  					$('.spotpicker-times').remove();
		  					$(".fc-state-highlight").removeClass("fc-state-highlight");
		  					return;
	  					}
	  				}
	  			},
	  		});
	  		calendar.render();
	  	});
			geteventdetails();
			getuser();
			$(window).on('load',function(){
				$('.booking-back-button').attr('href',baseURL+'bookevent?appId='+appId);
			});
	  </script>
</head>
<body data-gr-c-s-loaded="true">
	<div id="page-region">
		<div class="_3i0k6___Layout__cls1 mJVDY___Layout__isNotEmbedded">
			<div class="_2LpwQ___Wrapper__cls1 _1cMla___Wrapper__media-tablet-up _1P3Wz___Wrapper__media-desktop-up">
				<div data-container="booking-container" class="_36Zc1___container-StyledContainer__cls1 _1WIQY___container-StyledContainer__isTabletUp _3yQXt___container-StyledContainer__isDesktopUp">
					<div data-container="side-panel" class="_1x5lK___side_panel-Panel__cls1 _2rtAw___side_panel-Panel__isDesktopUp">
						<div class="_3Fp1z___side_panel-Container__cls1 gjDtZ___side_panel-Container__isDesktopUp">
							<div data-simplebar="init" class="_3zPIm___side_panel-ScrollContainer__cls1">
								<div class="simplebar-wrapper" style="margin: 0px;">
									<div class="simplebar-height-auto-observer-wrapper">
										<div class="simplebar-height-auto-observer"></div>
									</div>
									<div class="simplebar-mask">
										<div class="simplebar-offset" style="right: 0px; bottom: 0px;">
											<div class="simplebar-content-wrapper" style="height: 100%; overflow: hidden;">
												<div class="simplebar-content" style="padding: 0px;">
													<div class="_2DyJO___side_panel-InnerPaddingContainer__cls1">
														<a class="booking-back-button _1HG8o___BackButton__cls1 _2mHtj___back_button-Button__cls1 _1Qg-r___BareButton__cls1 _2zIir___index-UnstyledButton__cls1" aria-label="Go to previous page">
															<span class="icon-arrow-left u_Fd-___Icon__cls1 _1nLYz___Icon__cls1"></span>
														</a>
														<div class="profile-info has-sidebar-view">
															<img class="profile-info-avatar" alt="Avatar" src="images/guestuser.png">
															<h2 class="profile-info-name"></h2>
															<h1 class="profile-info-event-type-name"></h1>
														</div>
														<div class="_2_ni2___sidebar-DetailsContainer__cls1 _38UAA___sidebar-DetailsContainer__isTabletUp">
															<div data-container="details" class="_rO7V___styles-Container__cls1 _1kS_b___styles-Container__flow-column iYcui___styles-Container__isDesktopUp">
																<div class="_3haTY___styles-Item__cls1 meeting-duration">
																	<span class="icon-clock-fill u_Fd-___Icon__cls1 _1nLYz___Icon__cls1" data-id="details-item-icon"></span>
																</div>
																<!-- <div class="_3haTY___styles-Item__cls1">
																	<span class="icon-phone u_Fd-___Icon__cls1 _1nLYz___Icon__cls1" data-id="details-item-icon"></span>Phone call
																</div> -->
															</div>
														</div>
														<div class="_1eBQK___profile_description-Description__cls1 _11y5B___profile_description-Description__collapsed _1Pua3___profile_description-Description__isTabletUp">
															<div class="rich-text-view">
																<p></p>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="simplebar-placeholder" style="width: auto; height: 369px;"></div>
								</div>
								<div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
									<div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;"></div>
								</div>
								<div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
									<div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="_11234___MainPanel__cls1 _2AWMg___MainPanel__isDesktopUp">
						<div class="spotpicker">
							<h2 class="spotpicker-title">Select a Date</h2>
							<div style="flex-direction: row;display: flex;">
								<div style="width: 55%;padding: 1%;">
									<div id="calendar"></div>
								</div>
								<div class="selectTime" style="width: 45%;margin: 12px;"></div>
							</div>
						</div>
					</div>
<div id="gdpr-region"></div>

</body>
</html>