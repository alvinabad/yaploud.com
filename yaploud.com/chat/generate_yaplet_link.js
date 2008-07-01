
function includeJavascript(src) {
    if (document.createElement && document.getElementsByTagName) {
        var head_tag = document.getElementsByTagName('head')[0];
        var script_tag = document.createElement('script');
        script_tag.setAttribute('type', 'text/javascript');
        script_tag.setAttribute('src', src);
        head_tag.appendChild(script_tag);
    }
}

includeJavascript('http://www.yaploud.com/js/util.js');

var yaploud_yaplink_el = document.getElementById('yaploud_yaplink');
yaploud_yaplink_el.setAttribute('id', '');
if (yaploud_yaplink_el && document.location) {
	if (!yaplink_url) {
        var yaplink_url = document.location;
	}
	
	if (!yaplink_name) {
        var yaplink_name = 'Open Yaplet';
	}
	
    var code = '<a id="yaplink_href_id" class="yaplink_href_class" ' +
               'href="javascript: ' +
               'openChatWindow(' +
               "'" + yaplink_url + "', " +
               "'" + yaplink_url + "', " + yaploud_client + 
               ")" +
               '; void 0;' + '"' +
               '>' + yaplink_name + '</a>'; 
    yaploud_yaplink_el.innerHTML = code;
}
