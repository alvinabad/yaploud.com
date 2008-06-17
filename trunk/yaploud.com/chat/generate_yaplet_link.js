
function openChatWindow(site_url, title) {
    if (site_url == null) {
        site_url = ext_url;
    }
    
    if (title == null) {
        title = site_url;
    }
    
    // check if attempting to chat same site
    if (site_url.indexOf(location.hostname) != -1) {
        return;
    }
    
    // bypass Apache' mod_security: Access denied with code 503 
    title = title.replace(/\s+\|/g, ' -').replace(/\|\s+/g, '- '); 
    
    site_url = encodeURIComponent_recursive(site_url);
    title = encodeURIComponent_recursive(title);
    var url = "/chat/chat_window.php?url=" + site_url + "&title=" + title;
    
    var features = "width=340, height=340, status=yes, " +
                   "scrollbars=no, menubar=no, toolbar=no, " +
                   "location=no, resizable=yes";
                   //"location=no, resizable=yes, left=100, top=100";
    window.open(url, "", features);
}

var yaploud_yaplink_el = document.getElementById('yaploud_yaplink');
if (yaploud_yaplink_el && document.location) {
    var url = document.location;
    var link_name = 'Open Yaplet';
    var code = '<a href="javascript: openChatWindow(' +
               "'" + url + "', " +
               "'" + url + "'); void 0;" + '"' +
               '>' + link_name + '</a>'; 
    alert(code);
    yaploud_yaplink_el.innerHTML = code;
}
