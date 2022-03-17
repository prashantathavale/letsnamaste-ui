<!DOCTYPE html>
<html>
<head>
	<title> Lets Namaste | Meeting Call</title>
	<meta name="viewport" content="width=device-width, initial-scale=0.86, maximum-scale=3.0, minimum-scale=0.86">
	<script src='js/library.js'></script>
	<script type="text/javascript" src="https://unpkg.com/@cometchat-pro/chat@2.0.10/CometChat.js"></script>
	<script>

	let date = new Date();
	let timestamp = date.getTime();
	var chat_appid = '52250';
	var chat_auth = '4c7cab6303c5d68aa18668150b6a040b';
	var chat_id = 'uid_'+timestamp;
	var chat_name = 'Letsnamaste_user_'+Math.floor(Math.random() * 101);
	var urlParams = getURLParameter('urlParam',window.location.href);
		urlParams = atob(urlParams);
		urlParams = JSON.parse(urlParams);
	var sessid = urlParams.sessid;
	var guid = urlParams.guid;
	console.log('urlParams',urlParams,'guid',guid);
	var creditparams = btoa(JSON.stringify({isGroup:true,layout: 'embedded',name:'avchat',sess_id: sessid}));
	window.onload = (function () {
	var appId = "204122571c0d982";
	// $('#letsnamaste_trayicon_avcall_iframe').prop('src', 'https://rtc-web-us.cometchat.io/?sessionID='+sessid+'&username=NewURL');
	$('#letsnamaste_trayicon_avcall_iframe').prop('src', 'https://s.chatforyoursite.com/6.0/?v1=Turn%20On%20Video&v0=Turn%20Off%20Video&m1=Turn%20On%20Mic&m0=Turn%20Off%20Mic&room='+guid+'c&sess_id='+sessid+'&username='+chat_name+'&mobileNewWindow=1');
	/*$('#letsnamaste_trayicon_avcall_iframe').prop('src', 'https://rtc-us.cometchat.io/'+sessid+'#config.startWithAudioMuted=false&config.startWithAudioMuted=false');*/
	});
	</script>
<style>
	iframe {
	height: 700px;
	width: 100%
	}
	.callScreen{
    min-height: 740px;
    width: 100%;
    padding: 10px;
	}
	.letsnamaste_container {
	display: flex;
	width: 100%;
	min-width: 100%;
	flex-direction: row;
	}
	.letsnamaste_group {
	    width: 40%;
	    padding: 10px;
	}
	div#cometchat_embed_chatrooms_container {
	    width: 100%;
	}
</style>
</head>
<body>
<script type="text/javascript">


</script>
<div class="letsnamaste_container">
	<div id='callScreen' class="callScreen" style="min-height: 740px;">
		<iframe class="letsnamaste_iframe" id="letsnamaste_trayicon_avcall_iframe" width="100%" height="740px"  allowtransparency="true" frameborder="0"  scrolling="no" allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true" allow="geolocation; microphone; camera; midi; encrypted-media;"></iframe>
	</div>
	<div class="letsnamaste_group">
		<div id="cometchat_embed_chatrooms_container" style="display:inline-block; border:1px solid #CCCCCC;"></div>
		<script type="text/javascript" charset="utf-8" src="//fast.cometondemand.net/52250x_x219d4x_xcorex_xembedcode.js?v=7.50.4.2"></script>
		<script>var iframeObj = {};iframeObj.module="chatrooms";iframeObj.style="min-height:420px;min-width:300px;";iframeObj.src="https://52250.cometondemand.net/cometchat_embedded.php?guid="+guid;iframeObj.width="600";iframeObj.height="300";if(typeof(addEmbedIframe)=="function"){addEmbedIframe(iframeObj);}
		</script>
	</div>
</div>

</body>
</html>