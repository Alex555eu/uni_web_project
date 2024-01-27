<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="public/css/navbar.css">
    <script src="public/scripts/main.js"></script>
</head>

<body>


<div class="navbar-bg" id="nbbg">
    <img id="desktop-bg-01" src="public/images/slice_01.svg">
    <img id="mobile-bg-01" src="public/images/slice_01_mob.svg">
</div>
<div class="navbar" id="myNavbar">
    <div class="logo">
        <a href="/main">
            <img src="public/images/logo.svg">
        </a>
    </div>
    <div class="icon">
        <a href="javascript:void(1);" onclick="myFunction()">
            &#9776;
        </a>
    </div>
    <div class="options">
        <?php
        if(isset($user_data)) {
            if ($user_data['authorization'] == 1) {
                $html = '<a href="';
                $html .= '/admin';
                $html .= '">AdminPanel</a>';
                echo $html;
            } else if ($user_data['authentication'] == 0) {
                $html = '<a href="';
                $html .= '/worker';
                $html .= '">WorkerPanel</a>';
                echo $html;
            }
        }
        ?>
        <a href="/main#products-container">Menu</a>
        <a href="/locales">Locales</a>
        <a href="/cart">Cart</a>
        <?php
            $html = '<a href="';
            if(isset($user_data)) {
                $html .= '/user?session=' . $_COOKIE['user_token'];
                $html .= '">myAccount</a>';
            } else {
                $html .= '/login';
                $html .= '">Log in</a>';
            }
            echo $html;
        ?>
    </div>
</div>