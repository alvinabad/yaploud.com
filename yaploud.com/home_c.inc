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

function getChatUrlInfo($url) {
	$url = 'http://' . $url;
	$sql = "SELECT * FROM dev.chat_url WHERE url='$url';";
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
	         "(select topic_url from dev.chat group by topic_url) d";
	
	$result = $db->mysql_query($sql);
    $res_obj = mysql_fetch_object($result);
	$count = $res_obj->count;
	return $count;
}

function getTopicUrlInfo($db, $offset, $limit) {
	if (!$offset) {
		$offset = 0;
	}
	
	if (!$limit) {
		$limit = 3;
	}
	
	$query = "select topic_url as url, count(*) as c, " .
             "(select count(username) from dev.room_users where topic_url = url) " .
	         "as uniqs  from dev.chat group by topic_url order by 2 desc ";
	
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
$num_pagelinks = 8;
$offset = 0;
$limit = $num_pagelinks;
$db = new DB();

$previous = $offset;
$next = $offset + $limit;
if ($next>=$limit)
    $next = $offset;
    
$total_url = getCountTopicUrl($db);

if ( $_SERVER['REQUEST_METHOD'] == 'GET'  &&
     isset($_REQUEST['offset']) && isset($_REQUEST['limit']) ) {
    
    $offset = $_REQUEST['offset'];
    $limit = $_REQUEST['limit'];
    if ( $offset < 0 ) {
    	$offset = 0;
    }
    
    $topicUrlInfo_result = getTopicUrlInfo($db, $offset, $limit);
    
    $look_ahead = getTopicUrlInfo($db, $offset+$limit, $limit);
    $i = 0;
    while($row = mysql_fetch_assoc($look_ahead)) {
    	$i++;
    }
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
    $topicUrlInfo_result = getTopicUrlInfo($db, $offset, $limit);
}

?>

