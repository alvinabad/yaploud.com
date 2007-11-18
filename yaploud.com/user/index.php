<?php

// index page to prevent listing of directories
// redirect to home
$redirect = 'http://' . $_SERVER['HTTP_HOST'] . '/home.php';
header("Location: $redirect");

?>
