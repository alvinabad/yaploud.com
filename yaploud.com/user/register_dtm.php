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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html>
<head>
  <title>YapLoud - Sign Up</title>
  <meta name="description" content="Real time discussion on web pages" />
  <meta name="keywords" content="yaploud, chat, yap, discuss, Social networking, networking, real-time conversation, real-time chat, dynamic group, URL, YapURL, cricket, sports, live cricket, live sports, live entertainment, live chat, live conversation, live discussion" />
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <link type="text/css" rel="stylesheet" href="/css/style.css" />
  <?php require("common/yui.php"); ?>
  <script type="text/javascript">
	var yaploud_client = "<?php print $_REQUEST['yaploud_client']; ?>";
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
  <script type="text/javascript" src="/js/yui/build/yahoo/yahoo-min.js"></script>
  <script type="text/javascript" src="/js/yui/build/event/event-min.js"></script>
  <script type="text/javascript" src="/js/yui/build/connection/connection-min.js"></script>

</head>

<body class="yui-skin-sam">
<div id="container">
<?php include("common/header1.php"); ?>
<?php include("rightNav.php"); ?>

<div id="content">

  <div id="content_0">

  <h1>Register for <img src="/images/dogtime/petchat_logo_trans.gif" /></h1>
  <div id="content_1">
    <h4>What is PetChat?</h4>
    PetChat is a live chat forum for talking to other pet lovers. <br>Sign up to:
    <ul style="margin-left: 0;">
    <li style="margin-left: 0;">Chat about your dogs and cats
    <li>Share stories and advice
    <li>Talk to pet experts at weekly events
    </ul>

        <input style="width:20px;" type="checkbox" name="dtm" checked>
        Subscribe to the free Dogtimes Weekly newsletter and get expert advice
on nutrition, training, health, plus the latest pet news. Sign-Up today!

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
        Username:</td></tr>
        <tr>
        <td>
        <input type="text" id="username" name="username" value="<?php print $username; ?>"/>




        <input type="button" name="Submit2"  value="check availability!"
            onclick="makeRequest(form.username.value);"/>

        </td>
        </tr>
        <tr>
        <td>
         <div id="result"></div></td>
        </tr>
        <tr>




    </tr>
    <tr>
      <td>
      First Name:
      <br>
      <input type="text" id="first_name" name="first_name" value="<?php print $first_name; ?>"/>
	  <input type="hidden" id="yaploud_client" name="yaploud_client" value="<?php print $_REQUEST['yaploud_client']; ?>"/>
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
      <td style="text-align: left;">
        Enter code:
      </td>
    </tr>
    <tr>
      <td>
        <img style="vertical-align: bottom;" src="Captcha.php" />
        <input style="width:120px;" type="text" id="captcha" name="captcha" />
      </td>
    </tr>
    <tr>
      <td>
        <input style="width:20px;" type="checkbox" name="ylml" checked>
        Add me to your mailing list
      </td>
    </tr>
    <tr>
      <td>
        <input style="width:20px;" type="checkbox" name="petalert" checked>
        I would like to receive email alerts about upcoming PetChat events- talk to experts, win prizes, and more!
      </td>
    </tr>
    <tr>
      <td>
        <input style="width:20px;" type="checkbox" name="eula"
               onclick="enable_submit_signup(this);">
        I agree to <a href="/user/Terms_of_Use.pdf"> terms of use</a>
        and <a href="/user/Privacy_Policy.pdf">privacy statement</a>
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
<script>
	var sUrl = "isUsernameAvailable.php?username=";

	var div = document.getElementById('result');

	var handleSuccess = function(o){
	    if(o.responseText !== undefined){

	        div.innerHTML = o.responseText;

	    }
	}

	var handleFailure = function(o){

	}

	var callback =
	{
	  success:handleSuccess,
	  failure: handleFailure,
	  argument: { foo:"foo", bar:"bar" }
	};

	function makeRequest(userName){
		var request = YAHOO.util.Connect.asyncRequest('GET', sUrl+userName, callback);
	}

</script>
