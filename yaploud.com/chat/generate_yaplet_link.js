

var yaploud_yaplink_el = document.getElementById('yaploud_yaplink');
if (yaploud_yaplink_el && document.location) {
    var url = document.location;
    var link_name = 'Open Yaplet';
    var code = '<a href="' + url + '" ' + 
               "onclick='openChatWindow(" +
               '"' + url + '", ' +
               '"' + url + '");' +
               '>' + link_name + '</a>'; 
    
    yaploud_yaplink_el.innerHTML = code;
}
