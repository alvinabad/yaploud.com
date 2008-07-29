<?php

//--- Initialize include path and session
$yaploud_home = dirname($_SERVER['DOCUMENT_ROOT']);
$yaploud_com_home = $yaploud_home . "/yaploud.com";

set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT'] .
                  PATH_SEPARATOR . $yaploud_com_home );

require_once 'db.inc';
	$db= new DB();
	$user = $_POST['user'];
	$password = md5($_POST['password']); 
	
	$sql = "SELECT * FROM user WHERE userid = '$user' AND password = '$password';";
	$result = $db->mysql_query($sql);
	$errMessage = "<html><body><h2> Invalid login try again</h2> <a href =index.php >Login Page</a></body></html>";
		if ($user != "dogtimemedia") {
			print $errMessage;
			return true;
		}
		
        if (mysql_num_rows($result) != 1)  {
			print $errMessage;
			return true;
	    }
	
require_once 'user/User.inc';

$u = new User();
$result = $u->getPartnerUsers();

?>


<html>
<head>
  <title>Welcome to YapLoud Partner Administration</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <link type="text/css" rel="stylesheet" href="/css/style.css" />
</head>

<body>
<h2><a href="/">YapLoud Partner Administration</a></h2>

<h3>Registered Partner Users:</h3>

<table border="1">
<tr>
  <th class="center">Username</th>
  <th class="center">Email</th>
  <th class="center">First Name</th>
  <th class="center">Last Name</th>
  <th class="center">Date Registered</th>
  <th class="center">Partner</th>
</tr>

<?php

$total_users = 0;
while($row = mysql_fetch_assoc($result)) {
   $date_registered = strtotime($row['update_timestamp']);
   $date_registered = strftime("%a %b %d %I:%M %p %Z %G ", $date_registered);
	print <<< HTML
  <tr>
    <td class="username">{$row['username']}</td>
    <td class="email">{$row['email']}</td>
    <td>{$row['first_name']}</td>
    <td>{$row['last_name']}</td>
    <td class="date_registered">{$date_registered}</td>
	<td>{$row['partner']}</td>
  </tr>
HTML;

    $total_users++;
}

print "Total Users = $total_users";

?>

</table>


</body>
</html>
