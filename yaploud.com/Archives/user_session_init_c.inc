<?php

/*
 * This is the controller (MVC pattern) for the login_page.php view
 * There shouldn't be HTML in here. Please put them in the view page.
 * 
 * Created on Feb 9, 2008
 * Author: alvinabad@alumni.cmu.edu
 */

//--- Initialize include path and session
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);
session_start();
ob_start();

require ("user.php");

?>

