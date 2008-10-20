<?php
/*
 * Created on Oct 20, 2008
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
require_once 'db.inc';
require_once('moderators/Moderators.inc');
require_once('chat/BannedUsers.inc');
$md = new Moderators();
$bu = new BannedUsers();
	
print $bu->candidateForBan('123');	

	
	
	?>
