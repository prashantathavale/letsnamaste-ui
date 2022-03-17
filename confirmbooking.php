<!DOCTYPE html>
<html lang="en" style="" class=" history no-touchevents localstorage">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Letsnamaste | Confirmbooking </title>
	<link rel="stylesheet" type="text/css" href="css/confirmbooking.css">
	<script src="js/library.js"></script>
	<script src='js/config.js'></script>
	<script>
		var meetingDetials = JSON.parse(localStorage.getItem('meetingDetails'));
		var meetingbookingdetails = JSON.parse(localStorage.getItem('meetingbookingdetails'));

	      $(window).on( "load", function() {
	        $('._2Swh____marker-Title__cls1').text(meetingDetials.title);
	        $('._3kBmc___styles-HighlightedItem__cls1').text(meetingDetials.description);
	        $('_2RxMj___styles-HighlightedItem__highlighted').text('Meeting Type: '+ meetingDetials.type);
	        $('.meeting-link').html('<div>Meeting link will be: <a href="'+meetingbookingdetails.url+'"> '+meetingbookingdetails.url+' </a></div>');
	      });
	</script>
</head>
<body data-gr-c-s-loaded="true">
	<div id="page-region">
		<div class="_3i0k6___Layout__cls1 mJVDY___Layout__isNotEmbedded">
			<div class="_2LpwQ___Wrapper__cls1 _1cMla___Wrapper__media-tablet-up _1P3Wz___Wrapper__media-desktop-up">
				<div data-container="booking-container" class="_36Zc1___container-StyledContainer__cls1 _3Atqo___container-StyledContainer__expanded _1WIQY___container-StyledContainer__isTabletUp _3yQXt___container-StyledContainer__isDesktopUp">

					<div class="_11234___MainPanel__cls1 _2AWMg___MainPanel__isDesktopUp">
						<div class="_2mTCf___index-Container__cls1">
							<div data-component="confirmation-header" class="_3je1O___index-Header__cls1">
								<div class="profile-info">
									<!-- <img src="./confirmbooking_files/5df0b373.jpg" class="profile-info-avatar" alt="Avatar"> -->
								</div>
									<h2 class="_2KVR1___index-Title__cls1">Confirmed</h2>Your meeting is scheduled.</div>
									<div>
										<div data-container="details" class="_rO7V___styles-Container__cls1 _1kS_b___styles-Container__flow-column iYcui___styles-Container__isDesktopUp">
											<div class="YhnBF___styles-MarkerItem__cls1 _3haTY___styles-Item__cls1">
												<div class="VGzOH___marker-MarkerIcon__cls1" style="background-color: rgb(238, 83, 83);"></div>
												<h2 class="_2Swh____marker-Title__cls1"></h2>
											</div>
											<div data-id="details-highlighted-item" class="_3kBmc___styles-HighlightedItem__cls1 _2RxMj___styles-HighlightedItem__highlighted _3haTY___styles-Item__cls1">

											</div>
											<div class="_3haTY___styles-Item__cls1 meeting-type"></div>
											<div class="_3haTY___styles-Item__cls1 meeting-link"></div>
										</div>
										<div class="eWZZP___payment_message-Message__cls1">A calendar invitation has been sent to your email address.</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
<div id="gdpr-region"></div>
</body
></html>