

function $(s) {
	return document.getElementById(s);
}


function generateEmbedCode() {
    var url = document.embed_form.url.value;
    var code = '<div id="yaploud"></div>' + '\n' +
               '<script>yapurl="' + url + '";' + '</script>' + '\n' +
               '<script type="text/javascript"' + '\n' +
               'src="http://www.yaploud.com/chat/embedded_chat.js">' + '\n' +
               '</script>';
    document.embed_form.text_area.value = code;
    return false;
}

function init() {
    var code = '<div id="yaploud"></div>' + '\n' +
               '<script type="text/javascript"' + '\n' +
               'src="http://www.yaploud.com/chat/embedded_chat.js">' + '\n' +
               '</script>';
    document.embed_form1.text_area1.value = code;
    
    //document.embed_form.text_area.disabled = "yes";
    //document.embed_form1.text_area1.disabled = "yes";
    
    $('url').focus();
}

YAHOO.util.Event.onDOMReady(init);
