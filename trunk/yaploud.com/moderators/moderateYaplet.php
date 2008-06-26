<?php
    require("moderateYaplet_c.inc");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html>
<head>
  <title>Moderate Yaplet</title>
  <meta name="description" content="Real time discussion on web pages" />
  <meta name="keywords" content="yaploud, chat, yap, discuss, Social networking, networking, real-time conversation, real-time chat, dynamic group, URL, YapURL, cricket, sports, live cricket, live sports, live entertainment, live chat, live conversation, live discussion" />
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <link type="text/css" rel="stylesheet" href="/css/style.css" />
  <link type="text/css" rel="stylesheet" href="/moderators/moderateYaplet.css" />
</head>

<body class="yui-skin-sam">
<div id="container">
<?php include("common/header1.php"); ?>
<?php include("rightNav.php"); ?>

<div id="content">
  <div id="content_0">
  <h1>Moderate Yaplet of a website</h1>
  <p>
<?php
	print <<<HTML
    <form action="{$_SERVER['PHP_SELF']}" method="get" >
    Enter url of the website you wish to moderate: 
    <input size="60" id="yap_url" type="text" name="url" value="{$yap_url}"/>
    <input type="submit" value="Submit">
    </form>
    <font size="-1">(If you don't know the url of the website, go to the yaplet 
       window and click on the moderate link.)</font>
  <hr>
HTML;
?>

<?php
if ( !isset($yap_url) || $yap_url == '' || !isset($voter) ) {
    return;
}

	print <<<HTML
	Hello <b>{$voter},</b>
	<p>
HTML;
	
if (!$isModerator) {
	print <<<HTML
	<p>
	You are currently not a moderator of this yaplet. Please send an email to 
	<a href="mailto:info@yaploud.com">info@yaploud.com</a> if you wish to be a moderator.
	<p>
	<!-- You can still vote to ban users or remove inappropriate messages. However,
	this will require several number of users to take effect. -->
	<p>
HTML;
}

?>  

<?php
  $url_encoded = $url_util->encode($yap_url);
	print <<<HTML
  <a href="{$yap_url}" onclick='openChatWindow("{$url_encoded}", "{$url_encoded}");'>
  Yap on this site:</a>
HTML;
?>

  <div id="yaps">
<?php
foreach($yap_messages as $yap_msg) {
	print <<<HTML
	<div id="yap">
	  <div style="float: left;">
	    <span class="sender">{$yap_msg['s']}:</span>
	    <span class="msg">{$yap_msg['msg']}</span>
	  </div>
	  <div style="float: right;">
	    <span class="msg">{$yap_msg['t']}</span>
	  </div>
	</div>
HTML;
}
?>
  </div>

  <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="post" >
  <div id="yappers">
<?php
foreach($yappers as $yapper) {
	$user = $yapper['name'];
    $ip = $yapper['ip'];
    $isIpBanned = $yapper['banned'];
	print <<<HTML
	<div id="yapper">
	  <div style="float: left; clear:both;">
	    {$user} ({$ip}) 
	  </div>
  	  <div style="float: right;">
HTML;
    $checked = '';
    if ($isIpBanned) {
    	$checked = 'checked';
    }
   	print <<<HTML
        <input type="checkbox" {$checked} name="banned_users[]" value="{$user},{$ip}">
        <input type="hidden" name="users[]" value="{$user},{$ip}">
HTML;
    print <<<HTML
      </div>
    </div>
HTML;
}
    print <<<HTML
	<div id="yapper"></div>
    <input type="hidden" name="url" value="{$yap_url}">
    <input type="hidden" name="ban_users" value="yes">
HTML;
?>
  </div>
  <div style="float: right; clear:both; padding-right: 10px;">
    Users shown with a check mark is currently banned from sending messages.
    Select or uncheck a user to ban or un-ban. 
    <br>
    Hit submit button to submit request => 
    <input type="submit" value="Submit">
  </div>
  </form>
  
  </div> <!-- yappers -->

</div> <!-- content0 -->
</div> <!-- content -->

<?php include("common/footer1.php"); ?>
<!-- </div> <!-- container -->  -->

  <?php require("common/yui.php"); ?>
  <script type="text/javascript" src="/css/niftycube.js" ></script>
  <script type="text/javascript" src="/js/home.js" ></script>

</body>
</html>
