<?php
   //require_once 'db.inc';
   //ob_start();
   //session_start();
   require("./user_session_init_c.inc");
   //include 'common/header.php';
   include 'common/header2.php';
?>

<html>
<head>
<title>YapLoud.com</title>
<link rel="stylesheet" type="text/css" href=css/chat.css />
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.1/build/container/assets/container.css">
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.3.1/build/assets/skins/sam/skin.css">


</head>
<body style="font-size:16px;" class=yui-skin-sam>
<?php include 'common/yui.php'; ?>

<script type=text/javascript src=js/chat.js></script>
<?
   $sess = $_SESSION;
   if(!$sess['logged']){
      print "<h2><a href=login_page.php>Please Login</a><br/></h2><br/>\n";
      ob_end_flush();
      return;
   }
   $username = $_SESSION['username'];
   print "<h3><b>Hello, $username</b></h3><br/>\n";
?>

   <div id=popular_chat>
   	<div class=hd>Popular Chat Sites</div>
	<div class=bd>
<?
   $query = "select topic_url as url, count(*) as c, (select count(username) from dev.room_users where topic_url = url) as uniqs  from dev.chat group by topic_url order by 2 desc limit 15";
   $db = new DB();
   $result = $db->mysql_query($query);
   if($result){
      while($row = mysql_fetch_assoc($result)){
         print "<div class=home_row><span class=column>" . $row['c'] . "&nbsp;msgs</span>&nbsp;<span class=column>" .  $row['uniqs'] . "&nbsp;users</span>&nbsp;<a style=\"font-size:14px;width:450px;float:left;text-align:right;\" href=chat_frames.php?url=http://" . urlencode($row['url']) . ">" . $row['url'] . "</a></div>\n";
      }
      mysql_free_result($result);
   }
?>
	</div>
	<div class=ft></div>
   </div>
   <script>
      var popular_panel = new YAHOO.widget.Panel('popular_chat', {width:'600px', visible:true, draggable:false, close:false});
      popular_panel.render();
   </script>

<?
   ob_end_flush();
?>

</body>
</html>
