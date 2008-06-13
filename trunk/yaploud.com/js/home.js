
function $(id) {
	return document.getElementById(id);
}

function openChatWindow_deprecated(site_url, title) {
    var url = "/chat/chat_window.php?url=" + site_url +
              "&title=" + title;
    var features = "width=320, height=320, status=yes, " +
                   "menubar=no, toolbar=no, status=no, " +
                   "location=no, resizable=yes, left=100, top=100";
    window.open(url, "", features);
}
   
function strip_http() {
    var url = document.getElementById("yapurl_box");
    url.value = url.value.replace('/^http:\/\//', '');
}


function select_link() {
    reset_links();
    this.style.fontWeight = "bold";
    this.style.color = "brown";
}

function reset_links() {
    $('most_yaps').style.fontWeight = "normal";
    $('most_yaps').style.color = "black";
    
    $('most_recentyaps').style.fontWeight = "normal";
    $('most_recentyaps').style.color = "black";
    
    $('most_numberyaps').style.fontWeight = "normal";
    $('most_numberyaps').style.color = "black";
}

var most_discussed_el = document.getElementById('most_discussed');
var most_active_el = document.getElementById('most_active');
var most_recent_el = document.getElementById('most_recent');
var most_yappers_el = document.getElementById('most_yappers');

function reset_tabs() {
    most_discussed_el.style.textDecoration = "none";
    most_active_el.style.textDecoration = "none";
    most_recent_el.style.textDecoration = "none";
    most_yappers_el.style.textDecoration = "none";
    
    most_active_el.style.fontWeight = "normal";
    most_recent_el.style.fontWeight = "normal";
    most_yappers_el.style.fontWeight = "normal";
    most_discussed_el.style.fontWeight = "normal";
}

function init() {
    Nifty("div.yap_url, div#tagCloud","big, transparent");
    //Nifty("div#tagCloud", "big, transparent");
    
    reset_tabs();
    if (list_order == 'most_active') {
        most_active_el.style.textDecoration = "underline";
        most_active_el.style.fontWeight = "bold";
    }
    else if (list_order == 'most_recent') {
        most_recent_el.style.textDecoration = "underline";
        most_recent_el.style.fontWeight = "bold";
    }
    else if (list_order == 'most_yappers') {
        most_yappers_el.style.textDecoration = "underline";
        most_yappers_el.style.fontWeight = "bold";
    }
    else {
        most_discussed_el.style.textDecoration = "underline";
        most_discussed_el.style.fontWeight = "bold";
    }
    
    //var homeTabs = new YAHOO.widget.TabView("center_nav");    
    //YAHOO.util.Event.addListener($('most_yaps'), "click", select_link); 
    
    //YAHOO.util.Event.addListener($('most_recentyaps'), "click", select_link); 
    //YAHOO.util.Event.addListener($('most_numberyaps'), "click", select_link); 

}

YAHOO.util.Event.onDOMReady(init);
