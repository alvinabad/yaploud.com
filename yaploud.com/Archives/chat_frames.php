<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<?php
   $url = $_GET['url'];
?>

<script type=text/javascript>

function close_frames() {

  var mainFrame = document.getElementById("mainDocumentFrame");
  var currentUrl = mainFrame.src;
  window.location.href = currentUrl;

}

function showChat() {

  var frame = document.getElementById("yaploudFrame");
  frame.style.opacity = "1";

}

function hideChat() {

  var frame = document.getElementById("yaploudFrame");
  frame.style.opacity = "0.3";

}


</script>

<html id="mainPage">
  <head>
    <link rel="stylesheet" href="style.css" type="text/css"/>
    <title>YapLoud.com</title>
    <script type="text/javascript">
      document.domain = "yaploud.com";
    </script>
  </head>
  <body id="mainBody">
    <div id="mainPageDiv">
      <iframe id="mainDocumentFrame" src="<?php print($url); ?>" height="100%" width="100%" frameborder="0" marginwidth="0" marginheight="0" vspace="0" hspace="0">
      </iframe>
    </div>
    <iframe id="yaploudFrame" src="http://www.yaploud.com/chat_frame.php?url=<?php print($url); ?>" frameborder="0" scrolling="no" allowtransparency="true" style="position:absolute;width:585px;height:470px;right:30px;top:0px;background:transparent;">
    </iframe>
    
  </body>
</html>
