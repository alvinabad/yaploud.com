
<?php

// Create your own datasource credentials locally 
$ds_local = ".local_datasource.php";

// use it if it exists
if (file_exists($_SERVER['DOCUMENT_ROOT']  . "/" . $ds_local) ) {
    include($ds_local);
}
else {
	// Set your database credentials here if you want 
	// them shared to all developers
    $ds['host'] = "";
    $ds['user'] = "";
    $ds['password'] = "";
    $ds['database'] = "";
}

?>