<!DOCTYPE html>
<!-- saved from url=(0014)about:internet -->
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Lets Namaste | Get started</title>
<link href='css/getstarted.css' rel='stylesheet' />
<script src="js/library.js"></script>
<script src='js/config.js'></script>
<script src='js/getstarted.js'></script>
<script>
	if(localStorage.getItem('userInfo') != undefined){
		window.location = 'myevents';
	}
	$(window).on("load", function() {
	  	$('.submit-email').on('click',function(){
	  		console.log('rttyut',$('.js-email-input').val() != '');
	  		if($('.js-email-input').val() != ''){
		  		$('.submit-email').remove();
		  		$('.js-loading-show').removeClass('hidden');
		  		$(".js-email-input").prop("readonly", true);
		  		verifyEmail($('.js-email-input').val());
		  		// window.location =baseURL+'signup?email='+$('.js-email-input').val();
	  		}
	  	});
	});
</script>
</head>
<body class="centered" data-gr-c-s-loaded="true">
	<div id="page-region">
		<div class="section last">
			<div class="sub-section narrow">
				<div class="mbm">
					<!-- <a class="logo" href="#"><img width="35" height="35" src="./signup_files/logo_icon-5855fd7f1e3a31267dbb103936ea0db589e06132b13bf2086048a1020d764e3f.png">
					</a> -->
				</div>
				<div id="main-region">
					<div>
						<div class="js-step-region">
							<div>
								<h3>Sign up Here</h3>
								<div class="box text-left">
									<div class="pbl">
										<small class="error-message mbs"></small>
										<form class="js-form" novalidate="">
											<div class="field">
												<h5>Enter your email to get started.</h5>
												<input class="js-email-input" name="email" type="email" placeholder="email address" value="" required>
												<div class="error-message js-error-message"></div>
											</div>
											<input class="button js-loading-hide submit-email" type="submit" value="Get Started">
											<div class="button hidden js-loading-show spinner">
												<div class="bounce1"></div>
												<div class="bounce2"></div>
												<div class="bounce3"></div>
												<div class="bounce4"></div>
											</div>
										</form>
									</div>
									<!-- <h5>Already have an account?&nbsp;<a href="login">Log in</a>.</h5> -->
								</div>
							</div>
						</div>
<!-- 						<div class="js-locale-region">
							<div>
								<div class="_3AygJ___locale_selector-Container__cls1">
									<button class="_1kAzm___locale_selector-Toggler__cls1 _3w3vl___Link__cls1 Y6Jkn___styles-Container__cls1 _1Qg-r___BareButton__cls1 _2zIir___index-UnstyledButton__cls1" type="button">English<span class="icon-angle-down u_Fd-___Icon__cls1 _1nLYz___Icon__cls1"></span>
									</button>
								</div>
							</div>
						</div> -->
					</div>
				</div>
			</div>
		</div>
		</body>
		</html>