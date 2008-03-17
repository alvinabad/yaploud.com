
var yaploud_site = "http://www.yaploud.com";
var open_url = yaploud_site + "/chat/chat_window.php?url=" + 
                document.location + "&title=" + document.title;

var embedded_yaplet_link_div = document.getElementById("eyl");
var html_text = '<a href=\'javascript: window.open(' + '"' +
                open_url + '"' + ',"", "width=320, height=320, status=yes, ' +
                'resizable=no, left=600, top=100"); void 0;\'>' +
                'Yap about this page</a>';
                
embedded_yaplet_link_div.innerHTML = html_text; 