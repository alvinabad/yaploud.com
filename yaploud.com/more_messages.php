<?php

include 'util.inc';

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
require_once 'db.inc';

$last_msg_id = $_GET['last_msg_id'];
$url = $_GET['url'];
$url = normalizeURL($url);
$cur_num_msgs = $_GET['cur_num_msgs']; 

$fetch_size = $cur_num_msgs + 100;

$query = "SELECT submitter as s, id, msg, date_format(creation_date, '%b %D %H:%i:%s') as t FROM dev.chat WHERE topic_url = '$url' ORDER BY creation_date DESC limit " . $fetch_size . ", 50"; 

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
print json_encode($rv);

?>
