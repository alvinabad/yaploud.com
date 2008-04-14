<?php

set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);
require("util.inc");

$u = new Url();

$url = "http://www.ew.com/ew/article/0,,20189186,00.html?iid=top25-20080406-Box+office%3A+'Leatherheads'+fumbles";
//$url = 'http://www.ew.com/ew/article/0,,20189186,00.html?iid=top25-20080406-Box+office%3A+"Leatherheads"+fumbles';
//$url = addslashes($url);
//$url = addslashes($url);

$url = $u->encode($url);
$url = $u->encode($url);
$url = $u->decode($url);
$url = $u->encode($url);
$url = $u->decode($url);
$url = $u->encode($url);

print "<hr>";
print $url;
$url = $u->decode($url);

print "<hr>";
print $url;
print "<hr>";
print $u->stripslashes($url);

print "<hr>";

print "2008-03-20 20:13:28";
print "<br>";
print strftime("%a %b %d %I:%M%p %Z %G ", "2008-03-20 20:13:28");

?>