
<!-- HEADER SECTION -->
<div id="header">
    <div class="header-top">
        <div class="header-left">
        <a href="home.php">
            <img src="/images/logo.gif" /><img src="images/home_06.gif" />
        </a>
        </div>
        <div class="header-center">
            <img src="/images/home_02.gif" /><img src="images/home_07.gif" />
        </div>

        <div class="header-right">
        <?php
            if(!isset($_SESSION['logged']) || $_SESSION['logged'] == false) {
                print <<<HTML
            <a href="/user/register.php"><strong>Sign Up</strong></a> | 
            <a href="/login_page.php">Log In</a>
HTML;
            }
            else {
                print <<<HTML
            <a href="/user/myaccount.php">Hi {$_SESSION['username']}</a> | 
            <a href="/user/myaccount.php">My Account</a> | 
            <a href="/login_page.php?logout=true">Log Out</a>
HTML;
            }
        ?>
        </div>
    </div>
</div>



