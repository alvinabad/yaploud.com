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

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.yaploud.com/TR/html4/loose.dtd">

<html>
<head>
<title>Yaploud - Sign Up</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="/css/chat.css" rel="stylesheet" type="text/css">
<link href="/style.css" rel="stylesheet" type="text/css">
<link href="/images/style_Yaploud.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="/user/Register.js" ></script>

</head>

<body onLoad="Register.focus('username')">

<?php include("common/header2.php"); ?>

<div style="float:left;width:600px;">
  <div class=yap_title>Register at YapLoud</div>
  <p>

  <div>
    <form action="/user/register.php" method="post" 
          onSubmit="return Register.validate();">
    
    <p>
    <div style="color: red;" id="error_message">
       <?php
           if ( isset($registration_processed) ) {
               if ( $status ) {
                   echo <<<HTML
    <div>$message
    <br>
    You may now <a href="/login_page.php">login</a> 
    to continue.
    </div>
HTML;
               }
               else {
                   print "$message <br>";
               }
           }
       ?>
    </div>
    
    <label>Desired Username: </label>
    <br>
    <input type="text" id="username" name="username" />
    <br>
    <label>First Name: </label>
    <br>
    <input type="text" id="first_name" name="first_name" />
    <br>
    <label>Last Name: </label>
    <br>
    <input type="text" id="last_name" name="last_name" />
    <br>
    <label>Email: </label>
    <br>
    <input type="text" id="email" name="email" />
    <br>
    <label>Password: </label>
    <br>
    <input type="password" id="password" name="password" />
    <br>
    <label>Re-type password: </label>
    <br>
    <input type="password" id="password2" name="password2" />
    <br><br>
    <div style="vertical-align: top;"><img src="Captcha.php" /></div>
    <label>Type in the characters shown above </label>
    <br>
    <input type="text" id="captcha" name="captcha" />
    <br><br>
    
    <input type="submit" value="Submit" />
  </div>

  <?php include("common/footer2.php");?>
</div>

</body>
</html>





