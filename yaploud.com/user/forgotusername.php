<?php include("./forgotusername_c.inc");

/*
 * This is the view (MVC pattern) of the forgotusername page
 * The controller is located in forgotusername_c.inc
 *
 * PHP code in this view is only used for rendering logic and is kept
 * to the minimum. Please put all logic in the controller.
 */
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html>
<head>
  <title>YapLoud - Forgot Username</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <link type="text/css" rel="stylesheet" href="/css/style.css" />
  <?php require("common/yui.php"); ?>

  <script type="text/javascript" src="/css/niftycube.js" ></script>
  <script type="text/javascript" src="/user/forgotusername.js" ></script>
  <script type="text/javascript">
    YAHOO.util.Event.onDOMReady(function() {document.getElementById('email').focus();});
  </script>
</head>

<body class="yui-skin-sam">
<div id="container">
<?php include("common/header1.php"); ?>
<?php include("rightNav.php"); ?>

<div id="content">

  <div id="content_0">
  <h1>Forgot username</h1>
  <div id="content_1">
    <ul style="margin-left: 0;">
    <li style="margin-left: 0;">Enter the email address associated with your YapLoud account
    <li>Enter the verification code you see in the box
    <li>We'll send you an email with your username
    </ul>

    <a href="/user/register.php">Sign up</a> now to join the YapLoud Community
    <br>
    <a href="/extension/yaploud.xpi" onclick="installxpi(this); return false;">Install</a> Firefox add-on
  </div>

  <div style="color: green;">
    <?php
      if ($post_processed && $status) {
          if ($valid_email) {
              $email = "";
              print "Thank you for your request. " .
                    "We've sent you an email with your username. <p>";
          }
          else {
              print "Your email is not found in our system. " .
                    "Please try another email. <p>";
          }
      }
    ?>
  </div>

  <div id="content_2">
    <div id="error_message" style="color: red; font-weight: normal;">
    <?php
      if (isset($post_processed) && $post_processed &&
          isset($valid_captcha) && !$valid_captcha ) {
              print "Invalid code. Please try again.<br>";
      }
    ?>
    </div>

    <form action="/user/forgotusername.php" method="post"
          name="forgotusername_form" id="forgotusername_form"
          onSubmit="return ForgotUsername.validate();">

    <table style="text-align: left;">
    <tr>
      <td>
        Email:
        <br>
        <input id="email" type="text" name="email" value="<?php print $email; ?>"/>
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
        <input style="width:100px;" type="submit" value="Submit" ;/>
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
