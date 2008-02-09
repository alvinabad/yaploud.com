<?php
    $user = new User();

    // If the user pressed the logout link, end the session
    if (isset($_REQUEST['logout'])) {
        $user->_logout();
    }
?>

<!-- Top nav -->
<div style="margin-bottom:5px;margin-top:10px; width:700px;">
	<a href="/"><img style="float:left;" alt="yaploud logo" width="163" 
	   height="90" border="0" src="/images/logo.gif"></img></a>
	<img style="float:left;" width="43" height="90" 
	     src="/images/home_02.gif"></img>
	<img style="float:left;" width=220 height=90 
	     src="/images/home_03.gif"></img>
	<div style="float:left; padding-right:10px; height:90px; 
	     background-image: url(/images/home_03.gif);">
	
<?php
    if(!isset($_SESSION['logged']) || $_SESSION['logged'] == false) {
        echo <<<HTML
    <a scope="col" class="menu_1" href="/user/register.php"><strong>Sign Up</strong></a> | 
	<a scope="col" class="menu_1" href="/help.php">Feedback</a> | 
	<a scope="col" class="menu_1" href="/login_page.php">Log In</a>
HTML;
    }
	else {
	    $current_user = $_SESSION['username'];
		echo <<<HTML
	<a scope="col" class="menu_1"><strong> Hi $current_user</strong></a> | 
	<a scope="col" class="menu_1" href="/user/myaccount.php">My Account</a> | 
	<a scope="col" class="menu_1" href="/help.php">Feedback</a> | 
	<a scope="col" class="menu_1" href=/login_page.php?logout=true>Log Out</a>
HTML;

    }
?>

    <form method=get action="/search.php">
    <span class=menu_1 style="margin-top:5px; margin-left: 0px;">Search:</span>
    <input name="q" id=search_box type="text" class="Text2_b" size="16"></input>
    <img src="/images/go_image.gif" width="29" height="21" border="0"></img>
    </form>
    </div>
</div>

<script type="text/javascript">
    function strip_http() {
        var url = document.getElementById("yapurl_box");
        url.value = url.value.replace('http://', '');
    }
</script>

<div style="clear:both;"></div>
<table width="777"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th width="777" align="left" valign="top" scope="col">
    <table width="99%"  
        border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th align="left" valign="top" scope="row" width="163"><img alt="home_06" 
            src="/images/home_06.gif" width="163" height="22"></th>
        <td align="left" valign="top"><img alt="home_07" 
            src="/images/home_07.gif" width="43" height="22">
        <td>
          <form method=get action="/chat.php" onsubmit="strip_http(); ">
            <span class=menu_1 style="margin-top:5px; margin-left: 0px;">
            Enter URL to yap:</span>
            <input name="url" id="yapurl_box" type="text" class="Text2_b" 
                   value="http://" size="48"></input>
            <input type="submit" value="Go" class="Text2_b"/>
            </form>
        </td>
        <td>&nbsp;</td>
      </tr>
    </table>
  <tr>
</table>

<br>

<!-- End Top Nav -->
