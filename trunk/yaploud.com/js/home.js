
function $(id) {
	return document.getElementById(id);
}

function openChatWindow(site_url, title) {
    var url = "/chat/chat_window.php?url=" + site_url +
              "&title=" + title;
    var features = "width=320, height=320, status=yes, " +
                   "menubar=no, toolbar=no, status=no, " +
                   "location=no, resizable=yes, left=600, top=100";
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

function init() {
    Nifty("div.yap_url, div#tagCloud","big, transparent");
    //Nifty("div#tagCloud", "big, transparent");
    
    //YAHOO.util.Event.addListener($('most_yaps'), "click", select_link); 
    //YAHOO.util.Event.addListener($('most_recentyaps'), "click", select_link); 
    //YAHOO.util.Event.addListener($('most_numberyaps'), "click", select_link); 
}

YAHOO.util.Event.onDOMReady(init);
