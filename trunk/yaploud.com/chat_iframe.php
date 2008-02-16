<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.yaploud.com/TR/html4/loose.dtd">

<html>

	<?php
	   require("./user_session_init_c.inc");
	?>


	<head>
		<link rel="stylesheet" type="text/css" href=css/chat.css />
		<link rel="stylesheet" type="text/css" href="css/tap_style.css" >
		<style>
			label{
			   font: 18px Helvetica, Arial, sans-serif;
			   text-align:right;
			   display:block;
			   width:50px;
			}
			input{
			   font: 18px Helvetica, Arial, sans-serif;
			   color:orange;
			}
		</style>
	</head>
	<body>
		<?php include("common/header2.php");  ?>
		
		
		<hr align="left" width="600px">
		<p/>
		<div style="width:550px;float:left;">
			<table width="777"  border="0" cellspacing="0" cellpadding="0">
				<tr>
					<th width="100%" align="left" valign="top" scope="col">
						<table width="99%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td>
									<form method=get action="/chat.php" onsubmit="strip_http(); ">
										<span style="font: 20px Helvetica, Arial, sans-serif;color:#336600;font-weight:bold;">Enter URL to Yap:</span>
										<input name="url" id="yapurl_box" type="text" class="Text2_b" value="http://" size="40"></input>
										<input type="submit" value="Go" class="Text2_b"/>
									</form>
								</td>
								<td>&nbsp;</td>
							</tr>
						</table>
					</th>
				<tr>
			</table>
			<p/><p/>
		</div>
		<p/><p/>
		<hr align="left" style="clear:both" width="100%">
        <div style="clear:both;" >
            <iframe id="yaploudFrame" src="http://www.yaploud.com/chat_frames.php?url=http://www.cnn.com" frameborder="0" scrolling="no" allowtransparency="true" style="position:absolute;width:100%;height:100%;background:transparent;" />
        </div>
		<!--
		<div style="width:200px;padding: 10px 10px 5px 10px;">
			<table>
				<tr>
					<td><div align="center"><img src="images/plugin_firefox.gif" width="167" height="30"></div></td>
				</tr>
				<tr>
					<td><div align="center"><img src="images/plugin_ie.gif" width="167" height="30"></div></td>
				</tr>
				<tr>
					<td><div align="center"><img src="images/add.gif" width="182" height="143"></div></td>
				</tr>
			</table>
		</div>
        -->

		<div style="clear:both;"></div>
		<p/>
		<div align="left" class="main_text">Free. No spyware or adware.</div>

		<?PHP include("common/footer.php"); ?>

	</body>
</html>

<?php ob_end_flush(); ?>
