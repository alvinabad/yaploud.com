
var title_header = "YapLoud.com";
var poll_interval = 5000;
var poll_interval_id;
var url_GetMessages = "/get_msg.php";
var url_SendMessage = "/put_msg.php";
var url_SendLogout = "/chat/logout";
var bd_content = '';
var chatWidgetMinimize = false;
var loginname = '';

function $(s) {
    return document.getElementById(s);
}

function onClosePanel() {
    openWindow(site_url);
    closeWindow();
}

function openWindow(url) {
    var url = decodeURIComponent(url);
    url = appendHttp2Url(url);
    window.open(url);
}

function closeWindow() {
    window.open('','_self','');
    window.close();
}

function popout(site_url, site_title) {
	openWindow(site_url);
    //if (navigator.appName == 'Microsoft Internet Explorer') {
    
    setTimeout(closeWindow, 3000);
    openChatWindow(site_url, site_title);
}

function popin(site_url, site_title) {
    openPopinWindow(site_url, site_title);
    closeWindow();
}

function minimizeChatWidget() {
    bd_div = document.getElementById('bd0');	
	if (chatWidgetMinimize) {
        bd_div.innerHTML = bd_content;
        chatWidgetMinimize = false;
        GetMessages.startPolling();
	}
	else {
        GetMessages.stopPolling();
        bd_content = bd_div.innerHTML;
        bd_div.innerHTML = '';
        chatWidgetMinimize = true;
	}
}

function displayBrowserInfo() {
    var browser = "Browser Information\n";	
    for(var propname in navigator) {
    	browser += propname + ": " + navigator[propname] + "\n";
    }
    alert(browser);
}

function openChatWindow_old(site_url, title) {
	var url = "/chat/chat_window.php?url=" + site_url +
	          "&title=" + title;
	var features = "width=320, height=320, status=yes, " +
			       "location=no, resizable=no, left=600, top=100";
    window.open(url, "", features);
}

function openPopinWindow(site_url, title) {
	site_url = encodeURIComponent(site_url);
    var url = "/chat/chat_window.php?url=" + site_url +
             "&title=" + title + "&iframe=yes";
    var features = "width=800, height=640, status=yes, " +
                   "menubar=yes, toolbar=yes, location=yes, resizable=yes";
    window.open(url, "", features);
}

function openExternalWindow(url) {
    var features = "width=800, height=640, status=yes, " +
                   "menubar=yes, toolbar=yes, location=yes, resizable=yes";
    window.open(url, "", features);
}

function openChatWindow(site_url, title) {
    var url = "/chat/chat_window.php?url=" + site_url +
             "&title=" + title;
    var features = "width=320, height=320, status=yes, " +
                   "menubar=no, toolbar=no, status=no, " +
                   "location=no, resizable=yes, left=600, top=100";
    window.open(url, "", features);
}

function generateContent() {
	var url = site_url;
	url = appendHttp2Url(url);
	
    var title = document.getElementById('hd_title');
    var html_text = "<strong>Yapping about: </strong>";
    html_text = '';
    
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
}

function logout() {
    var continue_logout = confirm("Are you sure you want to log out?");	
    if (continue_logout) {
    	SendLogout.sendRequest(url_SendLogout);
    } 
}

function updateLoginInfo(username) {
	var login_info_html;
	
	if (username.substr(0,5) == 'guest') {
		login_info_html = 'You are logged in as ' + 
		                  '<strong>' + username + 
		                  '</strong>. ';
	    login_info_html += ' <a href="javascript: void 0;" id="login">Login</a>' + ' | ' +
	                       ' <a href="javascript: openExternalWindow(\'/user/register.php\'); void 0;" id="signup">Signup</a>';
	}
	else {
		login_info_html = 'Hi ' + '<strong>' + username + '</strong>! ';
	    login_info_html += '| <a href="javascript: logout();">Logout</a>';
	}
	
	$('login_info').innerHTML = login_info_html;
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
                    '<span class="sender">' + 
                    msgs[i].s + 
                    '</span>' + 
                    ": <span class=msg>" + msgs[i].msg + "</span></div>\n"; 
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

function suspendChat() {
    document.chat_form.chat_textarea.disabled = 'yes';
    GetMessages.stopPolling();
}

function resumeChat() {
    document.chat_form.chat_textarea.disabled = '';
    GetMessages.startPolling();
}

/*****************************************************************************
 * Get Messages Object
 *****************************************************************************/
var GetMessages = {
    handleFailure:function(o){
        //alert('GetMessages handleFailure');
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
        }
        
        if (msgs.length > 0) {
        	last_msg_id = msgs[0].id;
        	var stripped = msgs[0].msg.replace(/(<([^>]+)>)/ig,"");
        	//document.title = msgs[0].s + " - " + stripped;
        }
            renderYappers(obj);
    },

    sendRequest:function() {
        if (!site_url)
            site_url = 'http://cmu.facebook.com/profile.php?id=4813337';
            
    	var url = removeHttp(site_url);
	    url = encodeURIComponent(url);
	            
        url = url_GetMessages + '?url=' + url + "&last_msg_id=" + last_msg_id;
        YAHOO.util.Connect.asyncRequest('GET', url, GetMessages_callback, null);
    },

    startPolling: function(auto) {
	    GetMessages.sendRequest();
	    poll_interval_id = setInterval(GetMessages.sendRequest, poll_interval);
	    
	    if (!auto) {
            chat_mode_div = document.getElementById('chat_mode');
            chat_mode_div.innerHTML = 
            '<a href="javascript: suspendChat(); void 0;">Suspend chat</a>';
	    }
    },

    stopPolling: function(auto) {
        clearInterval(poll_interval_id);
        
	    if (!auto) {
            chat_mode_div = document.getElementById('chat_mode');
            chat_mode_div.innerHTML = 
            '<a href="javascript: resumeChat(); void 0;">Resume chat</a>';
	    }
    }
};

var GetMessages_callback = {
    success: GetMessages.handleSuccess,
    failure: GetMessages.handleFailure,
    scope: GetMessages,
    timeout: 4500,
    cache: false
};

/*****************************************************************************
 * Send Message Object
 *****************************************************************************/
var SendMessage = {
    textMessage: '',
    
    handleFailure:function(o){
        //alert('SendMessage handleFailure');
    },

    handleSuccess:function(o){
        // This member is called by handleSuccess
        //alert(o.responseText);
        // set flag to skip getting messages by timer
        // retrieve message immediately
	    //GetMessages.stopPolling(true);
	    GetMessages.sendRequest();
	    //GetMessages.startPolling(true);
    },

    getText: function(event) {
    	var e = event || window.event;
    	var textMsg = '';
    	var code = e.charCode || e.keyCode;
        if (code == 13) {
        	textMsg = document.chat_form.chat_textarea.value;
        	SendMessage.sendRequest(textMsg);
        	document.chat_form.chat_textarea.value = '';
        }
    },
    
    sendRequest:function(textMsg) {
        var url = encodeURIComponent(site_url);
        textMsg = escape(textMsg);
        
        url = url_SendMessage + '?url=' + url + "&user=" + username + "&msg=" + textMsg;
        YAHOO.util.Connect.asyncRequest('GET', url, SendMessage_callback, null);
    }

};

var SendMessage_callback = {
    success: SendMessage.handleSuccess,
    failure: SendMessage.handleFailure,
    scope: SendMessage,
    timeout: 4500,
    cache: false
};

var SendLogout = {
    handleFailure:function(o){
        alert('Sending logout failed');
    },

    handleSuccess:function(o){
    	var username = eval('(' + o.responseText + ')');
    	updateLoginInfo(username);
    },

    sendRequest:function(url) {
        YAHOO.util.Connect.asyncRequest('GET', url, SendLogout_callback, null);
    }

};

var SendLogout_callback = {
    success: SendLogout.handleSuccess,
    failure: SendLogout.handleFailure,
    scope: SendLogout,
    timeout: 4500,
    cache: false
};


var Chat = {
	onunload: function() {
	}
};

/************************************************************/

function init_chat() {
	generateContent();
    GetMessages.startPolling();
}

function init_login() {    
    var handleSubmit = function() {
        this.submit();
    };
    var handleCancel = function() {
        this.cancel();
    };
    var handleSuccess = function(o) {
        var obj = eval('(' + o.responseText + ')');
        if (obj && obj.username == loginname) {
        	username = obj.username;
        	updateLoginInfo(username);
        }
        else {
        	alert("Login failed.\nIncorrect username and/or password.");
        }
    };
    var handleFailure = function(o) {
        //alert("Submission failed: " + o.status);
        alert("Server failure. Please try again later.");
    };

    // Instantiate the Dialog
    var login_dialog = new YAHOO.widget.Dialog("login_dialog", 
                            { width : "275px",
                              //height: "250px",
                              fixedcenter : true,
                              visible : false, 
                              constraintoviewport : true,
                              buttons : [ { text:"Login", handler:handleSubmit, isDefault:true },
                                      { text:"Cancel", handler:handleCancel } ]
                            });

    // Validate the entries in the form to require that both first and last name are entered
    login_dialog.validate = function() {
        var data = this.getData();
        loginname = data.username.replace(/^\s+|\s+$/g,"");
        
        if (data.username == "" || data.password == "") {
            alert("Please enter username and password.");
            return false;
        } else {
            return true;
        }
    };

    // Wire up the success and failure handlers
    login_dialog.callback = { success: handleSuccess,
                             failure: handleFailure };
    
    // Render the Dialog
    login_dialog.render();

    YAHOO.util.Event.addListener("login", "click", login_dialog.show, login_dialog, true);
    //YAHOO.util.Event.addListener("hide", "click", login_dialog.hide, login_dialog, true);
}

function init_signup() {    
    var handleSubmit = function() {
        this.submit();
    };
    var handleCancel = function() {
        this.cancel();
    };
    var handleSuccess = function(o) {
        var obj = eval('(' + o.responseText + ')');
        if (obj && obj.username == loginname) {
            username = obj.username;
            updateLoginInfo(username);
        }
        else {
            alert("Signup failed.\nUsername or email is already taken.");
        }
    };
    var handleFailure = function(o) {
        //alert("Submission failed: " + o.status);
        alert("Server failure. Please try again later.");
    };

    // Instantiate the Dialog
    var signup_dialog = new YAHOO.widget.Dialog("signup_dialog", 
                            { width : "275px",
                              //height: "250px",
                              fixedcenter : true,
                              visible : false, 
                              constraintoviewport : true,
                              buttons : [ { text:"Sign up", handler:handleSubmit, isDefault:true },
                                      { text:"Cancel", handler:handleCancel } ]
                            });

    // Validate the entries in the form to require that both first and last name are entered
    signup_dialog.validate = function() {
        var data = this.getData();
        loginname = data.username.replace(/^\s+|\s+$/g,"");
        
        if (data.username == "" || data.password == "") {
            alert("Please enter username and password.");
            return false;
        } else {
            return true;
        }
    };

    // Wire up the success and failure handlers
    signup_dialog.callback = { success: handleSuccess,
                               failure: handleFailure };
    
    // Render the Dialog
    signup_dialog.render();

    YAHOO.util.Event.addListener("signup", "click", signup_dialog.show, signup_dialog, true);
}

function init() {
    // work around to display cursor in Firefox
    if (navigator.userAgent.indexOf('Firefox') != -1) {
        document.getElementById('chat_textarea').style.position = "fixed";
    }
    
    // set focus to chat textarea
    document.getElementById('chat_textarea').focus();
    
	// initialize chat widget
    init_chat();    
    if (iframe_enabled)
        init_panel();
    
    // update login information
    updateLoginInfo(username);
    
    // initialize login widget
    init_login();
    //if (navigator.userAgent.indexOf('Firefox') != -1) {
    //    document.getElementById('login_username').style.position = "fixed";
    //}
    
    // initialize signup widget
    //init_signup();
}

function quit() {
    alert('closing window');    
}

YAHOO.util.Event.onDOMReady(init);
//YAHOO.util.Event.addListener(body, "onunload", quit); 


