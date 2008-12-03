<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
 <title>PetChat brought to you by dogtime.com</title>
 <link rel="stylesheet" type="text/css" href="http://partners.dogtime.com/network/0.0.1/core/petchat//c/petchat_popup.css" />
 <script type="text/javascript">
  function openExternal (link) {
    if (link.getAttribute) {
      var url = link.getAttribute("href");
      if (url != null) {
        window.open(url, "externalWindow");
      }
    }
    return(false);
  }
 </script>
</head>
<body>

 <div id="leftCol">
  <div id="banner">

   <img src="http://partners.dogtime.com/network/0.0.1/core/petchat//i/petchat_banner.gif" border="0"  width="269" height="78" alt="PetChat" />
  </div>
  <div id="ad">
   <img src="http://partners.dogtime.com/network/0.0.1/core/petchat//i/petchat_sponsored_by.gif" width="300" height="15" alt="PetChat sponsored by.." /><br />

   <iframe id="adFrame" src="http://d3.zedo.com/jsc/d3/ff2.html?n=809;c=574/3;s=2;d=9;w=300;h=250" frameborder="0" marginheight="0" marginwidth="0" scrolling="no" allowTransparency="true" width="300" height="250"></iframe>

  </div>
 </div>

 <div id="rightCol">
  <div id="powBy">
    <span class="yap-about">Yapping about:</span> Live chat with pet lovers
  </div>
  <iframe id="chatFrame" src="" frameborder="0"></iframe>
  <div id="logoBar">
   <img src="http://partners.dogtime.com/network/0.0.1/core/petchat//i/petchat_broughttype-49x38.gif" width="49" height="38" /><a href="http://dogtime.com/" onclick="return(openExternal(this));"><img src="" width="120" height="40" border="0" /></a><a href="http://dogtime.com/" onclick="return(openExternal(this));"><img src="http://partners.dogtime.com/network/0.0.1/core/petchat//i/petchat_dtclogo-161x38.gif" width="161" height="38" border="0" /></a><a href="http://yaploud.com/home.php" onclick="return(openExternal(this));"><img height="38" border="0" width="92" src="http://partners.dogtime.com/network/0.0.1/core/petchat//i/petchat_yaploudlogo.gif" /></a>
  </div>

 </div>
 <div id="footer">
  <img id="cs-i" src="http://partners.dogtime.com/network/0.0.1/core/petchat//i/petchat_starter1.gif" width="732" height="44" />
 </div>

 <!-- Ad rotation -->
 <script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/yuiloader/yuiloader-beta-min.js"></script>
 <script type="text/javascript" src="http://yui.yahooapis.com/combo?2.5.2/build/yahoo-dom-event/yahoo-dom-event.js"></script>

 <script type="text/javascript" src="http://partners.dogtime.com/widgets/ad_rotator/v0.0.1/j/dtm-ad-rotator.js"></script>
 <script type="text/javascript">
  YAHOO.util.Event.onDOMReady(function () {
   // Initialize the iframe through JS so crawlers don't instantiate it.
   var chatFrame = YAHOO.util.Dom.get("chatFrame");
   chatFrame.src = "http://www.yaploud.com/chat/chat_window.php?url=http://dogtimemedia.com&title=Live+chat+with+pet+lovers&c=dogtimemedia&yaploud_css=http://partners.dogtime.com/service_providers/yaploud/chat/chat_window.css";
   DTM.utility.AdRotator.rotateAd("adFrame");
  });
 </script>
 <!-- /Ad rotation -->

 <!-- Conversation starters rotation -->
 <script type="text/javascript">
  // The delay in rotating images
  var csDelay = 20000;
  
  // Preload conversation starters
  var csImageNames = [
    "petchat_starter1.gif",
    "petchat_starter2.gif",
    "petchat_starter3.gif"
  ];
  var csImageURLBase = "http://partners.dogtime.com/network/0.0.1/core/petchat//i/";
  var csImages = new Array;
  for (var i=0; i < csImageNames.length; i++) {
    csImages[i] = new Image();
    csImages[i].src = csImageURLBase + csImageNames[i];
  }

  function rotateConversationStarters (i) {
    var next = (i+1) % csImages.length;
    
    var imageEl = YAHOO.util.Dom.get("cs-i");
    if (imageEl != null) {
      imageEl.src = csImages[i].src;
    }
    setTimeout("rotateConversationStarters(" + next + ")", csDelay);
  }
  
  YAHOO.util.Event.onDOMReady(function () {setTimeout("rotateConversationStarters(1)", csDelay)});
 </script>
 <!-- /Conversation starters rotation -->
 
 <!--
  GA code that is customized for PetChat since it is a widget that will be
 launched from multiple domains and it is a popup without a real url.
  We are also specifying the non-SSL version so we can avoid a doc.write
-->

<script type="text/javascript" src="http://www.google-analytics.com/ga.js"></script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-2208727-1");
pageTracker._setDomainName("none");
pageTracker._setAllowLinker(true);
pageTracker._trackPageview("/dtm-widget/petchat/100/dogtime.com");
</script>
</body>
</html>