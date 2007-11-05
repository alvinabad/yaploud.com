<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.yaploud.com/TR/html4/loose.dtd">
<html>
<?php
   session_start();
   ob_start();
?>
<head>
<title>www.yaploud.com</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/chat.css" rel="stylesheet" type="text/css">
<link href="style.css" rel="stylesheet" type="text/css">
<link href="images/style_Yaploud.css" rel="stylesheet" type="text/css">
<script language="JavaScript">

function processLogin() {

	alert("Function called.");
	return false;

}

function focus()   {
// Sets cursor to FirstName input element
    document.forms[0].name.focus();
}

function checkme()
{
    if (document.forms[0].name.value == "")
    {
    alert("You did not enter your name. Please provide it.");
    document.forms[0].name.focus();return(false)
    }

    if (document.forms[0].email.value == "")
    {alert("You did not enter your email. Please provide it.");
    document.forms[0].email.focus();return(false)
    }

    if (document.forms[0].comments.value == "")
    {alert("You did not enter any comments. Please provide it.");
    document.forms[0].comments.focus();return(false);
    }

</script>
</head>
<body onLoad="focus()">
<?php include("common/header.php");  ?>
<script type=text/javascript src=js/chat.js></script>
<div style="float:left;width:500px;"><p>
	<div class=yap_title>Welcome to Help </div>
	<p>
	<strong> <a href="newinfo.php"> >> New User Information</a></strong><br/><br>
	<strong> <a href="faq.php""> >> F.A.Q</a></strong><br/><br/>
	</p>
	<p>
	<label for=Comment> Comments</label><br/>
	<form action="mail.php" method="post" onSubmit="return checkme()">
	<label for=yourName>Your Name: </label>

<?
   $sess = $_SESSION;
   if(!$sess['logged']){

      print "<br><input type=\"text\" name=\"name\" /><br/><br/>
      		<label for=email>Email: </label><br>
			<input type=\"text\" name=\"email\" /><br><br>";
      ob_end_flush();
   }
   else {
   	$username = $_SESSION['username'];
   $email = $_SESSION['email'];
   print " $username <br/><br/>
   	<label for=email>Email: </label>$email <br><br>";
   }
 ?>
		<label for=comments>Comments </label><br/>
		<textarea name="comments" rows="13" cols="55"></textarea><br>

	</p>
		<input type="submit" value="Submit">
	</form>
</div>
<?PHP include("common/footer.php");?>
</body>
</html>
