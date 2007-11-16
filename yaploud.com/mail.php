<?

$name=$_POST['name'];
$email=$_POST['email'];
$comments=$_POST['comments'];
$to="feedback@yaploud.com";
$message="$name just filled in your comments form. They said:\n$comments\n\nTheir e-mail address was: $email";
if(mail($to,"Comments From Your Site",$message,"From: $email\n")) {
echo "Thanks for your comments.";
} else {
echo "There was a problem sending the mail. Please check that you filled in the form correctly.";
}
echo("<br><br><a scope=\"col\" class=\"menu_1\" href=\"http://www.yaploud.com/home.php\"><strong>Home</strong></a>");
?>
