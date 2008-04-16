<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/strict.dtd">

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

<html>
<head>
  <title>Yaploud - My Account</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <link type="text/css" rel="stylesheet" href="/css/style.css" />
  <?php require("common/yui.php"); ?>
    
  <script type="text/javascript" src="/css/niftycube.js" ></script>
  <script type="text/javascript" src="/user/ChangePassword.js" ></script>
  <script type="text/javascript" src="/user/UpdateUserInfo.js" ></script>
  <script type="text/javascript">
    function init() {
        ChangePassword.clear();
        document.getElementById('password').focus();
    }
    YAHOO.util.Event.onDOMReady(init);
  </script>
</head>

<body class="yui-skin-sam">
<div id="container">
<?php include("common/header1.php"); ?>
<?php include("rightNav.php"); ?>

<div id="content">

  <div style="width: 600px; overflow: hidden;">
  <h1>My Account</h1>
  
  <div id="greeting">
    <h4>Change Password</h4>
    <form action="/user/myaccount.php" method="post" 
          onSubmit="return ChangePassword.validate();">
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
    
    <table style="text-align: left;">
    <tr>
      <td>
        Password:
        <br>
        <input type="password" id="password" name="password" />
      </td>
    </tr>
    <tr>
      <td>
        Re-type password:
        <br>
        <input type="password" id="password2" name="password2" />
      </td>
    </tr>
    <tr>
      <td>
        <input type="submit" name="submit_change_password" value="Change password" />
      </td>
    </tr>
    </table>
    </form>
  </div>

  <div id="greeting">
    <h4>Update User Profile</h4>
    
    <form action="/user/myaccount.php" method="post" 
          onSubmit="return UpdateUserInfo.validate();">
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
    
    <table style="text-align: left;">
    <tr>
      <td>
        Username: <strong><?php print $username; ?></strong>
      </td>
    </tr>
    <tr>
      <td>
        First Name:
        <br>
        <input type="text" id="first_name" name="first_name" 
               value="<?php print $first_name; ?>" />
      </td>
    </tr>
    <tr>
      <td>
        Last Name:
        <br>
        <input type="text" id="last_name" name="last_name"
               value="<?php print $last_name; ?>" />
      </td>
    </tr>
    <tr>
      <td>
        Email:
        <br>
        <input type="text" id="email" name="email"
               value="<?php print $email; ?>" />
      </td>
    </tr>
    <tr>
      <td>
        <input type="submit" name="submit_update_userinfo" value="Update" />
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
