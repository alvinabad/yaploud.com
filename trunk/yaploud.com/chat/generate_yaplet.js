
var yaploud_yaplet_el = document.getElementById('yaploud_yaplet');
if (yaploud_yaplet_el && document.location) {
	if (!url) {
        var url = document.location;
	}
    var code = '<iframe id="yaplet_iframe_id" class="yaplet_iframe_class" src=' + 
               '"http://www.yaploud.com/chat/chat_window.php?url=' + url +
               '&title=' + url + '"' +
               ' scrolling="no" style="width:325px; ' +
               'height:320px" frameborder="1"></iframe>';
    
    yaploud_yaplet_el.innerHTML = code;
}
