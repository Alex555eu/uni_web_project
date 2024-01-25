

<?php include("global_top.php"); ?>
<!-- edit starts here -->

<link rel="stylesheet" type="text/css" href="public/css/login.css">

<div class="login-container">
        <div class="login-bg-container">
            <div>
                <img src="public/images/logo.svg" alt="logo img">
            </div>
            <form action="login_secure" method="POST">
                <input name="email" type="text" placeholder="email">
                <input name="password" type="password" placeholder="password">
                <?php
                    if (isset($messages)) {
                        foreach ($messages as $msg) {
                            echo $msg;
                        }
                    }
                if (isset($_GET['alert'])) {
                    echo '<script>alert("Your session expired!")</script>';
                }

                ?>
                <button id="login-button" type="submit" >login</button>
            </form>
            <a href="/register" >
                <button id="register-button">register</button> 
            </a>
        </div>
    </div>


<!-- edit ends here -->
<?php include("global_bottom.php"); ?>