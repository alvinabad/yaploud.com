<?php
/*
 * Created on Oct 20, 2008
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);
require_once('db.inc');
require_once('moderators/Moderators.inc');
require_once('chat/BannedUsers.inc');
$md = new Moderators();
$bu = new BannedUsers();
	

$value = $bu->candidateForBan('24.4.39.63');
print $value;
	

	
	
	?>
