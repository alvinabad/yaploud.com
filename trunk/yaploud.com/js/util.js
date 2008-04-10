
function $(s) {
    return document.getElementById(s);
}

function trim(str) {
    if (!str) {
        return str;
    }
	    
    return str.replace(/^\s\s*/, '').replace(/\s\s*$/, ''); 
}

function openChatWindow(site_url, title) {
    site_url = encodeURIComponent(site_url);
    var url = "/chat/chat_window.php?url=" + site_url +
             "&title=" + title;
    var features = "width=320, height=320, status=yes, " +
                   "menubar=no, toolbar=no, status=no, " +
                   "location=no, resizable=yes, left=100, top=100";
    window.open(url, "", features);
}

function promptChatUrl() {
    var site_url = prompt("Enter URL of the site you want to chat:","http://")
    
    site_url = trim(site_url);
    if (site_url == "" || site_url == "http://") {
        return;
    }
    
    openChatWindow(site_url, site_url);
    
    //site_url = encodeURIComponent(site_url);
    //document.location = url;
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
	} else if (obj.attachEvent){
	    var r = obj.attachEvent("on" + evt, fn);
	    return r;
        } else {
            return false;
        }
}
