<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.yaploud.com/TR/html4/loose.dtd">

<html>

<?php
   session_start();
   ob_start();
?>


<head>
<link href="/css/chat.css" rel="stylesheet" type="text/css">
<link href="/style.css" rel="stylesheet" type="text/css">
<link href="/images/style_Yaploud.css" rel="stylesheet" type="text/css">
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

<div style="width:450px;float:left;">
<p>
<div style="font: 26px Helvetica, Arial, sans-serif;color:#006699;font-weight:bold;">Forgot Username</div>

<ul style="color:grey;font:18px Helvetica, Arial, sans-serif;">
<li>Enter the email address associated with your YapLoud account
<li>Enter the verification code you see in the box
<li>We'll email your username to you
</ul>

</p>
<div style="font: 20px Helvetica, Arial, sans-serif;color:#336600;font-weight:bold;"><a href="/user/register.php">Sign up now</a> to join the YapLoud Community<br/><br/><a href="#">Download</a> the YapLoud toolbar</div>
</div>

<div style="float:left;margin-left:30px;">

	<div style="padding: 20px 30px 20px 20px; background-color:#BDEDFF;" id="forgotunameform">
		<form name=forgotuname id=loginForm method=POST action=TBD.php>
			<label>Email: </label>
    		<input type="text" id="forgotunameemail" name="forgotunameemail" />
    		<br><br>
    		<div style="vertical-align: top;"><img src="user/Captcha.php" /></div>
    		<br>
    		<label>Code: </label>
    		<input type="text" id="captcha" name="captcha" />
    		<br><br>
    		<input type="submit" value="Email username" />
    		<script type=text/javascript>
			    document.getElementById('username').focus();
			</script>

	</div>
</div>
<div style="clear:both;"></div>

</br>
<div align="left" class="main_text">Free.No spyware or adware.</div>

<?PHP include("common/footer.php"); ?>

</body>
</html>

<?php ob_end_flush(); ?>
