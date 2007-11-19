<?php

/*
 * Captcha Module
 * 
 * Created on Nov 18, 2007
 * 
 * Author: alvinabad@alumni.cmu.edu
 */

session_start();

// Generate random string
$md5 = md5(microtime() * mktime());
$captcha_string = substr($md5, 0, 5);

$captcha_image = imagecreatefrompng("./captcha.png");

// set colors to image
$black = imagecolorallocate($captcha_image, 0, 0, 0);
$line = imagecolorallocate($captcha_image, 233, 239, 239);

// add lines to image
imageline($captcha_image, 0, 0, 39, 29, $line);
imageline($captcha_image, 40, 0, 64, 29, $line);

// write the captcha string to the image
imagestring($captcha_image, 5, 20, 10, $captcha_string, $black);

// encrypt the captcha string and store in SESSION
$_SESSION['captcha'] = md5($captcha_string);

// set header
header("Content-type: image/png");
imagepng($captcha_image);

// Prevent image from getting cached
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Pragma: no-cache");

?>


