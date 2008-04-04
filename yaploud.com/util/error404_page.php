<?php
//--- Initialize include path and session
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html>
<head>
<title>YapLoud - My Account</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- 
<link href="/css/chat.css" rel="stylesheet" type="text/css">
<link href="/style.css" rel="stylesheet" type="text/css">
<link href="/images/style_Yaploud.css" rel="stylesheet" type="text/css">
 -->
<link type="text/css" rel="stylesheet" href="/css/style.css" />

<?php include("common/yui.php"); ?>

<script type="text/javascript" src="/user/ChangePassword.js" ></script>
<script type="text/javascript" src="/user/UpdateUserInfo.js" ></script>
</head>

<body class="yui-skin-sam">
<div id="container">
<?php include("common/header1.php"); ?>

<?php include("rightNav.php"); ?>

<div id="content">

<h3>
It appears you have reached this page in error.
</h3>
<a href="javascript: history.go(-1); void 0;">Back</a>
| <a href="/home.php">Home</a>
</div>

            
<?php include("common/footer1.php"); ?>

</div>
</body>
</html>
