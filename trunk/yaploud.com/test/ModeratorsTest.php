<?php

set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);
require_once('moderators/Moderators.inc');
require_once('lib/simpletest/autorun.php');

class ModeratorsTest extends UnitTestCase {
	private $username;
	private $domainname;
	private $md;
	
    function ModeratorsTest() {
        $this->UnitTestCase('ModeratorsTest');
    }
    
    function setUp() {
        $this->md = new Moderators();
    	$this->username = 'testuser';
    	$this->domainname= 'www.yaploud.com';
    	$this->md->add($this->username, $this->domainname);
    	//print "setUp()\n<br>";
    }
    
    function tearDown() {
    	$this->md->remove($this->username, $this->domainname);
    	//print "tearDown()\n<br>";
    }
    
    function testAdd() {
    	$result = $this->md->add('testuser1', 'www.testdomain1.com');
    	$this->assertTrue($result);
    	$result = $this->md->remove('testuser1', 'www.testdomain1.com');
    }
    
    function testRemove() {
    	$result = $this->md->add('testuser1', 'www.testdomain1.com');
    	$result = $this->md->remove('testuser1', 'www.testdomain1.com');
    	$result = $this->md->isModerator('testuser1', 'www.testdomain1.com');
    	$this->assertFalse($result);
    }
    
    function testIsModerator() {
    	$result = $this->md->isModerator($this->username, $this->domainname);
    	$this->assertTrue($result);
    }
    
    function testGetModerator() {
    	$res_obj = $this->md->getModerator($this->username, $this->domainname);
    	$username = $res_obj->username;
    	$domainname = $res_obj->domainname;
    	
    	$this->assertEqual($username, $this->username);
    	$this->assertEqual($domainname, $this->domainname);
    }

    function testGetModerators() {
    	$result = $this->md->getModerators($this->domainname);
        
        while($row = mysql_fetch_assoc($result)){
            $this->assertEqual($row['username'], $this->username);
        }
    }
    
    function testGetDomains() {
    	$result = $this->md->getDomains($this->username);
        while($row = mysql_fetch_assoc($result)){
            $this->assertEqual($row['domainname'], $this->domainname);
        }
    }
    
    function testGetDomainname() {
    	$url = "https://www.yahoo.com/search/search.cgi?s=hello";
    	$domainname = $this->md->getDomainname($url);
    	$this->assertEqual($domainname, 'www.yahoo.com');
    	
    	$url = "http://www.yahoo.com/search/search.cgi?s=hello";
    	$domainname = $this->md->getDomainname($url);
    	$this->assertEqual($domainname, 'www.yahoo.com');
    	
    	$url = "www.yahoo.com/search/search.cgi?s=hello";
    	$domainname = $this->md->getDomainname($url);
    	$this->assertEqual($domainname, 'www.yahoo.com');
    	
    }
}


?>