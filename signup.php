<!DOCTYPE html>
<html><head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
 	<script src="https://apis.google.com/js/api:client.js"></script>
	<title>Lets Namaste</title>
	<link href='css/signup.css' rel='stylesheet' />
	<script src="js/library.js"></script>
	<script src='js/config.js'></script>
	<script src='js/signup.js'></script>
	<script>
		var googleUser = {};
		var email = getURLParameter('email',window.location.href);
		var startApp = function() {
			gapi.load('auth2', function(){
				auth2 = gapi.auth2.init({
					client_id: '450427852718-qqv5eqc4k0llqvq9jtfb59lipbqk9b0i.apps.googleusercontent.com',
					cookiepolicy: 'single_host_origin',
					login_hint: email,
					/*scope:'https://www.googleapis.com/auth/calendar.events',*/
				});
				attachSignin(document.getElementById('customBtn'));
			});
		};

		function attachSignin(element) {
			console.log('sssasss');
			auth2.attachClickHandler(element, {},
				function(googleUser) {
					createcustomergoogleAuth(googleUser.getAuthResponse().id_token);
				}, function(error) {
					window.location.reload();
				});
		}
		$(window).on("load", function() {
			var signupName = signUpemail = signupPassword = '';
			$('.sign-up-text').text('Hi '+getURLParameter('email',window.location.href));
			$('.email-input').val(getURLParameter('email',window.location.href));
			$('.signup-password').keyup(function(){
				checkPasswordStrength('.signup-password');
			});
		});
	</script>
  <style type="text/css">
    #customBtn {
      display: inline-block;
      background: white;
      color: #444;
      width: 190px;
      border-radius: 5px;
      border: thin solid #dcd7d7d6;
      white-space: nowrap;
    }
    #customBtn:hover {
      cursor: pointer;
    }
    span.label {
      font-family: serif;
      font-weight: normal;
    }
    span.icon {
      background: url('https://developers.google.com/identity/sign-in/g-normal.png') transparent 5px 50% no-repeat;
      display: inline-block;
      vertical-align: middle;
      width: 42px;
      height: 42px;
    }
    span.buttonText {
      display: inline-block;
      vertical-align: middle;
      padding: 2px;
      font-size: 14px;
      font-weight: bold;
      font-family: 'Roboto', sans-serif;
    }
  </style>
</head>
<body class="centered" data-gr-c-s-loaded="true">
	<div id="page-region">
		<div class="section last">
			<div class="sub-section narrow">
				<div class="mbm">
				</div>
				<div id="main-region">
					<div>
						<div class="js-step-region">
							<div>
								<div class="js-signup-region">
									<div>
										<div class="js-signup-internal-region"><div>
											<h3 class="sign-up-text"></h3>
											<div class="box text-left">
												<div class="mbm">
													<p>The easiest way for you to sign up is with Google. This will automatically connect your calendar so you can start using Let's Namaste right away!</p>
												</div>
													<div class="field google-signup">
													  <div id="gSignInWrapper">
													    <div id="customBtn" class="customGPlusSignIn">
													      <span class="icon"></span>
													      <span class="buttonText">Sign Up with Google</span>
													    </div>
													  </div>
													  <div id="name"></div>
													  <script>startApp();</script>
													</div>
													<div class="or-seperator"><i>or</i></div>
													<h5>Prefer to create an account with a password?&nbsp;<a href="#" onclick="signUpform()">Click Here</a>.</h5>
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