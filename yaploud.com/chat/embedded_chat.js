
var last_msg_id = -1;
var on_color = "on_row";
var off_color = "off_row";
var last_color = "on_row";
var poll_interval = 7000;

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


function $(s) {
	return document.getElementById(s);
}

function getNextColor(last_color) {
    if(last_color == on_color) {
    	return off_color;
    }
    
    return on_color;
}

function callback(s){
    var m = $('yaploud_msgs');
    var msgs = s.msgs;
    var len = msgs.length;
    if(len <= 0){return;}
    last_msg_id = msgs[0].id;
    var tmp_html = '';
    for(var i = len-1; i>=0; i--){
        var color = getNextColor(last_color);
        last_color = color;
        tmp_html += "<div class=\"row " + last_color + "\">" + 
                    msgs[i].s + ": " + 
                    //msgs[i].t + " " + 
                    msgs[i].msg + 
                    "</div>";
    }
    m.innerHTML = m.innerHTML + tmp_html;
    m.scrollTop = m.scrollHeight;
    if ( navigator.appName == "Microsoft Internet Explorer" ) {
        m.scrollTop = m.scrollHeight; // IE7 requires running this twice!
    }
   
}


function includeJavascript(src) {
    if (document.createElement && document.getElementsByTagName) {
        var head_tag = document.getElementsByTagName('head')[0];
        var script_tag = document.createElement('script');
        script_tag.setAttribute('type', 'text/javascript');
        script_tag.setAttribute('src', src);
        head_tag.appendChild(script_tag);
    } else {
     //alert('include failed');
    }
}

function includeCSSfile(href) {
    var head_node = document.getElementsByTagName('head')[0];
	var link_tag = document.createElement('link');
    link_tag.setAttribute('rel', 'stylesheet');
    link_tag.setAttribute('type', 'text/css');
    link_tag.setAttribute('href', href);
    head_node.appendChild(link_tag);
}

function create_div(parent_node, id_value, class_value) {
    if (document.createElement && document.getElementsByTagName) {
    	var div_tag = document.createElement('div');
    	div_tag.setAttribute('id', id_value);
    	div_tag.setAttribute('class', class_value);
    	parent_node.appendChild(div_tag);
    }
	
}

function appendHttp2Url(url) {
    if ( url.indexOf('http') == -1 ) {
        url = 'http://' + url;  
        // if protocol is not found, append http
        // this could be https but that's the best we can do
    }
    return url;
}

/*******************************************
 * Start of program
 *******************************************/
 


// include CSS file
includeCSSfile("http://logan:9000/chat/embedded_chat.css");

// include more javascript src
// includeJavascript();

var yapurl;
//yapurl = String(document.location);

if (!yapurl) {
    yapurl ="www.intrade.com";
}

yapurl = appendHttp2Url(yapurl);

var yaploud_msgs_div = document.getElementById('yaploud_msgs');

if (yaploud_msgs_div) {
    create_div(yaploud_msgs_div.parentNode, 'yaploud_title', 'yyy');
    yaploud_title_div = document.getElementById('yaploud_title');
    yaploud_title_div.innerHTML = "Yapping about this page: " + 
               '<br>' +
               '<a href="' +
               yapurl +
               '" target="_blank">' +
               yapurl +
               '</a>';
}

// Retrieve chat messages from server
get();
setInterval(get, poll_interval);

