<?php
require("./chat_window_c.inc");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>YapLoud.com</title>

<?php
require("./yui.php");
?>

<link rel="stylesheet" type="text/css" href="/chat/chat_window.css"></link>
 <script type="text/javascript">
    var site_url = "<?php print $site_url; ?>";
    var site_title = "<?php print $site_title; ?>";
    var username = "<?php print $username; ?>";
    var iframe_enabled = <?php print $iframe_enabled; ?>;
</script>

<script type="text/javascript" src="/chat/chat_widget.js"></script>
<script type="text/javascript" src="/chat/chat_window.js" ></script>

</head>
<body class=" yui-skin-sam">

<?php
if($iframe) {
    if ( ! preg_match('/^http/', $site_url) ) {
        $site_url = "http://" . $site_url;
    }
    print <<<HTML
  <div style="position: absolute; width: 100%; height: 100%; z-index: 1;">
    <iframe id="mainDocumentFrame" src="{$site_url}" 
                height="100%" width="100%" frameborder="0" marginwidth="0" 
                marginheight="0" vspace="0" hspace="0">
    </iframe>
  </div>
HTML;
}
?>

<?php
if(!$iframe) {
    print '<div id="main" class="main_non_iframe">';
} else {
    print '<div id="main" class="main">';
}
?>
  
  <div class="hd" id="hd">
    <a href="/home.php" target="_blank">
      <img src=/images/logo.gif border="0" width=41 height=22 valign=absmiddle></img></a>
      <strong>Yapping about: </strong><span id="hd_title"></span>
  </div>
<?php
  if($iframe) {
      print '<div id="minimize_bar" onclick="minimizeChatWidget();"></div>';
  }
?>
  <div id="bd0">
    <div id="bd">
      <div id="bd2">
          <div id="msg"></div>
          <div id="yappers"></div>
      </div>
      <div style="clear: both;"></div>
      <div id="yap">
        <form name="chat_form">
          <textarea onkeyup="SendMessage.getText(event);" name="chat_textarea" class="chat_textarea" id="chat_textarea"></textarea>
        </form>
      </div>
      <div id="links"><?php print $username; ?></div>
      <div style="clear: both;"></div>
    </div>
    <div id="ft">
        <?php
            if ( preg_match('/^guest/', $username) ) {
                print <<<HTML
            <a href="/login_page.php" target="_blank">Log In</a> |
            <a href="/user/register.php" target="_blank">Sign Up</a> | 
            <a href="javascript: location.reload();">Reload</a> |
            <span id="chat_mode"></span> | 
            <br>
            <a href='javascript: openChatWindow("{$site_url}", "{$site_title}"); closeWindow();'>New window</a>
HTML;
            }
            else {
                print <<<HTML
            <a href="/user/myaccount.php" target="_blank">Hi {$username}</a> | 
            <a href="/login_page.php?logout=true" target="_blank">Log Out</a> | 
            <a href="javascript: location.reload();">Reload</a> |
            <span id="chat_mode"></span>
            <br>
            <a href='javascript: openChatWindow("{$site_url}", "{$site_title}"); closeWindow();'>New window</a>
HTML;
            }
        ?>
    </div>
  </div>
</div>

</body>
</html>
