
function includeJavascript(src) {
    if (document.createElement && document.getElementsByTagName) {
        var head_tag = document.getElementsByTagName('head')[0];
        var script_tag = document.createElement('script');
        script_tag.setAttribute('type', 'text/javascript');
        script_tag.setAttribute('src', src);
        head_tag.appendChild(script_tag);
    }
}

includeJavascript('http://www.yaploud.com/js/util.js');

var yaploud_yaplink_el = document.getElementById('yaploud_yaplink');
if (yaploud_yaplink_el && document.location) {
    var url = document.location;
    var link_name = 'Open Yaplet';
    var code = '<a href="javascript: ' +
               'openChatWindow(' +
               "'" + url + "', " +
               "'" + url + "')" +
               '; void 0;' + '"' +
               '>' + link_name + '</a>'; 
    yaploud_yaplink_el.innerHTML = code;
}
