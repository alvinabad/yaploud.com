

/**
<!-- 
<script type="text/javascript" src="/js/yui/build/yahoo/yahoo-min.js" ></script> 
<script type="text/javascript" src="/js/yui//build/event/event-min.js" ></script> 
<script type="text/javascript" src="/js/yui/build/yahoo/yahoo-min.js"> </style>
<script type="text/javascript" src="/js/yui/build/event/event-min.js" > </script> 
<script type="text/javascript"
    src="/js/yui/build/yahoo-dom-event/yahoo-dom-event.js">
</style>
<script
    type="text/javascript" src="/js/yui/build/utilities/utilities.js">
</script>
 -->
**/


var title_header = "YapLoud.com";
var poll_interval = 5000;
var poll_interval_id;
var url_GetMessages = "/get_msg.php";

function getMessages() {
	//alert('xxx');
}

function displayBrowserInfo() {
    var browser = "Browser Information\n";	
    for(var propname in navigator) {
    	browser += propname + ": " + navigator[propname] + "\n";
    }
    alert(browser);
}

function openChatWindow(site_url, title) {
	var url = "/chat/chat_window.php?url=" + site_url +
	          "&title=" + title;
	var features = "width=320, height=320, status=yes, " +
			       "resizable=no, left=600, top=100";
    window.open(url, "", features);
}

function generateContent() {
	var url = site_url;
	url = appendHttp2Url(url);
	
    var title = document.getElementById('hd');
    html_text = "<strong>Yapping about: </strong>";
    
    // check type of browser
    if (navigator.userAgent.indexOf('Firefox') != -1) {
    	var features = 'location=yes, menubar=yes, scrollbars=yes, ' +
                       'status=yes, toolbar=yes'; 
        var js_href = 'javascript: window.open(\'' + url +
                      '\'' + ', \'\', ' + '\'' + features +
                      '\'' + '); void 0;'; 
        html_text += '<a href="' + js_href + '">';
    } else {
        html_text += '<a href="' + url + '" target="_blank">';
    }
    
    html_text += site_title + "</a>";
    title.innerHTML = html_text;
	
	var links_div = document.getElementById('links');
	html_text = "<a href='#'>Login</a>"
	html_text += " | <a href='#'>Help</a>"
	html_text += "<br> <a href='#'>Signup</a>"
	links_div.innerHTML = html_text;
}

function includeJavaScript(js_src) {
  document.write('<script type="text/javascript" src="'
    + js_src + '"></script>'); 
}

function appendHttp2Url(url) {
	if ( url.indexOf('http') == -1 ) {
        url = 'http://' + url;  
        // if protocol is not found, append http
        // this could be https but that's the best we can do
	}
    return url;
}

function removeHttp(url) {
    if ( url.substr(0,7) == "http://" ) {
        url = url.replace(/^http:\/\//, '');
    }
    else if ( url.substr(0,8) == "https://" ) {
        url = url.replace(/^https:\/\//, '');
    }
    
    return url;
}

/***************************************************************************/

var last_msg_id = -1;
var last_color = "on_row"; 
var on_color = "on_row";
var off_color = "off_row";
var already_hidden = false;
var sl = null;

function getNextColor(last_color){
    if(last_color == on_color){return off_color;}
        return on_color;
    }

function renderMsgs(obj, prepend){
    var msgs_div = document.getElementById('msg');
    var msgs = obj.msgs;
    var len = msgs.length;
    var tmp_html = '';
    for(var i = len-1; i >= 0; i--){
        var color = getNextColor(last_color); 
        last_color = color;
        tmp_html += '<div class="row ' + last_color + '">' +
                    //'<span class=msg_time>[' + 
                    //msgs[i].t + 
                    //']</span> ' + 
                    '<span class="sender">' + msgs[i].s + '</span>:' +
                    " <span class=msg>" + msgs[i].msg + "</span></div>\n"; 
    }

    if(prepend){
        msgs_div.innerHTML = tmp_html + msgs_div.innerHTML;
    }
    else{
        msgs_div.innerHTML += tmp_html; 
    }
    
    msgs_div.scrollTop = msgs_div.scrollHeight;
    if ( navigator.appName == "Microsoft Internet Explorer" ) {
        msgs_div.scrollTop = msgs_div.scrollHeight; // IE7 requires running this twice!
    }
}
   
function renderYappers(obj) {
	/**
    if(!already_hidden){
        sl.hide();
        already_hidden = true;
    }
    */
    var users = obj.users;
    var users_el = document.getElementById('yappers');
    users_el.innerHTML = '';
    for(var i = 0; i < users.length; i++){
        users_el.innerHTML += "<div class=room_user>" + users[i] + "</div>";
    }
}

/*****************************************************************************
 * Get Messages Object
 *****************************************************************************/
var GetMessages = {
    handleFailure:function(o){
        alert('GetMessages handleFailure');
    },

    handleSuccess:function(o){
        // This member is called by handleSuccess
        var obj = eval('(' + o.responseText + ')'); 
	    var msgs = obj.msgs;
	    if(msgs.length > 0){
	        if(msgs[0].id <= last_msg_id) {
			    return;
		    }
            renderMsgs(obj); 
            renderYappers(obj);
	   }
    },

    sendRequest:function() {
        if (!site_url)
            site_url = 'http://cmu.facebook.com/profile.php?id=4813337';
            
    	site_url = removeHttp(site_url);
	    site_url = encodeURIComponent(site_url);
	            
        url = url_GetMessages + '?url=' + site_url + "&last_msg_id=" + last_msg_id;
        YAHOO.util.Connect.asyncRequest('GET', url, GetMessages_callback, null);
    },

    startPolling: function() {
	    GetMessages.sendRequest();
	    poll_interval_id = setInterval(GetMessages.sendRequest, poll_interval);
        chat_mode_div = document.getElementById('chat_mode');
        chat_mode_div.innerHTML = 
            '<a href="javascript: GetMessages.stopPolling();">Suspend Chat</a>';
    },

    stopPolling: function() {
        clearInterval(poll_interval_id);
        chat_mode_div = document.getElementById('chat_mode');
        chat_mode_div.innerHTML = 
            '<a href="javascript: GetMessages.startPolling();">Resume Chat</a>';
    },

};

var GetMessages_callback = {
    success: GetMessages.handleSuccess,
    failure: GetMessages.handleFailure,
    scope: GetMessages,
    timeout: 5000,
    cache: false
};

/*****************************************************************************
 * Send Message Object
 *****************************************************************************/
var SendMessage = {
    handleFailure:function(o){
        alert('GetMessages handleFailure');
    },

    handleSuccess:function(o){
        // This member is called by handleSuccess
        var obj = eval('(' + o.responseText + ')'); 
        var msgs = obj.msgs;
        if(msgs.length > 0){
            if(msgs[0].id <= last_msg_id) {
                return;
            }
            renderMsgs(obj); 
            renderYappers(obj);
       }
    },

    sendRequest:function() {
        site_url = encodeURIComponent(site_url);
        
        url = url_GetMessages + '?url=' + site_url + "&last_msg_id=" + last_msg_id;
        YAHOO.util.Connect.asyncRequest('GET', url, SendMessage_callback, null);
    }

};

var SendMessage_callback = {
    success: SendMessage.handleSuccess,
    failure: SendMessage.handleFailure,
    scope: SendMessage,
    timeout: 5000,
    cache: false
};

var Chat = {
	onunload: function() {
	},
	
}

/************************************************************/

function init() {
	generateContent();
    GetMessages.startPolling();
    //startPolling();
}

function quit() {
    alert('closing window');	
}

YAHOO.util.Event.onDOMReady(init);
//YAHOO.util.Event.addListener(body, "onunload", quit); 



//YAHOO.util.Event.onAvailable('main', init);
//YAHOO.util.Event.on(window, "load", init);
//YAHOO.util.Event.addListener("elementid", "click", fnCallbac); 
//document.write('<link rel="stylesheet" type="text/css" href="/chat/embedded_chat.css" />');
