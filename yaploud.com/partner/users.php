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
require_once 'chat/ChatMessages.inc';

$cm = new ChatMessages();
$numGuestUsers = $cm->getPartnerNumGuestUsers($user);
$numYaps = $cm->getPartnerNumMessages($user);
$yapsLastHour = $cm->getMessagesStatistics("Interval 60 minute");
$yapsLast24Hour = $cm->getMessagesStatistics("Interval 1 day");
$yapsLastMonth = $cm->getMessagesStatistics("Interval 1 Month");
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
?>
</table>
<?php
print "Total users = $total_users". "<br>";
print "Total guest users = $numGuestUsers" . "<br/>";
print "Total number of yaps = $numYaps" . "<br/> <br/>";
	
print "Other Statistics...." . "<br/>";
print "Yaps in last 60 minutes = $yapsLastHour" . "<br>";
print "Yaps in last 24 hours = $yapsLast24Hour" . "<br>";
print "Yaps in last 30 days = $yapsLastMonth" . "<br>";
?>
<h3>Next table shows number of yaps during each hour for past week.</h3>
<table border="1" >
	<tr> <th> Day of week </th>
<?php
function getDayOfWeek($number) {
	
	if ($number == 1)
		return Sunday;
	
	if ($number == 2)
		return Monday;
	
	if ($number == 3)
		return Tuesday;
	
	if ($number == 4)
		return Wednesday;
	
	if ($number == 5)
		return Thursday;
	
	if ($number == 6)
		return Friday;
	
	if ($number == 7)
		return Saturday;
	}
	
function initArray() {
	$newArray = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
	return $newArray;
}
	
function populateDaysArray($currentDay) {
	$newArray= array(8);
	for ($j=0 ; $j < 8; $j++ ) {
		$newArray[$j] =$currentDay;
	 	if ($currentDay == 7)
			$currentDay = 0;
		$currentDay++;
	
	}
	return $newArray;
}
	
$firstArray = initArray();
$secondArray = initArray();
$thirdArray = initArray();
$fourthArray = initArray();
$fifthArray = initArray();
$sixthArray = initArray();
$seventhArray = initArray();
$todayArray = initArray();
	
function printRow($day, $arrayInput) {
	$dayofweek = getDayOfWeek($day);
	print "<tr>";
	print "<td>" . "$dayofweek" . "</td>";
	for ($i = 0; $i <24; $i++) {
		$cellData = $arrayInput[$i];
		if ($cellData != 0) 
			print "<td align=center>" . "$cellData" ."</td>";
		else
			print "<td align=center>"."&nbsp" ."</td>";
	}
	print "</tr>";
	}	

	
	

	for ($inc = 1; $inc < 25 ; $inc++ ) {
		
	    $start = $inc -1;
	    $before = $start . ":00";
		$end = $inc;
		$after = $end . ":00";
		if ($inc  == 1)
			$before = Midnight;
		if ($inc == 24)
			$after = Midnight;
	
	
	print 	"<th class=" . "center".">$before to $after</th>";

		
	}

?>
</tr>
<?php
$cm = new ChatMessages();
$db= new DB();
$sql = "SELECT creation_date, DAYOFWEEK(creation_date) as day,HOUR(creation_date) as hour, count(*) as sum FROM chat where topic_url like '%dogtime%' and creation_date >= date_sub(now(), Interval 1 Week) and creation_date < date(now()) group by day,hour order by creation_date asc;";
$result1 = $db->mysql_query($sql);
	
$currentDay = $cm->getReportStartDay();
$daysArray = populateDaysArray($currentDay);

//$result1 = $cm->getWeeklyStatistics();
	//if ($result1) {
	while($row = mysql_fetch_assoc($result1)) {
			if($row['day']==$daysArray[0])
				$firstArray[$row['hour']] = $row['sum'];
			if($row['day']==$daysArray[1])
				$secondArray[$row['hour']] = $row['sum'];
			if($row['day']==$daysArray[2])
				$thirdArray[$row['hour']] = $row['sum'];
			if($row['day']==$daysArray[3])
				$fourthArray[$row['hour']] = $row['sum'];
			if($row['day']==$daysArray[4])
				$fifthArray[$row['hour']] = $row['sum'];
			if($row['day']==$daysArray[5])
				$sixthArray[$row['hour']] = $row['sum'];
			if($row['day']==$daysArray[6])
				$seventhArray[$row['hour']] = $row['sum'];
			
	}
	//}
printRow($daysArray[0],$firstArray);
printRow($daysArray[1],$secondArray);
printRow($daysArray[2],$thirdArray);
printRow($daysArray[3],$fourthArray);
printRow($daysArray[4],$fifthArray);
printRow($daysArray[5],$sixthArray);
printRow($daysArray[6],$seventhArray);
	
?>	
</table>

</body>
</html>
