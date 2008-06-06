<?php
/*
 * Created on Jun 6, 2008
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/yahoo/yahoo-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/event/event-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/connection/connection-min.js"></script>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Is Username Available</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<form name="form1" method="get" action="">
<table width="600" border="1">
<tr>
<td width="63">username</td>
<td width="8">:</td>
<td width="306"><input type="text" name="username">
<input type="button" name="Submit2" value="isAvailable?"
onclick="makeRequest(form1.username.value);"></td>
<td>
<div id="result"></div></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input type="submit" name="Submit" value="Submit"></td>
</tr>
</table>
</form>
</body>
</html>

<script> 
	var sUrl = "get.php?username=";  
	
	var div = document.getElementById('result'); 
	 
	var handleSuccess = function(o){ 
		//alert ('Success called');
	    if(o.responseText !== undefined){ 
	     
	        div.innerHTML += "<li>Server response: " + o.responseText + "</li>"; 
	        
	    } 
	} 
	 
	var handleFailure = function(o){ 
	//	alert ('failure called');
	    /*if(o.responseText !== undefined){ 
	        div.innerHTML = "<li>Transaction id: " + o.tId + "</li>"; 
	        div.innerHTML += "<li>HTTP status: " + o.status + "</li>"; 
	        div.innerHTML += "<li>Status code message: " + o.statusText + "</li>"; 
	    } */
	} 
	 
	var callback = 
	{ 
	  success:handleSuccess, 
	  failure: handleFailure, 
	  argument: { foo:"foo", bar:"bar" } 
	}; 
	function makeRequest(userName){
		//alert(userName);
	var request = YAHOO.util.Connect.asyncRequest('GET', sUrl+userName, callback);
	
	//YAHOO.log("Initiating request; tId: " + request.tId + ".", "info", "example");

	}
	
</script>

