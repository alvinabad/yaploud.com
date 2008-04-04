
<?php

// Create your own datasource credentials locally 
$ds_local = ".local_datasource.php";

// use it if it exists
if (file_exists($_SERVER['DOCUMENT_ROOT']  . "/" . $ds_local) ) {
    include($ds_local);
}
else {
	// Set your database credentials here
	// Note: This will be shared by all developers
    $ds['host'] = "";
    $ds['user'] = "";
    $ds['password'] = "";
}

?>