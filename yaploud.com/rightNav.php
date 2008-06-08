
<script type="text/javascript" src="/js/util.js" ></script>
<script type="text/javascript" src="/extension/browser_extension.js" ></script>

<!-- RIGHT NAV SECTION -->
<div id="rightnav">
    <div id="plugins">
        <a href="/extension/yaploud.xpi" onclick="installxpi(this); return false;">
          Firefox Add-on
        </a>
    </div>
    <hr/>
    <div id="bookmarklet">
        <label>Bookmarklet</label>
        <br/>
        <div style="clear: both;"></div>
        <div style="text-align: center;">
            <a href="javascript: newurl = window.location.href.replace(/^http:\/\//,'http://www.yaploud.com/chat/chat_window.php?url=http://');
               newurl = newurl + '&title=' + window.document.title;
               if (location.hostname.indexOf('yaploud') == -1)
               window.open(newurl, '', 'width=340, height=340, status=yes, 
                         scrollbars=no, menubar=no, toolbar=no, location=no, 
                         resizable=yes'); void 0;">
                <img alt="YapLoud" src="/images/bookmarklet.jpg" style="vertical-align: bottom;">
            </a>
        </div>
        <ul>
            <li>
               <b>Firefox and Safari browsers</b>: Drag the image above to your toolbar.
            </li>
            <li>
               <b>IE browser</b>: Right-click on the image and select "Add to Favorites..."
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
        <label>Open a chat window</label>
        <br/>
        <a href='javascript: promptChatUrl(); void 0;'>Enter URL here</a>
    </div>
    <hr/>
    
    <div id="tour">
    <a href="/help/tour.php">Virtual Tour</a>
    <br>
    <a href="/chat/embed_code.php"> Embed yap window </a>
    </div>
    <hr/>
   
    <div id="tagCloud">
        <label>Tag Cloud</label><p>
        <?php 
        require_once 'db.inc';
        include("chat/YapLoudCloud.php"); 
        ?>
         
    </div>
     
     
    <div style="clear: both"></div>
</div>
