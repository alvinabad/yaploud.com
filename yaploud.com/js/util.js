
function $(s) {
    return document.getElementById(s);
}

function trim(str) {
    if (!str) {
        return str;
    }
	    
    return str.replace(/^\s\s*/, '').replace(/\s\s*$/, ''); 
}

function addslashes(str) {
    if (!str) {
        return str;
    }
    
    str=str.replace(/\'/g,'\\\'');
    str=str.replace(/\"/g,'\\"');
    str=str.replace(/\\/g,'\\\\');
    str=str.replace(/\0/g,'\\0');
    return str;
}

var ext_url;
function openChatWindow(site_url, title) {
	if (site_url == null) {
		site_url = ext_url;
	}
	
	if (title == null) {
		title = ext_title;
	}
	
	// check if attempting to chat same site
	if (site_url.indexOf(location.hostname) != -1) {
        return;
	}
	
	// bypass Apache' mod_security: Access denied with code 503 
    title = title.replace(/\s+\|/g, ' -').replace(/\|\s+/g, '- '); 
    
    site_url = encodeURIComponent_recursive(site_url);
    title = encodeURIComponent_recursive(title);
    var url = "/chat/chat_window.php?url=" + site_url + "&title=" + title;
    
    var features = "width=340, height=340, status=yes, " +
                   "scrollbars=1, menubar=no, toolbar=no, " +
                   "location=no, resizable=yes";
                   //"location=no, resizable=yes, left=100, top=100";
    window.open(url, "", features);
}

function promptChatUrl() {
    var site_url = prompt("Enter URL of the site you want to chat:","http://")
    var title;
    
    site_url = trim(site_url);
    if (site_url == "" || site_url == "http://") {
        return;
    }
    
    title = site_url;
    openChatWindow(site_url, title);
}

function displayBrowserInfo() {
    var browser = "Browser Information\n";  
    for(var propname in navigator) {
        browser += propname + ": " + navigator[propname] + "\n";
    }
    alert(browser);
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
    } 
    else if (obj.attachEvent){
	    var r = obj.attachEvent("on" + evt, fn);
	    return r;
    } 
    else {
        return false;
    }
}

function decodeURIComponent_recursive(url) {
    new_url = decodeURIComponent(url);
    if (new_url == url) {
        return url;
    }
    return decodeURIComponent_recursive(new_url);
}

function encodeURIComponent_recursive(url) {
    url = decodeURIComponent_recursive(url);
    return encodeURIComponent(url);
}
