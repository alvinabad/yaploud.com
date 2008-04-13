<?php
   ob_start("gz_handler");
   session_start();
   require_once 'db.inc';
?>
   <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
   <html>
   <head>
   <link rel="icon" href="favicon.ico">
   <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
   <title> Yaploud Search </title>
   <link rel="stylesheet" type="text/css" href=css/chat.css />
   
   <link rel="stylesheet" type="text/css" href="/js/yui/build/container/assets/skins/sam/container.css" />
   <script type="text/javascript" src="/js/yui/build/yahoo-dom-event/yahoo-dom-event.js"></script>
   <script type="text/javascript" src="/js/yui/build/dragdrop/dragdrop-min.js"></script>
   <script type="text/javascript" src="/js/yui/build/container/container-min.js"></script>

   <script type=text/javascript src=js/util.js></script>
   <script type=text/javascript src=js/chat.js></script>
   
   </head>
   <body>
   <script type="text/javascript"><!--
          google_ad_client = "pub-0438387956273069";
          google_ad_width = 728;
          google_ad_height = 90;
          google_ad_format = "728x90_as";
          google_ad_type = "text_image";
          google_ad_channel ="9343611779";
   //--></script>



<?
   include 'common/header.php';
   $qt = $_GET['q'];
?>

   <!-- <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script> -->
<?
   print "<div style=\"font-size:120%;\">Search results for <b><span style=\"font-size:150%;color:orange;\" id=search_term>" . $qt . "</span></b></div><br/>";
?>
   <div id=results>
   </div>
   <script type=text/javascript>
      var t = document.getElementById('search_term').innerHTML;
      searchTerm(t);
   </script>
   </body>
   </html>
<?
   ob_end_flush();
?>
