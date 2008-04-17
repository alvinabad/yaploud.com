<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/strict.dtd">

<?php
require("./login_c.inc");

/*
 * This is the view (MVC pattern) of the login page
 * The controller is located in register_c.inc
 * 
 * PHP code in this view is only used for rendering logic and is kept 
 * to the minimum. Please put all logic in the controller.
 * 
 * Created on Nov 18, 2007
 * Author: alvinabad@alumni.cmu.edu
 */
?>

<html>
<head>
  <title>YapLoud - Login</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <link type="text/css" rel="stylesheet" href="/css/style.css" />
  <?php require("common/yui.php"); ?>
    
  <script type="text/javascript" src="/css/niftycube.js" ></script>
  <script type="text/javascript">
    YAHOO.util.Event.onDOMReady(function() {document.getElementById('username').focus();});
  </script>
</head>

<body class="yui-skin-sam">
<div id="container">
<?php include("common/header1.php"); ?>
<?php include("rightNav.php"); ?>

<div id="content">

  <div id="content_0">
  <h1>Login at YapLoud</h1>
  <div id="content_1">
    <h4>What is YapLoud?</h4>
    YapLoud is the home for yapping about everything:
    <ul style="margin-left: 0;">
    <li style="margin-left: 0;">Chat about any topic of your interest
    <li>Share favorite Yaps
    <li>Connect with other yappers 
    </ul>

    <a href="/user/register.php">Sign up</a> now to join the YapLoud Community
    <br>
    <a href="/extension/yaploud.xpi" onclick="installxpi(this); return false;">Install</a> Firefox add-on
  </div>

  <div id="content_2">
    <div style="color: red;" id="error_message">
    <?php
        if (!$result) {
            print "$message <br>";
        }
    ?>
    </div>
    
    <form action="/user/login.php" method="post" >
          
    <table style="text-align: left;">
    <tr>
      <td>
        Username:
        <br>
        <input id="username" type="text" id="username" name="username" value="<?php print $username; ?>"/>
      </td>
    </tr>
    <tr>
      <td>
        Password:
        <br>
        <input type="password" id="password" name="password" value=""/>
      </td>
    </tr>
    <tr>
      <td>
      <input style="width:20px;" type="checkbox" name="remember" id=password >
      Remember me
      </td>
    </tr>
    <tr>
      <td>
        <input style="width:100px;" type="submit" value="Login" ;/>
      </td>
    </tr>
    <tr>
      <td>
      <ul>
      <li><a href="/user/forgotpassword.php">Forgot password?</a>
      <li><a href="/user/forgotusername.php">Forgot username?</a>
      <li><a href="/user/register.php">Not yet registered?</a>
      </ul>
      </td>
    </tr>
    </table>
    
    <input type=hidden name=action value=login />
    
    </form>
    </div>
  </div>

</div> <!-- content -->

<?php include("common/footer1.php"); ?>
</div> <!-- container -->

</body>
</html>
