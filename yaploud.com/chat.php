<?php
   ob_start("ob_gzhandler");
   session_start();
   header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
   header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
   header("Cache-Control: no-store, no-cache, must-revalidate");
   header("Cache-Control: post-check=0, pre-check=0", false);
   header("Pragma: no-cache");
   // store this URI in session. This will be used so that the next page
   // can access the previous one if it needs to like going to login
   $_SESSION['PREVIOUS_URI'] = $_SERVER['REQUEST_URI'];

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<link rel="icon" href="favicon.ico">
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<style>
label{
   width:5em;
   display:inline;
   text-align:right;
   margin-right: 0.5em;
   display:block;
}
</style>
<title>
Yaploud Chat
</title>
<link rel="stylesheet" type="text/css" href=css/chat.css />
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.1/build/container/assets/container.css">
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.1/build/assets/skins/sam/skin.css">
</head>

<body class="yui-skin-sam">
<?
   //require("./user_session_init_c.inc");
   //include("common/header.php");
   include("util.inc");
?>

<script type="text/javascript"><!--
        google_ad_client = "pub-0438387956273069";
        google_ad_width = 728;
        google_ad_height = 90;
        google_ad_format = "728x90_as";
        google_ad_type = "text_image";
        google_ad_channel ="9343611779";
//--></script>

<? include ("common/yui.php"); ?>

<script type=text/javascript src=js/util.js></script>
<script type=text/javascript src=js/chat.js></script>
<script type=text/javascript src=js/resizepanel.js></script>
<!-- <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script> -->

<?php
   $url = $_GET['url'];
   if(!$url || $url == "" || preg_match('/yaploud.com/', $url)){
   	print "<h3>It's possible you reached this page in error</h3><br/>\n";
	print "<h3>Find a url, click on the \"chat\" button, and you'll be redirected here correctly</h3>\n";
	ob_end_flush();
	return;
   }
?>

<div style="position: absolute; width: 100%; height: 100%; z-index: 1;">
  <iframe id="mainDocumentFrame" src="http://<?php print $url ?>" 
              height="100%" width="100%" frameborder="0" marginwidth="0" 
              marginheight="0" vspace="0" hspace="0">
  </iframe>
</div>
<!-- 
 -->
 
<div id=panel1>
   <div id=normalized_url style="display:none;"><?php print normalizeURL($url); ?></div>
   
   <div class=hd>
      <a href="/home.php">
      <img src=images/logo.gif border="0" width=41 height=22 valign=absmiddle></img></a>
      &nbsp;Chatting about: <span id=url><?php print "$url"; ?></span>
      <a style="margin-left:10px;" href="<?php print "http://$url"; ?>" target="_blank">(go)</a></div>

   <div class=bd>
        <!-- begin msgs -->
	<div id=msgs_div class=msgs_div>
	</div> <!-- msgs_div -->
	
	<div class=members id=members>
	<div style="font-size:1.12em;">Yappers:</div>
	<br/>
	</div>
	
	<div style="clear:both;"></div>
	<form enctype="text/plain" name="msgform">


	  <div style="margin-top:5px;float:left;">
	    <?php
	      if(!isset($_SESSION['logged']) || $_SESSION['logged'] == false) {
	      	$guest = $_SESSION['guest'];
	      	print "<div style=\"float:left;\"><label for=username>" . 
	      	          $_SESSION['guest'] . "</label></div> \n";
	         echo <<<EOB
	         <input name=username type=hidden id=username value="$guest" />
	          <a class=menu_1  href="/user/register.php">Join Now!</a>
EOB;

	      }
	      else{
	         print "<input type=hidden name=username id=username value=\"" . $_SESSION['username'] . "\" />\n";
	      }
	      ?>
	  </div>

	  <div style="clear:both;"></div>

	  <div style="margin-top:4px;margin-left:3px;float:left;">
	      <textarea name=msg_content id=msg_content rows=3 cols=40></textarea>
	      <!-- <input onclick="return sendMsg();" type="submit" value=send></input> -->

	      <input type="image" src="images/go_image.gif" value="send" onclick="sendMsg();">

	  </div>

	  <div class=util_box style="margin-left:5px;margin-top:4px;float:left;" class=chars_left>
	   	<span id=chars_left>250</span> <span class=menu_1>chars left</span>
	   	<p><a style="float:left; margin-top:10px;" class=menu_1 href="javascript:more_messages(<? print "'" . urlencode($url) . "'";?> );">Get more messages</a></p>
        <p><a style="float:left; margin-top:10px;" class=menu_1 href="javascript:show_msg_times();">Show the times</a></p>

		<p><a style="float:left; margin-top:10px;" class=menu_1 href="javascript:invite_friend();">Invite your friend</a></p>
	  </div>

	  <div style="clear:both;"></div>
	
	</form>
   </div> <!-- bd -->
</div> <!-- panel -->

<script type=text/javascript>
   var hide_handler = function(){
   	var username = document.getElementById('username').value;
   	var url = document.getElementById('normalized_url').innerHTML;
   	sendRoomLeave(url, username);
   }


   var buildPanel = function(){
	var p = new YAHOO.widget.ResizePanel('panel1', {
	    width:'580px', 
	    visible:true, 
	    draggable:true, 
	    close:true, 
   		fixedcenter:true, 
        constraintoviewport: true,
	    zIndex:1});
	win_manager.register(p);
	p.hideEvent.subscribe(hide_handler);
	p.render();
	p.focus();
   }

   YAHOO.util.Event.onAvailable('panel1', buildPanel, this);

   function _login(){
  	var username = document.getElementById('username').value;
	var url = document.getElementById('normalized_url').innerHTML;
	sendRoomLogin(url, username);
   }

   setTimeout(_login, 1500);
   window.onunload = hide_handler;
   addEvent(window, 'load', startMsgPull);

</script>

<div id=debug></div>
<div id=invite_dialog>
   <div class=hd>Enter Email to Invite (alpha)</div>
   <div class=bd>
   	<form method=post action=send_invite.php>
   	<input type=text size=20 name=invite_email id=invite_email></input>
	</form>
   </div>
</div>

</body>
</html>


<?php
//include("common/footer.php");
ob_end_flush();
?>
