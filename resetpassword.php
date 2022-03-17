<!DOCTYPE html>
<!-- saved from url=(0014)about:internet -->
<html><head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Lets Namaste | Reset Password</title>
	<link href='css/signup.css' rel='stylesheet' />
	<script src="js/library.js"></script>
	<script src='js/config.js'></script>
	<script src='js/resetpassword.js'></script>
	<script>
		$(window).on("load", function() {
		$('.new-password-input').keyup(function(){
			checkPasswordStrength('.new-password-input');
		});
		$('.js-reset-button').on('click',function(){
			var old_password = $('.old-password-input').val();
			var new_password = $('.new-password-input').val();
			var confirm_password = $('.confirm-password-input').val();
			if(old_password != '' && (new_password != '' && new_password.length > 8) && confirm_password != ''){
					$('.js-reset-button').remove();
			  		$('.js-loading-show').removeClass('hidden');
				if(new_password == confirm_password){
					resetPassword(old_password,new_password);
				}else{
					$('.error-message-confirm-password').text('Password does not match');
					$('.js-loading-show').addClass('hidden');
					$('.text-left form').append('<button class="button js-loading-hide js-reset-button" type="submit" value="Reset">Reset</button>');
				}
			}
		});
		});
	</script>
	<style>
	</style>
</head>
<body class="centered" data-gr-c-s-loaded="true">
	<div id="page-region">
		<div class="section last">
			<div class="sub-section narrow">
				<div class="mbm">
					<!-- <a class="logo" href="https://calendly.com/">
						<img width="35" height="35" src="./signup1_files/logo_icon-5855fd7f1e3a31267dbb103936ea0db589e06132b13bf2086048a1020d764e3f.png">
					</a> -->
				</div>
				<div id="main-region">
					<div>
						<div class="js-step-region">
							<div>
								<div class="js-signup-region">
									<div>
										<div class="js-signup-internal-region"><div>
											<h3 class="sign-up-text">Reset Your Password.</h3>
											<div class="box text-left">
												<form class="js-form" novalidate="" autocomplete="off" method="post">
													<div class="field js-password-field">
														<h5>Enter old Password.</h5>
														<input class="old-password-input" name="passowrd" type="password">
														<div class="error-message error-message-old-password js-error-message"></div>
													</div>
													<div class="field js-password-field">
														<h5>Enter New Password.</h5>
														<input class="new-password-input" name="passowrd" type="password">
														<div class="error-message error-message-new-password js-error-message"></div>
														<div id="password-strength-status"></div>
													</div>
													<div class="field js-password-field">
														<h5>Confirm New Password.</h5>
														<input class="confirm-password-input" name="passowrd" type="password">
														<div class="error-message error-message-confirm-password js-error-message"></div>
													</div>
													<button class="button js-loading-hide js-reset-button" type="submit" value="Reset">Reset</button>
													<div class="button hidden js-loading-show spinner">
														<div class="bounce1"></div>
														<div class="bounce2"></div>
														<div class="bounce3"></div>
														<div class="bounce4"></div>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="js-locale-region"></div>
					<div class="js-analytics-region">
						<div></div>
					</div>
				</div>
			</div>
			<div id="root">
				<div id="main-region"></div>
			</div>
		</div>
	</div>
</div>
</body></html>