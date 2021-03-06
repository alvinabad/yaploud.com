<?php
/*
 * This is the controller (MVC pattern) for the find.php view
 * There shouldn't be HTML in here. Please put them in the view page.
 *
 * Created on April 13, 2008
 * Author: alvinabad@alumni.cmu.edu
 */

//--- Initialize include path and session
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);
session_start();
ob_start();

require ("user.php");
require("chat/ChatRoom.inc");
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



// default values
$msg_selected = "";
$url_selected = "";
$searchby = "";

$num_pagelinks = 10;
$offset = 0;
$limit = $num_pagelinks;
$db = new DB();

$previous = $offset;
$next = $offset + $limit;
$cu = new ChatUrl();

$query_str = "";

if ( $_SERVER['REQUEST_METHOD'] == 'GET'  && isset($_REQUEST['query'])) {
    if (isset($_REQUEST['offset'])) {
        $offset = $_REQUEST['offset'];
    }
    else {
    	$offset = 0;
    }
    	
    if (isset($_REQUEST['limit'])) {
    	$limit = $_REQUEST['limit'];
    }
    
    if ( $offset < 0 ) {
    	$offset = 0;
    }
    
    $query_str = $_REQUEST['query'];
    $query_str = trim($query_str);
    
    if (isset($_REQUEST['searchby'])) {
        $searchby = $_REQUEST['searchby'];
        $searchby = trim($searchby);
    }
    
    if ($searchby == "url") {
        $total_url = $cu->getCountFindUrl($query_str);
        $search_result = $cu->findUrl($query_str, $offset, $limit);
        $look_ahead = $cu->findUrl($query_str, $offset+$limit, $limit);
    	$url_selected = "SELECTED";
    }
    else if ($searchby == "tag") {
        $total_url = $cu->getCountFindUrlByTag($query_str);
        $search_result = $cu->findUrlByTag($query_str, $offset, $limit);
        $look_ahead = $cu->findUrlByTag($query_str, $offset+$limit, $limit);
    	$url_selected = "SELECTED";
    }
    else {
        $total_url = $cu->getCountFindMsg($query_str);
        $search_result = $cu->findMsg($query_str, $offset, $limit);
        $look_ahead = $cu->findMsg($query_str, $offset+$limit, $limit);
        $msg_selected = "SELECTED";
    }
    
    if ($next>$total_url) {
        $next = $offset;
    }
    
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

?>

