var keywords = ['Google',
                'resume',
                'Life',
                'service',
                'Hindu',
                'Hansraj',
                'Ramjas',
               ];

function chomp(str) {
  return str.replace(/(\n|\r)+$/, '');
}

function parseNode(node) {
    if (node.nodeType == 3) {
    	var words = node.nodeValue.split(' ');
    	for(var i=0; i<words.length; i++) {
    		for(var x=0; x<keywords.length; x++) {
    			if (keywords[x] == chomp(words[i])) {
    				words[i] = '<a href="http://www.yaploud.com">' + words[i] + '</a>';
    			}
    		}
    	}
    	node.nodeValue = words.join(' ');
    }
    
    if (node.childNodes != null) {
        for (var i=0; i < node.childNodes.length; i++) {
            parseNode(node.childNodes.item(i));
        }
    }
}

function init() {
	var div_el = document.getElementById('news');
	
	parseNode(div_el);
}
window.onload = init;