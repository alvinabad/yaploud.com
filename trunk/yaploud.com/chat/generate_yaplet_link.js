
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
	if (typeof(yaplet_with_ad) != "undefined" && yaplet_with_ad) {
	    var code = '<a href="javascript:window.open(\'' +
	    script_domain + '/test/ad_template_test.php' + 
        '?yaploud_embedded=true&yaplink_name=' + yaplink_name + 
        '&yaploud_client=' + yaploud_client +
        '&yaploud_css=' + yaploud_css + 
	    '\',\'\',\'width=500,height=325,status=yes,scrollbars=no,menubar=no,toolbar=no,location=no,resizable=yes\')">' + 
	    yaplink_name + '</a>';
	}
    else if (typeof(yaploud_embedded) != "undefined" && yaploud_embedded) {
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
