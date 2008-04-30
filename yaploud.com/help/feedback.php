<?php
    set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);
    session_start();
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html>
    <head>
        <title>Welcome to YapLoud - Help</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link type="text/css" rel="stylesheet" href="/css/style.css" />
        <script language="JavaScript">
            function processLogin() {
                alert("Function called.");
                return false;
            }

            function focus()   {
                // Sets cursor to FirstName input element
                var e_name = document.getElementById('name');
                e_name.focus();
            }

            function checkme() {
                var e_name = document.getElementById('name');
                var e_comments = document.getElementById('comments');
                var e_email = document.getElementById('email');
                
                if (e_name.value == "") {
                    alert("You did not enter your name. Please provide it.");
                    e_name.focus();
                    return false;
                }
                else if (e_email.value == "") {
                    alert("You did not enter your email. Please provide it.");
                    e_email.focus();
                    return false;
                }
                else if (e_comments.value == "") {
                    alert("You did not enter any comments. Please provide it.");
                    e_comments.focus();
                    return false;
                }
                return true;
            }
        </script>
    </head>
    
    <body onLoad="focus()">
        <div id="container">
			<?php
    			// Logo - Header
				include("common/header1.php");
            
    			// Right Navigation Panel
				include("rightNav.php");
			?>    
        
        <div id="content">
            <?php
                $feedback_sent = false;
                if (isset ($_POST['action']) && $_POST['action'] == 'help') {
                    $name = $_POST['name'];
                    $email = $_POST['email'];
                    $comments = $_POST['comments'];
                    $to = "feedback@yaploud.com";
                    $message = "$name just filled in your comments form. " . "They said:\n$comments\n\nTheir e-mail address was: $email";
                    $feedback_sent = mail($to,"Comments From Your Site",$message,"From: $email\n");
                }
            ?>
            <p>
                <?php
                    if (!isset ($_POST['action'])) {
                        echo "<h1>Welcome to Feedback </h1>";
                    } elseif ($feedback_sent) {
                        echo "<div class=yap_title>Thanks for your comments. </div>";
                        echo "<p>";
                        echo"<strong><a href=\"/home.php\">Home</a></strong>";
                        include ("common/footer1.php");
                        exit;
                    } else {
                        echo "<strong>There was a problem sending the mail. " . "Please check that you filled in the form correctly.</strong>";
                    }
                ?>
            </p>
            <p>
                <label for=Comment> Comments</label><br/>
                <form action="/help/feedback.php" method="post" onSubmit="return checkme()">
                    <label for=yourName>Your Name: </label>
                    <?
                        //$sess = $_SESSION;
                        if (!$_SESSION || !$_SESSION['logged']) {
                            print "<br><input type=\"text\" id=\"name\" name=\"name\" /><br/><br/>
                            <label for=email>Email: </label><br>
                            <input type=\"text\" id=\"email\" name=\"email\" /><br><br>";
                            ob_end_flush();
                        } else {
                            $username = $_SESSION['username'];
                            $email = $_SESSION['email'];
                            print " $username <br/><br/><label for=email>Email: </label>$email <br><br>";
                        }
                    ?>
                    <label for=comments>Comments </label><br/>
                    <textarea id="comments" name="comments" rows="13" cols="55"></textarea><br>
                    <input type=hidden name=action value="help" />
                    <input type="submit" value="Submit">
                </form>
            
        </div>
            <?php include("common/footer1.php");  ?>
      </div>
    </body>
</html>
