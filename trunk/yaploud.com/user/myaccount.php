<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.yaploud.com/TR/html4/loose.dtd">
<html>

<?php 
/*
 * PHP view of My Account page
 * 
 * Created on Nov 17, 2007
 * Author: alvinabad@alumni.cmu.edu
 * Revised:
 */
 
//--- load controller for this php view
include("./myaccount_c.inc");

?>

<head>
<title>Yaploud - My Account</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="/css/chat.css" rel="stylesheet" type="text/css">
<link href="/style.css" rel="stylesheet" type="text/css">
<link href="/images/style_Yaploud.css" rel="stylesheet" type="text/css">

</head>

<body onLoad="ChangePassword.focus('password')">

<?php include("common/header2.php"); ?>

<div style="float:left;width:500px;">
<div class=yap_title>My Account</div>
<p>

<div id="myaccount_change_password">
    <form action="/user/myaccount.php" method="post" onSubmit="return ChangePassword.validate();">
    <strong>Change Password</strong>
    <p>
    <div style="color: red;" id="error_message">
       <?php
           if ( isset($change_password_processed) && $change_password_processed ) {
               if ( $reset_password ) {
                   print "Success! Your password has been changed. <br>";
               }
               else {
                   print "Server error! Your password cannot be changed at this time. Please try again later. <br>";
               }
           }
       ?>
    </div>
    
    <label for=yourName>Password: </label>
    <br>
    <input type="password" id="password" name="password" />
    <br>
    <label>Re-type password: </label>
    <br>
    <input type="password" id="password2" name="password2" />
    <br>
    <input type="submit" value="Submit" />
</div>

<?php include("common/footer2.php");?>
</div>

</body>
</html>
