   //yeah, i'll worry about namespaces later.
   var url = ''; 
   var last_msg_id = -1; //the most recent msg id we've received
   var sl = null;
   var already_hidden = false;
   var max_chars = 250;
   var on_color = "on_row";
   var off_color = "off_row";
   var last_color = "on_row"; 
   var time_on = false;
   var win_manager = new YAHOO.widget.OverlayManager();
   var invite_dia = null;

   YAHOO.util.Event.onAvailable('login_link', function(){
          var link = $('login_link');
          if(link == null || !link){
                  return;
          }
          var href = link.getAttribute('href');
	  link.setAttribute('href', href + "&src=" + encodeURIComponent(document.location));
   }, this);

   function $(id){return document.getElementById(id)}

   YAHOO.util.Event.onAvailable('invite_dialog', function(){
   	invite_dia = new YAHOO.widget.Dialog("invite_dialog", {buttons: [ {text:"Submit", handler:handleInviteFriend, isDefault:true}, {text:"Cancel", handler:handleInviteCancel}],iframe:true,zIndex:100000,width:"300px",fixedcenter:true, close:false,draggable:false,modal:true,visible:false,effect:{effect:YAHOO.widget.ContainerEffect.FADE, duration:0.5}});
   	invite_dia.render();
   });

   function handleInviteFriend(){
      var email = $('invite_email').value;
      var url = $('url').innerHTML;
      if(email == ''){return;}
      var xhr = xmlHttpCreate();
      xhr.open("GET", "invitefriend.php?url="+url+"&to="+email, true);
      xhr.onreadystatechange = function(){
   	if(xhr.readyState == 4 && xhr.status == 200){
	}
      }
      xhr.send("");
      invite_dia.hide();
   }

   function handleInviteCancel(){invite_dia.hide();}
   
   function invite_friend(){
	invite_dia.show();
   }


   function showLoading(){
   	sl = null;
   	sl = new YAHOO.widget.Panel("p", {
   		    iframe:true,
   		    zIndex:100000,
   		    width:"240px",
   		    fixedcenter:true, 
   		    close:false,
   		    draggable:true,
            constraintoviewport: true,
   		    modal:true,
   		    visible:false,
   		    effect:{effect:YAHOO.widget.ContainerEffect.FADE, duration:0.5}});
	sl.setHeader("Loading, please wait...");
	sl.setBody('<img src="http://us.i1.yimg.com/us.yimg.com/i/us/per/gr/gp/rel_interstitial_loading.gif" />');
	sl.render(document.body);
	sl.show();
   }

   function sendMsg(){
	var ta = escape(myEditor.getEditorHTML());
	var username = $('username').value;
	if(url == ''){
	   url = getURL();
	}
	var xml_req = xmlHttpCreate();
	xml_req.onreadystatechange = function(){
   		if(xml_req.readyState == 4 && xml_req.status == 200){
   	   	   $('msg_content').value = '';
		   myEditor.setEditorHTML('');
	   	   $('chars_left').innerHTML = max_chars;
		}
	}
	xml_req.open("GET", "put_msg.php?url=" + url + "&user=" + username + "&msg=" + ta, true);
	xml_req.send("");
	//don't forward the request
	return false;
   }


   function getURL(){
	var url_el = $('url');
	return encodeURIComponent(url_el.firstChild.nodeValue);
   }

   function show_msg_times(toggle){
	var a = YAHOO.util.Dom.getElementsByClassName('msg_time');
	time_on = (time_on === true ? false : true);
	for(var i = 0; i < a.length; i++){
	   YAHOO.util.Dom.setStyle(a[i], 'display', (time_on ? 'inline' : 'none'));
	}
      	$('msgs_div').scrollTop = $('msgs_div').scrollHeight;
   }

   /* obj - json object containing msgs */
   /* prepend - prepend cur obj to existing msgs */
   function renderMsgs(obj, prepend){
	var msgs_div = $('msgs_div');
	var msgs = obj.msgs;
	var len = msgs.length;
	var tmp_html = '';
	for(var i = len-1; i >= 0; i--){
		var color = getNextColor(last_color); 
		last_color = color;
	   	tmp_html += "<div class=\"row " + last_color + "\"><span class=msg_time>[" + msgs[i].t + "]</span> " + msgs[i].s + ":<span class=msg>" + msgs[i].msg + "</span></div>\n"; 
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

   function getNextColor(last_color){
      if(last_color == on_color){return off_color;}
      return on_color;
   }

   function more_messages(url){
      showLoading();
      var num_msgs = YAHOO.util.Dom.getElementsByClassName('row').length;
      var xhr = xmlHttpCreate();
      xhr.onreadystatechange = function(){
   	  if(xhr.readyState == 4 && xhr.status == 200){
	      var obj = eval('(' + xhr.responseText + ')'); 
	      if(obj.msgs.length > 0){
	         renderMsgs(obj, true);

	      }
	      sl.hide();
	  }
      }
      xhr.open("GET", "more_messages.php?url=" + url + "&cur_num_msgs=" + num_msgs, true);
      xhr.send("");
   }

   function getmsgs(){
	if(url == ''){
		url = getURL();
	}
   	var get_msgs_req = xmlHttpCreate();
	get_msgs_req.onreadystatechange = function(){
   	 if(get_msgs_req.readyState == 4 && get_msgs_req.status == 200){
	   var obj = eval('(' + get_msgs_req.responseText + ')'); 
	   var msgs = obj.msgs;
	   if(msgs.length > 0){
	        if(msgs[0].id <= last_msg_id){
			return;
		}
	        renderMsgs(obj); 
	   }
	   if(msgs.length > 0){
	      last_msg_id = msgs[0].id;
	      var stripped = msgs[0].msg.replace(/(<([^>]+)>)/ig,"");
	      document.title = msgs[0].s + " - " + stripped;
	   }
	   if(!already_hidden){
	      sl.hide();
	      already_hidden = true;
	   }
	   var users = obj.users;
	   var users_el = $('members');
	   users_el.innerHTML = '';
	   for(var i = 0; i < users.length; i++){
	      users_el.innerHTML += "<div class=room_user>" + users[i] + "</div>";
	   }
	 }
	}
	get_msgs_req.open("GET", "get_msg.php?url=" + url + "&last_msg_id=" + last_msg_id, true);
	get_msgs_req.send("");
	return false;
   }

   function searchTerm(term){
        var xhr = xmlHttpCreate();
	xhr.onreadystatechange = function(res){
   	   if(xhr.readyState == 4 && xhr.status == 200){
	       var el = $('results');
	       var obj = eval('(' + xhr.responseText + ')'); 
	       var r = obj.results;
	       if(r.length == 0){
	          el.innerHTML = "<p><h2>No search results for this query.</h3><br/>\n";
	       }
	       else{
	          el.innerHTML = "Found <span style=\"font-size:110%;\">" + r.length + " </span> results.<br/><hr/>\n";
	       }
	       for(i = 0; i < r.length; i++){
	       	  var res = r[i];
	       	  el.innerHTML += "<p><span class=s_result><span style=\"color:orange;font-size:18px;\">" + res.m + "</span><span><br/>by <b>" + res.s + "</b> on " + res.t + "<br/><a href=\"http://www.yaploud.com/chat.php?url=" + encodeURIComponent(res.url) + "\">" + res.url + "</a></span></span><br/>";
	       }

	   }
	}
	xhr.open("GET", "dosearch.php?q=" + encodeURIComponent(term), true);
	xhr.send("");
   }

   function startPolling(){
   	showLoading();
   	setInterval(getmsgs, 1300);
   }

   function sendRoomLogin(url, username){
        var log = xmlHttpCreate();
	log.onreadystatechange = function(req){
	}
	log.open("GET", "adduser_room.php?url=" + encodeURIComponent(url) + "&username=" + username, true);
	log.send("");
   }

   function sendRoomLeave(url, username, sessid){
   	var log = xmlHttpCreate();
	log.open("GET", "deluser_room.php?url=" + encodeURIComponent(url) + "&username=" + username);
	log.send("");
   }

   function editorKeyPress(charCode){
	var chars_el = $('chars_left');
	var left = parseInt(chars_el.innerHTML);
	switch(charCode){
	   case 13: //return key
   		if(myEditor.getEditorHTML().length > 0){
	   	   sendMsg();
		}
		break;
	   case 8:  //backspace
	   	//make sure not to allow max_chars to become > max_chars
		if(left < max_chars){
		   chars_el.innerHTML = ++left;
		}
	   	break;
	   default:
		chars_el.innerHTML = --left;
		break;
	}
   }

   function startMsgPull(){
   	YAHOO.util.Event.onAvailable('msgs_div', startPolling, this);
	YAHOO.util.Event.onAvailable('msg_content', function(){
	    myEditor = new YAHOO.widget.Editor('msg_content', { width: '400px', dompath: false, animate: false, toolbar: {  buttons: [ { group: 'textstyle', label: 'Font Style', buttons: [ { type: 'push', label: 'Bold', value: 'bold' }, { type: 'push', label: 'Italic', value: 'italic' }, { type: 'push', label: 'Underline', value: 'underline' }, { type: 'separator' }, { type: 'select', label: 'Arial', value: 'fontname', disabled: false, menu: [  { text: 'Arial', checked: true }, { text: 'Arial Black' }, { text: 'Comic Sans MS' }, { text: 'Courier New' }, { text: 'Lucida Console' }, { text: 'Tahoma' }, { text: 'Times New Roman' }, { text: 'Trebuchet MS' }, { text: 'Verdana' }] }, { type: 'spin', label: '13', value: 'fontsize', range: [ 9, 20 ], disabled: false }, { type: 'separator' }, {type:'color', label: 'Font Color', value: 'forecolor'}, { type: 'color', label: 'Background Color', value: 'backcolor'} ] } ] } });
   		myEditor.on('editorKeyPress', function(o){
         		editorKeyPress(YAHOO.util.Event.getCharCode(o.ev));
   		});
   		myEditor.render();
		$('msg_content').focus();
	});
   }




