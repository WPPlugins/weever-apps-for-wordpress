jQuery(document).ready(function($) {
	
	$('body').append('<div id="weever-view-app" style="padding:5px;background-color: #000;color:#FFF;position:fixed;bottom:0;width:100%;z-index:100001;height:41px;font-family:arial;text-align:center;"><a href="' + WDesktop.url + '">Tap here to view mobile version</a></div>');

	$('#weever-view-app').click(function(){
		window.location.href = WDesktop.url;
	});
	
});