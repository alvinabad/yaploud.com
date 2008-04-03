<?php

function getUrlTitle($url) {
    $html = '';
    $title = false;
    
    $c = curl_init($url);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($c, CURLOPT_TIMEOUT, 2);
    curl_setopt($c, CURLOPT_FOLLOWLOCATION, 1);
    $html = curl_exec($c);
    curl_close($c);
    
    preg_match('#<title>(.+?)</title>#is', $html, $matches);
    
    $title = $matches[1];
    if ( $title == '' ) {
        return false;
    }
    
    return $title;
}


?>