<!DOCTYPE html>
<!-- saved from url=(0014)about:internet -->
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Lets Namaste | Login</title>
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
<script src="https://apis.google.com/js/api:client.js"></script>
<link href='css/getstarted.css' rel='stylesheet' />
<script src="js/library.js"></script>
<script src='js/config.js'></script>
<script src='js/login.js'></script>
<script src='js/getstarted.js'></script>


	<script>
		var googleUser = {};
		var email = getURLParameter('email',window.location.href);
		var startApp = function() {
			gapi.load('auth2', function(){
				auth2 = gapi.auth2.init({
					client_id: '450427852718-qqv5eqc4k0llqvq9jtfb59lipbqk9b0i.apps.googleusercontent.com',
					cookiepolicy: 'single_host_origin',
					login_hint: email,
				});
				attachSignin(document.getElementById('customBtn'));
			});
		};

		function attachSignin(element) {
			console.log('sssasss');
			auth2.attachClickHandler(element, {},
				function(googleUser) {
					logincustomergoogleAuth(googleUser.getAuthResponse().id_token);
				}, function(error) {
					window.location.reload();
				});
		}
		$(window).on('load',function(){
			$('.welcome_msg').text('Welcome back '+email);
		});
	</script>
  <style type="text/css">
	.or-seperator {
	  display:flex;
	  justify-content:center;
	  align-items: center;
	  color:grey;
	}

	.or-seperator:after,
	.or-seperator:before {
	    content: "";
	    display: block;
	    background: grey;
	    width: 30%;
	    height:1px;
	    margin: 0 10px;
	}
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
					<!-- <a class="logo" href="https://calendly.com/"><img width="35" height="35" src="./signup_files/logo_icon-5855fd7f1e3a31267dbb103936ea0db589e06132b13bf2086048a1020d764e3f.png">
					</a> -->
				</div>
				<div id="main-region">
					<div>
						<div class="js-step-region">
							<div>
								<h3 class="welcome_msg"></h3>
								<div class="box text-left">
									<div class="mbm">
										<p>The easiest way for you to sign up is with Google. This will automatically connect your calendar so you can start using Let's Namaste right away!</p>
									</div>
									<div class="field google-signup">
										<div id="gSignInWrapper">
											<div id="customBtn" class="customGPlusSignIn">
												<span class="icon"></span>
												<span class="buttonText">Sign In with Google</span>
											</div>
										</div>
										<div id="name"></div>
										<script>startApp();</script>
									</div>
									<div class="or-seperator"><i>or</i></div>
									<h5>Prefer to Login an account with a password?&nbsp;<a href="#" onclick="loginform()">Click Here</a>.</h5>
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