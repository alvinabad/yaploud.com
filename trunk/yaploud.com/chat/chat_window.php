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
      <div id="links">
      <a href="#">Show tags</a>
      <br>
      <a href="#">Add tags</a>
      <br>
      <a href="javascript: void 0;" id="invite_friend">Invite friend</a> 
      </div>
      <div style="clear: both;"></div>
    </div>
    <div id="ft">
        <div id="login_info"><?php print $username; ?></div>
        <a href="javascript: location.reload();">Reload</a>
        | <span id="chat_mode"></span>
     <?php
     if($iframe) {
        //| <a href='javascript: openChatWindow("{$site_url}", "{$site_title}"); openWindow("{$site_url}"); setTimeout(closeWindow, 2000); void 0;'>Pop out</a>
         print <<<HTML
        | <a href='javascript: popout("{$site_url}", "{$site_title}"); void 0;'>Pop out</a>
HTML;
     }
     else {
         print <<<HTML
        | <a href='javascript: popin("{$site_url}", "{$site_title}"); void 0;'>Pop in</a>
HTML;
     }
     ?>
    </div>
  </div>
</div>

<?php
if($iframe) {
    if ( ! preg_match('/^http/', $site_url) ) {
        $site_url = "http://" . $site_url;
    }
    print <<<HTML
  <div style="position: absolute; width: 100%; height: 100%; z-index: 1;">
    <iframe id="mainDocumentFrame" src="{$site_url}" 
                height="100%" width="100%" frameborder="0" marginwidth="0" 
                marginheight="0" vspace="0" hspace="0" scrolling="auto">
    </iframe>
  </div>
HTML;
}
?>

<div id="login_dialog">
  <div class="hd">YapLoud Login</div>
  <div class="bd">
    <form name="login_form" method="POST" action="/chat/login.php">
      <label>Username: </label><input type="text" name="username" value=''/>
      <label>Password: </label><input type="password" name="password" value=''/>
      <div class="clear"></div>
      <label>&nbsp;</label><input type="checkbox" name="remember" /> Keep me logged in
      <br>
      <a href="javascript: openExternalWindow('/user/forgotpassword.php'); void 0;">Forgot password?</a>
      | <a href="javascript: openExternalWindow('/user/forgotusername.php'); void0;">Forgot username?</a>
    </form>
  </div>
  <div class="clear"></div>
</div>

<div id="invite_friend_dialog">
  <div class="hd">YapLoud Invite a Friend</div>
  <div class="bd">
    <strong>Invite your friend to join this chat:</strong>
    <p>
    <form name="invite_friend_form" method="POST" action="/chat/invitefriend.php">
      <label>Email: </label><input size="37" type="text" name="email" value=''/>
      <label>Message: </label><textarea rows="3" cols="28"></textarea>
      <div class="clear"></div>
    </form>
  </div>
  <div class="clear"></div>
</div>

<!-- 
<div id="signup_dialog">
  <div class="hd">YapLoud Sign up</div>
  <div class="bd">
    <form name="signup_form" method="POST" action="/chat/signup.php">
      <label>Username: </label><input type="text" name="username" value=''/>
      <label>First Name: </label><input type="text" name="firstname" value=''/>
      <label>Last Name: </label><input type="text" name="lastname" value=''/>
      <label>Email: </label><input type="text" name="email" value=''/>
      <label>Password: </label><input type="password" name="password" value=''/>
      <label>Re-type password: </label><input type="password" name="password2" value=''/>
      <div class="clear"></div>
    </form>
  </div>
  <div class="clear"></div>
</div>
 -->

</body>
</html>
