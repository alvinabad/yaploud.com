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
  	$objResponse->assign("result", "innerHTML", "<font size=3 color=red>
Please enter username!
</font>");
  }elseif (mysql_num_rows($result)>0) {
  	$objResponse->assign("result", "innerHTML", "<font size=3 color=red>
Not Available!
</font>");
  } else {
  	$objResponse->assign("result", "innerHTML", "<font size=3 color=blue>
Available!
</font>");
  }
  return $objResponse;
}
$xajax->processRequest();

?>