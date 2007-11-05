<?php
   header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
   header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
   header("Cache-Control: no-store, no-cache, must-revalidate");
   header("Cache-Control: post-check=0, pre-check=0", false);
   header("Pragma: no-cache");

   require_once 'db.inc';
   $qt = $_GET['q'];
   if($qt == null){
   }
   else{
   	$db = new DB();
	$qt = strip_tags(clean($qt, 128, $db->getConnection()));
	$tokens = preg_split("/\s+/", $qt);
	$first = true;
	$query = "select id, topic_url as url, submitter as s, creation_date as t, msg as m from dev.chat where match (msg) against ('";
	foreach($tokens as $tok){
	   if($tok[0] == "-"){
	   }
	   else{
	   	$tok = "+" . $tok;
	   }
	   if($first){
	   	$query .= $tok;
		$first = false;
	   }
	   else{
	   	$query .= " $tok";
	   }
	}
	$query .= "' IN BOOLEAN MODE)";

	$result = $db->mysql_query($query);
	$rv = array();
	$results = array();
	if($result){
	   while($row = mysql_fetch_assoc($result)){
	   	array_push($results, $row);
	   }
	   mysql_free_result($result);
	}
	$rv['search_term'] = $qt;
	$rv['results'] = $results;
	print json_encode($rv);
   }
?>
