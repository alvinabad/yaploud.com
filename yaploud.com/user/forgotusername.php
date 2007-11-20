<?php
include("./forgotusername_c.inc");

/*
 * This is the view (MVC pattern) of the forgotusername page
 * The controller is located in forgotusername_c.inc
 * 
 * PHP code in this view is only used for rendering logic and is kept 
 * to the minimum. Please put all logic in the controller.
 */
 
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.yaploud.com/TR/html4/loose.dtd">

<html>
<head>
<link href="/css/chat.css" rel="stylesheet" type="text/css">
<link href="/style.css" rel="stylesheet" type="text/css">
<link href="/images/style_Yaploud.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/user/forgotusername.js" ></script>
<style>
label{
   font: 18px Helvetica, Arial, sans-serif;
   text-align:right;
   display:block;
   width:50px;
}
input{
   font: 18px Helvetica, Arial, sans-serif;
   color:orange;
}
</style>
</head>
<body>

<?php include("common/header2.php");  ?>

<div style="color: red;">
    <?php
      if (isset($post_processed) && $post_processed) {
          if (isset($status) && $status) {
          	    if ($valid_email) {
          	    	    $email = "";
          	    	    print "Thank you for your request. " .
          	    	          "Your username has been sent to your email. <p>";
          	    }
          	    else {
          	    	    print "Your email is not found in our system. " .
          	    	          "Please try another email. <p>";
          	    }
          		}		
      }  
    ?>
</div>
	
<div style="width:450px;float:left;">
  <p>
  <div style="font: 26px Helvetica, Arial, sans-serif;color:#006699;
            font-weight:bold;">Forgot Username</div>

  <ul style="color:grey;font:18px Helvetica, Arial, sans-serif;">
  <li>Enter the email address associated with your YapLoud account
  <li>Enter the verification code you see in the box
  <li>We'll email your username to you
  </ul>

  </p>
  <div style="font: 20px Helvetica, Arial, sans-serif;
     color:#336600; font-weight:bold;">
     <a href="/user/register.php">Sign up now</a>
     to join the YapLoud Community<br/><br/>
     <a href="#">Download</a> the YapLoud toolbar</div>
</div>

<div style="float:left;margin-left:30px;">
  <div id="error_message" style="color: red; font-weight: normal;">
    <?php
      if (isset($post_processed) && $post_processed &&
          isset($valid_captcha) && !$valid_captcha ) {
              print "Invalid code. Please try again.<br>";
      }
    ?>
  </div>
	
	  <div style="padding: 20px 30px 20px 20px; background-color:#BDEDFF;
	              font-weight: normal;" 
	       id="forgotusername_div">
		    <form name="forgotusername_form" id="forgotusername_form" 
		          method=POST action="/user/forgotusername.php" 
		          onSubmit="return ForgotUsername.validate();">
			    <label>Email: </label>
    		<input type="text" id="email" name="email" value="<? print $email; ?>"/>
    		<br><br>
    		<div style="vertical-align: top;"><img src="/user/Captcha.php" /></div>
    		<br>
    		<label>Code: </label>
    		<input type="text" id="captcha" name="captcha" />
    		<br><br>
    		<input type="submit" value="Email username" />
    		<a href="<? print $_REQUEST['URI']; ?>">Reset</a>
    		<script type=text/javascript>
			      document.getElementById('email').focus();
			    </script>
			    </form>
	  </div>
	</div>

<div style="clear:both;"></div>

</br>
<div align="left" class="main_text">Free.No spyware or adware.</div>
	
<?PHP include("common/footer.php"); ?>

</body>
</html>

<?php ob_end_flush(); ?>
