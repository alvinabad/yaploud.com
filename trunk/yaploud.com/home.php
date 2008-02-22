<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.yaploud.com/TR/html4/loose.dtd">

<html>

<?php
require("./user_session_init_c.inc");
require('fetchURL.inc');
?>


<head>
<link rel="stylesheet" type="text/css" href=css/chat.css />
<link rel="stylesheet" type="text/css" href="css/tap_style.css">
<style>
label {
	font: 18px Helvetica, Arial, sans-serif;
	text-align: right;
	display: block;
	width: 50px;
}

input {
	font: 18px Helvetica, Arial, sans-serif;
	color: orange;
}
</style>
</head>
<body>
<?php include("common/header2.php");  ?>


<div style="clear: both;"></div>

<p />


<div style="width: 550px; float: left;">
<table width="777" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<th width="100%" align="left" valign="top" scope="col">
		<table width="99%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td>
				<form method=get action="/chat_iframe.php"><span
					style="font: 20px Helvetica, Arial, sans-serif; color: #336600; font-weight: bold;">Enter
				URL to Yap:</span> <input name="url" id="yapurl_box" type="text"
				    value="http://" size="35"></input> <input
					type="submit" value="Go" /></form>
				</td>
				<td>&nbsp;</td>
			</tr>
		</table>
		</th>
	
	
	<tr>

</table>
<p />
<p />


<div id=popular_chat>

<table width="97%" >
	<tr align="left" valign="middle" height="23px" class="grry_line">
		<td><span class="arial_16">Yappers</span></td>
		<td align="center"><span class="arial_16">Popular Yaps</span></td>
		<td>&nbsp;</td>
	</tr>

	<?
	$query = "select topic_url as url, count(*) as c, (select count(username) from dev.room_users where topic_url = url) as uniqs  from dev.chat group by topic_url order by 2 desc limit 15";
	$db = new DB();
	$result = $db->mysql_query($query);
	if($result){
		while($row = mysql_fetch_assoc($result)){
			$title = '';
			
            print '<tr height="30px" class="grry_line2">' .
                  '  <td width="20px"><span class="users">';
                  
			print $row['uniqs'];
			
            print '</span></td>' .
                  '  <td align="left"><span class="mail_text">';
                  
			print '<a href="chat_iframe.php?url=http://' . $row['url'] .
              '">';

			$url = 'http://' . $row['url'];
			$title = getUrlTitle($url);
			if (!$title) {
				$title = $url;
			}
			
			print $title;
			print '</a>';

			print '</td>' .
                  '  <td><div align="center"><span class="view_details_text style3">';
			print $row['c'];
			print '</span></div></td>' .
                  ' </tr>';
		}
		mysql_free_result($result);
	}
	?>

</table>
</div>
</div>

<p />
<p />

<div style="width: 200px; padding: 10px 10px 5px 10px;">
<table>
	<tr>
		<td>
		<div align="center"><img src="images/plugin_firefox.gif" width="167"
			height="30"></div>
		</td>
	</tr>
	<tr>
		<td>
		<div align="center"><img src="images/plugin_ie.gif" width="167"
			height="30"></div>
		</td>
	</tr>
	<tr>
		<td>
		<div align="center"><img src="images/add.gif" width="182" height="143"></div>
		</td>
	</tr>
</table>
</div>

<div style="clear: both;"></div>
<p />


<div align="left" class="main_text">Free. No spyware or adware.</div>

	<?PHP include("common/footer.php"); ?>

</body>
</html>



	<?php ob_end_flush(); ?>
