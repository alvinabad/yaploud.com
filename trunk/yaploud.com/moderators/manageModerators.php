<?php
    require("manageModerators_c.inc");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html>
<head>
  <title>Manage Moderators</title>
  <meta name="description" content="Real time discussion on web pages" />
  <meta name="keywords" content="yaploud, chat, yap, discuss, Social networking, networking, real-time conversation, real-time chat, dynamic group, URL, YapURL, cricket, sports, live cricket, live sports, live entertainment, live chat, live conversation, live discussion" />
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <link type="text/css" rel="stylesheet" href="/css/style.css" />
  <style type="text/css">
  th {
      font-size: 14px;
  }
  td {
      font-size: 12px;
      font-family: arial;
      padding-left: 2px;
  }
  </style>
</head>

<body class="yui-skin-sam">
<div id="container">
<?php include("common/header1.php"); ?>
<?php include("rightNav.php"); ?>

<div id="content">
  <div id="content0">
  <h1>Manage Moderators</h1>
  <p>

  <hr>
  <h3>Add Moderator</h3>
<?php
if ( !$isAuthenticated ) {
    return;
}

	print<<<HTML
    <form action="{$_SERVER['PHP_SELF']}" method="post" >
    <table>
    <tr>
      <td>Moderator username:</td>
      <td>
        <input size="30" id="moderator" type="text" name="moderator" value="{$moderator}"/>
      </td>
    </tr>
    <tr>
      <td>Domainname or Url:</td>
      <td>
        <input size="30" id="domainname" type="text" name="domainname" value="{$domainname}"/>
      </td>
    </tr>
    <tr>
      <td></td>
      <td>
        <input type="submit" name="add" value="Add moderator">
      </td>
    </tr>
    </table>
    </form>
  <hr>
  <h3>Remove Moderators</h3>
HTML;

	print<<<HTML
    <form action="{$_SERVER['PHP_SELF']}" method="post" >
    <table border="1" width="100%">
    <th width="20%">Moderator</th>
    <th>Domainname</th>
    <th width="25%">Date Created</th>
    <th width="5%">Remove</th>
HTML;

$found = false;
foreach($moderators as $moderator) {
    print <<<HTML
    <tr>
      <td>{$moderator['username']}</td>
      <td>{$moderator['domainname']}</td>
      <td>{$moderator['date_created']}</td>
      <td align="right">
        <input type="checkbox" name="moderators[]"
                               value="{$moderator['username']},{$moderator['domainname']}">
      </td>
    </tr> 
HTML;
    $found = true;
}
    print<<<HTML
    </table>
HTML;

	if ($found) {
    print <<<HTML
    <table width="100%">
    <tr>
      <td align="right">
      <input style="width:200px;" type="submit" name="remove" value="Remove selected moderator(s)">
      </td>
    </tr> 
    </table>
HTML;
	}
	
	print<<<HTML
    </form>
HTML;
  
?>
  
</div> <!-- content0 -->
</div> <!-- content -->
  
<?php include("common/footer1.php"); ?>
</div> <!-- container --> 

  <?php require("common/yui.php"); ?>
  <script type="text/javascript" src="/css/niftycube.js" ></script>
  <script type="text/javascript" src="/js/home.js" ></script>
  <script type="text/javascript">
    yaps_div = document.getElementById('yaps');
    yaps_div.scrollTop = yaps_div.scrollHeight;
    if ( navigator.appName == "Microsoft Internet Explorer" ) {
        yaps_div.scrollTop = yaps_div.scrollHeight; // IE7 requires running this twice!
    }
  </script>

</body>
</html>
