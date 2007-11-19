<?php

/*
 * Captcha Module
 * 
 * Created on Nov 18, 2007
 * Author: alvinabad@alumni.cmu.edu
 */

session_start();

// Generate random string
$md5 = md5(microtime() * mktime());
$captcha_string = substr($md5, 0, 4);

$captcha_image = imagecreatefrompng("./captcha.png");

// set colors to image
$black = imagecolorallocate($captcha_image, 255, 255, 0);
$line = imagecolorallocate($captcha_image, 200, 200, 200);

// add lines to image
imageline($captcha_image, 0, 20, 30, 0, $line);
imageline($captcha_image, 0, 30, 50, 0, $line);
imageline($captcha_image, 20, 30, 70, 0, $line);
imageline($captcha_image, 40, 30, 70, 10, $line);

// write the captcha string to the image
imagestring($captcha_image, 5, 20, 10, $captcha_string, $black);

// encrypt the captcha string and store in SESSION
$_SESSION['captcha'] = md5($captcha_string);

// set header
header("Content-type: image/png");
imagepng($captcha_image);

// Prevent image from getting cached
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

?>


