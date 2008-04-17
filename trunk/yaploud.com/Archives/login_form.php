<?PHP


// This file will check to see if the user is logged in, and if not, will display a login form


//$user = new User();

if (isset($_POST['login'])) {

	// Login form was submitted
	if (!isset($_SESSION['logged']) || $_SESSION['logged'] == false) {
	  $result = $user->_checkLogin($_POST['username'], $_POST['password'], $_POST['remember']);
	
	  if ($result != true) {
	
		echo("Login failed.  Please check your credentials and try again.");
		
	  } else {

		header("Location: http://www.yaploud.com/login_page.php");
	  }
	}

} 


if (!isset($_SESSION['logged']) || $_SESSION['logged'] == false) {
	
	// Display the login form
	
	echo "<div id=\"loginFormDiv\"><span style=\"font-weight:bold;\">Please log in:</span><br/><br/>
	
	<form id=\"loginForm\" method=\"POST\" action=\"login_page.php\">
		username: <input type=\"text\" name=\"username\"/><br/>
		password: <input type=\"password\" name=\"password\"/><br/>
		<input type=\"checkbox\" name=\"remember\">Remember me</input><br/>
		<input type=\"submit\" name=\"login\" value=\"Submit\"/>
    </form></div>"; 
		
	

}










?>
