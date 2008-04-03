<?php

require_once 'util.inc';

//IE will cache AJAX stuff w/o things like cache killers below

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
require_once 'db.inc';
$last_msg_id = $_GET['last_msg_id'];
$url = $_GET['url'];
$url = normalizeURL($url);
$query = "SELECT submitter as s, id, msg, date_format(creation_date, '%b %D %H:%i') as t FROM dev.chat WHERE id > $last_msg_id AND topic_url = '$url' ORDER BY creation_date DESC limit 50";

$db = new DB();
$rv = array(); 
$all_msgs = array();

if(($result = $db->mysql_query($query, $db->getConnection())) != null){
    while($row = mysql_fetch_assoc($result)){
        array_push($all_msgs, $row);
    }
    $json = json_encode($all_msgs);
    mysql_free_result($result);
}

$rv['msgs'] = $all_msgs;
$rv['users'] = array(); 
$query = "select distinct(username) as u from dev.room_users where topic_url = '$url'"; 
if(($result = $db->mysql_query($query)) != null){
   while($row = mysql_fetch_assoc($result)){
      array_push($rv['users'], $row['u']);
   }
   mysql_free_result($result); 
}
print json_encode($rv);

?>
