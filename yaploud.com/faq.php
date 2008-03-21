<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html>
    <?php
       //session_start();
       //ob_start();
    ?>
    <head>
        <title>Welcome to YapLoud - FAQ</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link type="text/css" rel="stylesheet" href="css/style.css" />
        <script type="text/javascript" src="css/niftycube.js" ></script>
        <script type="text/javascript">
            window.onload=function() {
                //alert("test");
                Nifty("div.yap_url, div#tagCloud","big, transparent");
                //Nifty("div#tagCloud", "big, transparent");
            }
        </script>
    </head>

    <body>
        <div id="container">
			<?php
    			// Logo - Header
				include("common/header1.php");
			?>
            
            <!--
            <div id="leftnav">
                <p>
                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut.
                </p>
            </div>
            -->
            
			<?php
    			// Right Navigation Panel
				include("rightNav.php");
			?>
            
            <div id="content">
                <div class="section_heading"><h1>General Questions</h1></div>
                <ul>
                    <li><a href="#faq1">Is it really free?</a></li>
                    <li><a href="#faq2">How do I start / participate in the Yap (chat)?</a></li>
                    <li><a href="#faq3">Can I really Yap (chat) about any link (URL) on the web?</a></li>
                    <li><a href="#faq4">Can I Yap (chat) without downloading the client plugin?</a></li>
                    <li><a href="#faq5">How do I install the plugin on Firefox browser?</a></li>
                    <li><a href="#faq6">What about a plugin for other browsers (IE, Safari etc)?</a></li>
                    <li><a href="#faq7">How do I contact you?</a></li>
                    <li><a href="#faq8">How do I find something I want to chat about?</a></li>
                </ul>
                <div class="section_heading"><h1>My Account</h1></div>
                <ul>
                    <li><a href="#faq101">I forgot my Password?</a></li>
                </ul>
                
				<div class="section_heading"><h1>General Questions</h1></div>
				<strong id="faq1">Is it really free?</strong>
				<p>
					Yup
				</p>
				<strong id="faq2">How do I start / participate in the Yap (chat)?</strong>
				<p>
					There are multiple ways to start/participate a Yap (chat). You can use our firefox plugin, or go to Yaploud.com/login_page.php, search for your topic, and start yapping.
				</p>
				<strong id="faq3">Can I really Yap (chat) about any link (URL) on the web?</strong>
				<p>
					Yes, you can Yap (chat) about any URL on the web
				</p>
				<strong id="faq4">Can I Yap (chat) without downloading the client plugin?</strong>
				<p>
					Yes, you can start Yappling about the topic of your interest from yaploud.com/login_page.php.
				</p>
				<strong id="faq5">How do I install the plugin on Firefox browser?</strong>
				<p>
					Download the plugin from <a href="#">HERE</a> to any location on your computer. Open firefox browser, Go to File -- > Open File. Select the file "NAME" and Install the plugin. Restart Firefox browser and start Yapping.
				</p>
				<strong id="faq6">What about a plugin for other browsers (IE, Safari etc)?</strong>
				<p>
					We are currently working on those plugins and will release them soon
				</p>
				<strong id="faq7">How do I contact you?</strong>
				<p>
					We will love to hear from you. Please leave your comments at <a href="help.php">Feedback</a>
				</p>
				<strong id="faq8">How do I find something I want to chat about?</strong>
				<p>
					Yup
				</p>
                
				<div class="section_heading"><h1>My Account</h1></div>
				<strong id="faq1">I forgot my password?</strong>
				<p>
					<a href="forgotpass.php"> Go here </a> to retreive your password
				</p>
            </div>
            
            <?php
                // Footer page
                include("common/footer1.php"); 
            ?>
        </div>
    </body>
</html>

