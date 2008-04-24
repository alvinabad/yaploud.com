
<script type="text/javascript" src="/js/util.js" ></script>
<script type="text/javascript" src="/extension/browser_extension.js" ></script>

<!-- RIGHT NAV SECTION -->
<div id="rightnav">
    <div id="plugins">
        <a href="/extension/yaploud.xpi">
            <button onclick="installxpi(this); return false;">Install Firefox Add-on</button>
        </a>
    </div>
    <hr/>
    <div id="bookmarklet">
        <label>Bookmarklet:</label>
        <br/>
        <div style="clear: both;"></div>
        <div style="text-align: center;">
            <a href="javascript: newurl = window.location.href.replace(/^http:\/\//,'http://www.yaploud.com/chat/chat_window.php?url=http://');
               newurl = newurl + '&title=' + window.document.title;
               if (location.hostname.indexOf('yaploud') == -1)
               window.open(newurl, '', 'width=340, height=340, status=yes, 
                         scrollbars=1, menubar=no, toolbar=no, location=no, 
                         resizable=yes, left=100, top=100'); void 0;">
                <img alt="YapLoud" src="/images/bookmarklet.jpg" style="vertical-align: bottom;">
            </a>
        </div>
        <ul>
            <li>
                <label>Firefox and Safari:</label> Drag the image above to your toolbar.
            </li>
            <li>
                <label>IE:</label> Right-click on the image and select "Add to Favorites..."
            </li>
        </ul>
    </div>
    <hr/>
    <!--
    <div id="embed">
        <a href="/chat/embed_code.php">Embed a yaplet</a>
        <br/>
    </div>
    <hr/>
    -->
    <div id="searchURL">
        <label>Search YapURL:</label>
        Can't find the site people are yapping about? 
        <br/>
        <a href='javascript: promptChatUrl(); void 0;'>Enter URL here</a>
    </div>
    <hr/>
    
    <div id="tour">
        <label>Virtual Tour:</label>
        <br/>
        Take YapLouds <a href="/help/tour.php">virtual tour here</a>
    </div>
    <hr/>
    <!-- 
    <div id="tagCloud">
        <label>Tag Cloud</label>
        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim 
    </div>
     --> 
    <div style="clear: both"></div>
</div>
