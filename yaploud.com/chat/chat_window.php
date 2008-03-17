<?php
require("./chat_window_c.inc");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>YapLoud.com</title>

<script type="text/javascript" src="/js/yui/build/yahoo/yahoo-min.js"></script> 
<script type="text/javascript" src="/js/yui/build/event/event-min.js"></script> 
<script src="/js/yui/build/connection/connection-min.js"></script>
<link rel="stylesheet" type="text/css" href="/chat/chat_window.css"></link>
<script type="text/javascript" src="/chat/chat_window.js" ></script>
<script type="text/javascript">
    var site_url = "<?php print $site_url; ?>";
    var site_title = "<?php print $site_title; ?>";
</script>

</head>
<body onunload="Chat.onunload();">

<div id="main" class="main">
  <div>
  </div>
  <div id="hd"></div>
    <div id="bd">
      <div id="msg"></div>
      <div id="yappers"></div>
      <div style="clear: both;"></div>
      <div id="yap">
        <textarea class="chat_textarea" id="chat_textarea" rows="3" ></textarea>
      </div>
      <div id="links"></div>
     <div style="clear: both;"></div>
    </div>
  <div id="ft">
        <?php
            if(!isset($_SESSION['logged']) || $_SESSION['logged'] == false) {
                print <<<HTML
            <a href="/login_page.php" target="_blank">Log In</a> |
            <a href="/user/register.php" target="_blank">Sign Up</a> | 
            <a href="javascript: location.reload();">Reload</a> |
            <span id="chat_mode"></span>  
HTML;
            }
            else {
                print <<<HTML
            <a href="/user/myaccount.php" target="_blank">Hi {$_SESSION['username']}</a> | 
            <a href="/login_page.php?logout=true" target="_blank">Log Out</a> | 
            <a href="javascript: location.reload();">Reload</a> |
            <span id="chat_mode"></span>  
HTML;
            }
        ?>
  </div>
</div>

</body>
</html>
