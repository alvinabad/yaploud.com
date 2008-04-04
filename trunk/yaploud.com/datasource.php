
<?php

if ($_SERVER['HTTP_HOST'] == "www.yaploud.com") {
    // Dev
    $ds['host'] = "west.yaploud.com";
    $ds['user'] = "dev";
    $ds['password'] = "cmuwest";
}
else {
    // local sandbox
    $ds['host'] = "localhost";
    $ds['user'] = "yaploud";
    $ds['password'] = "yaploud";
}

?>