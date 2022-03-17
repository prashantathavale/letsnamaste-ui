<!DOCTYPE html>
<!-- saved from url=(0014)about:internet -->
<html style="" class=" history no-touchevents localstorage">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Lets Namaste</title>
	  <link href='fullcalendar/packages/core/main.css' rel='stylesheet' />
	  <link href='fullcalendar/packages/bootstrap/main.css' rel='stylesheet' />
	  <link href='fullcalendar/packages/timegrid/main.css' rel='stylesheet' />
	  <link href='fullcalendar/packages/daygrid/main.css' rel='stylesheet' />
	  <link href='fullcalendar/packages/list/main.css' rel='stylesheet' />
	  <link href='css/selectbookingdate.css' rel='stylesheet' />
	  <link href='css/time.css' rel='stylesheet' />
	  <link href='css/availability.css' rel='stylesheet' />
	  <script src='js/library.js'></script>
	  <script src='js/config.js'></script>
	  <script src='js/time.js'></script>
	  <script src='js/availability.js'></script>
	  <script src='fullcalendar/packages/core/main.js'></script>
	  <script src='fullcalendar/packages/interaction/main.js'></script>
	  <script src='fullcalendar/packages/bootstrap/main.js'></script>
	  <script src='fullcalendar/packages/daygrid/main.js'></script>
	  <script src='fullcalendar/packages/timegrid/main.js'></script>
	  <script src='fullcalendar/packages/list/main.js'></script>
	  <script src='fullcalendar/examples/js/theme-chooser.js'></script>
	  <script>
	  	$(window).on('load',function(){
			$('.start_time').timepicker({timeFormat: 'h:mm p',interval: 60,minTime: '0',maxTime: '11:59pm',defaultTime: '09',startTime: '09:00',dynamic: true,dropdown: false,scrollbar: true});
			$('.end_time').timepicker({timeFormat: 'h:mm p',interval: 60,minTime: '0',maxTime: '11:59pm',defaultTime: '18',startTime: '09:00',dynamic: true,dropdown: false,scrollbar: true});
		$('.set_availability').on('click',function(){
			window.start_time = getTime($('.start_time').val());
			window.end_time = getTime($('.end_time').val());
            window.availableDays = [];
            $.each($("._ZaPM___styles-Input__cls1:checked"), function(){
                availableDays.push($(this).val());
            });
            if(start_time != '' && end_time != '' && availableDays != ''){
            	setDefaultavailability({start_time:start_time,end_time:end_time,availableDays:availableDays});
            }
		});
	  	});
	  </script>
</head>
<body class="publishers" data-gr-c-s-loaded="true">
	<div id="page-region">
		<div id="popup-region"></div>
		<div class="header">
			<div class="wrapper row">
				<div class="logo centered">
					<!-- <img src="./availableDates_files/logo-app-ea32f8163fbbb3fe9f0f9f142799e7c87ef21b839194d9a37bc0a0074a93eca2.png" width="115" height="35"> -->
				</div>
			</div>
		</div>
		<div class="flash-region" id="flash-region"></div>
	<div class="body-content">
		<div id="root">
			<div class="body-content">
				<div id="main-region" class="main-region">
					<div>
						<div class="intro step-wrapper">
							<div class="js-step-content-region step-frame" style="overflow: visible;">
								<div class="step availability">
									<div class="row step-header">
										<div class="step-legend">
											<h2 class="mbm">Set your availability</h2>
											<div class="increased muted step-description">
											Let us know when you’re typically available to accept meetings.
										</div>
									</div>
									<!-- <div class="step-illustration">
										<img src="./availableDates_files/availability-illustration-b26b392ce59f895b2375a6cf0d98e901.svg">
									</div> -->
								</div>
								<div class="row step-content">
									<div class="mbs">
										<strong>Available Hours</strong>
									</div>
									<div class="mbm select-container">
										<div class="select">
											<div id="time_to_chzn" class="chzn-container chzn-container-single" style="width: 81px;" title="">
												<input class="js-time-input start_time" tabindex="0" name="from" placeholder="hh:mm am">
											</div>
										</div>
										<div class="select-spacing"></div>
										<div class="select">
											<div id="time_to_chzn" class="chzn-container chzn-container-single" style="width: 81px;" title="">
												<input class="js-time-input end_time" tabindex="0" name="from" placeholder="hh:mm am">
											</div>
										</div>
										    </div>
										    <div class="mbs">
										    	<strong>Available Days</strong>
										    </div>
										    <div class="js-days js-days-container-region">
										    	<div>
										    		<div class="days-container">
										    			<label class="day-option">
										    				<div class="_1aDbB___CheckboxInput__cls1 _2Vn_e___styles-Container__cls1">
										    					<input type="checkbox" class="_ZaPM___styles-Input__cls1" value="Sunday">
										    					<div class="_1OAEh___styles-Body__cls1">
										    						<svg viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg" class="_17YbC___styles-Svg__cls1"><path d="M2 0h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm6.156 3.5L4.975 6.68 3.561 5.267 2.5 6.328 4.621 8.45l.354.354L9.217 4.56 8.156 3.5z" fill="currentColor" fill-rule="evenodd"></path></svg>
										    					</div>
										    				</div>
										    				<div class="day-option-label-inner">Sundays</div>
										    			</label>
										    			<label class="day-option">
										    				<div class="_1aDbB___CheckboxInput__cls1 _2Vn_e___styles-Container__cls1">
										    					<input type="checkbox" class="_ZaPM___styles-Input__cls1" value="Monday" checked=""><div class="_1OAEh___styles-Body__cls1">
										    						<svg viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg" class="_17YbC___styles-Svg__cls1"><path d="M2 0h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm6.156 3.5L4.975 6.68 3.561 5.267 2.5 6.328 4.621 8.45l.354.354L9.217 4.56 8.156 3.5z" fill="currentColor" fill-rule="evenodd"></path>
										    						</svg>
										    					</div>
										    				</div>
										    				<div class="day-option-label-inner">Mondays</div>
										    			</label>
										    			<label class="day-option">
										    				<div class="_1aDbB___CheckboxInput__cls1 _2Vn_e___styles-Container__cls1">
										    					<input type="checkbox" class="_ZaPM___styles-Input__cls1" value="Tuesday" checked="">
										    					<div class="_1OAEh___styles-Body__cls1">
										    						<svg viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg" class="_17YbC___styles-Svg__cls1"><path d="M2 0h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm6.156 3.5L4.975 6.68 3.561 5.267 2.5 6.328 4.621 8.45l.354.354L9.217 4.56 8.156 3.5z" fill="currentColor" fill-rule="evenodd"></path>
										    						</svg>
										    					</div>
										    				</div>
										    				<div class="day-option-label-inner">Tuesdays</div>
										    			</label>
										    			<label class="day-option">
										    				<div class="_1aDbB___CheckboxInput__cls1 _2Vn_e___styles-Container__cls1">
										    					<input type="checkbox" class="_ZaPM___styles-Input__cls1" value="Wednesday" checked="">
										    					<div class="_1OAEh___styles-Body__cls1">
										    						<svg viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg" class="_17YbC___styles-Svg__cls1"><path d="M2 0h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm6.156 3.5L4.975 6.68 3.561 5.267 2.5 6.328 4.621 8.45l.354.354L9.217 4.56 8.156 3.5z" fill="currentColor" fill-rule="evenodd"></path>
										    						</svg>
										    					</div>
										    				</div>
										    				<div class="day-option-label-inner">Wednesdays</div>
										    			</label>
										    			<label class="day-option">
										    				<div class="_1aDbB___CheckboxInput__cls1 _2Vn_e___styles-Container__cls1">
										    					<input type="checkbox" class="_ZaPM___styles-Input__cls1" value="Thursday" checked="">
										    					<div class="_1OAEh___styles-Body__cls1">
										    						<svg viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg" class="_17YbC___styles-Svg__cls1"><path d="M2 0h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm6.156 3.5L4.975 6.68 3.561 5.267 2.5 6.328 4.621 8.45l.354.354L9.217 4.56 8.156 3.5z" fill="currentColor" fill-rule="evenodd"></path>
										    						</svg>
										    					</div>
										    				</div>
										    				<div class="day-option-label-inner">Thursdays</div>
										    			</label>
										    			<label class="day-option">
										    				<div class="_1aDbB___CheckboxInput__cls1 _2Vn_e___styles-Container__cls1">
										    					<input type="checkbox" class="_ZaPM___styles-Input__cls1" value="Friday" checked="">
										    					<div class="_1OAEh___styles-Body__cls1">
										    						<svg viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg" class="_17YbC___styles-Svg__cls1"><path d="M2 0h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm6.156 3.5L4.975 6.68 3.561 5.267 2.5 6.328 4.621 8.45l.354.354L9.217 4.56 8.156 3.5z" fill="currentColor" fill-rule="evenodd"></path>
										    						</svg>
										    					</div>
										    				</div>
										    				<div class="day-option-label-inner">Fridays</div>
										    			</label>
										    			<label class="day-option">
										    				<div class="_1aDbB___CheckboxInput__cls1 _2Vn_e___styles-Container__cls1">
										    					<input type="checkbox" class="_ZaPM___styles-Input__cls1" value="Saturday">
										    					<div class="_1OAEh___styles-Body__cls1">
										    						<svg viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg" class="_17YbC___styles-Svg__cls1"><path d="M2 0h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm6.156 3.5L4.975 6.68 3.561 5.267 2.5 6.328 4.621 8.45l.354.354L9.217 4.56 8.156 3.5z" fill="currentColor" fill-rule="evenodd"></path>
										    						</svg>
										    					</div>
										    				</div>
										    				<div class="day-option-label-inner">Saturdays</div>
										    			</label>
										    		</div>
										    	</div>
										    </div>
									</div>
								</div>
							</div>
							<div class="js-step-controls-region">
								<div class="intro-controls">
									<div class="intro-common-actions">
										<button class="action-button button js-loading-hide js-submit-button primary set_availability" style="width: auto;">
											<span>Continue</span>
										</button>
										<div class="button hidden js-loading-show spinner">
											<div class="bounce1"></div>
											<div class="bounce2"></div>
											<div class="bounce3"></div>
											<div class="bounce4"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>