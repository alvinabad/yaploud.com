<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/strict.dtd">

<?php
    require("./home_c.inc");
    require("chat/ChatRoom.inc");
    require("./util.inc");
?>

<html>
<head>
  <title>Welcome to YapLoud</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <link type="text/css" rel="stylesheet" href="/css/style.css" />
  <?php require("chat/yui.php"); ?>
    
  <script type="text/javascript" src="/css/niftycube.js" ></script>
  <script type="text/javascript" src="/js/home.js" ></script>
</head>

<body class="yui-skin-sam">
<div id="container">
<?php include("common/header1.php"); ?>
<?php include("rightNav.php"); ?>

<div id="content">
  <br>
      <?php include("home/most_discussed_div.php")?>
  <!-- 
  <div id="center_nav" class="yui-navset">
    <ul style="text-align: center;" class="yui-nav">
      <li class="selected"><a href="#tab1"><em>Most Discussed</em></a></li>
      <li><a href="#tab2"><em>Most Active</em></a></li>
      <li><a href="#tab3"><em>Most Recent</em></a></li>
      <li><a href="#tab4"><em>Top Rated</em></a></li>
    </ul>            
    
    <div class="yui-content">
      <?php include("home/most_discussed_div.php")?>
      <?php include("home/most_active_div.php")?>
      <?php include("home/most_recent_div.php")?>
      <?php include("home/top_rated_div.php")?>
    </div>
  </div>
   -->
</div> <!-- content -->

<?php include("common/footer1.php"); ?>
</div> <!-- container -->

</body>
</html>
