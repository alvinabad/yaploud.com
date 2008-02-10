<?php 
include("./myaccount_c.inc");

/*
 * This is the view (MVC pattern) of My Account page.
 * The controller is located at myaccount_c.inc
 * 
 * PHP code in this view is only used for rendering logic and is kept 
 * to the minimum. Please put all logic in the controller.
 * 
 * Created on Nov 17, 2007
 * Author: alvinabad@alumni.cmu.edu
 * Revised:
 */
 
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.yaploud.com/TR/html4/loose.dtd">

<html>
<head>
<title>Yaploud - My Account</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="/css/chat.css" rel="stylesheet" type="text/css">
<link href="/style.css" rel="stylesheet" type="text/css">
<link href="/images/style_Yaploud.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="/user/ChangePassword.js" ></script>
<script type="text/javascript" src="/user/UpdateUserInfo.js" ></script>

</head>

<body onLoad="ChangePassword.focus('password')">

<?php include("common/header2.php"); ?>

<div style="float:left;width:700px;">
  <div class=yap_title>My Account</div>
  <p>

  <div id="myaccount_change_password" style="float:left;width:350px;">
    <form action="/user/myaccount.php" method="post" 
          onSubmit="return ChangePassword.validate();">
    <strong>Change Password</strong>
    <p>
    <div style="color: red;" id="error_message">
       <?php
           if ( isset($change_password_processed) && 
                   $change_password_processed ) {
               if ( $reset_password ) {
                   print "Success! Your password has been changed. <br>";
               }
               else {
                   print "Server error! Your password cannot be changed at " .
                         "this time. Please try again later. <br>";
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
    <input type="submit" name="submit_change_password" value="Change password" />
    </form>
  </div>

<div id="myaccount_updateUserInfo" style="float:left;width:350px;">
    <form action="/user/myaccount.php" method="post" 
          onSubmit="return UpdateUserInfo.validate();">
    <strong>Update User Profile</strong>
    <p>
    <div style="color: red;" id="error_message_update_userinfo">
       <?php
           if ( isset($update_userinfo_processed) && 
                   $update_userinfo_processed ) {
               if ( $update_userinfo ) {
                   print "Success! Your user information has been updated. <br>";
               }
               else {
                   print "Server error! Your user information cannot be updated at " .
                         "this time. Please try again later. <br>";
               }
           }
       ?>
    </div>
    
    <label for=yourName>Username: </label>
    <strong><?php print $username; ?></strong>
    <br>
    <br>
    <label>First Name: </label>
    <br>
    <input type="first_name" id="first_name" name="first_name" 
           value="<?php print $first_name; ?>" />
    <br>
    <label>Last Name: </label>
    <br>
    <input type="last_name" id="last_name" name="last_name"
           value="<?php print $last_name; ?>" />
    <br>
    <label>Email: </label>
    <br>
    <input type="email" id="email" name="email"
           value="<?php print $email; ?>" />
    <br>
    <input type="submit" name="submit_update_userinfo" value="Update" />
    </form>
  </div>
</div>

<p>
<div style="clear:both;"></div>
<?php include("common/footer.php");?>

</body>
</html>
