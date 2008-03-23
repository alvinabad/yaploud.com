<?php

function getUrlTitle($url) {
    $html = '';
    $title = false;
    
    /**
    $fh = fopen($url, 'r');
    if ( $fh ) {
        while( !feof($fh) ) {
            $html .= fread($fh, 1048576);
        }
    }
    fclose($fh);
    **/
    
    $c = curl_init($url);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($c, CURLOPT_TIMEOUT, 2);
    curl_setopt($c, CURLOPT_FOLLOWLOCATION, 1);
    $html = curl_exec($c);
    curl_close($c);
    
    print $html;
    
    preg_match('#<title>(.+?)</title>#is', $html, $matches);
    
    $title = $matches[1];
    if ( $title == '' ) {
        return false;
    }
    
    return $title;
}

function getUrlTitle2($url) {
    $html = '';
    $title = false;
    
    $fh = fopen($url, 'r');
    if ( $fh ) {
        while( !feof($fh) ) {
            $html .= fread($fh, 1048576);
        }
    }
    fclose($fh);
    
    preg_match('#<title>(.+?)</title>#is', $html, $matches);
    
    $title = $matches[1];
    print $title;
    
    if ( $title == '' ) {
        return false;
    }
    
    return $title;
}

?>

<html>
<head>
<title>Test Fetch URL</title>
</head>
<body>
<h1>Hello, Test</h1>
<?php
print "<hr>";
$url = 'http://cmu.facebook.com/profile.php?id=4813337';
$url = 'http://west.jot.com/WikiHome/Meetings';
$title = getUrlTitle($url);

print "<br>";
print $url;
print "<br>";
print $title;


?>
</body>
</html>