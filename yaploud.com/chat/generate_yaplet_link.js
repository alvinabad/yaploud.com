

var yaploud_yaplink_el = document.getElementById('yaploud_yaplink');
if (yaploud_yaplink_el && document.location) {
    var url = document.location;
    var link_name = 'Open Yaplet';
    var code = '<a href=' + 
               "onclick='openChatWindow(" +
               '"' + url + '", ' +
               '"' + url + '");' +
               '>' + link_name + '</a>'; 
    alert(code);
    yaploud_yaplink_el.innerHTML = code;
}
