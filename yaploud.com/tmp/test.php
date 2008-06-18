<?php



$deny = array("10.2.2.105", "204.16.157.225", "333.333.333");
if (in_array ($_SERVER['REMOTE_ADDR'], $deny)) {
   print $_SERVER['REMOTE_ADDR'];
   print "<H1> YOU ARE NOT ALLOWED HERE </H1>";
   //header("location: http://www.google.com/");
   //exit();
}


set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);
require("util/Url.inc");

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