
var title_header = "YapLoud.com";
var poll_interval = 5000;
var poll_interval_id;
//var url_GetMessages = "/get_msg.php";
var url_GetMessages = "/chat/getChatMessages.php";
var url_SendMessage = "/put_msg.php";
var url_SendLogout = "/chat/logout.php";
var url_SendLogin = "/chat/login.php";
var bd_content = '';
var chatWidgetMinimize = false;
var loginname = '';
var logged_in = false;
var query_count = 0;

function $(s) {
    return document.getElementById(s);
}

function trim(str) {
    return str.replace(/^\s\s*/, '').replace(/\s\s*$/, '');	
}

function scrollDown() {
    msgs_div = $('msg');
    msgs_div.scrollTop = msgs_div.scrollHeight;
    if ( navigator.appName == "Microsoft Internet Explorer" ) {
        msgs_div.scrollTop = msgs_div.scrollHeight; // IE7 requires running this twice!
    }
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
 
    // maximize chat window   
	if (chatWidgetMinimize) {
        bd_div.innerHTML = bd_content;
        init_all_dialog();
        chatWidgetMinimize = false;
        GetMessages.startPolling();
        scrollDown();
	}
	// minimize
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

function uiLogout() {
    var confirm_logout = confirm("Are you sure you want to logout?");
    
    if (confirm_logout) {
    	logout();
    }
}

function logout() {
 	SendLogout.sendRequest();
    init_all_dialog();
    logged_in = false;
    	
    // force update of chat room by calling GetMessages.sendRequest
    query_count = 0;
    GetMessages.sendRequest();
}

function login() {
	alert("who's calling login?");
}

function updateLoginInfo(username) {
	var login_info_html;
	var login_html;
	var signup_html;
	
	if (username.substr(0,5) == 'guest') {
		login_info_html = 'You are logged in as ' + 
		                  '<strong>' + username + 
		                  '</strong>. ';
	    login_html = '| <a href="javascript: void 0;">Login</a> ';
	    signup_html = '| <a href="javascript: openExternalWindow(\'/user/register.php\'); void 0;">Signup</a>';
	    logged_in = false;
	}
	else {
		login_info_html = 'Hi ' + '<strong>' + username + '</strong>! ';
	    login_info_html += '| <a href="javascript: uiLogout(); void 0;">Logout</a>';
	    login_html = '';
	    signup_html = '';
	    logged_in = true;
	}
	
	$('login_info').innerHTML = login_info_html;
	$('login').innerHTML = login_html;
	$('signup').innerHTML = signup_html;
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
    var found = false;
    var users = obj.users;
    var users_el = document.getElementById('yappers');
    users_el.innerHTML = '';
    for(var i = 0; i < users.length; i++){
        users_el.innerHTML += "<div class=room_user>" + users[i] + "</div>";
        
        // check if current user is in chat room
        if (users[i] == username) {
        	found = true;
        }
    }
    
    // if current user is not in chat room, change login info
    if (!found) {
    	username = obj.user_session;
    	updateLoginInfo(username);
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
            
        if (username != obj.user_session) {
      		username = obj.user_session;
       		updateLoginInfo(username);
        }
        
        query_count++;
    },

    sendRequest:function() {
        if (!site_url)
            site_url = 'http://cmu.facebook.com/profile.php?id=4813337';
            
    	var url = removeHttp(site_url);
	    url = encodeURIComponent(url);
	            
        url = url_GetMessages + '?url=' + url + "&last_msg_id=" + last_msg_id;
        
        if (query_count%Math.round(poll_interval/84) == 0 ) { // send heartbeat every 300 secs
            url += "&heartbeat=1";	
        }
        
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
            textMsg = trim(textMsg);
            if (textMsg != "") {
            	SendMessage.sendRequest(textMsg);
            }
                
        	document.chat_form.chat_textarea.value = '';
        }
    },
    
    sendRequest:function(textMsg) {
        var url = encodeURIComponent(site_url);
        //textMsg = escape(textMsg);
        textMsg = encodeURIComponent(textMsg);
        
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
        //alert('Sending logout failed: ' + o.responseText + ': ' + o.status);
        alert('Server failure. Please try again later. ' + o.status);
    },

    handleSuccess:function(o){
    	var guestname = eval('(' + o.responseText + ')');
    	username = guestname;
    	updateLoginInfo(guestname);
    },

    sendRequest:function() {
        var url = encodeURIComponent(site_url);
        url = url_SendLogout + "?url=" + url;
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

function isEmailValid(email) {
	//validate email
    var regx = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    var result = regx.test(email);
    return result;
}

function init_invite_friend() {    
    var handleSubmit = function() {
        this.submit();
    };
    var handleCancel = function() {
        this.cancel();
    };
    var handleSuccess = function(o) {
        var obj = eval('(' + o.responseText + ')');
        var msg;
        if (obj.email) {
            msg = "Your invitation has been sent to " + obj.email;
            alert(msg);
        }
        else {
            alert("Server failed sending invitation. Please try again later.");
        }
    };
    var handleFailure = function(o) {
        //alert("Submission failed: " + o.status);
        alert("Server failure. Please try again later.");
    };

    // Instantiate the Dialog
    var invite_friend_dialog = new YAHOO.widget.Dialog("invite_friend_dialog", 
                            { width : "275px",
                              //height: "250px",
                              fixedcenter : true,
                              visible : false, 
                              constraintoviewport : true,
                              buttons : [ { text:"Send", handler:handleSubmit, isDefault:true },
                                      { text:"Cancel", handler:handleCancel } ]
                            });

    // Validate the entries in the form to require that both first and last name are entered
    invite_friend_dialog.validate = function() {
        var data = this.getData();
        email = data.email.replace(/^\s+|\s+$/g,"");
        
        if (username.substr(0,5) == 'guest') {
            alert("Sorry, guests are not allowed to invite a friend.\nPlease login to send invitation.");
            return false;
        }
        
        if (data.email == "") {
            alert("Please enter email of your friend.");
            return false;
        }
        
        if (!isEmailValid(email)) {
            alert("Invalid email: " + data.email + "\nPlease enter a valid email.");
            return false;
        }
        
        return true;
    };

    // Wire up the success and failure handlers
    invite_friend_dialog.callback = { success: handleSuccess,
                             failure: handleFailure };
    
    // Render the Dialog
    invite_friend_dialog.render();

    YAHOO.util.Event.addListener("invite_friend", "click", invite_friend_dialog.show, invite_friend_dialog, true);
}

function init_add_tags() {    
    var handleSubmit = function() {
        this.submit();
    };
    var handleCancel = function() {
        this.cancel();
    };
    var handleSuccess = function(o) {
        var obj = eval('(' + o.responseText + ')');
        var msg;
        if (obj.tags) {
            msg = "Your tags have been added.\n" + obj.tags;
            alert(msg);
        }
        else {
            alert("Server failed adding tags. Please try again later.");
        }
    };
    var handleFailure = function(o) {
        //alert("Submission failed: " + o.status);
        alert("Server failure. Please try again later.");
    };

    // Instantiate the Dialog
    var add_tags_dialog = new YAHOO.widget.Dialog("add_tags_dialog", 
                            { width : "275px",
                              //height: "250px",
                              fixedcenter : true,
                              visible : false, 
                              constraintoviewport : true,
                              buttons : [ { text:"Submit", handler:handleSubmit, isDefault:true },
                                      { text:"Cancel", handler:handleCancel } ]
                            });

    // Validate the entries in the form to require that both first and last name are entered
    add_tags_dialog.validate = function() {
        var data = this.getData();
        tags = data.tags.replace(/^\s+|\s+$/g,"");
        
        if (username.substr(0,5) == 'guest') {
            alert("Sorry, guests are not allowed to invite a friend.\nPlease login to send invitation.");
            return false;
        }
        
        if (data.tags == "") {
            alert("Please enter tags.");
            return false;
        }
        
        return true;
    };

    // Wire up the success and failure handlers
    add_tags_dialog.callback = { success: handleSuccess,
                                 failure: handleFailure };
    
    // Render the Dialog
    add_tags_dialog.render();

    YAHOO.util.Event.addListener("add_tags", "click", add_tags_dialog.show, add_tags_dialog, true);
}


function init_all_dialog() {
	init_login();
    init_invite_friend();	
    init_add_tags();	
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
    init_all_dialog();
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


