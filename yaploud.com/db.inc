<?php

function clean(&$str, $maxlength, &$connection){
	$input = substr($str, 0, $maxlength);
	$input = mysql_real_escape_string($input, $connection);
	return ($input);
}


class DB{
	var $connection;

	function connect($host, $user, $password){
		$link = mysql_pconnect($host, $user, $password); // or die ('cannot connect : ' . mysql_error()) ;
		return $link;
	}

	function DB($host = "localhost", $user = "yaploud", $password = "yaploud"){
	//function DB($host = "west.yaploud.com", $user = "dev", $password = "cmuwest"){
		$this->connection = $this->connect($host, $user, $password);
	}

	function unlock(){
		mysql_query("UNLOCK TABLES", $this->connection);
	}

	function &getConnection(){
		return $this->connection;
	}

	function showerror(){
		print "Error " . mysql_errno() . " : " . mysql_error() . "<br/>";

	}

	function mysql_query($query){
		$result = @mysql_query($query, $this->connection);
		if(!$result){
    		$error_msg = "Error " . mysql_errno() . ": " . mysql_error();
			error_log($error_msg . ', SQL: ' . $query); 
			// this will log error message to apache's error_log and not to the user!
		}
		return $result;
	}
}

?>

