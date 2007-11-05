<?php
   $to = $_GET['to'];
   $url = $_GET['url'];
   mail($to, "Join Chat at Yaploud.com", "You have been invited to join the chat session about $url at Yaploud.com.  Click here to join http://www.yaploud.com/chat.php?url=" . $url);
?>
