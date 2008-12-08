
<script type="text/javascript" src="/js/util.js" ></script>
<script type="text/javascript" src="/extension/browser_extension.js" ></script>

<!-- RIGHT NAV SECTION -->
<div id="rightnav">
    <!-- <div id="plugins">
        <a href="/extension/yaploud.xpi" onclick="installxpi(this); return false;">
          Firefox Add-on
        </a>
    </div>
    <hr/>-->
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
               <b>FF, Safari </b>: Drag image to toolbar.
            </li>
            <li>
               <b>IE</b>: Right-click and select "Add to Favorites..."
            </li>
        </ul>
    </div>
    <!--
    <div id="embed">
        <a href="/chat/embed_code.php">Embed a yaplet</a>
        <br/>
    </div>
    <hr/>
    -->
    <!-- <div id="searchURL">
        <label>Open a chat window</label>
        <br/>
        <a href='javascript: promptChatUrl(); void 0;'>Enter URL here</a>
    </div>-->
    <hr/>

    <div id="tour">
    <a href="/help/tour.php">Virtual Tour</a>
    <br>
    <a href="/chat/embed_code.php"> Embed yap window </a>
    </div>
    <hr/>

<script type="text/javascript"><!--
google_ad_client = "pub-8718455105980393";
/* Right Nav 120x600, created 12/8/08 */
google_ad_slot = "6307022216";
google_ad_width = 120;
google_ad_height = 600;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>

    <div id="tagCloud">
        <label>Tag Cloud</label><p>
        <?php
        require_once 'db.inc';
        include("chat/YapLoudCloud.php");
        ?>

    </div>


    <div style="clear: both"></div>
</div>
