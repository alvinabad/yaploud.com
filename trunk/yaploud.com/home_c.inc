<?php

/*
 * This is the controller (MVC pattern) for the home.php view
 * There shouldn't be HTML in here. Please put them in the view page.
 *
 * Created on Feb 25, 2008
 * Author: alvinabad@alumni.cmu.edu
 */

//--- Initialize include path and session
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);
session_start();
ob_start();

require ("user.php");
require("chat/ChatRoom.inc");
//require_once("chat/ChatUrl.inc");
require("rating/Rating.inc");
require("tags/Tags.inc");
require("util/Url.inc");

function getChatUrlInfo($url) {
	$u = new Url();
	$url = $u->addslashes($url);
	$sql = "SELECT * FROM chat_url WHERE url='$url';";
	$db = new DB();
	$result = $db->mysql_query($sql);

	$title = $url;
	$description = '<br>';
	if (mysql_num_rows($result) != 1) {
		$res_obj = false;
	}
	else {
        $res_obj = mysql_fetch_object($result);
	    $title = $res_obj->title;
	    $description = $res_obj->description;
	}

	$info['title'] = $title;
	$info['description'] = $description;
	
	return $info;
}

function getCountTopicUrl($db) {
	$sql = "select count(*) as count from ". 
	         "(select topic_url from chat group by topic_url) d";
	
	$result = $db->mysql_query($sql);
    $res_obj = mysql_fetch_object($result);
	$count = $res_obj->count;
	return $count;
}

function getTopicUrlInfo($db, $offset, $limit, $list_order) {
	if (!$offset) {
		$offset = 0;
	}
	
	if (!$limit) {
		$limit = 3;
	}
	
	/**
	// Wow, the subselect was really heavy. Doing this takes at least 8 seconds.
	$query = "select topic_url as url, count(*) as c, " .
             "(select count(username) from room_users where topic_url = url) " .
	         "as uniqs  from chat group by topic_url order by 2 desc ";
	**/
	
	if ($list_order == "most_recent") {
	    $query = "select distinct topic_url as url " .
	             "from chat order by creation_date desc ";
	             //"from chat group by topic_url order by creation_date desc ";
	}
	elseif ($list_order == "most_active") {
	    $query = "select topic_url as url, count(*) as c " .
	             "from room_users " .
	             "where DATEDIFF(CURRENT_DATE(), creation_date) <1 " . 
	             "group by topic_url order by creation_date desc ";
	}
	elseif ($list_order == "most_yappers") {
	    $query = "select topic_url as url, count(*) as c " .
	             "from room_users " .
	             "where username != '' " .
	             //"and DATEDIFF(CURRENT_DATE(), creation_date) <10 " . 
	             "group by username order by c desc ";
	}
    else {
	    $query = "select topic_url as url, count(*) as c " .
	             "from chat group by topic_url order by 2 desc ";
	}
	
	if ( $limit >= 0 ) {
		$query = $query . "limit $offset, $limit";
	}
	
	$chatUrlInfo_result = $db->mysql_query($query);

	if($chatUrlInfo_result) {
		return $chatUrlInfo_result;
	}
	else {
		return false;
	}
	
}



// default values
$num_pagelinks = 5;
$offset = 0;
$limit = $num_pagelinks;
$db = new DB();

$previous = $offset;
$next = $offset + $limit;
$total_url = getCountTopicUrl($db);
$num_results = -1;

if ($next>$total_url)
    $next = $offset;

if (isset($_REQUEST['list']) ) {
    $list_order = $_REQUEST['list'];
}
else {
    $list_order = "most_discussed";
}

if ( $_SERVER['REQUEST_METHOD'] == 'GET'  &&
     isset($_REQUEST['offset']) && isset($_REQUEST['limit']) ) {
    
    $offset = $_REQUEST['offset'];
    $limit = $_REQUEST['limit'];
    if ( $offset < 0 ) {
    	$offset = 0;
    }
    
    
    $topicUrlInfo_result = getTopicUrlInfo($db, $offset, $limit, $list_order);
    
    $look_ahead = getTopicUrlInfo($db, $offset+$limit, $limit, $list_order);
    $i = 0;
    while($row = mysql_fetch_assoc($look_ahead)) {
    	$i++;
    }
    
    $num_results = $i;
    
    if ($i != 0) {
        $previous = $offset - $limit;
        if ($previous < 0) {
            $previous = 0;
        }
         
        $next = $offset + $limit;
    }
    else {
    	$next = $offset;
    	$previous = $offset - $limit;
    }
}
else {
    $topicUrlInfo_result = getTopicUrlInfo($db, $offset, $limit, $list_order);
}

$previous_url = $_SERVER['PHP_SELF'] . "?offset=$previous" . "&limit=$limit" . 
                "&list=$list_order";
$next_url = $_SERVER['PHP_SELF'] . "?offset=$next" . "&limit=$limit" . 
            "&list=$list_order";

$most_discussed_url = $_SERVER['PHP_SELF'] . "?list=most_discussed";
$most_active_url = $_SERVER['PHP_SELF'] . "?list=most_active";
$most_recent_url = $_SERVER['PHP_SELF'] . "?list=most_recent";
$most_yappers_url = $_SERVER['PHP_SELF'] . "?list=most_yappers";
//$most_active_url = $_SERVER['PHP_SELF'] . "?offset=$next" . "&" . "limit=$limit";

?>

