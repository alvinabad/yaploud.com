<?php
	require_once '../db.inc';
	$db = new DB();
	$username = $_REQUEST['username'];
	$sql = "SELECT * FROM user WHERE username = '$username'";
  	$result = $db->mysql_query($sql);
  	
	if (empty($username)) {
  		$objResponse= "Please enter username!";
  	}elseif (mysql_num_rows($result)>0) {
  		$objResponse="Not Available!";
  } else {
  	$objResponse="Available!";
  }
  print $objResponse;

?>