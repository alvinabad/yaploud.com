<?php


/*
 * Captcha Module
 * 
 * Created on Nov 18, 2007
 * Author: alvinabad@alumni.cmu.edu
 */

session_start();

class Captcha {
	    var $captcha_string;

    function Captcha() {
        // Generate random string
        $md5 = md5(microtime() * mktime());
        $this->captcha_string = substr($md5, 0, 4);
        
        // encrypt the captcha string and store in SESSION
        $_SESSION['captcha'] = md5($this->captcha_string);
    }

    function generateImage() {
        $captcha_string = $this->captcha_string;
        	
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
        imagestring($captcha_image, 20, 15, 10, $captcha_string, $black);

        // set header
        header("Content-type: image/png");
        imagepng($captcha_image);

        // Prevent image from getting cached
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }

}

$c = new Captcha();
$c->generateImage();

?>


