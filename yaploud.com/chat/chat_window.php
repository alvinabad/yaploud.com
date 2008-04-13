<?php
require("./chat_window_c.inc");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>YapLoud</title>

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
<script type="text/javascript" src="/rating/Rating.js" ></script>
<script type="text/javascript" src="/js/util.js" ></script>

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
    <a href="javascript: openExternalWindow('/home.php'); void 0;">
      <img src=/images/logo.gif border="0" width=41 height=22 valign=absmiddle></img></a>
      <strong>Yapping about: </strong>
      <?php
      print <<<HTML
      <span><a href="{$site_url}" onclick='openExternalWindow("{$url_encoded}", "{$title_encoded}"); return false;'>
                {$site_title}</a>
      </span>
HTML;
       ?>
      
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
          <div id="tags"></div>
      </div>
      <div style="clear: both;"></div>
      <div id="yap">
        <form name="chat_form">
          <textarea onkeyup="SendMessage.getText(event);" name="chat_textarea" class="chat_textarea" id="chat_textarea"></textarea>
        </form>
      </div>
      <div id="links">
      <input type="radio" name="userstags" onclick="showUsers();" value="users" checked>Users
      <br>
      <input type="radio" name="userstags" onclick="showTags();" value="tags">Tags
      <br>
      </div>
      <div style="clear: both;"></div>
    </div>
    <div style="clear: both;"></div>
    <div id="ft">
        <a href="javascript: SendMessage.text();"><img border="0" src="/images/go.gif" /></a>
        <div id="logout_info">
         <strong><span id="username_info1"></span></strong>
         | <a href="javascript: void 0;" id="login">Login</a> 
         | <a href="javascript: openExternalWindow('/user/register.php'); void 0;" id="signup">SignUp</a> 
        </div>
        <div id="login_info">
         Hi <strong><span id="username_info2"></span>!</strong>
	     | <a href="javascript: logout(); void 0;">Logout</a>
         | <a href="javascript: void 0;" id="add_tags">Add tags</a> 
         | <a href="javascript: void 0;" id="invite_friend">Invite a friend</a> 
        </div>
        <br>
        <!-- 
         <a href="javascript: location.reload();">Reload</a>
         -->
        <span id="chat_mode"></span>
     <?php
     if($iframe) {
        //| <a href='javascript: openChatWindow("{$site_url}", "{$site_title}"); openWindow("{$site_url}"); setTimeout(closeWindow, 2000); void 0;'>Pop out</a>
         print <<<HTML
        | <a href='javascript: popout("{$url_encoded}", "{$title_encoded}"); void 0;'>Pop out</a>
HTML;
     }
     else {
         print <<<HTML
        | <a href='javascript: popin("{$url_encoded}", "{$title_encoded}"); void 0;'>Pop in</a>
HTML;
     }
     ?>
     <span id="star_rating" onmouseout="StarRating.render();" >
     | Rating:
     <img alt="starRating" src="/images/ratings/stars-0-0.gif" usemap="#mapStarRating" 
          border="0" id="stars" />
     <map name="mapStarRating" id="mapStarRating" >
        <area alt="1" shape="rect" coords="0,0,16,12" id="1starRating"
            href="javascript: onclick=StarRating.select('1starRating')"
            onmouseover="StarRating.show('1starRating');" />
        <area alt="2" shape="rect" coords="16,0,28,12" id="2starRating"
            href="javascript: onclick=StarRating.select('2starRating')"
            onmouseover="StarRating.show('2starRating');" />
        <area alt="3" shape="rect" coords="28,0,38,12" id="3starRating"
            href="javascript: onclick=StarRating.select('3starRating')"
            onmouseover="StarRating.show('3starRating');" />
        <area alt="4" shape="rect" coords="38,0,48,12" id="4starRating"
            href="javascript: onclick=StarRating.select('4starRating')"
            onmouseover="StarRating.show('4starRating');" />
        <area alt="5" shape="rect" coords="48,0,64,12" id="5starRating"
            href="javascript: onclick=StarRating.select('5starRating')"
            onmouseover="StarRating.show('5starRating');" />
     </map>
     </span><span id="votes">0 votes</span>
    </div> <!-- footer -->
  </div> <!-- bd0 -->
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
      <input type="hidden" name="url" value="<?php print $site_url; ?>">
      <div class="clear"></div>
      <label>&nbsp;</label><input type="checkbox" name="remember" /> Keep me logged in
      <br>
      <a href="javascript: openExternalWindow('/user/forgotpassword.php'); void 0;">Forgot password?</a>
      | <a href="javascript: openExternalWindow('/user/forgotusername.php'); void 0;">Forgot username?</a>
    </form>
  </div>
  <div class="clear"></div>
</div>

<div id="invite_friend_dialog">
  <div class="hd">YapLoud Invite a Friend</div>
  <div class="bd">
    <strong>Invite a friend to join this chat:</strong>
    <p>
    <form name="invite_friend_form" method="POST" action="/chat/invite_friend.php">
      <label>Email: </label><input size="34" type="text" name="email" value=''/>
      <label>Message: </label><textarea name="msg" rows="3" cols="28"></textarea>
      <input type="hidden" name="url" value="<?php print $site_url; ?>" >
      <div class="clear"></div>
    </form>
  </div>
  <div class="clear"></div>
</div>

<div id="add_tags_dialog">
  <div class="hd">YapLoud Add tags</div>
  <div class="bd">
    <strong>Add tags to this chat:</strong>
    <p>
    <form name="addtags_form" method="POST" action="/tags/addTags.php">
      <label></label><input size="34" type="text" name="tags" value=''/>
      <label>Use commas to separate tags</label>
      <input type="hidden" name="url" value="<?php print $site_url; ?>" >
      <div class="clear"></div>
    </form>
  </div>
  <div class="clear"></div>
</div>

</body>
</html>
