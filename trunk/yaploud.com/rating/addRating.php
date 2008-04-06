<?php

//--- Initialize include path and session
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);
if (!isset($_SESSION['logged'])) session_start();
    
ob_start();
require("user.php");
require("common/nocache.php");
require("util.inc");
require("tags/Tags.inc");
$user = new User();

$username = '';
$tags = '';

// Returns false in json format of login fails
// Returns username of login if successful

if (
    $_SERVER['REQUEST_METHOD'] == 'POST' || 
    $_SERVER['REQUEST_METHOD'] == 'GET' &&
    isset($_SESSION['logged']) && $_SESSION['logged'] && 
    isset($_REQUEST['tags']) &&  isset($_REQUEST['url']) ) {
        
    $tags = $_REQUEST['tags'];
    $url = $_REQUEST['url'];
    $username = $_SESSION['username'];
    
    $js['tags'] = $tags;
    
    $t = new Tags();
    $result = $t->addTags($url, $tags);
    
    if ($result) {
        print json_encode($js);
    }
    else {
        print json_encode(false);
    }
}
else {
    print json_encode(false);
}

?>
