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
    $new_rating = $_REQUEST['rating'];
    
    $t = new Rating();
    
    $has_rated_url = "has_rated_" . normalize_url($url);
    
    if ( !isset($_SESSION[$has_rated_url]) ) {
        $js[$has_rated_url] = false;
        $result = $t->updateRating($url, $new_rating);
        if ($result) {
            $_SESSION[$has_rated_url] = true;
        }
    }
    else {
        $js[$has_rated_url] = true;
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
