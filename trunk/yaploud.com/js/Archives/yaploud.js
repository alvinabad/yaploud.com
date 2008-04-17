
var logged_in = false;
var user = "";
var lastMessageId = 0;
var currentLocation = "";
var chatWindow = null;
var debug = false;
var numYappers = 0;
var functionTimer = null;
var timerId = null;
var timerInterval = 1000;


function yaploud_closeChat() {

	if (chatWindow != null) {
		chatWindow.style.display = "none";
		if (logged_in == true) {
			yaploud_leaveChat();
		}
	}
	
}



function yaploud_minimizeChat() {


	var body = document.getElementById("yaploud_body");
	var title = document.getElementById("yaploud_chatTitle");
	var image = document.getElementById("yaploud_minimize");
	
	body.style.display = "none";
	body.style.height = "0";
	chatWindow.style.height = "40px";
	title.style.background = "url(\"/images/minimized.png\")";
	image.src = "/images/restore.png";
	image.onclick = "yaploud_restoreChat();";
}


function yaploud_restoreChat() {
	
	var winWrapper = new XPCNativeWrapper(content, "doc");
	var mainDocument = new XPCNativeWrapper(winWrapper.document, "top");

	var body = mainDocument.getElementById("yaploud_body");
	var title = mainDocument.getElementById("yaploud_chatTitle");
	var image = mainDocument.getElementById("yaploud_minimize");
	
	body.style.display = "block";
	body.style.height = "410px";
	chatWindow.style.height = "450px";
	title.style.background = "url(\"chrome://yaploud/skin/topbar.png\")";
	image.src = "chrome://yaploud/skin/minimize.png";
	image.onclick = yaploud_minimizeChatFunction();
}
	

function yaploud_logout() {

	var winWrapper = new XPCNativeWrapper(content, "doc");
	var mainDocument = new XPCNativeWrapper(winWrapper.document, "top");
	yaploud_leaveChat();
	logged_in = false;
	user = "";
	var login = mainDocument.getElementById("yaploud_logindiv");
	var comment = mainDocument.getElementById("yaploud_commentDiv");
	var logout = mainDocument.getElementById("yaploud_logoutDiv");
	comment.style.display = "none";
	login.style.display = "block";
	logout.style.display = "none";
	return false;
	
}




function yaploud_addComment() {

	var winWrapper = new XPCNativeWrapper(content, "doc");
	var mainDocument = new XPCNativeWrapper(winWrapper.document, "top");
	var oXHR = yaploud_createXHR();
	var comment = mainDocument.getElementById("yaploud_newCommentText").value;
	var addr = "http://www.yaploud.com/put_msg.php?user=" + encodeURIComponent(user) + "&url=" + encodeURIComponent(currentLocation) + "&msg=" + encodeURIComponent(comment);
	oXHR.open("GET", addr, true);
	
	if (comment != null && comment != "") {
  
  		// Set up the response handler
		oXHR.onreadystatechange = function () {
	
			if (oXHR.readyState == 4) {
				// Request completed, check response code
				if (oXHR.status != 200) {
					// Request failed, post error
					alert("Error: Server returned error code " + oXHR.status);
				} else {
					mainDocument.getElementById("yaploud_newCommentText").value = "";
					//alert(oXHR.responseText);
					yaploud_getNewMessages();
				}
		
			}	
	
		}
		

		oXHR.send(null);
		
 
	}


}


function yaploud_openChat(event) {
  
	var winWrapper = new XPCNativeWrapper(content, "doc");
	var mainDocument = new XPCNativeWrapper(winWrapper.document, "top");
  
  	if (mainDocument.location == "" || mainDocument.location == "about:blank") {
		alert("You cannot yap about an empty page!");
		return;
	}

	chatWindow = mainDocument.getElementById("yaploud_chatWindow");
	
	if (chatWindow == null) {
		
		// This is the first time opening the chat window, so we need to create it
		// First, create the main chat window
		chatWindow = mainDocument.createElement("div");
		chatWindow.setAttribute("title", "YapLoud.com");
		chatWindow.setAttribute("id", "yaploud_chatWindow");
		chatWindow.setAttribute("style", "position:fixed;z-index:999999;top:5px;left:5px;background:transparent;text-align:left;opacity:.95;font: normal 8pt arial;width:580px;height:450px;margin-bottom:15px;");
		mainDocument.body.appendChild(chatWindow);
		
		// Next, create the title bar div
		var titleDiv = mainDocument.createElement("div");
		titleDiv.setAttribute("id", "yaploud_chatTitle");
		titleDiv.setAttribute("style", "background: transparent url(\"chrome://yaploud/skin/topbar.png\");color:white;font-size:12pt;font-weight:bold;width:100%;height:40px;border:0;");
		titleDiv.onmousedown = yaploud_handleMouseDown();
		var titleTextDiv = mainDocument.createElement("div");
		titleTextDiv.appendChild(mainDocument.createTextNode("YapLoud.com"));
		titleTextDiv.setAttribute("style", "float:left;");
		//titleDiv.appendChild(titleTextDiv);

		var closeImage = mainDocument.createElement("input");
		closeImage.setAttribute("type", "image");
		closeImage.src = "chrome://yaploud/skin/close.png";
		closeImage.alt = "";
		closeImage.title = "close";
		closeImage.setAttribute("style", "width:15px;height:15px;float:right;margin-top:7px;margin-right:10px;");
		closeImage.onclick = yaploud_closeChatFunction();
		titleDiv.appendChild(closeImage);
		var minimizeImage = mainDocument.createElement("input");
		minimizeImage.setAttribute("type", "image");
		minimizeImage.setAttribute("id", "yaploud_minimize");
		minimizeImage.src = "chrome://yaploud/skin/minimize.png";
		minimizeImage.alt = "";
		minimizeImage.title = "minimize";
		minimizeImage.setAttribute("style", "width:15px;height:15px;float:right;margin-top:7px;");
		minimizeImage.onclick = yaploud_minimizeChatFunction();
		titleDiv.appendChild(minimizeImage);
		
		var logoutDiv = mainDocument.createElement("div");
		logoutDiv.setAttribute("id", "yaploud_logoutDiv");
		if (logged_in == true) {
			logoutDiv.setAttribute("style", "font:8pt arial;float:right;margin-top:20px;margin-right:10px;display:block;width:160px;height:10px;");
		} else {
			logoutDiv.setAttribute("style", "font:8pt arial;float:right;margin-top:20px;margin-right:10px;display:none;width:160px;height:10px;");
		}
		
		var welcomeDiv = mainDocument.createElement("div");
		welcomeDiv.setAttribute("id", "yaploud_welcomeMessage");
		welcomeDiv.setAttribute("style", "width:110px;text-align:right;float:left;");
		welcomeDiv.appendChild(mainDocument.createTextNode("Welcome " + user + "!"));
		logoutDiv.appendChild(welcomeDiv);
		var logoutLink = mainDocument.createElement("a");
		logoutLink.href = "";
		logoutLink.title = "Logout";
		logoutLink.onclick = yaploud_logoutFunction();
		logoutLink.setAttribute("style", "font:8pt arial;color:red;margin-left:15px;float:right;");
		logoutLink.appendChild(mainDocument.createTextNode("logout"));
		logoutDiv.appendChild(logoutLink);
		titleDiv.appendChild(logoutDiv);		
		
		chatWindow.appendChild(titleDiv);
		
		// Create a large div to hold the rest of the body
		var bodyDiv = mainDocument.createElement("div");
		bodyDiv.setAttribute("style", "display:block;width:100%;height:410px;border:0;color:black;background:transparent;");
		bodyDiv.setAttribute("id", "yaploud_body");
		chatWindow.appendChild(bodyDiv);
		
		// Create the left sidebar div
		var leftDiv = mainDocument.createElement("div");
		leftDiv.setAttribute("style", "width:5px;height:390px;background:url(\"chrome://yaploud/skin/sidebar.png\");float:left;");
		bodyDiv.appendChild(leftDiv);
		

		// Create the Google Ads Div
		//var adsDiv = mainDocument.createElement("div");
		//adsDiv.setAttribute("id", "yaploud_ads");
		//adsDiv.setAttribute("style", "width:490px;background-color:white;height:50px;");
		//adsDiv.appendChild(mainDocument.createTextNode("Google Ads Here..."));
		//chatWindow.appendChild(adsDiv);
		//var adScript = mainDocument.createElement("script");
		//adScript.setAttribute("type", "text/javascript");
		//adScript.appendChild(mainDocument.createTextNode("<!--\ngoogle_ad_client = \"pub-0438387956273069\";\ngoogle_ad_width = 490;\ngoogle_ad_height = 50;\ngoogle_ad_format = \"490x50_as\";\ngoogle_ad_type = \"text_image\";\ngoogle_ad_channel =\"9343611779\";\n//-->"));
		//var headElement = mainDocument.getElementsByTagName("head");
		//headElement[0].appendChild(adScript);
		//adsDiv.appendChild(adScript);
		//var ads = mainDocument.createElement("script");
		//ads.setAttribute("type", "text/javascript");
		//ads.setAttribute("src", "http://pagead2.googlesyndication.com/pagead/show_ads.js");
		//adsDiv.appendChild(ads);
		
		// Create the chat window div
		var chatDiv = mainDocument.createElement("div");
		chatDiv.setAttribute("style", "width:450px;height:65%;background-color:white;border:1px solid black;overflow:auto;float:left;margin-top:0px;");
		chatDiv.setAttribute("id", "yaploud_chatdiv");
		bodyDiv.appendChild(chatDiv);
	
		var chatTable = mainDocument.createElement("table");
		chatTable.setAttribute("id", "yaploud_messagesTable");
		chatTable.setAttribute("style", "width:99%;");
	
		chatDiv.appendChild(chatTable);
	
		var chatTableBody = mainDocument.createElement("tbody");
		chatTableBody.setAttribute("id", "yaploud_messagesTableBody");
		chatTable.appendChild(chatTableBody);
		
		// Create the right sidebar div
		var rightDiv = mainDocument.createElement("div");
		rightDiv.setAttribute("style", "width:5px;height:390px;background:url(\"chrome://yaploud/skin/sidebar.png\");float:right;");
		bodyDiv.appendChild(rightDiv);
		
		
		// Create the chat members list div
		var yapperDiv = mainDocument.createElement("div");
		yapperDiv.setAttribute("style", "width:20%;height:65%;background-color:white;border:1px solid black;margin-top:0px;float:right;");
		var yapperTitleDiv = mainDocument.createElement("div");
		yapperTitleDiv.setAttribute("style", "width:100%;height:6%;background: transparent url(\"chrome://yaploud/skin/textbg.png\");color:black;text-align:center;");
		yapperTitleDiv.appendChild(mainDocument.createTextNode("Yappers"));
		yapperDiv.appendChild(yapperTitleDiv);
		var yapperMembers = mainDocument.createElement("div");
		yapperMembers.setAttribute("id", "yaploud_yappers");
		yapperMembers.setAttribute("style", "width:90%;height:92%;color:black;background-color:white;overflow:auto;margin:5px;border:0px;");
		yapperDiv.appendChild(yapperMembers);
		var yapperTable = mainDocument.createElement("table");
		yapperTable.setAttribute("id", "yaploud_yapperTable");
		yapperTable.setAttribute("style", "width:94%;margin:3%;");
		yapperMembers.appendChild(yapperTable);
		var yapperTableBody = mainDocument.createElement("tbody");
		yapperTableBody.setAttribute("id", "yaploud_yapperTableBody");
		yapperTable.appendChild(yapperTableBody);
		bodyDiv.appendChild(yapperDiv);
		
		
		// Create the login div
		var loginDiv = mainDocument.createElement("div");
		loginDiv.setAttribute("title","Log in to post comments");
		loginDiv.setAttribute("id", "yaploud_logindiv");
		if (!logged_in) {
			loginDiv.setAttribute("style", "display:block;width:568px;height:120px;background-color:white;border:1px solid black;float:left;margin-top:0px;");
		} else {
			loginDiv.setAttribute("style", "display:none;width:568px;height:120px;background-color:white;border:1px solid black;float:left;margin-top:0px;");
		}
		
		bodyDiv.appendChild(loginDiv);
	
		var loginTitleDiv = mainDocument.createElement("div");
		loginTitleDiv.setAttribute("style", "width:100%;background: transparent url(\"chrome://yaploud/skin/textbg.png\");color:black;margin-bottom:10px;");
		var loginTitle = mainDocument.createTextNode('Log in to post comments:');
		loginTitleDiv.appendChild(loginTitle);
		loginDiv.appendChild(loginTitleDiv);
		
		var loginFormDiv = mainDocument.createElement("div");
		loginFormDiv.setAttribute("style", "width:220px;background-color:white;color:black;padding-left:10px;padding-right:10px;font: normal 8pt arial;");
		loginDiv.appendChild(loginFormDiv);
		
		var loginForm = mainDocument.createElement("form");
		loginForm.setAttribute("id", "yaploud_loginForm");
		
	
		loginForm.appendChild(mainDocument.createTextNode("Username :"));
		var usernameField = mainDocument.createElement("input");
		usernameField.setAttribute("type", "text");
		usernameField.setAttribute("id", "yaploud_username");
		usernameField.setAttribute("style", "margin-left:6px;");
		usernameField.onkeypress = yaploud_checkLoginKeyPressFunction();
		loginForm.appendChild(usernameField);
		
		loginForm.appendChild(mainDocument.createElement("br"));
		loginForm.appendChild(mainDocument.createTextNode("Password :"));
		var passwordField = mainDocument.createElement("input");
		passwordField.setAttribute("type", "password");
		passwordField.setAttribute("id", "yaploud_password");
		passwordField.setAttribute("style", "margin-left:5px;margin-top:5px;");
		passwordField.onkeypress = yaploud_checkLoginKeyPressFunction();
		loginForm.appendChild(passwordField);
		
		var registerLink = mainDocument.createElement("a");
		registerLink.setAttribute("href", "http://www.yaploud.com/register.htm");
		registerLink.appendChild(mainDocument.createTextNode("Create an account"));
		registerLink.setAttribute("target", "_blank");
		registerLink.setAttribute("style", "margin-left:52%;width:100%;margin-bottom:10px;font-size:8pt;font-weight:normal;");
		loginForm.appendChild(registerLink);
		loginForm.appendChild(mainDocument.createElement("br"));
		
		var loginButton = mainDocument.createElement("input");
		loginButton.setAttribute("type", "button");
		loginButton.setAttribute("value", "Login");
		loginButton.setAttribute("style", "float:right; margin-right:15px;margin-top:5px;");
		loginButton.onclick = yaploud_processLoginFunction();
		loginForm.appendChild(loginButton);
		loginFormDiv.appendChild(loginForm);
	
		// Create the add comment div
		var commentDiv = mainDocument.createElement("div");
		commentDiv.setAttribute("title","Chat with other YapLoud Members");
		commentDiv.setAttribute("id", "yaploud_commentDiv");
		if (!logged_in) {
			commentDiv.setAttribute("style", "display:none;width:568px;height:120px;background-color:white;border:1px solid black;float:left;margin-top:0px;");
		} else {
			commentDiv.setAttribute("style", "display:block;width:568px;height:120px;background-color:white;border:1px solid black;float:left;margin-top:0px;");
		}
		
		bodyDiv.appendChild(commentDiv);
	
		var commentTitleDiv = mainDocument.createElement("div");
		commentTitleDiv.setAttribute("style", "width:100%;background: transparent url(\"chrome://yaploud/skin/textbg.png\");color:black;margin-bottom:10px;");
		var commentTitle = mainDocument.createTextNode('Post a comment:');
		commentTitleDiv.appendChild(commentTitle);
		commentDiv.appendChild(commentTitleDiv);
		
		var commentField = mainDocument.createElement("textarea")
		commentField.setAttribute("cols", "99");
		commentField.setAttribute("rows", "3");
		commentField.setAttribute("name", "yaploud_newComment");
		commentField.setAttribute("id", "yaploud_newCommentText");
		commentField.setAttribute("wrap", "soft");
		commentField.setAttribute("style", "background-color:white;font:8pt sans-serif;margin-left:10px;");
		commentField.onkeypress = yaploud_checkKeyPressFunction();
		commentDiv.appendChild(commentField);
  
		var submitCommentButton = mainDocument.createElement("input");
		submitCommentButton.setAttribute("type", "button");
		submitCommentButton.setAttribute("value", "Submit");
		submitCommentButton.setAttribute("style", "float:right;margin-right:10px;margin-bottom:8px;margin-top:5px;");
		submitCommentButton.onclick = yaploud_addCommentFunction();
		commentDiv.appendChild(submitCommentButton);
		
		// Create the bottom bar
		var bottomDiv = mainDocument.createElement("div");
		bottomDiv.setAttribute("style", "background: transparent url(\"chrome://yaploud/skin/bottombar.png\");color:white;width:100%;height:13px;border:0;float:right;");
		bodyDiv.appendChild(bottomDiv);

		// Get the messages and set the timer
		yaploud_getNewMessages();
		// Set the timer to check for new messages every few seconds.
		if (functionTimer == null) {
			functionTimer = window.setInterval(yaploud_getNewMessages, timerInterval);
		}
		
		if (logged_in) {
			// Alert the server that we have joined the chat
			yaploud_joinChat();
		}
	
	} else {
  
		chatWindow.style.display = "block";
		if (logged_in) {
			// Alert the server that we have joined the chat
			yaploud_joinChat();
		}
	}
  
	var chatButton = document.getElementById("yaploud_chatButton");
	// Set the carrot symbol to the open image and change the text
	chatButton.setAttribute("style", "list-style-image:url(\"chrome://yaploud/skin/testopen.png\");");
	chatButton.oncommand = yaploud_closeChatFunction();
  
}


function yaploud_checkKeyPressFunction() {
	
	return function(event) {
		
		var winWrapper = new XPCNativeWrapper(content, "doc");
	
		var keycode = 0;
		if (winWrapper.event) {
			keycode = winWrapper.event.keyCode;
		} else if (event) {
			keycode = event.which;
		} else {
			return;
		}
		
		if (keycode == 13) {
			yaploud_addComment();
		}
			
	
	}
}


function yaploud_checkLoginKeyPressFunction() {


	return function(event) {
		
		var winWrapper = new XPCNativeWrapper(content, "doc");
	
		var keycode = 0;
		if (winWrapper.event) {
			keycode = winWrapper.event.keyCode;
		} else if (event) {
			keycode = event.which;
		} else {
			return;
		}
		
		if (keycode == 13) {
			yaploud_processLogin();
		}
			
	
	}


}


// This function will hide the login window and display the add comment window
function yaploud_showCommentWindow() {

  var winWrapper = new XPCNativeWrapper(content, "doc");
  var mainDocument = new XPCNativeWrapper(winWrapper.document, "top");

  var loginDiv = mainDocument.getElementById("yaploud_logindiv");
  if (loginDiv != null) {
	loginDiv.style.display = "none";
  }
  
  var commentDiv = mainDocument.getElementById("yaploud_commentDiv");
  if (commentDiv != null) {
	commentDiv.style.display = "block";
  }
  
  yaploud_clearMessages();
  yaploud_getNewMessages();



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

function yaploud_processLogin() {

	var winWrapper = new XPCNativeWrapper(content, "doc");
	var mainDocument = new XPCNativeWrapper(winWrapper.document, "top");
	var error = false;
	
	// Make sure the user entered both a username and a password before contacting the server
	var username = mainDocument.getElementById("yaploud_username");
	var password = mainDocument.getElementById("yaploud_password");
	
	if (username.value == "" || password.value == "") {
		// No username, display an error message
		alert("Username and Password are both required fields.");
		return;
	}
		
		
	// Submit the data to the server and attempt to log the user in
	var oXHR = yaploud_createXHR();
	var addr = "http://www.yaploud.com/login.php";
	oXHR.open("POST", addr, true);
	oXHR.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	user = username.value;
	
	// Set up the response handler
	oXHR.onreadystatechange = function () {
	
		if (oXHR.readyState == 4) {
			// Request completed, check response code
			if (oXHR.status == 200) {
				// Request completed successfully, process the returned comments
				var data = eval('(' + oXHR.responseText + ')');
					
				if (data.success != null) {
					logged_in = true;
					var logoutDiv = mainDocument.getElementById("yaploud_logoutDiv");
					logoutDiv.style.display = "block";
					var welcomeDiv = mainDocument.getElementById("yaploud_welcomeMessage");
					welcomeDiv.innerHTML = "Welcome " + user + "!";
					yaploud_showCommentWindow();
					var loginForm = mainDocument.getElementById("yaploud_loginForm");
					loginForm.reset();
					yaploud_joinChat();
						
				} else {
					user = "";
					alert(data.error);
				}
				
			} else {
					
				alert("Error " + oXHR.status + " occurred when attempting to contact the server.");
			}
		
		}	

	}
		
	// format the post data
	var postData = "username=" + encodeURIComponent(username.value) + "&password=" + encodeURIComponent(password.value);
		
	oXHR.send(postData);
		
}

function yaploud_processLoginFunction() {

	return yaploud_processLogin; 
		
	
}


// This function will remove all existing messages
function yaploud_clearMessages() {

	var winWrapper = new XPCNativeWrapper(content, "doc");
	var mainDocument = new XPCNativeWrapper(winWrapper.document, "top");
	var chatTableBody = mainDocument.getElementById("yaploud_messagesTableBody");
	chatTableBody.innerHTML = "";
	lastMessageId = 0;

}


// This function will retrieve any new messages from the server.
// It will also call the function to update the list of current yappers  
function yaploud_getNewMessages() {

	var oXHR = yaploud_createXHR();
	var addr = "http://www.yaploud.com/get_msg.php?url=" + encodeURIComponent(currentLocation) + "&last_msg_id=" + encodeURIComponent(lastMessageId);
	oXHR.open("GET", addr, true);
	// Set up the response handler
	oXHR.onreadystatechange = function () {
	
		if (oXHR.readyState == 4) {
			// Request completed, check response code
			if (oXHR.status == 200) {
				// Request completed successfully, process the returned comments
				if (debug == true) {
					alert(oXHR.responseText);
				}
				var data = eval('(' + oXHR.responseText + ')');
				yaploud_showMessages(data.msgs);
				yaploud_showYappers(data.users);
				
			}		
		
		}	
	
	}
	
	oXHR.send(null);



}


// The yaploud_showMessages function receives an array of messages which will be appended 
// to the currently displayed messages.
function yaploud_showMessages(messages) {

	var winWrapper = new XPCNativeWrapper(content, "doc");
	var mainDocument = new XPCNativeWrapper(winWrapper.document, "top");
	var i = 0;
	var chatTableBody = mainDocument.getElementById("yaploud_messagesTableBody");
	var chatDiv = mainDocument.getElementById("yaploud_chatdiv");

	if (chatTableBody != null) {
	  for (i = messages.length - 1; i >= 0; i--) {
		
		
		if (messages[i].id > lastMessageId) {
			var chatTableRow1 = mainDocument.createElement("tr");
			chatTableBody.appendChild(chatTableRow1);
  
			var userData = mainDocument.createElement("td");
			userData.setAttribute("valign", "top");
			userData.appendChild(mainDocument.createTextNode(messages[i].s + "  (" + messages[i].t + ") :"));
			if (logged_in == true && messages[i].s == user) {
				userData.setAttribute("style", "font:8pt sans-serif;color:blue;width:158px;");
			} else {
				userData.setAttribute("style", "font:8pt sans-serif;color:red;width:158px;");
			}
			chatTableRow1.appendChild(userData);
  
			var message = mainDocument.createElement("td");
			var messageDiv = mainDocument.createElement("div");
			messageDiv.setAttribute("style", "width:292px;font:8pt sans-serif;word-wrap:break-word;overflow:none;");
			messageDiv.appendChild(mainDocument.createTextNode(messages[i].msg));
			//message.appendChild(mainDocument.createTextNode(messages[i].msg));
			//message.setAttribute("style", "width:292px;font:8pt sans-serif;word-wrap:break-word;");
			chatTableRow1.appendChild(message);
			message.appendChild(messageDiv);
			lastMessageId = messages[i].id;
			
			chatDiv.scrollTop = chatDiv.scrollHeight;
		}

	  }
	}
	
	
}


function yaploud_chatAtYaploud(event) {
	
	// This function redirects the user to YapLoud.com to chat there
	var winWrapper = new XPCNativeWrapper(content, "doc");
	var mainDocument = new XPCNativeWrapper(winWrapper.document, "top");

	var ref_url = mainDocument.location;
	ref_url = encodeURIComponent(ref_url);
	mainDocument.location = 'http://www.yaploud.com/chat.php?url=' + ref_url; 
	return;
	

}


// This function alerts the server that we have joined the chat
function yaploud_joinChat() {

	var oXHR = yaploud_createXHR();
	var addr = "http://www.yaploud.com/adduser_room.php?url=" + encodeURIComponent(currentLocation) + "&username=" + encodeURIComponent(user) + "&session=0000";
	oXHR.open("GET", addr, true);
	// Set up the response handler
	oXHR.onreadystatechange = function () {
	
		if (oXHR.readyState == 4) {
			// Request completed, check response code
			if (oXHR.status == 200) {
				// Request completed successfully, we are now a part of the chat
				if (debug == true) {
					alert(oXHR.responseText);
				}
				
			} else {
				alert("Server error:  Couldn't join the chat");
			}
		
		}	
	
	}
	
	oXHR.send(null);

}


// This function alerts the server that we have left the chat
function yaploud_leaveChat() {

	var oXHR = yaploud_createXHR();
	var addr = "http://www.yaploud.com/deluser_room.php?url=" + encodeURIComponent(currentLocation) + "&username=" + encodeURIComponent(user);
	oXHR.open("GET", addr, true);
	// Set up the response handler
	oXHR.onreadystatechange = function () {
	
		if (oXHR.readyState == 4) {
			// Request completed, check response code
			if (oXHR.status == 200) {
				// Request completed successfully, we are now a part of the chat
				
			} else {
				alert("Server error:  Couldn't leave the chat");
			}
		
		}	
	
	}
	
	oXHR.send(null);	



}




// This function displays the members of the current chat room
function yaploud_showYappers(yappers) {

	var winWrapper = new XPCNativeWrapper(content, "doc");
	var mainDocument = new XPCNativeWrapper(winWrapper.document, "top");
	var yapperTableBody = mainDocument.getElementById("yaploud_yapperTableBody");
	var yapperRow = null;
	var yapperName = null;
	
	numYappers = yappers.length;
	var chatButton = document.getElementById("yaploud_chatButton");
	chatButton.setAttribute("label", numYappers + " Yapper(s)");
	
	if (yapperTableBody != null) {
	  
	  yapperTableBody.innerHTML = "";
	  
	  for (i = 0; i < yappers.length; i++) {
		
		yapperRow = mainDocument.createElement("tr");
		yapperTableBody.appendChild(yapperRow);
		yapperName = mainDocument.createElement("td");
		yapperName.appendChild(mainDocument.createTextNode(yappers[i]));
		
		if (yappers[i] == user && logged_in == true) {
			yapperName.setAttribute("style", "font:8pt sans-serif;color:blue;");
		} else {
			yapperName.setAttribute("style", "font:8pt sans-serif;color:red;");
		}

		yapperRow.appendChild(yapperName);

	  }
	}



}


/*********************************************************************
 * The following code is to support drag and drop for the chat window
 *********************************************************************/

var xchange = 0;
var ychange = 0; 

function yaploud_handleMouseDown() {
	
	return function(event) {
	
		var winWrapper = new XPCNativeWrapper(content, "doc");
		var mainDocument = new XPCNativeWrapper(winWrapper.document, "top");
		
		if (xchange == 0 && ychange == 0) {
			xchange = event.clientX - chatWindow.offsetLeft;
			ychange = event.clientY - chatWindow.offsetTop;
		}
		mainDocument.body.addEventListener("mousemove", yaploud_handleMouseMove, false);
		mainDocument.body.addEventListener("mouseup", yaploud_handleMouseUp, false);
		//alert("Mouse pressed.  xchange = " + xchange + " ychange = " + ychange);
	
	}

}


function yaploud_handleMouseUp(event) {
	
	
	var winWrapper = new XPCNativeWrapper(content, "doc");
	var mainDocument = new XPCNativeWrapper(winWrapper.document, "top");
	mainDocument.body.removeEventListener("mousemove", yaploud_handleMouseMove, false);
	mainDocument.body.removeEventListener("mouseup", yaploud_handleMouseUp, false);
	xchange = 0;
	ychange = 0;
	

}


function yaploud_handleMouseMove(event) {
	
	var winWrapper = new XPCNativeWrapper(content, "doc");
	var mainDocument = new XPCNativeWrapper(winWrapper.document, "top");
	//var event = winWrapper.event;
	var newXPos = event.clientX - xchange;
	var newYPos = event.clientY - ychange;
	var chatdiv = mainDocument.getElementById("yaploud_chatWindow");
	//alert("New position: x = " + newXPos + " y = " + newYPos);
	chatdiv.style.left = newXPos;
	chatdiv.style.top = newYPos;

}


/********************************************************************
 * End of drag and drop code
 ********************************************************************/


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


