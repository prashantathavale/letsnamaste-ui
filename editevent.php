<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<meta name="viewport" content="width=device-width, initial-scale=0.86, maximum-scale=3.0, minimum-scale=0.86">
	<title> Letsnamaste | Edit Events </title>
	<link href='fullcalendar/packages/core/main.css' rel='stylesheet' />
	<link href='fullcalendar/packages/bootstrap/main.css' rel='stylesheet' />
	<link href='fullcalendar/packages/timegrid/main.css' rel='stylesheet' />
	<link href='fullcalendar/packages/daygrid/main.css' rel='stylesheet' />
	<link href='fullcalendar/packages/list/main.css' rel='stylesheet' />
	<link href='css/editevent.css' rel='stylesheet' />
	<link href='css/time.css' rel='stylesheet' />
	<script src='fullcalendar/packages/core/main.js'></script>
	<script src="js/library.js"></script>
	<script src='js/config.js'></script>
	<script src='js/editevent.js'></script>
	<script src='js/time.js'></script>
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
	  			initialView: 'dayGridMonth',
	  			showNonCurrentDates: false,
	  			fixedWeekCount: false,
	  			initialView: 'pastAndFutureView',
				eventTimeFormat: {
				    hour: '2-digit',
				    minute: '2-digit',
				    meridiem: true
				},
				displayEventTime: true,
				displayEventEnd:true,
	  			selectable: true,
	  			allDay: false,
	  			timeFormat: 'h:mm',
	  			events: events,
	  			timeZone: 'local',
	  			validRange: {
	  				start: new Date(),
	  				end: endDate.toISOString(),
	  				display: 'inverse-background'
	  			},
	  			eventClick: function(eventClickInfo){
	  				console.log('eventClickInfo',eventClickInfo.event.start);
	  				var clickedDay = new Date(eventClickInfo.event.start);
	  				// console.log('eventClickInfo12',moment(clickedDay).format('Do MMMM'));
	  				showEditavailability(intervalsList[weedDays[clickedDay.getDay()]],eventClickInfo.event,1);
					$('.start_time').timepicker({timeFormat: 'h:mm p',interval: 60,minTime: '0',maxTime: '11:59pm',defaultTime: '09',startTime: '09:00',dynamic: true,dropdown: false,scrollbar: true});
					$('.end_time').timepicker({timeFormat: 'h:mm p',interval: 60,minTime: '0',maxTime: '11:59pm',defaultTime: '18',startTime: '09:00',dynamic: true,dropdown: false,scrollbar: true});
					if(typeof intervalsList[weedDays[clickedDay.getDay()]] == 'undefined'){
						evenInterval = intervalsList[moment(clickedDate).format('YYYY_MM_DD')];
						$('.start_time').val(getTimeinMins(intervalsList[moment(clickedDate).format('YYYY_MM_DD')].start_time));
						$('.end_time').val(getTimeinMins(intervalsList[moment(clickedDate).format('YYYY_MM_DD')].end_time));
					}else{
						$('.start_time').val(getTimeinMins(intervalsList[weedDays[clickedDay.getDay()]].start_time));
						$('.end_time').val(getTimeinMins(intervalsList[weedDays[clickedDay.getDay()]].end_time));
					}
	  			},
	  			dateClick: function(info) {
	  				var clickedDay = new Date(info.dateStr);
	  				if(isEmpty(intervalsList[weedDays[clickedDay.getDay()]]) == true){
		  				showEditavailability({event_id:eventData.event_id,interval_type:'applicableday',start_date:0,end_date:0,start_time:userAccountInfo.default_available_start_time,end_time:userAccountInfo.default_available_end_time,day_of_weeks:weedDays[clickedDay.getDay()],default:1},info.date,0);
						$('.start_time').timepicker({timeFormat: 'h:mm p',interval: 60,minTime: '0',maxTime: '11:59pm',defaultTime: '09',startTime: '09:00',dynamic: true,dropdown: false,scrollbar: true});
						$('.end_time').timepicker({timeFormat: 'h:mm p',interval: 60,minTime: '0',maxTime: '11:59pm',defaultTime: '18',startTime: '09:00',dynamic: true,dropdown: false,scrollbar: true});
						$('.start_time').val(getTimeinMins(userAccountInfo.default_available_start_time));
						$('.end_time').val(getTimeinMins(userAccountInfo.default_available_end_time));
	  				}else{
	  					console.log('in else');
	  				}
	  			},
	  		});
	  	});
		$(window).on("load", function() {
			if(editFlag == 0){
				showDefaultavailability();
			}
			var payment_profile_id = 1;
			if(typeof eventData != 'undefined'){
				payment_profile_id = eventData.payment_profile_id;
			}
			var chargeType = 'free';
			var amount = 0;
			var currency = '';
			switch(payment_profile_id){
				case 1: $('#no-payment').prop('checked',true);
						break;
				case 2: $('#payubiz-payment').prop('checked',true);
						$('.js-payment-block').show();
						$('.currency-amount').val(eventData.amount);
						chargeType = 'paid';
						break;
				default: $('#no-payment').prop('checked',true);
						break;
			}
			if(editFlag == 1){
				$('.event_description').text(eventData.description);
				$('.event_title').val(eventData.title);
				$('.preselected-picker ul').find('.selected').removeClass('selected');
				$(".preselected-picker ul li").each((id, elem) => {
					if (parseInt(elem.innerText) == parseInt(eventData.duration_in_minute)) {
						$('.preselected-picker ul').find(elem).addClass('selected');
					}
				});

				$('.create_button').text('Update');
			}
			$('.preselected').on('click',function(){
				$('.preselected-picker ul').find('.selected').removeClass('selected');
				$(this).addClass('selected');
			});
			$('input[name="provider"]').on('click',function(){
			payment_profile_id = $('input[name="provider"]:checked').val();
				if(payment_profile_id > 1){
					$('.js-payment-block').show();
					chargeType = 'paid';
				}else{
					$('.js-payment-block').hide();
				}
			});
			$('.range').on('click',function(){
				var eventIntervalday = $(this).attr('data-value');
				showEditavailability(intervalsList[eventIntervalday]);
				$('.start_time').timepicker({timeFormat: 'h:mm p',interval: 60,minTime: '0',maxTime: '11:59pm',defaultTime: '09',startTime: '09:00',dynamic: true,dropdown: false,scrollbar: true});
				$('.end_time').timepicker({timeFormat: 'h:mm p',interval: 60,minTime: '0',maxTime: '11:59pm',defaultTime: '18',startTime: '09:00',dynamic: true,dropdown: false,scrollbar: true});
				$('.start_time').val(getTimeinMins(intervalsList[eventIntervalday].start_time));
				$('.end_time').val(getTimeinMins(intervalsList[eventIntervalday].end_time));
			});
			$('._ZaPM___styles-Input__cls1').on('click',function(){
				console.log('input clicked');
				var inputVal = $(this).val();
				if(intervalsList[inputVal] == undefined){
					intervalsList[inputVal] = {day_of_weeks: inputVal,end_date: 0,end_time: userAccountInfo.default_available_end_time,interval_type: "applicableday",start_date: 0,start_time: userAccountInfo.default_available_start_time}
				}
				$('.range[data-value="'+inputVal+'"] span').html(getTimeinMins( userAccountInfo.default_available_start_time)+' - '+getTimeinMins(userAccountInfo.default_available_end_time));
				$('input[value="'+inputVal+'"]').prop('checked',true);
			});
			$('.create_button').on('click',function(){
				var duration = parseInt($('.preselected-picker ul').find('.selected').text());
				var description = $('.event_description').text().trim();
				var title = $('.event_title').val();
				if($('.currency-amount').val() != ''){
					amount = parseInt($('.currency-amount').val());
					currency = $('.currency-selector option:selected').attr('data-symbol');
				}
				console.log(duration != '',description != '',title != '');
				if(duration != '' && description != '' && title != ''){
					$('.create_button').prop('disabled',true);
					var createEventparams = {type:'private',duration_in_minute:duration,description:description,title:title,charge_type:chargeType,amount:amount,payment_profile_id:payment_profile_id};
					if(editFlag == 1){
						editEvent(createEventparams);
					}else{
						createEvent(createEventparams);
					}
				}else{
					if(description == ''){
						$('.error-message-description').text('Description should not be empty');
					}
					if(title == ''){
						$('.error-message-name').text('Title should not be empty');
					}
				}

			});
			$(".currency-selector").on("change", updateSymbol);
			updateSymbol();

		});
	</script>
</head>
<body class="publishers" data-gr-c-s-loaded="true">
	<div id="page-region">
		<div id="popup-region"></div>
		<div id="root">
			<header class="L2Qtd___index-Container__cls1">
				<div class="_3bq4o___index-InnerContainer__cls1">
					<div data-component="full-header" class="_1g8Lp___index-Logo__cls1">
					</div>
					<ul class="ChwVX___navigation-List__cls1 _1Amac___navigation-List__isTabletUp">
						<li>
							<!-- <a class="v8LMF___navigation_link-Link__cls1 _1Qg-r___BareButton__cls1 _2zIir___index-UnstyledButton__cls1" href="myevents">Home</a> -->
						</li>
					</ul>
					<div class="_3Ib2a___user_menu-Container__cls1 _2pZHP___user_menu-Container__isTabletUp">
						<a aria-label="Account" class="_2nGlq___user_menu-UserMenuControl__cls1 _1Qg-r___BareButton__cls1 _2zIir___index-UnstyledButton__cls1" type="button" href="profile">
							<div class="_1n_Sb___user_menu-Label__cls1">Account</div>
						</a>
					</div>
				</div>
			</header>
			<div id="legacy-flash-region" class="flash-region"></div>
			<div id="nav-region">
				<div class="subheader">
					<div class="wrapper">
						<div class="actions">
							<a class="action-button back-button" href="myevents" data-navigation="browser">
								<i class="icon-angle-left"></i>
								<span>Back</span>
							</a>
						</div>
						<div class="title">
							<h2>Add One-on-One Event</h2>
							<h3 class="muted"></h3>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="body-content">
			<div id="main-region">
				<div class="wrapper">
					<div class="js-header">
						<div class="mbl">
							<div class="form-adaptive" data-section="general">
								<div class="expandable-block expanded" style="">
									<div class="expandable-header js-content-toggle row">
										<div>
											<div class="event-type-form">
												<div class="event-type-form-header">
													<div class="event-type-form-header-primary-info">
														<div class="mrs">
															<i class="marker" style="background-color: #8989fc"></i>
														</div>
														<div class="event-type-form-header-primary-info-content">
															<div>
																<div>What event is this?</div>
																<div class="muted"></div>
															</div>
															<div class="js-warning"></div>
														</div>
													</div>
													<div class="event-type-form-header-controls">
														<div class="actions">
															<div class="js-actions-region">
																<div>
																	<div class="srsee___actions-Container__cls1 _1qTMS___actions-Container__isTabletUp">
																		<button class="MOKW6___Button__cls1 Vhorz___styles-Container__cls1 _2ZYno___styles-Container__size-small _1-5mC___styles-Container__decoration-primary _2Ty7q___styles-Container__responsive _2UclO___styles-Container__onlyChild _1Qg-r___BareButton__cls1 _2zIir___index-UnstyledButton__cls1 create_button" type="button" href="myevents">
																			<div class="OPKSe___styles-TextContainer__cls1 create_text">Create</div>
																		</button>
																		<a class="MOKW6___Button__cls1 Vhorz___styles-Container__cls1 _2ZYno___styles-Container__size-small LrbVk___styles-Container__decoration-ghost _2Ty7q___styles-Container__responsive _2UclO___styles-Container__onlyChild _1Qg-r___BareButton__cls1 _2zIir___index-UnstyledButton__cls1" type="button" href="myevents">
																			<div class="OPKSe___styles-TextContainer__cls1">Cancel</div>
																		</a>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="expandable-content js-content-body"><div><div class="adaptive row">
										<div class="col1of2">
											<div class="field">
												<label>Event name *</label>
												<input type="text" name="name" value="" class="event_title" maxlength="55" data-model="event_type" data-validate="submit_only">
												<span class="error-message error-message-name"></span>
											</div>
											<div class="js-location-region">
												<div class="field">

												</div>
											</div>
											<div class="js-description-region">
												<div>
													<div class="field">
														<label class="component-field-label is-wide" for="wysiwyg-description">
															<span class="component-field-label-text">Description/Instructions *</span>
															<span class="error-message error-message-description"></span>
														</label>
														<div data-testid="rich-text-editor" class="rich-text-editor">
															<div class="rich-text-view">
																<div class="ql-toolbar ql-snow">

																</div>
																<div id="wysiwyg-description" class="quill rich-text-field">
																	<div class="ql-container ql-snow">
																		<div class="ql-editor ql-blank event_description" data-gramm="false" contenteditable="true">
																			<p><br></p>
																		</div>
																		<div class="ql-clipboard" contenteditable="true" tabindex="-1"></div>
																		<div class="ql-tooltip ql-hidden">
																			<a class="ql-preview" rel="noopener noreferrer" target="_blank" href="about:blank"></a>
																			<input type="text" data-formula="e=mc^2" data-link="https://quilljs.com" data-video="Embed URL">
																			<a class="ql-action"></a>
																			<a class="ql-remove"></a>
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
									<div class="field">
										<label>
											Event Duration *

										</label>
										<div class="js-duration-picker-region">
											<div class="preselected-picker">
												<ul>
													<li class="preselected" data-value="15">15<div class="desc">min</div>
													</li>
													<li class="preselected selected" data-value="30">30<div class="desc">min</div>
													</li>
													<li class="preselected" data-value="45">45<div class="desc">min</div>
													</li>
													<li class="preselected last" data-value="60">60<div class="desc">min</div>
													</li>
<!-- 													<li class="custom">
														<input name="custom_duration" data-value="" placeholder="-" type="number" tabindex="-1">
														<div class="desc hidden-tablet-up">custom</div>
														<div class="desc hidden-phone">custom min</div>
													</li> -->
												</ul>
												<span class="error-message" data-error="duration"></span>
											</div>
										</div>
									</div>
									<div class="field">
										<label>
											Availability

										</label>
										<div class="mbl">
											<span>Set your available hours when people can schedule meetings with you.</span>
										</div>
											<div class="availability-calendar">
												<div class="calendar_view">
													<div id="calendar"></div>
												</div>
											</div>
										</div>
										<div class="field">
											<label> Payments </label>
											<div class="mbs">
												<label class="js-no-payment-label">
													<input class="js-no-payment-button mrs" id="no-payment" type="radio" name="provider" value="1" >
													Do not collect payments for this event
												</label>
											</div>
											<div class="mbs">
												<label class="js-stripe-payment-label">
													<input class="js-stripe-payment-button mrs" id="payubiz-payment" type="radio" name="provider" value="2" >
													Accept payments with PayuBiz
												</label>
													<div class="error-message js-paypal-error mlm plx" style="display: none;">
														To accept payments, please confirm your email address with PayPal.
													</div>
											</div>
											<div class="js-payment-block">
												<div class="adaptive row">
													<div class="col1of2 field">
														<label class="pts">
															Amount to be collected *
														</label>
														<div class="amount-container">
<!-- 															<input class="amount-integer js-amount js-amount-integer" name="amount_integer" type="text" value="" data-model="event_type" maxlength="7" autocomplete="off">
															<span class="decimal-mark js-decimal-mark">.</span>
															<input class="amount-fraction js-amount js-amount-fraction" name="amount_fraction" type="text" value="" data-model="event_type" maxlength="2" autocomplete="off">
															<div class="currency-selection-toggle js-context-toggle">
																<span class="js-currency-code">USD</span>
																<i class="icon-angle-down"></i>
															</div>
															<span class="error-message"></span> -->
															<div class="input-group">
														      <div class="input-group-addon currency-symbol">$</div>
														      <input type="text" class="form-control currency-amount" id="inlineFormInputGroup" placeholder="00" size="8">
														      <div class="input-group-addon currency-addon">
														        <select class="currency-selector">
														          <option data-symbol="₹" data-placeholder="00" selected>INR</option>
														          <option data-symbol="$" data-placeholder="00">USD</option>
														          <option data-symbol="€" data-placeholder="00">EUR</option>
														          <option data-symbol="£" data-placeholder="00">GBP</option>
														          <option data-symbol="¥" data-placeholder="00">JPY</option>
														          <option data-symbol="$" data-placeholder="00">CAD</option>
														          <option data-symbol="$" data-placeholder="00">AUD</option>
														        </select>
														      </div>
														    </div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="expandable-footer js-content-footer">
										<div class="row">
											<div class="actions">
												<div class="js-actions-region">
													<div>
														<div class="srsee___actions-Container__cls1 _1qTMS___actions-Container__isTabletUp">
															<button class="MOKW6___Button__cls1 Vhorz___styles-Container__cls1 _2ZYno___styles-Container__size-small _1-5mC___styles-Container__decoration-primary _2Ty7q___styles-Container__responsive _2UclO___styles-Container__onlyChild _1Qg-r___BareButton__cls1 _2zIir___index-UnstyledButton__cls1 create_button" type="button" href="myevents">
																<div class="OPKSe___styles-TextContainer__cls1 create_text">Create</div>
															</button>
															<a class="MOKW6___Button__cls1 Vhorz___styles-Container__cls1 _2ZYno___styles-Container__size-small LrbVk___styles-Container__decoration-ghost _2Ty7q___styles-Container__responsive _2UclO___styles-Container__onlyChild _1Qg-r___BareButton__cls1 _2zIir___index-UnstyledButton__cls1" type="button" href="myevents">
																<div class="OPKSe___styles-TextContainer__cls1">Cancel</div>
															</a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div></div>
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
</div>
</div>
</div>
</body>
</html>