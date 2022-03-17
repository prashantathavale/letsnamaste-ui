<?php ?>
	<!DOCTYPE html>
	<html>
	<head>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	  <meta name="description" content="">
	  <meta name="author" content="">

	  <title> Letsnamaste | My Events </title>
	  <script src="js/library.js"></script>
	  <link href='fullcalendar/packages/core/main.css' rel='stylesheet' />
	  <link href='fullcalendar/packages/bootstrap/main.css' rel='stylesheet' />
	  <link href='fullcalendar/packages/timegrid/main.css' rel='stylesheet' />
	  <link href='fullcalendar/packages/daygrid/main.css' rel='stylesheet' />
	  <link href='fullcalendar/packages/list/main.css' rel='stylesheet' />
	  <script src='js/config.js'></script>
	  <link href='css/myevents.css' rel='stylesheet' />
	  <script src='js/myevents.js'></script>
	  <script src='fullcalendar/packages/core/main.js'></script>
	  <script src='fullcalendar/packages/interaction/main.js'></script>
	  <script src='fullcalendar/packages/bootstrap/main.js'></script>
	  <script src='fullcalendar/packages/daygrid/main.js'></script>
	  <script src='fullcalendar/packages/timegrid/main.js'></script>
	  <script src='fullcalendar/packages/list/main.js'></script>
	  <script src='fullcalendar/examples/js/theme-chooser.js'></script>
	  <script>
	    $(window).on("load", function() {
	    	var userInfo = userInfo = JSON.parse(localStorage.getItem("userInfo"));
	    	if(userInfo.hasOwnProperty('confirmation_time') == false){
	    		$('.js-toolbar-region div').show();
	    	}else{
	    		$('.js-toolbar-region div').hide();
	    	}
	    	$('.name').text(userInfo.full_name);
	    	$('.meeting-url').attr('href',baseURL+'bookevent?appId='+userInfo.id);
	    	$('.meeting-url').text(baseURL+'bookevent?appId='+userInfo.id);
	    	// $('.avatar-element img').attr('src','images/guestuser.png');
	    	if(userAccountInfo.hasOwnProperty('avatar_url') != false){
	    		$('.avatar-element img').attr('src',userAccountInfo.avatar_url);
	    	}
		  	$('.user_menu_UserMenuControl').on('click',function(){
		  		//showUserControl();
		  	});
	    });
	    createEventsList();
	  </script>
	</head>
	<body class="publishers is-scope-page" data-gr-c-s-loaded="true">
	<div id="page-region">
		<div id="popup-region"></div>
		<div id="root"></div>
			<header class="L2Qtd___index-Container__cls1">
				<div class="_3bq4o___index-InnerContainer__cls1">
					<div data-component="full-header" class="_1g8Lp___index-Logo__cls1">
						<a aria-label="Home" class="_27lBG___index-Link__cls1 _1Qg-r___BareButton__cls1 _2zIir___index-UnstyledButton__cls1" href="/home">
							<!-- <img src="/packs/media/images/logo-square-8da30b0ff31397b3e2df781ff0bde4d3.png" alt="" width="35" height="35"> -->
						</a>
					</div>
					<ul class="ChwVX___navigation-List__cls1 _1Amac___navigation-List__isTabletUp">
						<li>
							<!-- <a class="v8LMF___navigation_link-Link__cls1 _1Qg-r___BareButton__cls1 _2zIir___index-UnstyledButton__cls1" href="myevents">Home</a> -->
						</li>
					</ul>
					<div class="user_menu_Container user_menu_Container_isTabletU">
						<a aria-label="Account" class="user_menu_UserMenuControl _1Qg-r___BareButton__cls1 _2zIir___index-UnstyledButton__cls1" type="button" href="profile">
							<!-- <div class="_30KQ4___user_menu-Avatar__cls1">P</div> -->
							<div class="_1n_Sb___user_menu-Label__cls1">Account</div>
						</a>
					</div>
				</div>
			</header>
			<div id="nav-region"></div>
			<div class="body-content">
				<div data-component="home-bar">
					<div class="scope-dropdown-wrapper mbl">
						<div class="wrapper">
							<div class="scope-dropdown-region">
								<div class="scope-dropdown">
								</div>
						</div>
					</div>
					<div class="wrapper mtx">
						<nav class="giA3k___Tabs__cls1">
							<div class="KZqW____tabs-InnerContainer__cls1">
								<a class="_3N12Y___Tab__cls1 _2S9ml___Tab__selected _1Qg-r___BareButton__cls1 _2zIir___index-UnstyledButton__cls1 _1-i0z___index-UnstyledButton__disabledState" href="myevents" type="button" disabled="">
									<div class="_16FTS___tab-Text__cls1">Event Types</div>
								</a>
								<a class="_3N12Y___Tab__cls1 _1Qg-r___BareButton__cls1 _2zIir___index-UnstyledButton__cls1" type="button" href="mymeetings">
									<div class="_16FTS___tab-Text__cls1">Scheduled Events</div>
								</a>
							</div>
						</nav>
					</div>
				</div>
			</div>
			<div data-component="home-content">
				<div>
					<div>
						<div class="overflowing wrapper">
							<div class="js-enforcement-upgrade-informer"></div>
							<div class="js-enforcement-content">
								<!-- <div class="js-search-filter-region">
									<div class="search-filter">
										<label class="search-input">
											<span class="icon-magnifying-glass u_Fd-___Icon__cls1 _1nLYz___Icon__cls1"></span>
											<input name="filter-term" placeholder="Filter" autocomplete="off" value="">
										</label>
									</div>
								</div> -->
								<div class="event-type-list js-list-region">
									<div class="event-type-group-list">
										<div class="event-type-group-list-item user-item">
											<table class="list-header pbm table">
												<tbody>
													<tr>
														<td class="avatar">
															<div class="avatar-element"><img alt="Avatar" src="images/guestuser.png"></div>
														</td>
														<td class="user">
															<div class="left">
																<div class="name truncator"></div>
																<div class="truncator">
																	<a class="meeting-url" target="_blank" rel="noopener noreferrer"></a>
																</div>
															</div>
														</td>
														<td class="action hidden-phone">
															<div class="js-new-event-type-region new-event-type">
																<div>
																	<div class="pbx prx">
																		<a class="button js-new-event-type-link slim" href="createevent">
																			<i class="icon-add"></i>New Event
																		</a>
																	</div>
																</div>
															</div>
														</td>
													</tr>
												</tbody>
											</table>
											<div class="hidden-desktop js-new-event-type-mobile-region mbm new-event-type">
												<div>
													<button class="button js-new-event-type-link slim wide">
														<i class="icon-add"></i>New Event Type
													</button>
												</div>
											</div>
											<div class="js-event-types-region">
												<div class="event-type-card-list grid-3 ui-sortable">
												</div>
											</div>
											<div class="js-show-more-region"></div>
										</div>
									</div>
								</div>
								<div class="js-pagination-region"><div></div>
							</div>
						</div>
					</div>
					<div class="js-dropdown-trigger-region"></div>
					<div class="js-toolbar-region">
						<div style="display: none;">
							<div class="bulk-toolbar">
								<div class="wrapper">
									<div class="verify-message">
										<div>
											<h3 class="email-verify"> This email is not verified. <a href="verification"> Please click here to verify your Email ID </a></h3>
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