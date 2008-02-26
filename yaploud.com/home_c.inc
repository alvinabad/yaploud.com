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
	$description = ' ';
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

function getTopicUrlInfo() {
	$query = "select topic_url as url, count(*) as c, (select count(username) from dev.room_users where topic_url = url) as uniqs  from dev.chat group by topic_url order by 2 desc limit 15";
	$db = new DB();
	$chatUrlInfo_result = $db->mysql_query($query);

	if($chatUrlInfo_result) {
		return $chatUrlInfo_result;
	}
	else {
		return false;
	}
}

$topicUrlInfo_result = getTopicUrlInfo();

?>

