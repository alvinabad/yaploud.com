<?php
	require_once '../db.inc';
	$db = new DB();
	$username = $_REQUEST['username'];
	$sql = "SELECT * FROM user WHERE username = '$username'";
  	$result = $db->mysql_query($sql);
  	
	if (empty($username)) {
  	$objResponse="<font size=3 color=red> Please enter username! </font>";
  }elseif (mysql_num_rows($result)>0) {
  	$objResponse="<font size=3 color=red> Not Available! </font>";
  } else {
  	$objResponse="<font size=3 color=blue> Available! </font>";
	}
  print $objResponse;

?>