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
    /**************
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
    **************/
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
	You are designated to be the moderator for this yaplet. 
	As a moderator, you have the authority to take any action in good faith 
	to restrict access to or the availability of any material that you may 
	consider to be obscene, lewd, lascivious, filthy, excessively violent, 
	harassing or otherwise objectionable. 
	<p>
HTML;
}

?>  

<?php
  $url_encoded = $url_util->encode($yap_url);
	print <<<HTML
	YapURL: 
HTML;
	print <<<HTML
  <a href="{$yap_url}" onclick='openChatWindow("{$url_encoded}", "{$url_encoded}"); return false;'>
  {$yap_url}</a>
  <p>
HTML;
?>

  <div id="yaps">
<?php
foreach($yap_messages as $yap_msg) {
	print <<<HTML
	<div id="yap">
	  <div class="msg_time">{$yap_msg['t']}</div>
	    <span class="sender">{$yap_msg['s']}:</span>
	    <span class="msg">{$yap_msg['msg']}</span>
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
  <div style="clear:both;">
  <p>
    Users who are currently banned from having any conversations on this YapURL 
    are shown with a check mark. Please select from above the users who 
    should be prohibited from any conversations on this YapURL.
    <p>

<!--     

    Would you like to have the selected users' conversations to be deleted 
    from the Yaplet? 
        <input type="checkbox" name="delete_yaps" value="{$user},{$ip}">
    <p>

    -->

    Click here to submit your request: 
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
  <script type="text/javascript">
    yaps_div = document.getElementById('yaps');
    yaps_div.scrollTop = yaps_div.scrollHeight;
    if ( navigator.appName == "Microsoft Internet Explorer" ) {
        yaps_div.scrollTop = yaps_div.scrollHeight; // IE7 requires running this twice!
    }
  </script>
</body>
</html>
