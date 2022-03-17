<!DOCTYPE html>
<html style="" class=" history no-touchevents localstorage">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Lets Namaste | Profile page</title>
<link href='css/profile.css' rel='stylesheet' />
<script src="js/library.js"></script>
<script src='js/config.js'></script>
<script src='js/profile.js'></script>
<script>
	$(window).on('load',function(){
		window.userInfo = JSON.parse(localStorage.getItem('userInfo'));
        if(userInfo.hasOwnProperty('confirmation_time') == false){
          $('.js-toolbar-region div').show();
        }else{
          $('.js-toolbar-region div').hide();
        }
        var isMobileno = true;
		getUer();
		console.log('userInfo',userInfo);
		$('.profile-name').val(userInfo.full_name);
		$('.profile-email').val(userInfo.email);
		$('.profile-meeting-url').val(baseURL+'bookevent?appId='+userInfo.id);
		$('._1UxlO___avatar-AvatarElement__cls1 img').attr('src','images/guestuser.png');

		$('._3dR90___index-Input__cls1').on('change', function () {

		  var formData = new FormData();
		  formData.append('image', $('._3dR90___index-Input__cls1')[0].files[0]);

		  $.ajax({
		         url : apiLinks+'accounts/'+userInfo.id+'/uploadImage',
		         type : 'POST',
		         data : formData,
		         processData: false,
		         contentType: false,
		         headers: {appId:userInfo.id,accessKey:'letsnamaste_8428ecd711065166a86d03e902cebdd1'},
		         success : function(data) {
		             console.log(data);
		             $("._3sffF___avatar-Container__cls1").notify("Avatar updated successfully","success",{ position:"top center"});
		             $('._1UxlO___avatar-AvatarElement__cls1 img').attr('src',data.data.avatar_url);
		             localStorage.setItem('userAccountInfo',JSON.stringify(data.data));
		         },
		          error : function(data){
		            console.log('error',data);
		          }
		  });
		});
		$('.js-save').on('click',function(){
			controlParams = {};
			if($('.profile-contact-no').val() 	!= null){
				isMobileno = IsMobileNumber('profile-contact-no');
			}
			console.log('mobile',$('.profile-contact-no').val() == '', $('.profile-contact-no').val() == null);
			if(isMobileno == true || $('.profile-contact-no').val() == ''){
				var profileName 	= ($('.profile-name').val() 	!= null)		?	controlParams['full_name'] 	= $('.profile-name').val().capitalize() : '';
				var mobileNo 	= ($('.profile-contact-no').val() 	!= null)		?	controlParams['phone_number'] 	= $('.profile-contact-no').val() : '';
				var faceBookURL = ($('.profile-facebookURL').val() 	!= null) 		?	controlParams['facebook_url']	 = $('.profile-facebookURL').val()	: '';
				var linkedInURL = ($('.profile-linkedIn-url').val() != null)		?	controlParams['linkedin_url'] 	=$('.profile-linkedIn-url').val() : '';
				var twitterURL 	= ( $('.profile-twitterURL').val() 	!= null)		?	controlParams['twitter_url'] 	=$('.profile-twitterURL').val() : '';
				var instagramURL 	= ( $('.profile-instagramURL').val() != null)	?	controlParams['instagram_url'] 	=$('.profile-instagramURL').val() : '';
				var youtubeURL 	= ( $('.profile-youtubeURL').val() 	!= null)		?	controlParams['youtube_url'] 	=$('.profile-youtubeURL').val() : '';
				var tiktokURL 	= ( $('.profile-tiktokURL').val() 	!= null)		?	controlParams['tiktok_url'] 	=$('.profile-tiktokURL').val() : '';
				var websiteURL 	= ( $('.profile-websiteURL').val() 	!= null)		?	controlParams['website_url'] 	=$('.profile-websiteURL').val() : '';
				var about_me 	= ( $('.profile-description').val() != null)		?	controlParams['about_me'] 		=$('.profile-description').val() : '';
				updateUser(controlParams);
			}else{
				$('.error-message-mobileno').text('Please enter valid mobile number');
			}
		});
		$('.js-cancel').on('click',function(){
			window.location.reload();
		});
		$('.logout').on('click',function(){
			localStorage.clear();
			window.location = 'login';
		});
		$('.reset-password').on('click',function(){
			window.location = 'resetpassword';
		});
		$('.js-delete').on('click',function(){
			showDeletePopup();
		});

		$('._1flJn___button-CopyButton__cls1').click(function (e) {
		   e.preventDefault();
		   var copyText = $('.profile-meeting-url').val();

		   document.addEventListener('copy', function(e) {
		      e.clipboardData.setData('text/plain', copyText);
		      e.preventDefault();
		   }, true);

		   document.execCommand('copy');
		   console.log('copied text : ', copyText);
		 });
	});
</script>
</head>
<body class="legacy-body-layout" data-gr-c-s-loaded="true">
	<div id="page-region">
		<div id="popup-region"></div>
		<div id="root">
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
					<div class="_3Ib2a___user_menu-Container__cls1 _2pZHP___user_menu-Container__isTabletUp">
						<button aria-label="Account" class="_2nGlq___user_menu-UserMenuControl__cls1 _1Qg-r___BareButton__cls1 _2zIir___index-UnstyledButton__cls1" type="button">
							<!-- <div class="_30KQ4___user_menu-Avatar__cls1">
								<img alt="Avatar" src="https://d3v0px0pttie1i.cloudfront.net/uploads/user/avatar/5825862/5df0b373.jpg" class="_17fHX___user_menu-Img__cls1">
							</div> -->
							<a class="v8LMF___navigation_link-Link__cls1 _1Qg-r___BareButton__cls1 _2zIir___index-UnstyledButton__cls1" href="myevents">Home</a>
						</button>
					</div>
				</div>
			</header>
			<div id="legacy-flash-region" class="flash-region"></div>
			<div id="nav-region"></div>
			<div class="body-content">
				<div id="main-region">
					<div>
						<div class="subheader">
							<div class="wrapper">
								<h1>Account Settings</h1>
							</div>
						</div>
						<div class="wrapper">
							<div class="hidden-phone pbl"></div>
							<div class="adaptive row">
								<div class="col1of4 js-navigation-region">
									<div>
										<ul class="no-gutter page-navigation row">
											<li>
												<a href="#" data-tab="profile" class="">
													<span><strong>Profile</strong></span>
												</a>
											</li>
											<li>
												<buttom href="login" class="reset-password active" data-tab="login"><span>Reset Password</span>
												</buttom>
											</li>
											<li>
												<buttom href="login" class="logout active" data-tab="logout"><span>Log out</span>
												</buttom>
											</li>
										</ul>
									</div>
								</div>
								<div class="col3of4 js-main-region plm">
									<div>
										<div class="adaptive pbl row">
											<div class="col3of5">
												<div class="js-avatar-region">
													<div>
														<div class="_3sffF___avatar-Container__cls1">
															<div data-component="avatar_element" class="_1UxlO___avatar-AvatarElement__cls1 avatar-element x-large placeholder">
																<img alt="Avatar" src="images/guestuser.png">
															</div>
															<div>
																<label class="MOKW6___Button__cls1 Vhorz___styles-Container__cls1 R5pXI___styles-Container__decoration-outline _2Ty7q___styles-Container__responsive _1Qg-r___BareButton__cls1 _2zIir___index-UnstyledButton__cls1" type="button">
																	<div class="OPKSe___styles-TextContainer__cls1">Upload Picture
																		<input type="file" accept=".jpg, .jpeg, .png, .gif" class="_3dR90___index-Input__cls1">
																	</div>
																</label>
																<div class="_3O6Ps___avatar_controls-FormatString__cls1">JPG, GIF or PNG. Max size of 5MB.
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="field mbl">
													<label>Name</label>
													<input class="js-input profile-name" type="text" name="name" value="" maxlength="50" >
													<span class="error-message"></span>
												</div>
												<div class="field mbl">
													<label>Meeting URL:</label>
													<div class="meeting-url">
														<div class="_2QT18___ButtonGroup__cls1">
															<button class="_1flJn___button-CopyButton__cls1 MOKW6___Button__cls1 Vhorz___styles-Container__cls1 _2ZYno___styles-Container__size-small R5pXI___styles-Container__decoration-outline MfRDm___styles-Container__wide _1Qg-r___BareButton__cls1 _2zIir___index-UnstyledButton__cls1" type="button">
																<div class="OPKSe___styles-TextContainer__cls1">
																	<span class="_3MeR0___button-InitialState__cls1">Copy Link</span>
																</div>
															</button>
														</div>
														<input class="js-input profile-meeting-url" type="text" name="name" value="" disabled>
														<span class="error-message"></span>
													</div>
												</div>
												<div class="field mbl">
													<label>Welcome Message</label>
													<textarea class="expanding js-input legacy-styling-input profile-description" name="description" rows="4" maxlength="255">Welcome to my scheduling page. Please follow the instructions to add an event to my calendar.</textarea>
													<span class="error-message"></span>
												</div>
												<div class="field mbl">
													<label>Mobile Number</label>
													<input class="js-input profile-contact-no" id="profile-contact-no" type="text" name="name" value="" maxlength="50">
													<span class="error-message error-message-mobileno"></span>
												</div>
												<div class="field mbl">
													<label>Email</label>
													<input class="js-input profile-email" type="text" name="name" value="" maxlength="50" disabled>
													<span class="error-message"></span>
												</div>
												<div class="field mbl">
													<label>LinkedIn URL:</label>
													<input class="js-input profile-linkedIn-url" type="text" name="name" value="">
													<span class="error-message"></span>
												</div>
												<div class="field mbl">
													<label>FaceBook URL:</label>
													<input class="js-input profile-facebookURL" type="text" name="name" value="">
													<span class="error-message"></span>
												</div>
												<div class="field mbl">
													<label>Twitter URL:</label>
													<input class="js-input profile-twitterURL" type="text" name="name" value="">
													<span class="error-message"></span>
												</div>
												<div class="field mbl">
													<label>Youtube URL:</label>
													<input class="js-input profile-youtubeURL" type="text" name="name" value="">
													<span class="error-message"></span>
												</div>
												<div class="field mbl">
													<label>Instagram URL:</label>
													<input class="js-input profile-instagramURL" type="text" name="name" value="">
													<span class="error-message"></span>
												</div>
												<div class="field mbl">
													<label>TikTok URL:</label>
													<input class="js-input profile-tiktokURL" type="text" name="name" value="">
													<span class="error-message"></span>
												</div>
												<div class="field mbl">
													<label>Website URL:</label>
													<input class="js-input profile-websiteURL" type="text" name="name" value="">
													<span class="error-message"></span>
												</div>
											</div>
										</div>
										<div class="decision pvm row"><a class="button js-save" href="#">
											<div class="label">Save Changes</div>
											<div class="js-spinner spinner">
												<div class="bounce1"></div>
												<div class="bounce2"></div>
												<div class="bounce3"></div>
											</div>
										</a>
										<button class="align-top button hollow js-cancel">Cancel</button>
										<button class="button hollow js-delete lock-right mobile-separate">Delete Account</button>
									</div>
									<div class="pbl">&nbsp;</div>
								</div>
							</div>
						</div>
					</div>
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
</body>
</html>