<?php
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <title>Welcome to YapLoud - FAQ</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link type="text/css" rel="stylesheet" href="/css/style.css" />
        <script type="text/javascript" src="/css/niftycube.js" ></script>
        <script type="text/javascript">
            window.onload=function() {
                Nifty("div.yap_url, div#tagCloud","big, transparent");
            }
        </script>
    </head>

    <body>
        <div id="container">
			<?php
    			// Logo - Header
				include("common/header1.php");
			?>
            
			<?php
    			// Right Navigation Panel
				include("rightNav.php");
			?>
            
            <div id="content">
                <div class="section_heading"><h1>General Questions</h1></div>
                <ul>
                    <li><a href="#faqA1">Is it really free?</a></li>
                    <li><a href="#faqA2">How do I start / participate in the Yap?</a></li>
                    <li><a href="#faqA3">Can I really Yap about any link (URL) on the web?</a></li>
                    <li><a href="#faqA4">Can I Yap without downloading the client plugin?</a></li>
                    <li><a href="#faqA5">How do I install the plugin on Firefox browser?</a></li>
                    <li><a href="#faqA6">What about a plugin for other browsers (IE, Safari etc)?</a></li>
                    <li><a href="#faqA7">How do I contact you?</a></li>
                    <li><a href="#faqA9">Forgot Password?</a></li>
                </ul>
                <div class="section_heading"><h1>Web Users</h1></div>
                <ul>
                    <li><a href="#faqB1">What does YapLoud offer me?</a></li>
                    <li><a href="#faqB2">Do I need to download or install anything?</a></li>
                    <li><a href="#faqB3">What browsers do you support?</a></li>
                    <li><a href="#faqB4">Can I have emoticoms or use HTML within the chat window?</a></li>
                    <li><a href="#faqB5">Are my surfing habits tracked?</a></li>
                </ul>
                <div class="section_heading"><h1>Website Owners</h1></div>
                <ul>
                    <li><a href="#faqC1">What does YapLoud offer me?</a></li>
                    <li><a href="#faqC2">What are Yaplets?</a></li>
                    <li><a href="#faqC3">How can I embed Yaplets on my website?</a></li>
                    <li><a href="#faqC4">Can I embed Yaplet for any URL?</a></li>
                    <li><a href="#faqC5">Can I have more than one Yaplet on the same page?</a></li>
                    <li><a href="#faqC6">Where can I generate Yaplet from?</a></li>
                </ul>
                
				<div class="section_heading"><h1>General Questions</h1></div>
                <ul>
				<li><strong id="faqA1">Is it really free?</strong></li>
				<p>
					Yes. There is no charge what so ever to use the application.
				</p>
				<li><strong id="faqA2">How do I start / participate in the Yap?</strong></li>
				<p>
                    Well, there are several ways of doing this.
                    <ol>
                    <li>Go to homepage, search for a YapURL. Select one and join the Yapper community. </li>
                    <li>Add YapLoud's Bookmarklet to your browser. Now, whenever you visit any website, you can click on the Bookmarlet and immediately get connected with the community. </li>
                    <li>Install Firefox Plugin. Now, whenever you visit any website, you will immediately know if there are other Yappers. Click on the plugin to immediately get connected with the community.</li>
                    </ol>
                    Once you are connected to the community, you will be able to Yap in real-time. You can also review previosuly posted comments.
				</p>
				<li><strong id="faqA3">Can I really Yap about any link (URL) on the web?</strong></li>
				<p>
					Yes. We have tested the application across several domains and there are no restrictions on any URL for the Yapper community.
				</p>
				<li><strong id="faqA4">Can I Yap without downloading the client plugin?</strong></li>
				<p>
					Yes you can. 
                    <ol>
                    <li>You can go the home page, search for the YapURL of your interest. Select the link to immediately get connected with the Yapper Community or view the past Yaps. </li>
                    <li>Add YapLoud's Bookmarklet to your browser. Now, whenever you visit any website, you can click on the Bookmarlet and immediately get connected with the community. </li>
                    </ol>
				</p>
				<li><strong id="faqA5">How do I install the plugin on Firefox browser?</strong></li>
				<p>
					You can download the plugin by clicking <a href="/extension/yaploud.xpi">here</a>.
				</p>
				<li><strong id="faqA6">What about a plugin for other browsers (IE, Safari etc)?</strong></li>
				<p>
					We are currently working on those plugins and will release them soon. For now, you can use YapLoud Bookmarklet and get all the functionality of our plugin.
				</p>
				<li><strong id="faqA7">How do I contact you?</strong></li>
				<p>
					We love to hear from you. Please leave your comments at <a href="/help/feedback.php">Feedback</a>
				</p>
				<li><strong id="faqA9">Forgot password?</strong></li>
				<p>
					<a href="/user/forgotpassword.php"> Go here </a> to retrieve your password
				</p>
                </ul>
                
				<div class="section_heading"><h1>Web Users</h1></div>
                <ul>
				<li><strong id="faqB1">So what does YapLoud offer me?</strong></li>
				<p>
					Today, users go to web URL but are unable to interact with its content. YapLoud allows users who are visiting the same web URL to get connected with each other, in real-time, so that they can exchange ideas/thoughts and interact with them.
				</p>
				<li><strong id="faqB2">Do I need to download or install anything?</strong></li>
				<p>
					Please refer <a href="#faqA2">here</a>
				</p>
				<li><strong id="faqB3">What browsers do you support?</strong></li>
				<p>
					All browsers are supported. We have tested the application across several browsers running on various operating systems.
				</p>
				<li><strong id="faqB4">Can I have emoticoms or use HTML within the chat window?</strong></li>
				<p>
					We currently have not added support for rich-text inside our Yaplet. We would be adding this feature soon.
				</p>
				<li><strong id="faqB5">Are my surfing habits tracked?</strong></li>
				<p>
					No. We do not track any surfing habits of the users.
				</p>
                </ul>
                    
				<div class="section_heading"><h1>Website Owners</h1></div>
                <ul>
				<li><strong id="faqC1">What does YapLoud offer me?</strong></li>
				<p>
					<ol>
                        <li>Provides a direct communication link between you and your website users</li>
                        <li>Online, live and real-time feedback from your loyal users</li>
                        <li>Live support for your loyal user base</li>
                        <li>Increase your customer satisfaction and long-term loyalty</li>
                    </ol>
				</p>
                </ul>
                <ul>
				<li><strong id="faqC2">What are Yaplets?</strong></li>
				<p>
					Yaplets are small, embedable HTML widgets which allow all 
					users visiting that URL to Yap with each other. 
					You can generate Yaplet for any URL. The HTML snippet can then be embedded 
					into any website for its users to start interacting with each other.
				</p>
                </ul>
                <ul>
				<li><strong id="faqC3">How can I embed Yaplets on my website?</strong></li>
				<p>
                    Once you generate Yaplet, for any URL, the small HTML snippet can be embedded into your website pages.
				</p>
                </ul>
                <ul>
				<li><strong id="faqC4">Can I embed Yaplet for any URL?</strong></li>
				<p>
					Yes you can. There is no restriction on the URL or the number of Yaplets you can embed.
				</p>
                </ul>
                <ul>
				<li><strong id="faqC5">Can I have more than one Yaplet on the same page?</strong></li>
				<p>
					Yes you can. There is no restriction on the URL or the number of Yaplets you can embed.
				</p>
                </ul>
                <ul>
				<li><strong id="faqC6">Where can I generate Yaplet from?</strong></li>
				<p>
                    Coming Soon!
				</p>
                </ul>
            
            </div>
            
            <?php
                // Footer page
                include("common/footer1.php"); 
            ?>
        </div>
    </body>
</html>

