
<?php include("global_top.php"); ?>
<!-- edit starts here -->

<link rel="stylesheet" type="text/css" href="public/css/register.css">


    <div class="register-container">
        <div class="register-bg-container">
            <div>
                <img src="public/images/logo.svg" alt="logo img">
            </div>
            <form action="register_secure" method="POST">
                <div id="left">
                    <input name="name" type="text" placeholder="name">
                    <input name="surname" type="text" placeholder="surname">
                    <input name="email" type="text" placeholder="email">
                </div>
                <div id="right">
                    <input name="password" type="password" placeholder="password">
                    <input name="repeat-password" type="password" placeholder="repeat-password">
                    <button id="register-button" type="submit" >register</button>
                </div>
            </form>
        </div>
    </div>





<!-- edit ends here -->
<?php include("global_bottom.php"); ?>
