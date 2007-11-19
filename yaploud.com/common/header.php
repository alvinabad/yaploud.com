<?PHP
  include("user.php");
  $user = new User();
?>

<?PHP
  // If the user pressed the logout link, end the session
  if (isset($_REQUEST['logout'])) {
    $user->_logout();
  }
?>

<!-- Top nav -->
<div style="margin-bottom:5px;margin-top:10px; width:700px;">
	<a href="http://www.yaploud.com"><img style="float:left;" alt="yaploud logo" width="163" height="90" border="0" src="images/logo.gif"></img></a>
	<img style="float:left;" width="43" height="90" src="images/home_02.gif"></img>
	<img style="float:left;" width=220 height=90 src="images/home_03.gif"></img>
	<div style="float:left; padding-right:10px; height:90px; background-image: url(images/home_03.gif);">
	<?
	        if(!isset($_SESSION['logged']) || $_SESSION['logged'] == false) {
			echo("<a scope=\"col\" class=\"menu_1\" href=\"/user/register.php\"><strong>Sign Up</strong></a> | <a scope=\"col\" class=\"menu_1\" href=\"help.php\">Feedback</a> | <a scope=\"col\" class=\"menu_1\" href=\"/login_page.php\">Log In</a>");
		}
		else {
		    $current_user = $_SESSION['username'];
		    echo("<a scope=\"col\" class=\"menu_1\" ><strong> Hi $current_user</strong></a> | <a scope=\"col\" class=\"menu_1\" href=\"/user/myaccount.php\">My Account</a> | <a scope=\"col\" class=\"menu_1\" href=\"help.php\">Feedback</a> | <a scope=\"col\" class=\"menu_1\" href=/login_page.php?logout=true>Log Out</a>");

		    //echo("<span class=\"menu_1\"> <strong>Welcome, $current_user</strong></span> | <a scope=\"col\" class=\"menu_1\" href=\"myaccount.php\">My Account</a> | <a scope=\"col\" class=\"menu_1\" href=\"help.php\">Help</a> | <a scope=\"col\" class=\"menu_1\" href=\"/login_page.php?logout=true\">Log out</a>\n");
	        }
	?>
		<form method=get action=search.php>
		   <span class=menu_1 style="margin-top:5px; margin-left: 0px;">Search:</span>
		   <input name="q" id=search_box type="text" class="Text2_b" size="16"></input>
		   <img src="images/go_image.gif" width="29" height="21" border="0"></img>
		</form>
	</div>
</div>
<div style="clear:both;"></div>
<table width="777"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th width="777" align="left" valign="top" scope="col"><table width="99%"  border="0" cellspacing="0" cellpadding="0">

      <tr>
        <th align="left" valign="top" scope="row" width="163"><img src="images/home_06.gif" width="163" height="22"></th>
        <td align="left" valign="top"><img src="images/home_07.gif" width="43" height="22">
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
  <tr>
</table> <br>

<!-- End Top Nav -->
