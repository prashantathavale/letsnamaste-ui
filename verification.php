<!DOCTYPE html>
<!-- saved from url=(0014)about:internet -->
<html><head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Lets namaste</title>
  <script src="js/library.js"></script>
	<script src='js/config.js'></script>
	<script src='js/verification.js'></script>
  <link href='css/verification.css' rel='stylesheet' />
  <script>
    $(window).on('load',function(){
      $('.verification_button').on('click',function(){
        var code = $('.verificationBox').val();
        if(code != ''){
          verifyCode(code);
        }
      });
    });
  </script>
</head>
<body class="centered" data-gr-c-s-loaded="true">
	<div id="page-region">
		<div class="section last">
			<div class="sub-section narrow">
				<div id="main-region">
					<div>
						<div class="js-step-region">
							<div>
								<div class="js-signup-region">
									<div>
										<div class="js-signup-internal-region">
											<div>
												<div class="js-confirmation-region">
													<div>
														<h1 class="pbl">
  Before continuing, we need to verify your email address. Please check your inbox for a code.
														</h1>
														<p class="js-error-hide js-loading-hide">
  															<input class="verificationBox" type="text" name="">
                                <button class="MOKW6___Button__cls1 Vhorz___styles-Container__cls1 _8XRb1___styles-Container__size-large _1-5mC___styles-Container__decoration-primary _2Ty7q___styles-Container__responsive _2UclO___styles-Container__onlyChild _1Qg-r___BareButton__cls1 _2zIir___index-UnstyledButton__cls1 verification_button" type="submit">
                                  <div class="OPKSe___styles-TextContainer__cls1">Submit</div>
                                </button>
  														</p>
  														<div class="hidden js-loading-show spinner">
  															<div class="bounce1"></div>
  															<div class="bounce2"></div>
  															<div class="bounce3"></div>
  														</div>
  														<div class="error-message error-message-email js-error-message"></div>
  													</div>
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
  </body>
</html>