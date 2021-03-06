var yap_words = [
                'Google',
                'resume',
                'Second Life',
                'service',
                'Hindu College',
                'Hansraj College',
                'Ramjas College',
                'user suggestions',
               ];


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

var parent_node = null;

function addYaplinkNode(node, text) {
	var yaplet_url = "http://www.yaploud.com/home.php#" + text;
	
    var new_node = document.createElement('a');
    var yaplink_url = 'javascript: openChatWindow(' +
               "'" + yaplet_url + "', " +
               "'" + text + "', " + 
               "'" + text + "')" +
               '; void 0;';
        
    var style_str = "border-bottom: double; text-decoration: none;";
    
    new_node.setAttribute('href', yaplink_url);
    new_node.setAttribute('id', 'yaplink_url');
    new_node.setAttribute('style', style_str);
    appendTextNode(new_node, text);
    node.appendChild(new_node);
}

function appendTextNode(node, text) {
    var text_node = document.createTextNode(text);
    node.appendChild(text_node);
}

var found = false;

function parseNode(node) {
    if (node.nodeType == 3) {
    	var words = node.nodeValue;
    	var pre_words = "";
    	
    	// skip empty text node
    	if (words.replace(/(\n|\r)+$/, '').length == 0) {
    		return;
    	}
    	
    	// find yap_words in text
    	for(var x=0; x<yap_words.length; x++) {
    		yapword_index = words.indexOf(yap_words[x]);
    		yapword_length = yap_words[x].length;
    		
    		if (yapword_index != -1) {
    			found = true;
             	node.nodeValue = "";
            	pre_words = words.substr(0, yapword_index);
            	remaining_words = words.substr(yapword_index + yapword_length);
            	
            	appendTextNode(parent_node, pre_words);
            	addYaplinkNode(parent_node, yap_words[x]);
            	appendTextNode(parent_node, remaining_words);
    		}
    		
    		// quit after first find
    		if (found) {
    			break;
    		}
    	}
    }
    
    if (node.childNodes != null) {
        for (var i=0; i < node.childNodes.length; i++) {
        	parent_node = node;
        	var new_node = node.childNodes.item(i);
        	
        	// skip yaplink element nodes
        	if (new_node.nodeType == 1 && new_node.getAttribute('id') == 'yaplink_url') {
        		continue;
        	}
        	
        	if (found) {
        		found = false;
        		continue;
        	}
        	
            parseNode(new_node);
        }
            
    }
}

function init() {
	var div_el = document.getElementById('yaploud_yapwords');
	
	parent_node = div_el;
	parseNode(div_el);
}

window.onload = init;