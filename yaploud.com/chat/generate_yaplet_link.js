
function includeJavascript(src) {
    if (document.createElement && document.getElementsByTagName) {
        var head_tag = document.getElementsByTagName('head')[0];
        var script_tag = document.createElement('script');
        script_tag.setAttribute('type', 'text/javascript');
        script_tag.setAttribute('src', src);
        head_tag.appendChild(script_tag);
    }
}

var script_domain = '';
if (location.hostname.indexOf('localhost') == 0) {
}
else if (location.hostname.indexOf('yaploud') == -1) {
	script_domain = "http://www.yaploud.com";
}
includeJavascript(script_domain + '/js/util.js');


var yaploud_yaplink_el = document.getElementById('yaploud_yaplink');
yaploud_yaplink_el.setAttribute('id', '');
if (yaploud_yaplink_el && document.location) {
	if (!yaplink_url) {
        var yaplink_url = document.location;
	}
	
	if (!yaplink_name) {
        var yaplink_name = 'Discuss on YapLoud';
	}
	
	if (typeof(yaploud_client) == "undefined") {
		yaploud_client = '';
	}
        
	if (typeof(yaploud_css) == "undefined") {
		yaploud_css = '';
	}

    if (typeof(yaploud_embedded) != "undefined" && yaploud_embedded) {
        var code = '<iframe id="chatFrame" ' +
                    'src=http://www.yaploud.com/chat/chat_window.php?url=' + yaplink_url +  
                    '&c=' + yaploud_client +
                    '&yaploud_css=' + yaploud_css +
                    '" frameborder="0"></iframe>';
    } else {
        var code = '<a id="yaplink_href_id" class="yaplink_href_class" ' +
                   'href="javascript: ' +
                   'openChatWindow(' +
                   "'" + yaplink_url + "', " +
                   "'" + yaplink_url + "', " + 
                   "'" + yaploud_client + "', " +
    			   "'" + yaploud_css + "')" +
                   '; void 0;' + '"' +
                   '>' + yaplink_name + '</a>';         
    }
    yaploud_yaplink_el.innerHTML = code;
}
