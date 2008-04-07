
var currentLocation = "";
var numYappers = 0;
var timerInterval = 15000;
var functionTimer = null;

window.addEventListener("load", function() {
  var appcontent = window.document.getElementById("appcontent");
  if (appcontent) {
    if (!appcontent.yaploud) {
      appcontent.yaploud = true;
      //appcontent.addEventListener("DOMContentLoaded", yaploud_new_url, false);
      appcontent.addEventListener("load", yaploud_new_url, true);
    }
  }
}, false);

function yaploud_tabSelected(event) {
  yaploud_new_url(null);
}

// During initialization
var browser = window.getBrowser();

if (browser.tabContainer) {
	browser.tabContainer.addEventListener("TabSelect", yaploud_tabSelected, false);
} else {
	var container = browser.mPanelContainer;
	container.addEventListener("select", yaploud_tabSelected, false);
}

// Get the yappers and set the timer
yaploud_getYappers();
// Set the timer to check for yappers every few seconds.
if (functionTimer == null) {
	functionTimer = window.setInterval(yaploud_getYappers, timerInterval);
}

// This function will be called whenever a new page is loaded
function yaploud_new_url(evt) {

	var winWrapper = new XPCNativeWrapper(content, "doc");
	var mainDocument = new XPCNativeWrapper(winWrapper.document, "top");
	if (mainDocument.location != "" && mainDocument.location != "about:blank") {
		yaploud_enableButtons();
		yaploud_getYappers();
	} else {
		yaploud_disableButtons();
	}
	
}

function yaploud_enableButtons() {

	var winWrapper = new XPCNativeWrapper(content, "doc");
	var mainDocument = new XPCNativeWrapper(winWrapper.document, "top");
	currentLocation = yaploud_normalizeURL(mainDocument.location);

	var chatButton = document.getElementById("yaploud_chatButton");
	chatButton.setAttribute("disabled", "false");
}

function yaploud_disableButtons() {
	var chatButton = document.getElementById("yaploud_chatButton");
	chatButton.setAttribute("disabled", "true");
}

// This function provides a browser-neutral method of getting an AJAX XMLHttp object
function yaploud_createXHR() {
	if (typeof XMLHttpRequest != "undefined") {
		return new XMLHttpRequest();
	} else if (window.ActiveXObject) {
		var aVersions = ["MSXML2.XMLHttp.6.0", "MSXML2.XMLHttp.3.0"];
		for (var i = 0; i < aVersions.length; i++) {
			try {
				var oXHR = new ActiveXObject(aVersions[i]);
				return oXHR;
			} catch (oError) {
				//do nothing
			}
		}
	}
	
	// We couldn't create an object, throw an error
	throw new Error("XMLHttp object could not be created.");
}


// This function will retrieve the number of yappers on the site  
function yaploud_getYappers() {
	var oXHR = yaploud_createXHR();
	//var addr = "http://www.yaploud.com/get_usercnt.php?url=" + encodeURIComponent(currentLocation);
	var addr = "http://www.yaploud.com/chat/getUserCount.php?url=" + encodeURIComponent(currentLocation);
	
	oXHR.open("GET", addr, true);
	// Set up the response handler
	oXHR.onreadystatechange = function () {
	
		if (oXHR.readyState == 4) {
			// Request completed, check response code
			if (oXHR.status == 200) {
				// Request completed successfully, process the returned comments
				
				var usernum = eval( '(' + oXHR.responseText + ')' );
				var chatButton = document.getElementById("yaploud_chatButton");
				chatButton.setAttribute("label", usernum + " Yapper(s)");
			}		
		}	
	}
	
	oXHR.send(null);
}

function getDocumentDescription() {
	var winWrapper = new XPCNativeWrapper(content, "doc");
    var mainDocument = new XPCNativeWrapper(winWrapper.document, "top");
	
    var meta_tag = mainDocument.getElementsByTagName('meta');
    var name;
    var description = '';
    var description_content = '';
    var keywords_content = '';

    if (description) alert(description);

    for(var i=0; i<meta_tag.length; i++) {
        name = meta_tag[i].getAttribute('name');
        description = meta_tag[i].getAttribute('content');

        if ( name && name.toLowerCase() == 'description' && description ) {
            description_content = description;
        }
        else if ( name && name.toLowerCase() == 'keywords' && description ) {
            keywords_content = description;
        }
        description = '';
    }

    if (description_content) {
        return description_content;
    }
    else if (keywords_content) {
        return keywords_content;
    }

    return '';
}

function openChatWindow(site_url, title, description) {
	var host = 'http://www.yaploud.com';
	//host = 'http://yaploud';
    var uri = "/chat/chat_window.php?url=" + site_url +
              "&title=" + title +
	          '&update=info' +
	          '&description=' + description; 
	          
    uri = encodeURIComponent(uri);
    var url = host + uri;
    
    var features = "width=320, height=320, status=yes, " +
                   "menubar=no, toolbar=no, status=no, " +
                   "location=no, resizable=yes, left=600, top=100";
    window.open(url, "", features);
}

function yaploud_chatAtYaploud(event) {
	// This function redirects the user to YapLoud.com to chat there
	var winWrapper = new XPCNativeWrapper(content, "doc");
	var mainDocument = new XPCNativeWrapper(winWrapper.document, "top");

	var ref_url = mainDocument.location;
	var title = mainDocument.title;
	var description = getDocumentDescription();
	
	if (ref_url.indexOf("yaploud") == -1) {
		openChatWindow(ref_url, title, description);
		
		/**
   	    title = encodeURIComponent(mainDocument.title);
	    description = encodeURIComponent(description);
	    ref_url = encodeURIComponent(ref_url);
	
        var host = 'http://www.yaploud.com';
	    mainDocument.location = host + '/chat/chat_window.php?url=' + 
	                        ref_url + 
	                        '&title=' + title +
	                        '&update=info' +
	                        '&iframe=yes' + 
	                        //'&update=Update' +
	                        '&description=' + description; 
	    * **/
	}
	                        
	return;
}



/********************************************************************
 * Below are various utility functions
 ********************************************************************/

function yaploud_normalizeURL(url) {

	url = String(url);
	
	if (url.indexOf("http://") != -1) {
		
		url = url.substr(url.indexOf("http://") + 7);
	
	}
	
	if (url.lastIndexOf("/") == url.length - 1) {
	
		url = url.substr(0, url.length - 1);
	
	}
	
	return url;

}


