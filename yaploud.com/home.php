<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.yaploud.com/TR/html4/loose.dtd">

<html>

<?php
require("./user_session_init_c.inc");
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
				<form method=get action="/chat.php" onsubmit="strip_http(); "><span
					style="font: 20px Helvetica, Arial, sans-serif; color: #336600; font-weight: bold;">Enter
				URL to Yap:</span> <input name="url" id="yapurl_box" type="text"
					class="Text2_b" value="http://" size="40"></input> <input
					type="submit" value="Go" class="Text2_b" /></form>
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

<table>
	<tr align="left" valign="middle" height="23px" class="grry_line">
		<td><span class="arial_16">Popular</span></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>
		<table width="0" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td class="gr_text"></td>
				<td>
				<div align="right" class="view_details_text">
				<div align="center"><a href="#">Today</a> | <a href="#">This Week</a>
				| <a href="#">Ever</a>
				</div>
				</div>
				</td>
			</tr>
		</table>
		</td>
	</tr>

	<?
	$query = "select topic_url as url, count(*) as c, (select count(username) from dev.room_users where topic_url = url) as uniqs  from dev.chat group by topic_url order by 2 desc limit 15";
	$db = new DB();
	$result = $db->mysql_query($query);
	if($result){
		while($row = mysql_fetch_assoc($result)){
			echo<<<HTML
                <tr height="30px" class="grry_line2">
                    <td width="20px"><span class="users">
HTML;
			print $row['uniqs'];
			echo <<<HTML
        </span></td>
                    <td align="right"><span class="mail_text">
HTML;
			print '<a href="chat_frames.php?url=http://' . $row['url'] .
              '">' . 'http://' . $row['url'] . '</a>';

			echo <<<HTML
        <img src="images/icon2.gif" width="10" height="10"> </span><span class="view_details_text">view details</span></td>
                    <td><div align="right"><img src="images/icon1.gif" width="14" height="14"></div></td>
                    <td><div align="center"><span class="view_details_text style3">
HTML;
			print $row['c'];
			echo <<<HTML
        </span></div></td>
                    <td valign="middle"><div align="right"></div></td>
                </tr>
HTML;
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
