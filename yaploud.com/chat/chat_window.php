<?php
require("./chat_window_c.inc");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Embedded Chat</title>

<script type="text/javascript" src="/js/yui/build/yahoo/yahoo-min.js"></script> 
<script type="text/javascript" src="/js/yui/build/event/event-min.js"></script> 
<script src="/js/yui/build/connection/connection-min.js"></script>
<link rel="stylesheet" type="text/css" href="/chat/chat_window.css"></link>
<script type="text/javascript" src="/chat/chat_window.js" ></script>
<script type="text/javascript">
    var url_site = "<?php print $url_site; ?>";
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
        <textarea id="chat_textarea" rows="2" cols="22" style="border:0"></textarea>
      </div>
      <div id="links"></div>
     <div style="clear: both;"></div>
    </div>
  <div id="ft">
        <?php
            if(!isset($_SESSION['logged']) || $_SESSION['logged'] == false) {
                print <<<HTML
            <a href="/user/register.php" target="_blank"><strong>Sign Up</strong></a> | 
            <a href="/help.php" target="_blank">Feedback</a> | 
            <a href="/login_page.php" target="_blank">Log In</a>
HTML;
            }
            else {
                print <<<HTML
            <a href="/user/myaccount.php" target="_blank">Hi {$_SESSION['username']}</a> | 
            <a href="/user/myaccount.php" target="_blank">My Account</a> | 
            <a href="/help.php" target="_blank">Feedback</a> | 
            <a href="/login_page.php?logout=true" target="_blank">Log Out</a>
HTML;
            }
        ?>
        | <a href="javascript: location.reload();">Reload</a>
        | <div id="chat_mode"></div>
  </div>
</div>

</body>
</html>
