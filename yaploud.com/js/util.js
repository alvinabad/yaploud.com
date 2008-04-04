
function promptChatUrl() {
    var site_url = prompt("Enter URL of the site you want to chat:","http://")
    
    site_url = site_url.replace(/^\s\s*/, '').replace(/\s\s*$/, '');
    if (site_url == "" || site_url == "http://") {
        return;
    }
    
    site_url = encodeURIComponent(site_url);
    var url = "/chat/chat_window.php?url=" + site_url + "&iframe=yes";
    //var features = "width=320, height=320, status=yes, " +
    //               "menubar=no, toolbar=no, status=no, " +
    //               "location=no, resizable=yes, left=600, top=100";
    //window.open(url, "", features);
    document.location = url;
}

function xmlHttpCreate() {
	var req=null;
	try {
		req=new ActiveXObject("Msxml2.XMLHTTP");
	}
    catch(e) {
    	try {
    		req=new ActiveXObject("Microsoft.XMLHTTP");
        }
        catch(sc) {
    	    req=null;
        }
    }
    
    if(!req&&typeof XMLHttpRequest!="undefined") {
    	req=new XMLHttpRequest();
    }
    
    return req;
}


function addEvent(obj, evt, fn){
        if (obj.addEventListener){
            obj.addEventListener(evt, fn, true);
            return true;
	} else if (obj.attachEvent){
	    var r = obj.attachEvent("on" + evt, fn);
	    return r;
        } else {
            return false;
        }
}
