<?php
/*
 * Created on Nov 17, 2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 

class Token {
	var $key = "e60ef0b1fa9d438ee0efe37e4c9913d1";
	//TODO: Move this to a safer place and not hardcoded in the source
	
    function Token() {
    	//$this->init();
    }
    
    function init() {
    	return;
    }
  
    function encrypt($text){
    	if(!$text) {
            return false;
        }
   
        $key = $this->key;
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        
        $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $text, MCRYPT_MODE_ECB, $iv);
        return trim(base64_encode($crypttext));
    }

    function decrypt($cypher){
        if(!$cypher) {
        	return false;
        }
        
        $key = $this->key;
        $crypttext = base64_decode($cypher);
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        
        $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $crypttext, MCRYPT_MODE_ECB, $iv);
        return trim($decrypttext);
    }
 
    function create($username) {
	    $today = date("U"); 
	    $token = $username . "::" . $today;
	    $token = $this->encrypt($token);
	    return $token;
    }
    
    function validate($token, $diff = 86400) {
	    $today = date("U"); 
	    $token = $this->decrypt($token);
	    list($username, $token_date) = split("::", $token);
	    
	    $time_diff = $today - $token_date;
	    
	    // validate token if time difference is less than $diff (default is 24 hours or 86400 secs)
	    if ( $time_diff > 0 && $time_diff < $diff ) {
	    	return $username;  // return the username in the token
	    }
	    
	    return false;
    } 
 
}

//--- Unit test
$token = new Token();
$text = "yaploud";
$cypher = $token->encrypt($text);
$text2 = $token->decrypt($cypher);

print "Cypher: $cypher <br>";
if ( $text == $text2) print "Testing...Ok <br>";
else print "Failed <br>";


$t = $token->create($text);
sleep(2);
$v = $token->validate($t);
print "Token: $t <br>";
if ($v) print "Testing...Ok <br>";
else print "Failed <br>";

?>
