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
<table width="777" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th width="777" align="left" valign="top" scope="col">
      <table id="topNav" width="99%" cellspacing="0" cellpadding="0">
	<tr>
        <td width="163" valign="top" height="90" align="left" scope="row">
			<img width="163" height="90" src="images/logo.gif"/>
        <td width="43" valign="top" align="left">
			<img width="43" height="90" src="images/home_02.gif"/>
		</td>
        <td width="328" valign="middle" align="left" class="top_imge"></td>
        <td width="250" valign="top" align="left" class="top_imge">
			<table width="100%" cellspacing="0" cellpadding="2" border="0">
				<tbody>
					<tr>
					  <th scope="col" class="menu_1">
					    <div align="center">
					      <?PHP
					        if (!isset($_SESSION['logged']) || $_SESSION['logged'] == false) {
						  echo("<a scope=\"col\" class=\"menu_1\" href=\"http://www.yaploud.com/register.htm\"><strong>Sign Up</strong></a> | <a scope=\"col\" class=\"menu_1\" href=\"help.php\">Help</a> | <a scope=\"col\" class=\"menu_1\" href=login_page.php>Log In</a>");
					        } else {
					          $current_user = $_SESSION['username'];
					          echo("Welcome $current_user | <a scope=\"col\" class=\"menu_1\" href=\"#\">My Account</a> | <a scope=\"col\" class=\"menu_1\" href=\"help.php\">Help</a> | <a scope=\"col\" class=\"menu_1\" href=\"http://www.yaploud.com/login_page.php?logout=true\">Log out</a>");

					        }
				  	      ?>
					    </div>
					  </th>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>
							<table width="100%"  border="0" cellspacing="0" cellpadding="0">
								<tr>
									<th width="31%" class="Text2_b" scope="col">Search :</th>
									<th width="44%" align="left" valign="top" scope="col">
									<form method=get action=search.php><input name="q" type="text" class="Text2_b" size="16"></th>
									<th width="25%" align="left" valign="top" scope="col"><div align="left"><a href="#"><img src="images/go_image.gif" width="29" height="21" border="0"></a></div></th>
								</tr>
							</table>
						</td>
					</tr>
				</tbody>
			</table>
		</td>
        </tr>
      </table>
    </th>
  </tr>
</table>
