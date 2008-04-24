<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/strict.dtd">

<?php
include("./register_c.inc");

/*
 * This is the view (MVC pattern) of the registration page
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
  <title>YapLoud - Sign Up</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <link type="text/css" rel="stylesheet" href="/css/style.css" />
  <?php require("common/yui.php"); ?>
  <script type="text/javascript">
    function enable_submit_signup(e) {
        if (e.checked == true) {
            document.getElementById('submit_signup').disabled=false;
        }
        else {
            document.getElementById('submit_signup').disabled=true;
        }
    }
    YAHOO.util.Event.onDOMReady(function() {document.getElementById('username').focus();});
  </script>
    
  <script type="text/javascript" src="/css/niftycube.js" ></script>
  <script type="text/javascript" src="/user/Register.js" ></script>
</head>

<body class="yui-skin-sam">
<div id="container">
<?php include("common/header1.php"); ?>
<?php include("rightNav.php"); ?>

<div id="content">

  <div id="content_0">
  <h1>Register at YapLoud</h1>
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
      if ( isset($registration_processed) ) {
          if ( $status ) {
              echo <<<HTML
    $message
    <br>
    You may now <a href="/login_page.php">login</a> 
    to continue.
HTML;
          }
          else {
              print "$message <br>";
          }
      }
    ?>
    </div>
    
    <form action="/user/register.php" method="post" 
          onSubmit="return Register.validate();">
          
    <table style="text-align: left;">
    <tr>
      <td>
        Username:
        <br>
        <input type="text" id="username" name="username" value="<?php print $username; ?>"/>
      </td>
    </tr>
    <tr>
      <td>
      First Name:
      <br>
      <input type="text" id="first_name" name="first_name" value="<?php print $first_name; ?>"/>
      </td>
    </tr>
    <tr>
      <td>
        Last Name:
      <br>
        <input type="text" id="last_name" name="last_name" value="<?php print $last_name ?>"/>
      </td>
    </tr>
    <tr>
      <td>
        Email:
      <br>
        <input type="text" id="email" name="email" value="<?php print $email ?>"/>
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
        Re-type password:
      <br>
        <input type="password" id="password2" name="password2" value=""/>
      </td>
    </tr>
    <tr>
      <td>
        <input style="width:20px;" type="checkbox" name="mailinglist" checked>
        Add me to your mailing list
      </td>
    </tr>
    <tr>
      <td style="text-align: left;">
        <img style="vertical-align: bottom;" src="Captcha.php" />
        Enter code:
      </td>
    </tr>
    <tr>
      <td>
        <input type="text" id="captcha" name="captcha" />
      </td>
    </tr>
    <tr>
      <td>
        <input style="width:20px;" type="checkbox" name="eula" 
               onclick="enable_submit_signup(this);">
        I agree to all <a href="/user/Terms_of_Use.pdf"> terms and conditions</a>
      </td>
    </tr>
    <tr>
      <td>
        <input disabled=yes id="submit_signup" style="width:100px;" type="submit" 
               value="Sign up" ;/>
      </td>
    </tr>
    </table>
    
    </form>
    
  </div>
  </div>
</div> <!-- content -->

<?php include("common/footer1.php"); ?>
</div> <!-- container -->

</body>
</html>
