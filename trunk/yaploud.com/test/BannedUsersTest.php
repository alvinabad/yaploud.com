<?php

set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);
require_once('chat/BannedUsers.inc');
require_once('lib/simpletest/autorun.php');

class BannedUsersTest extends UnitTestCase {
	private $ip;
	private $voter;
	private $domainname;
	private $bu;
	
    function BannedUsersTest() {
        $this->UnitTestCase('BannedUsersTest');
    }
    
    function setUp() {
        $this->bu = new BannedUsers();
    	$this->ip = '192.168.0.250';
    	$this->voter = 'guest99999';
    	$this->domainname= 'www.yaploud.com';
    	
    	$this->bu->addIp($this->ip, $this->voter, $this->domainname);
    }
    
    function tearDown() {
    	$this->bu->removeIp($this->ip, $this->domainname);
    }
    
    function testAddIp() {
    	$result = $this->bu->addIp('10.0.0.0', 'guest00000', 'www.testdomain1.com');
    	$this->assertTrue($result);
    	$this->bu->removeIp('10.0.0.0', 'www.testdomain1.com');
    }
    
    function testRemoveIp() {
    	$result = $this->bu->addIp('10.0.0.0', 'guest00000', 'www.testdomain1.com');
    	$this->bu->removeIp('10.0.0.0', 'www.testdomain1.com');
    	$count = $this->bu->getNumIps('10.0.0.0', 'www.testdomain1.com');
        $this->assertEqual($count, 0);
    }
    
    function testGetNumIps() {
    	$count = $this->bu->getNumIps($this->ip, $this->domainname);
        $this->assertEqual($count, 1);
    }
    
    function testIsIpBanned1() {
    	$result = $this->bu->isIpBanned($this->ip, $this->domainname, 1);
    	$this->assertTrue($result);
    }
    
    function testIsIpBanned2() {
    	$voter = 'yapper';
    	$domainname = 'www.yaploud.com';
    	$ip = '10.10.10.10';
    	
    	$this->bu->addIp($ip, $voter, $domainname);
    	
    	$md = new Moderators();
    	$md->add($voter, $domainname);
    	
    	$result = $this->bu->isIpBanned($ip, $domainname, 100);
    	$this->assertTrue($result);
    	
    	$this->bu->removeIp($ip, $domainname);
    	$md->remove($voter, $domainname);
    }
    
    function testGetIp() {
    	$results = $this->bu->getIp($this->ip, $this->domainname);
        while($row = mysql_fetch_assoc($results)){
            $this->assertEqual($row['domainname'], $this->domainname);
            $this->assertEqual($row['ip'], $this->ip);
        }
    }
}
?>