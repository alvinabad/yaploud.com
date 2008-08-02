
var yaploud_yaplet_el = document.getElementById('yaploud_yaplet');
if (yaploud_yaplet_el && document.location) {
	if (!yaplet_url) {
        var yaplet_url = document.location;
	}
	
	if (typeof(yaploud_client) == "undefined") {
		yaploud_client = '';
	}
	
	var yaploud_host = "www.yaploud.com";
	
    var code = '<iframe id="yaplet_iframe_id" class="yaplet_iframe_class" src=' + 
               '"http://' + yaploud_host + '/chat/chat_window.php?url=' + yaplet_url +
               '&title=' + yaplet_url + '&c=' + yaploud_client + '"' +
               ' scrolling="no" style="width:325px; ' +
               'height:320px" frameborder="1"></iframe>';
    
    yaploud_yaplet_el.innerHTML = code;
}
