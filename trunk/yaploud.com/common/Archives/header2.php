
<script type="text/javascript">
function strip_http() {
    var url = document.getElementById("yapurl_box");
    url.value = url.value.replace('http://', '');
}

function isSearchValid() {
    var txt = document.search_form.q.value;
    txt = txt.replace(/^\s\s*/, '').replace(/\s\s*$/, '');  
    document.search_form.q.value = txt;
            
    if (txt == "" ) {
        return false;
    }
    else {
        return true;
    }
}
        
function submitSearch() {
    if (isSearchValid()) {
        document.search_form.submit();
    }
}
</script>

<!-- Top nav -->
<div style="margin-bottom:5px;margin-top:10px; width:700px;">
	<a href="/home.php"><img style="float:left;" alt="yaploud logo" width="163" 
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

    <form name="search_form" method=get action="/search.php" onsubmit="return isSearchValid();">
    <span class=menu_1 style="margin-top:5px; margin-left: 0px;">Search:</span>
    <input name="q" id=search_box type="text" class="Text2_b" size="16"></input>
    <a href="javascript: submitSearch();">
    <img src="/images/go_image.gif" width="29" height="21" border="0"></img>
    </a>
    </form>
    </div>
</div>

<div style="clear:both;"></div>
<table width="777"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th width="100%" align="left" valign="top" scope="col">
    <table width="99%"  
        border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th align="left" valign="top" scope="row" width="163"><img alt="home_06" 
            src="/images/home_06.gif" width="163" height="22"></th>
        <td align="left" valign="top"><img alt="home_07" 
            src="/images/home_07.gif" width="43" height="22"></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
  <tr>
</table>

<br>

<!-- End Top Nav -->
