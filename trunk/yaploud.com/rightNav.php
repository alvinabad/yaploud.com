
<script type="text/javascript" src="/js/util.js" ></script>
<script type="text/javascript" src="/extension/browser_extension.js" ></script>

<!-- RIGHT NAV SECTION -->
<div id="rightnav">
    <a href="/extension/yaploud.xpi">
    <button style="width: 170px; height: 25px; margin: 1px; padding 2px;" onclick="installxpi(this); return false;">Install Firefox Add-on</button>
    </a>
    <hr>
    <strong>Bookmarklet:</strong>
    <br>
    <div style="clear: both;"></div>
    <div style="text-align: center;">
    <a href="javascript: newurl = window.location.href.replace(/^http:\/\//,'http://www.yaploud.com/chat/chat_window.php?url=http://');
               newurl = newurl + '&title=' + window.document.title;
               if (location.hostname.indexOf('yaploud') == -1)
               window.open(newurl, '', 'width=340, height=340, status=yes, 
                         scrollbars=1, menubar=no, toolbar=no, location=no, 
                         resizable=yes, left=100, top=100'); void 0;">
    <img style="border: 1.5px outset green; vertical-align: bottom;" src=/images/logo.gif alt="YapLoud" width="40%" ></a>
    </div>
    <ol style="padding-left:10px;">
    <li style="margin:0; padding:0;">
    Firefox and Safari: 
    <br>
    Drag the image above to your toolbar.
    </li>
    <li>
    IE:
    <br>
    Right-click on the image and select "Add to Favorites..."
    </li>
    </ol>
    <!-- 
    <hr>
    <a href="/chat/embed_code.php">Embed a yaplet</a> 
    <br>
     -->
    <hr>
    Can't find the site people are chatting about? 
    <br>
    <a href='javascript: promptChatUrl(); void 0;'>Enter URL here</a> 
    <hr>
    <!-- 
    <div id="tagCloud">
        <strong>Tag Cloud</strong>
        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim 
    </div>
     --> 
    <br/>
    <div style="clear: both"></div>
</div>
