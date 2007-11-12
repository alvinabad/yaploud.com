   var last_msg_id = -1;
   var on_color = "on_row";
   var off_color = "off_row";
   var last_color = "on_row";
   function get(){
	var el = document.createElement('script');
	// el.setAttribute('src', 'http://www.yaploud.com/get_wid_msg.php?url=tim.com&last_msg_id=' + last_msg_id);
	//el.setAttribute('src', 'http://www.yaploud.com/get_wid_msg.php?url=http://www.cnn.com/2007/WORLD/asiapcf/11/04/pakistan/index.html&last_msg_id=' + last_msg_id);
	var enc = escape||encodeURIComponent;
	el.setAttribute('src', 'http://www.yaploud.com/get_wid_msg.php?url=' + enc(yapurl) + '&last_msg_id=' + last_msg_id);
	el.setAttribute('type', 'text/javascript');
	el.setAttribute('id', 'dynamic_script');
	var old = document.getElementById('dynamic_script');
	if(old){
              document.getElementsByTagName('head').item(0).removeChild(old);
	}
	document.getElementsByTagName('head').item(0).appendChild(el);
   }

   function $(s){return document.getElementById(s);}
   function getNextColor(last_color){
        if(last_color == on_color){return off_color;}
        return on_color;
   }

   function callback(s){
   	var m = $('_yaploudmsgs');
	var msgs = s.msgs;
	var len = msgs.length;
	if(len <= 0){return;}
	last_msg_id = msgs[0].id;
	var tmp_html = '';
	for(var i = len-1; i>=0; i--){
		var color = getNextColor(last_color);
		last_color = color;
		tmp_html += "<div class=\"row " + last_color + "\">" + msgs[i].s + ":" + msgs[i].t + " " + msgs[i].msg + "</div>";
	}
	m.innerHTML = m.innerHTML + tmp_html;
	m.scrollTop = m.scrollHeight;
   }

   setInterval(get, 1000);
