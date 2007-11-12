<?php
   ob_start("gz_handler");
   session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<link rel="icon" href="favicon.ico">
<link rel="stylesheet" type="text/css" href=css/chat.css />
<title>Yaploud Widget Generator</title>
<script type=text/javascript>
   function make_widget(){
   	document.getElementById('ta').value = '';
   	var url = document.getElementById('url').value;
	var w = '<script>var yapurl=\"' + url + "\";<\/script>";
   	w += "<script src=http:\/\/www.yaploud.com/widget.js><\/script><script>";

	w += '<\/script>';
	w += "<style>.row{ color:#gray; padding:3px 3px 3px 3px; margin:4px 4px 4px 4px; font-size:12px; border-top: 2px solid gray; } .on_row{ background-color:#E3E4FA; } .off_row{ background-color:white; } #msgs{font: 18px Helvetica, Arial, sans-serif;} <\/style> <div style=\"margin-top:1px;padding-top:1px;overflow:auto;border:1px solid gray;height:300px;width:400px;background:white;\" id=_yaploudmsgs><\/div>";
	document.getElementById('ta').value = w;
   }
</script>
</head>
<body>
<?php
   include 'common/header.php';
?>
<form>
<h3>Enter url of site to watch chat about:</h3>
<input type=text length=30 id=url></input>
<br/>
<input onclick="make_widget();return false;" type=submit value="Get Widget"></input>
</form>
<h3>Paste this code into your webpage:</h3>
<textarea rows=20 cols=80 id=ta>
</textarea>
</body>
</html>

<?php
   ob_end_flush();
?>
