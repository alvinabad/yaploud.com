<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/strict.dtd">

<?php
require("./pagechat_c.inc");
   header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
   header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
   header("Cache-Control: no-store, no-cache, must-revalidate");
   header("Cache-Control: post-check=0, pre-check=0", false);
   header("Pragma: no-cache");
?>

<html>
<head>
<title>Yaploud Page Chat</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<link rel="stylesheet" type="text/css" href="pagechat.css" />

<?php require("./yui.php"); ?>
<script src="pagechat.js"
    type="text/javascript"></script>


<style>
    #container {height:15em;}
</style>

</head>
<body class=" yui-skin-sam">

<div id="chat_panel">
  <div class="hd">CHAT URL: http://</div>
    <div class="bd">
      <div id="msg_rcv_div">receive yap messages</div>
      <div id="yappers_div">yappers go here</div>
      <div style="clear: both;"></div>
      <div id="msg_send_div"><!-- <textarea id="chat_textarea" rows="3" cols="37" border="0">text message</textarea> -->
        <textarea id="chat_textarea" rows="3" cols="37" disabled="disabled"
	              border="0">Login to send chat message</textarea>
	  </div>
      <div id="tag_div"></div>
      <div style="clear: both;"></div>
    </div>
  <div class="ft">Footer</div>
</div>

<div style="position: absolute; width: 100%; height: 100%; z-index: 1;">
  <iframe id="mainDocumentFrame" src="http://www.yahoo.com" 
              height="100%" width="100%" frameborder="0" marginwidth="0" 
              marginheight="0" vspace="0" hspace="0">
  </iframe>
</div>
      
</body>
</html>
