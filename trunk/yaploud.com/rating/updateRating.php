<?php

//--- Initialize include path and session
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);
if (!isset($_SESSION['logged'])) session_start();
    
ob_start();
require("common/nocache.php");
require("util.inc");
require("rating/Rating.inc");

if (
    $_SERVER['REQUEST_METHOD'] == 'POST' || 
    $_SERVER['REQUEST_METHOD'] == 'GET' &&
    isset($_REQUEST['rating']) && isset($_REQUEST['url']) ) {
        
    	
    $url = $_REQUEST['url'];
    $rating = $_REQUEST['rating'];
    
    $t = new Rating();
    
    if (!isset($_SESSION['has_rated']) ) {
    	$_SESSION['has_rated'] = false;
    }
    	
    if (!$_SESSION['has_rated']) {
        $result = $t->updateRating($url, $rating);
        if ($result) {
            $_SESSION['has_rated'] = true;
        }
    }
    else {
        $js['has_rated'] = true;
    }
        
    $rating = $t->getRating($url);
    $votes = $t->getVotes($url);
    
    $js['rating'] = $rating;
    $js['votes'] = $votes;
    
    print json_encode($js);
}
else {
    print json_encode(false);
}

?>
