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
</head>

<body onLoad="focus()">

<?php include("common/header.php");  ?>

<div style="width:500px;float:left;">
<p>
	<div class=yap_title>Register at YapLoud</div>
	<p>
	<form id="registrationForm" method="POST" action="/register.php">
	   <input type=hidden name=action value=register />
	   <label for=userid>Desired Username:</label><br/>
	   <input type=text name=userid id=userid /><br/>
	   <label for=firstName>First Name:</label><br/>
	   <input type=text name=firstName id=firstName /><br/>
	   <label for=lastName>Last Name:</label><br/>
	   <input type=text name=lastName /><br/>
	   <label for=email>Email:</label><br/>
	   <input type=text name=email /><br/>
      <label for=password>Password:</label><br/>
      <input type=password name=password /><br/>
      <label for=password2>Retype Password:</label><br/>
      <input type=password name=password2 />
      <p>
      <input type=submit value="Join Now" />
      </form>
</div>

</body>
</html>


<?PHP
   if(isset($_POST['action']) && $_POST['action'] == 'register') {

   $firstName = $_POST['firstName'];
   $userid = $_POST['userid'];
   $lastName = $_POST['lastName'];
   $pas = $_POST['password'];
   $pas2 = $_POST['password2'];
   $password = MD5($_POST['password']);
   $email = $_POST['email'];
   $userid = $_POST['userid'];

	function validate($value)
	{
	  if($value == "")
    return FALSE;
  else
    return TRUE;
	}

	$error=0;
	if(!validate($userid))
	{
	  echo "Please input value in 'Desired Username' <br/><br/>";
	  $error++; // $error=$error+1;
	}
	if(!validate($firstName))
	{
	  echo "Please input value in 'First Name'<br/><br/>";
	  $error++; // $error=$error+1;
	}
	if(!validate($lastName))
	{
	  echo "Please input value in 'Last Name'<br/><br/>";
	  $error++; // $error=$error+1;
	}
	if(!validate($email))
	{
	  echo "Please input value in 'Email'<br/><br/>";
	  $error++; // $error=$error+1;
	}
	if(!validate($pas))
	{
	  echo "Please input value in 'Password'<br/><br/>";
	  $error++; // $error=$error+1;
	}
	if($pas != $pas2)
	{
	  echo "Password enteries do not match. Please check password again";
	  $error++; // $error=$error+1;
	}


	If ($error == 0) {
   require_once 'db.inc';
   $db = new DB();
   $sql = "INSERT INTO dev.user(username, first_name, last_name, password, update_timestamp, email, userid) VALUES('$userid', '$firstName', '$lastName', '$password', sysdate(), '$email', '$userid');";

	$result = $db->mysql_query($sql);

	if ($result) {
		echo("Registration successful! <br>/<br/> <b><a href=login_page.php> LOGIN  </a></b>");
		}
	else {
		echo("Registration failed!");
		}
	}
   }
?>
