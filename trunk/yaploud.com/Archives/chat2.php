<?php

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<title>
Proof of concept chat
</title>
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.2.2/build/container/assets/container.css">
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.2.2/build/button/assets/button.css">
<style>
*{
   font: 100% Helvetica, Arial, sans-serif;
}

/* user_msg encapsulates a whole msg. */
/* msg contains just the text of the msg, not the username */

.user_msg{
   background-color:#CCFFFF;
   background-color:white;
   color:gray;
   padding:3px 3px 3px 3px;
   margin:4px 4px 4px 4px;
   /* provides divider between msgs*/
   border-top: 2px solid gray;
}
.msg{
   margin-left: 10px;
   font-size:80%;
}

.resizepanel .resizehandle { position:absolute; width:25px; height:4px; right:0; bottom:0; margin:0; padding:0; z-index:1; background:#666;  cursor:se-resize; font-size:2px; }

.msgs_div{
border:2px solid gray;
height:300px;
width:400px;
overflow:auto;
background:#99CCCC;
background:white;
margin:3px 3px 3px 3px;
padding:3px 3px 3px 3px;
}

</style>

<script type="text/javascript"><!--
        google_ad_client = "pub-0438387956273069";
        google_ad_width = 728;
        google_ad_height = 90;
        google_ad_format = "728x90_as";
        google_ad_type = "text_image";
        google_ad_channel ="9343611779";
//--></script>



<script type="text/javascript" src="http://yui.yahooapis.com/2.2.2/build/yahoo-dom-event/yahoo-dom-event.js" ></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.2.2/build/element/element-beta-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.2.2/build/button/button-beta-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.2.2/build/dragdrop/dragdrop-min.js" ></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.2.2/build/container/container-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.2.2/build/animation/animation-min.js"></script> 
<script type=text/javascript src=js/util.js></script>
<script type=text/javascript src=js/chat.js></script>
<script type=text/javascript src=js/resizepanel.js></script>

</head>
<body>
<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>


<p>
<?php
   $url = $_GET['url'];
   if(!$url || $url == "" || preg_match('/yaploud.com/', $url)){
   	print "<h3>It's possible you reached this page in error</h3><br/>\n";
	print "<h3>Find a url, click on the \"chat\" button, and you'll be redirected here correctly</h3>\n";
	return;
   }
?>


<div id=panel1>
<div class=hd>Chatting about: <span id=url><?php print "$url"; ?></span></div>
<div class=bd>
<div id=msgs_div class=msgs_div>
</div>
<form enctype="text/plain" name="msgform">
Username: <input type=text id=username></input>
<br/>
<div style="float:left;">Message: &nbsp;&nbsp;</div>
<div style="float:left;">
<textarea onkeypress="return ta_onkeypress(event);" id=msg_content rows=3 cols=40></textarea>
</div>
<div style="clear:both;"></div>
<div id=submitbutton onclick="return sendMsg();"></div>
</form>
<div class=ft></div>
</div> <!-- bd -->
</div> <!-- panel -->

<script type=text/javascript>
   var submitbutton = new YAHOO.widget.Button({id:"submitbutton", type:"button", label: "Submit", container: "submitbutton"});
   var p = new YAHOO.widget.ResizePanel('panel1', {width:'500px', visible:true, draggable:true, close:true});
   p.render(document.body);
</script>
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-2224520-1";
urchinTracker();
</script>
</body>
</html>
