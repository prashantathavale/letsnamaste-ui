<!DOCTYPE html>
<html>
<head>
	<title>lets namaste | payment</title>
	<script src='js/library.js'></script>
	<script src='js/config.js'></script>
	<script>
		$(window).on('load',function(){
			$('.accept').on('click',function(){
				console.log('clicked');
				// window.opener.postMessage({'action':'paid'},'*');
				bc.postMessage({'action':'paid'},'*');
				window.close();
			});
			$('.deny').on('click',function(){
				// console.log('clicked');
				// window.opener.postMessage({'action':'deny'},'*');
				bc.postMessage({'action':'deny'},'*');
				window.close();
			});
		});
	</script>
</head>
<body>
	<div>
		<button class="accept">
			<div> Pay </div>
		</button>
		<button class="deny">
			<div> Cancel </div>
		</button>
	</div>
</body>
</html>