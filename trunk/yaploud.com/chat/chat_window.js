/**
 * Chat Window Module
 * 
 * Created on Nov 17, 2007
 * Author: alvinabad@alumni.cmu.edu
 */
 
var title_header = "YapLoud.com";
var poll_interval = 5000;
var poll_interval_id;
//var url_GetMessages = "/get_msg.php";
var url_GetMessages = "/chat/getChatMessages.php";
var url_SendMessage = "/chat/sendChatMessages.php";
var url_SendLogout = "/chat/logout.php";
var url_SendLogin = "/chat/login.php";
var url_GetTags = "/tags/getTags.php";
var url_SendLeaveRoom = "/chat/leaveRoom.php";

var bd_content = '';
var chatWidgetMinimize = false;
var loginname = '';
var logged_in = false;
var query_count = 0;
var current_rating = 0;
//var has_rated = false;
var update_current_rating = true;

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
    //openWindow(site_url);
    //closeWindow();
    document.location = appendHttp2Url(site_url);
}

function openWindow(url) {
    var url = decodeURIComponent(url);
    url = appendHttp2Url(url);
    window.open(url);
}

//TODO: Deprecate
function closeWindow_deprecated() {
    if ( navigator.appName == "Microsoft Internet Explorer" ) {
        window.open('','_self','');
    }
    window.close();
}

function popout(site_url, site_title) {
        openChatWindow(site_url, site_title);
        document.location = appendHttp2Url(site_url);
}

function popin(site_url, site_title) {
    openPopinWindow(site_url, site_title);
    
    if ( navigator.appName == "Microsoft Internet Explorer" ) {
        window.open('','_self','');
    }
    window.close();
}

function minimizeChatWidget() {
    bd_div = document.getElementById('bd0');    
    
    // maximize chat window   
	if (chatWidgetMinimize) {
        chatWidgetMinimize = false;
        YAHOO.util.Dom.setStyle(bd_div, 'display', 'inline');
	}
	// minimize
	else {
        chatWidgetMinimize = true;
        YAHOO.util.Dom.setStyle(bd_div, 'display', 'none');
	}
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

function openPopinWindow(site_url, title) {
	//site_url = encodeURIComponent(site_url);
	//title = encodeURIComponent(title);
	
    var url = "/chat/chat_window.php?url=" + site_url +
             "&title=" + title + "&iframe=yes";
    
    url = addslashes(url);
    
    var features = "width=800, height=640, status=yes, directories=yes " +
                   "menubar=yes, toolbar=yes, location=yes, resizable=yes";
    window.open(url, "", features);
}

var ext_url = "";
function openExternalWindow(url) {
	if (url == null) {
		url = ext_url;
	}
	
    url = decodeURIComponent_recursive(url);
    
	if (iframe_enabled) {
		document.location = url;
		return;
	}
	
    var features = "width=950, height=640, status=1, + " +
    		       "menubar=1, toolbar=1, location=1, resizable=1, " +
    		       "directories=1, scrollbars=1";
    window.open(url, "", features);
}

//TODO: Deprecate
function generateContent_deprecated() {
	var url = site_url;
	url = appendHttp2Url(url);
	ext_url = url;
	
    var title = document.getElementById('hd_title');
    var html_text = '';
    
    // check type of browser
    if (navigator.userAgent.indexOf('Firefox') != -1) {
        html_text = '<a href="' + 
                    'javascript: openExternalWindow(); void 0;' +
                    '">';
    } else {
        html_text += '<a href="' + url + '" target="_blank">';
    }
    
    html_text += site_title + "</a>";
    title.innerHTML = html_text;
}

function logout() {
    var confirm_logout = confirm("Are you sure you want to logout?");
    
    if (confirm_logout) {
        SendLogout.sendRequest();
    }
 	
}

function login() {
	alert("who's calling login?");
}

function updateLoginInfo(username) {
	if (username.substr(0,5) == 'guest') {
	    logged_in = false;
	}
	else {
	    logged_in = true;
	}
	
    render_login_info();
    // force update of chat room by calling GetMessages.sendRequest
    query_count = 0;
    GetMessages.sendRequest();
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

function scrollDownDiv(div_el) {
    div_el.scrollTop = div_el.scrollHeight;
    if ( navigator.appName == "Microsoft Internet Explorer" ) {
        div_el.scrollTop = div_el.scrollHeight; // IE7 requires running this twice!
    }
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
                    '<div class=msg_time>' +  msgs[i].t + 
                    '&nbsp;</div>' + 
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
    
    scrollDownDiv(msgs_div);
    /**
    msgs_div.scrollTop = msgs_div.scrollHeight;
    if ( navigator.appName == "Microsoft Internet Explorer" ) {
        msgs_div.scrollTop = msgs_div.scrollHeight; // IE7 requires running this twice!
    }
    * **/
}
   
var tags_on = false;
function toggleShow() {
	var yappers_div = $('yappers');
	var tags_div = $('tags');
	//var moderator_div = $('moderator');
	
	
	if (tags_on) {
        tags_on = false;
        YAHOO.util.Dom.setStyle(yappers_div, 'display', 'inline');
        YAHOO.util.Dom.setStyle(tags_div, 'display', 'none');
      //  YAHOO.util.Dom.setStyle(moderator_div, 'display', 'none');
	}
	else {
        tags_on = true;
        YAHOO.util.Dom.setStyle(yappers_div, 'display', 'none');
        YAHOO.util.Dom.setStyle(tags_div, 'display', 'inline');
        GetTags.sendRequest();
	}
}   
	   
function showUsers() {
    var yappers_div = $('yappers');
    var tags_div = $('tags');
   // var moderator_div = $('moderator');
    
    
    YAHOO.util.Dom.setStyle(yappers_div, 'display', 'inline');
    YAHOO.util.Dom.setStyle(tags_div, 'display', 'none');
    //YAHOO.util.Dom.setStyle(moderator_div, 'display', 'inline');
    
}

function showTags() {
    var yappers_div = $('yappers');
    var tags_div = $('tags');
    //var moderator_div = $('moderator');
    
     YAHOO.util.Dom.setStyle(tags_div, 'display', 'inline');
    YAHOO.util.Dom.setStyle(yappers_div, 'display', 'none');
     //YAHOO.util.Dom.setStyle(moderator_div, 'display', 'none');
    GetTags.sendRequest();
   
}
/*
function deleteBannedUsers(users) {
	//alert(bannedUsers.length + ' ' + users.length);
	for (var i=0; i < bannedUsers.length ; i++) {
		var bannedUser = bannedUsers[i];
		//alert(bannedUser);
		
		for (var j=0; j < users.length; j++) {
			//alert('inner for compare ' + bannedUser + ':' + users[j]);
			if (bannedUser == users[j]) {
				//alert('before ' + users.length);
				users.splice(j,1);
				//alert('after ' + users.length);
				//bannedUsers.splice(i,1);
				continue;
				
				}
		
		}
	}

}
*/
function renderYappers(obj) {
	
	/**
    if(!already_hidden){
        sl.hide();
        already_hidden = true;
    }
    */
    var found = false;
    var users = obj.users;
   /* var names = ':';
    for (var i = 0; i < users.length; i++ ){
    	names = names + users[i] + ":";
    	}
    alert(names);*/
    var users_el = document.getElementById('yappers');
	//deleteBannedUsers(users);		
    var user_ip = '';
    users_el.innerHTML = '';
  
    for(var i = 0; i < users.length; i++){
        users_el.innerHTML += "<div class=room_user>" + users[i].name + "</div>";  
        //moderator.innerHTML += "<div class=room_user>" + "flag" + "</div>";   
        // check if current user is in chat room
        if (users[i].name == username) {
        	found = true;
        }
    }
    
    // if current user is not in chat room, change login info
    if (!found) {
    	username = obj.user_session;
    	updateLoginInfo(username);
    }
    //var moderator = document.getElementById('moderator');
    
    //moderator.innerHTML = '';
    //for(var i = 0; i < users.length; i++){
      //onmouseover="this.src=\'../images/redFlag.jpg\'" onmouseout="this.src=\'../images/greenFlag.jpg\'"
      //  moderator.innerHTML += "<div class=flag_user>" + "<img " + "id=" + users[i] + ' width=15 height=15 title="click to flag a user"  src="../images/greenFlag.jpg" alt="Click to flag user" onclick="moderate(this.id)" />' + "</div>";   
   
    //}
}

function processModerators(obj) {
    var found = false;
    var moderators = obj.moderators;
    var moderator_el = document.getElementById('moderate_link');
    /**
    var link = '<a href="javascript: openExternalWindow(' + "'" +
               '/moderators/moderateYaplet.php?url=' + site_url + 
               "'" + '); void 0;">Moderate</a> |';
    **/
    var href_link = '/moderators/moderateYaplet.php?url=' + site_url;
    var link = '<a href="' + href_link + '" onclick="openExternalWindow(' + "'" +
               href_link + "'" + '); return false;">Moderate</a> |';
               
    for(var i = 0; i < moderators.length; i++){
        if (moderators[i].username == username) {
            moderator_el.innerHTML = link;
            return;
        }
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


var GetTags = {
    handleFailure:function(o){
    },

    handleSuccess:function(o){
        // This member is called by handleSuccess
        var obj = eval('(' + o.responseText + ')'); 
        var tags = obj.tags;
        GetTags.render(obj);
    },

    sendRequest:function() {
        if (!site_url)
            site_url = 'http://cmu.facebook.com/profile.php?id=4813337';
            
        var url = encodeURIComponent(site_url);
        url = url_GetTags + '?url=' + url;
        
        YAHOO.util.Connect.asyncRequest('GET', url, GetTags_callback, null);
    },
    
    render:function(obj) {
        var tags = obj.tags;
        var tags_el = document.getElementById('tags');
        tags_el.innerHTML = '';
        for(var i = 0; i < tags.length; i++){
            tags_el.innerHTML += '<div class=room_user>' + 
                    tags[i] + 
                    '</div>';
        }
    }

};

var GetTags_callback = {
    success: GetTags.handleSuccess,
    failure: GetTags.handleFailure,
    scope: GetTags,
    timeout: 4500,
    cache: false
};


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
        
        // update yappers list
        //alert('Hello new ' + bannedUsers[0]);// + bannedUsers[0]);
		 renderYappers(obj);
		 
		 // Check if user is moderator
		 processModerators(obj);
        
        // update star ratings and votes
        if (obj.rating && obj.rating != current_rating) {
        	if ( update_current_rating ) {
        	    StarRating.set(obj.rating);
        	}
        	Votes.set(obj.votes);
        	current_rating = obj.rating;
        }
            
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
            chat_mode_div.innerHTML = '<span id="chat_mode">' +
               '<a href="javascript: suspendChat(); void 0;">Suspend chat</a>' +
               ' </span>';
	    }
    },

    stopPolling: function(auto) {
        clearInterval(poll_interval_id);
        
	    if (!auto) {
            chat_mode_div = document.getElementById('chat_mode');
            chat_mode_div.innerHTML = '<span id="chat_mode">' +
               '<a href="javascript: resumeChat(); void 0;">Resume chat</a>' +
               ' </span>';
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
        //('SendMessage handleFailure');
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
        	SendMessage.text();
        }
    },
    
    text: function() {
        textMsg = document.chat_form.chat_textarea.value;
        textMsg = trim(textMsg);
        if (textMsg != "") {
            SendMessage.sendRequest(textMsg);
        }
                
        document.chat_form.chat_textarea.value = '';
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

var SendLeaveRoom = {
    handleFailure:function(o){
        //alert('Sending logout failed: ' + o.responseText + ': ' + o.status);
        alert('Server failure. Please try again later. ' + o.status);
    },

    handleSuccess:function(o){
        //var guestname = eval('(' + o.responseText + ')');
        //username = guestname;
        //updateLoginInfo(guestname);
    },

    sendRequest:function() {
        var url = encodeURIComponent(site_url);
        url = url_SendLeaveRoom + "?url=" + url;
        YAHOO.util.Connect.asyncRequest('GET', url, SendLeaveRoom_callback, null);
    }

};

var SendLeaveRoom_callback = {
    success: SendLeaveRoom.handleSuccess,
    failure: SendLeaveRoom.handleFailure,
    scope: SendLeaveRoom,
    timeout: 4500,
    cache: false
};


var Chat = {
	onunload: function() {
	}
};

/************************************************************/

function init_chat() {
	//generateContent();
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
            document.invite_friend_form.email.value = '';
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
            GetTags.sendRequest();
            msg = "Your tags have been added:\n" + obj.tags;
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

function render_login_info() {
	login_info_el = document.getElementById('login_info');
	logout_info_el = document.getElementById('logout_info');
	user_divs_el = document.getElementById('user_divs');
	username_info1_el = document.getElementById('username_info1');
	username_info2_el = document.getElementById('username_info2');
    
    username_info1_el.innerHTML = username;
    username_info2_el.innerHTML = username;
    
    if (logged_in) {
        YAHOO.util.Dom.setStyle(login_info_el, 'display', 'inline');
        YAHOO.util.Dom.setStyle(logout_info_el, 'display', 'none');
        YAHOO.util.Dom.setStyle(user_divs_el, 'display', 'inline');
    }
    else {
        YAHOO.util.Dom.setStyle(logout_info_el, 'display', 'inline');
        YAHOO.util.Dom.setStyle(login_info_el, 'display', 'none');
        YAHOO.util.Dom.setStyle(user_divs_el, 'display', 'none');
    }
}

function init_all_dialog() {
	init_login();
    init_invite_friend();	
    init_add_tags();	
}

function init() {
	resizeDivs();
	
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
    
    
    // initialize login widget
    init_all_dialog();
    updateLoginInfo(username);
    
    //if (navigator.userAgent.indexOf('Firefox') != -1) {
    //    document.getElementById('login_username').style.position = "fixed";
    //}
    StarRating.init();
    document.title = site_title;
}

function quit() {
    SendLeaveRoom.sendRequest();    
    //alert('closing window');
}

function resizeDivs() {
    var newHeight = 150 + YAHOO.util.Dom.getViewportHeight() - 375;
    if (newHeight > 85) {
        YAHOO.util.Dom.setStyle($("msg"), 'height', newHeight + "px");
        YAHOO.util.Dom.setStyle($("yappers"), 'height', newHeight + "px");
        YAHOO.util.Dom.setStyle($("tags"), 'height', newHeight + "px");
        scrollDownDiv($("msg"));
        scrollDownDiv($("yappers"));
        scrollDownDiv($("tags"));
    }
}

YAHOO.util.Event.addListener(window, "resize", resizeDivs);
YAHOO.util.Event.addListener(window, "beforeunload", quit);
YAHOO.util.Event.onDOMReady(init);
//window.onunload = quit;


/**
var yui_alert = {
	dlg: null,

    alert:function(str) {
        yui_alert.dlg.setBody(str);
        yui_alert.dlg.cfg.queueProperty('icon', YAHOO.widget.SimpleDialog.ICON_WARN);
        yui_alert.dlg.cfg.queueProperty('zIndex', 9999);
        yui_alert.dlg.render(document.body);
        if (yui_alert.dlg.bringToTop) {
            yui_alert.dlg.bringToTop();
        }
        dlg.show();
    },

    init:function() {
        var handleOK = function() {
            this.hide();
        };

        yui_alert.dlg = new YAHOO.widget.SimpleDialog('widget_alert', {
            visible:false,
            width: '20em',
            zIndex: 9999,
            close: false,
            fixedcenter: true,
            modal: false,
            draggable: true,
            constraintoviewport: true, 
            icon: YAHOO.widget.SimpleDialog.ICON_WARN,
            buttons: [
                { text: 'OK', handler: handleOK, isDefault: true }
                ]
        });
        yui_alert.dlg.setHeader("Alert!");
        yui_alert.dlg.setBody('Alert body passed to window.alert'); // Bug in panel, must have a body when rendered
        yui_alert.dlg.render(document.body);
    }
};
**/    
    
    
    