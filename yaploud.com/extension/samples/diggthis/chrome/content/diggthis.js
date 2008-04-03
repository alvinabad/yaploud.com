function getSelectedText(charlen) 
    {
        var focusedWindow = document.commandDispatcher.focusedWindow;
        var searchStr = focusedWindow.getSelection();      
        searchStr = searchStr.toString();

        var originalSearchStrLength = searchStr.length;

        if ( !charlen )
        {
            charlen = 4096;
        }

        if ( charlen < searchStr.length ) 
        {
            var pattern = new RegExp("^(?:\\s*.){0," + charlen + "}");
            pattern.test(searchStr);
            searchStr = RegExp.lastMatch;
        }

        searchStr = searchStr.replace(/^\s+/, "");
        searchStr = searchStr.replace(/\s+$/, "");
        searchStr = searchStr.replace(/\s+/g, " ");

        return { str:searchStr, len:originalSearchStrLength };
    }

function digg() {
    alert("DIGGTHIS!");
}

function digg2()
    {
        var notes ='';
        var selectedObj = getSelectedText(4096);

        if ( selectedObj.str )
        {
            notes = selectedObj.str;
        }

        var location, title;
        var browser = window.getBrowser();
        var webNav = browser.webNavigation;
        if( webNav.currentURI )
        {
            location = webNav.currentURI.spec;
        }
        else
        {
            location = gURLBar.value;  
        }

        if( webNav.document.title )
        {
            title = webNav.document.title;
        } 
        else
        {
            title = location;
        }
        var browser = document.getElementById("content");

        var tab = browser.addTab('http://digg.com/submit?phase=2&url=' + encodeURIComponent(location) + '&title=' + encodeURIComponent(title) + '&bodytext=' + encodeURIComponent(notes));  
        browser.selectedTab = tab;
    }