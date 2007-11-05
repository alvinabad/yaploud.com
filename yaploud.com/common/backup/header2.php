<?PHP
  include("user.php");
  $user = new User();
?>


<link href="style.css" rel="stylesheet" type="text/css"/>

<?PHP
  // If the user pressed the logout link, end the session
  if (isset($_REQUEST['logout'])) {
    $user->_logout();
  }
?>

<!-- Top nav -->
<div style="margin-top:20px; padding-top:20px;">
	<img style="float:left;" alt="yaploud logo" width="163" height="90" src="images/logo.gif"></img>
	<img style="float:left;" width="43" height="90" src="images/home_02.gif"></img>
	<img style="float:left;" width=349 height=90 src="images/home_03.gif"></img>
	<div style="float:left; height:90px; background:white;">
	<?
	        if(!isset($_SESSION['logged']) || $_SESSION['logged'] == false) {
			echo("<a scope=\"col\" class=\"menu_1\" href=\"http://www.yaploud.com/register.htm\"><strong>Sign Up</strong></a> | <a scope=\"col\" class=\"menu_1\" href=\"help.php\">Help</a> | <a scope=\"col\" class=\"menu_1\" href=login_page.php>Log In</a>");
		} 
		else {
		    $current_user = $_SESSION['username'];
		    echo("<span class=menu_1>Welcome, $current_user</span> | <a scope=\"col\" class=\"menu_1\" href=\"#\">My Account</a> | <a scope=\"col\" class=\"menu_1\" href=\"help.php\">Help</a> | <a scope=\"col\" class=\"menu_1\" href=\"http://www.yaploud.com/login_page.php?logout=true\">Log out</a>");
	        }
	?>
	<form method=get action=search.php>
	<label class=menu_1 for=q>Search:</label>
	<input name="q" id=search_box type="text" class="Text2_b" size="16">
	<img src="images/go_image.gif" width="29" height="21" border="0">
	</form>
	</div>
	<div style="clear:both;"></div>
</div>
