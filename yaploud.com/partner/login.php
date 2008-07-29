<html>
<head>
	<title>Yaploud Partner Login</title>
</head>
<body>

<h2>YapLoud partner login page</h2>

<h3></h3>

<form action="/partner/users.php" method="post" onSubmit="return true;">
          
    <table style="text-align: left;">
     <tr>
      <td>
        Username:</td>
        
        <td>
			<input type="text" id="user" name="user" />
		</td>
		</tr>
	<tr>
      <td>
        Password:
      </td>
		<td>
        <input type="password" id="password" name="password" />
      </td>
    </tr>
	<tr>
      <td>
        <input  id="submit" style="width:100px;" type="submit" 
               value="Login" />
      </td>
    </tr>
	    
</table>
	</form>
</body>
</html>