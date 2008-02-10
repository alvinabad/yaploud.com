<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.yaploud.com/TR/html4/loose.dtd">

<html>

<?php
   require("./user_session_init_c.inc");
?>


<head>
<link rel="stylesheet" type="text/css" href=css/chat.css />
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

<div style="width:450px;float:left;">
<p/>
<div style="font: 26px Helvetica, Arial, sans-serif;color:#006699;font-weight:bold;">
    What is YapLoud?</div>
<div style="font: 20px Helvetica, Arial, sans-serif;color:#006600;font-weight:bold;">
    YapLoud is the home for yapping about everything:</div>
<ul style="color:grey;font:18px Helvetica, Arial, sans-serif;">
  <li>Chat about any topic of your interest
  <li>Share favorite Yaps.
  <li>Connect with other yappers
</ul>

<div style="font: 20px Helvetica, Arial, sans-serif;color:#336600;font-weight:bold;"><a href="/user/register.php">Sign up now</a> to join the YapLoud Community<br/><br/><a href="#">Download</a> the YapLoud toolbar</div>
</div>

<div style="float:left;margin-left:30px;">
<?php
    if(isset($_POST['action']) && $_POST['action'] == 'login') {
        // Login form was submiteted
        if (!isset($_SESSION['logged']) || $_SESSION['logged'] == false) {
	        $result = $user->_checkLogin($_POST['username'], $_POST['password'], 
	                  $_POST['remember']);
		
	        if (!$result) {
		        echo ("<div style=\"font:17px Helvetica, Arial, sans-serif; color:#FF0000;font-weight:bold;\">Invalid username or password</div>");
		        echo ("<div style=\"font:17px Helvetica, Arial, sans-serif; color:#FF0000;\">Please try again<p></div>");
		    }
		    else {
		        //header("Location: http://www.yaploud.com/home.php");
                if (isset($_SESSION['PREVIOUS_URI'])) {
    			    $redirect = 'http://' . $_SERVER['HTTP_HOST'] . 
    			                $_SESSION['PREVIOUS_URI'];
    			    unset($_SESSION['PREVIOUS_URI']);
			    }
			    else {
             	    $redirect = 'http://' . $_SERVER['HTTP_HOST'] . '/home.php';
			    }
	  	        header("Location: $redirect");
	        }
	    }
    }

   if (!isset($_SESSION['logged']) || $_SESSION['logged'] == false) {
   	// Display the login form
       echo <<<HTML
	<div style="padding: 20px 30px 20px 20px; background-color:#BDEDFF;" 
	     id="loginFormDiv"><span style="font-weight:bold;\">Please log in:</span>
	     <br/><br/>
	     <form name=loginForm id=loginForm method=POST action=login_page.php>
			<input type=hidden name=action value=login />
			<label for=username>Username:</label>
			<input type="text" name="username" id=username tabindex=1 alt="Your Username" /><br/>
			<label for=password>Password:</label>
			<input type="password" name="password" id=password tabindex=2 /><br/>
			<input type="checkbox" name="remember" id=password />Remember me</input><br/>
			<input type="submit" name=submit value="Submit" /> <br/><br/>
			<div style="font:14px Helvetica, Arial, sans-serif; color:#006699;">
			  <a href="/user/forgotusername.php">Forgot Username</a>&nbsp;&nbsp;|&nbsp;&nbsp;
			  <a href="/user/forgotpassword.php">Forgot Password</a></div>
			<script type=text/javascript>
			    document.getElementById('username').focus();
			</script>
		</form>
    </div>
HTML;
   }

   ?>
</div>

<div style="clear:both;"></div>

<div align="left" class="main_text">Free.No spyware or adware.</div>

<?PHP include("common/footer.php"); ?>

</body>
</html>

<?php ob_end_flush(); ?>
