<?php
    require("./home_c.inc");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html>
<head>
  <title>Welcome to YapLoud</title>
  <meta name="description" content="Real time discussion on web pages" />
  <meta name="keywords" content="yaploud, chat, yap, discuss, Social networking, networking, real-time conversation, real-time chat, dynamic group, URL, YapURL, cricket, sports, live cricket, live sports, live entertainment, live chat, live conversation, live discussion" />
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <link type="text/css" rel="stylesheet" href="/css/style.css" />
</head>

<body class="yui-skin-sam">
<div id="container">
<?php include("common/header1.php"); ?>
<?php include("rightNav.php"); ?>

<div id="content">

   <h1>YapLoud has gone opensocial!</h1>
   <p style="padding-left: 30px;">
   We've developed a chat application for Ning.com. Installation is as simple
   as loading this gadget xml file:
   <br />
   <span style="font-family: arial; padding-left: 20px;">
   <a target="_blank" href="http://opensocial.yaploud.com/static/yaploud_gadget.xml">
         http://opensocial.yaploud.com/static/yaploud_gadget.xml</a></span>
   <br />
   <br />
   Check out our sample installation here: 
   <a target="_blank" style="font-family: arial;" href="http://yaploud1.ning.com/">http://yaploud1.ning.com/</a>
   </p>
   
   <hr />
   
   <div class="yap_url title">
    <a href="/help/tour.php"><b>What is YapLoud?</b></a>
   </div>
  <br>
      <?php include("home/most_discussed_div.php")?>
</div> <!-- content -->

<?php include("common/footer1.php"); ?>
</div> <!-- container -->

  <?php require("common/yui.php"); ?>
  <script type="text/javascript" src="/css/niftycube.js" ></script>
  <script type="text/javascript" src="/js/home.js" ></script>

</body>
</html>

<?php
/** YUI TABS
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
**/
?>
