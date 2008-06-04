<?php
 require_once('../js/xajax/xajax_core/xajax.inc.php');
$xajax = new xajax();
$xajax->registerFunction("processForm");
function processForm($username) {
  require_once '../db.inc';
        $db = new DB();
        $sql = "SELECT * FROM user WHERE username = '$username'";
  		$result = $db->mysql_query($sql);
  	
 
  $objResponse = new xajaxResponse();
  if (empty($username)) {
  	$objResponse->assign("result1", "innerHTML", "Empty username");
  }elseif (mysql_num_rows($result)>0) {
  	$objResponse->assign("result1", "innerHTML", "Not Available");
  } else {
  	$objResponse->assign("result1", "innerHTML", "Available");
  }
  return $objResponse;
}
$xajax->processRequest();

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Is Username Available</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?
$xajax->printJavascript("../js/xajax/");
?>
</head>
<body>
<form name="form1" method="post" action="">
<table width="600" border="1">
<tr>
<td width="63">username</td>
<td width="8">:</td>
<td width="306"><input type="text" name="username">
<input type="button" name="Submit2" value="isAvailable?"
onclick="xajax_processForm(form1.username.value);"></td>
<td>
<div id="result1"></div></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input type="submit" name="Submit" value="Submit"></td>
</tr>
</table>
</form>
</body>
</html>