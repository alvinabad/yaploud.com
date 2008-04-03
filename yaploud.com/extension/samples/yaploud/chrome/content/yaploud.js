var Yaploud = {};

Yaploud.getSelectedText = function(charlen) {
    var focusedWindow = document.commandDispatcher.focusedWindow;
    var searchStr = focusedWindow.getSelection();      
    searchStr = searchStr.toString();

    var originalSearchStrLength = searchStr.length;

    if ( !charlen ) {
        charlen = 4096;
    }

    if ( charlen < searchStr.length ) {
        var pattern = new RegExp("^(?:\\s*.){0," + charlen + "}");
        pattern.test(searchStr);
        searchStr = RegExp.lastMatch;
    }

    searchStr = searchStr.replace(/^\s+/, "");
    searchStr = searchStr.replace(/\s+$/, "");
    searchStr = searchStr.replace(/\s+/g, " ");

    return { str:searchStr, len:originalSearchStrLength };
};

Yaploud.oncommand = function() {
    var notes ='';
    
    var selectedObj = Yaploud.getSelectedText(4096);
    if ( selectedObj.str ) {
        notes = selectedObj.str;
    }
    
    var location, title;
    var browser = window.getBrowser();
    var webNav = browser.webNavigation;
    
    // get URL of the page
    if( webNav.currentURI ) {
        location = webNav.currentURI.spec;
    }
    else {
        location = gURLBar.value;  
    }

    // get title of the page
    if( webNav.document.title ) {
        title = webNav.document.title;
    } 
    else {
        title = location;
    }
    
    if ( location == "" || location == "about:blank" )
    	return;
    	
    var browser = document.getElementById("content");

    location = encodeURIComponent(location);
    title = encodeURIComponent(title);
    notes = encodeURIComponent(notes);  
    
    //var tab = browser.addTab('http://digg.com/submit?phase=2&url=' + encodeURIComponent(location) + '&title=' + encodeURIComponent(title) + '&bodytext=' + encodeURIComponent(notes));  
    //browser.selectedTab = tab;
        
    alert("Title: " + title + "\n" + "Location: " + location + "\n\n" + notes);
    
    var yaploud_home = 'http://www.yaploud.com/home.php';
    
    window.open(yaploud_home + '?url=' + location + '&title=' + title + 
                '&bodytext=' + notes);  
};