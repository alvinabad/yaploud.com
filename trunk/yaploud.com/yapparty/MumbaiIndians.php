<?php
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
  <title>YapLoud Party</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <link type="text/css" rel="stylesheet" href="/css/style.css" />
</head>

<body class="yui-skin-sam">
<div id="container">
<?php include("common/header1.php"); ?>
<?php include("rightNav.php"); ?>

<div id="content">

<h1>Mumbai Indians Yap Party</h1>

<p>
<iframe src="http://www.yaploud.com/chat/chat_window.php?url=http://www.themumbaiindians.com&title=http://www.themumbaiindians.com" 
        scrolling="no" style="width:325px; height:320px" frameborder="1"></iframe>
<br>
<a href="http://www.themumbaiindians.com" 
   onclick='openChatWindow("http://www.themumbaiindians.com", "http://www.themumbaiindians.com");'>
   Chat on a separate window</a>








</div> <!-- content -->

<?php include("common/footer1.php"); ?>
</div> <!-- container -->

  <?php require("common/yui.php"); ?>
  <script type="text/javascript" src="/css/niftycube.js" ></script>
  <script type="text/javascript" src="/js/home.js" ></script>
  
</body>
</html>
