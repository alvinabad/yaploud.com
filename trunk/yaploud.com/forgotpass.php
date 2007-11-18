<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.yaploud.com/TR/html4/loose.dtd">

<html>

<?php
   session_start();
   ob_start();
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

<?php include("common/header.php");  ?>

<!-- <div style="width:450px;float:left;"> -->
<p>
<div style="font: 26px Helvetica, Arial, sans-serif;color:#006699;font-weight:bold;">Password Assitance</div><br/><br/>

</p>

<!-- <div style="float:left;margin-left:30px;"> -->

   <?php
   $display = true;
   if(isset($_POST['pass']) == 'password') {
        // Request for password email has been submitted
        if (!isset($_SESSION['logged']) || $_SESSION['logged'] == false) {
	    $result = $user->_forgotPassword2($_POST['email']);
		if (!$result) {
			echo ("<div style=\"font:23px Helvetica, Arial, sans-serif; color:#FF0000;font-weight:bold;\">Invalid Email.</div>");
		  	echo ("<div style=\"font:17px Helvetica, Arial, sans-serif; color:#FF0000;font-weight:bold;\"></div>");
		   	echo ("<div style=\"font:17px Helvetica, Arial, sans-serif; color:#FF0000;\">The email address you entered has not been registered. Try again or <a href=register.htm> Sign up now</a><p></div>");
		}
		else {
		 		// Send the password to the email address
		 		$display = false;
		 		echo <<<HTML
	<div style="font:18px Helvetica, Arial, sans-serif; color:#FF0000;font-weight:bold;">
	Thank you for your request. We've sent you an email with instructions on how to reset your password.
	</div>
HTML;
	     	  }
		}
   }

   if ($display) {
   if (!isset($_SESSION['logged']) || $_SESSION['logged'] == false) {
   	// Display the login form
	echo <<<HTML
<div style="font: 18px Helvetica, Arial, sans-serif;color:#006600;font-weight:bold;" >
    Enter the email address of your Yaploud account below.
    We will send you an email with instructions on how to reset your password.
</div>

<form name=passwordAssistance id=passwordAssitance method=POST action=forgotpass.php>
    <input type=hidden name=pass value=passsword /><br/>
	<div style="font:18px Helvetica, Arial, sans-serif; color:#006699;">Email:</div>

	<input type="text" name="email" id=email maxlength="50" size ="30" tabindex=1 alt="Your Email" />
	<br/>
	<input type="submit" name=submit value="Submit" /> <br/><br/>
	<script type=text/javascript>
	    document.getElementById('email').focus();
	</script>
</form>
HTML;
   }
   }
   ?>
</div>

<div style="clear:both;"></div>

</br>
<?PHP include("common/footer.php"); ?>

</body>
</html>

<?php ob_end_flush(); ?>
