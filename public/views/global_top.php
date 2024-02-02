<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Knewave' rel='stylesheet'>
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
        <a href="javascript:void(1);" onclick="navResponse()">
            &#9776;
        </a>
    </div>
    <div class="options">
        <?php
        if(isset($user_data)) {
            if ($user_data['authorization'] == 2) {
                $html = '<a href="';
                $html .= '/admin';
                $html .= '" onclick="myFunction()">AdminPanel</a>';
                echo $html;
            } else if ($user_data['authentication'] == 1) {
                $html = '<a href="';
                $html .= '/worker';
                $html .= '" onclick="myFunction()">WorkerPanel</a>';
                echo $html;
            }
        }
        ?>
        <a href="/main#products-container" onclick="navResponse()">Menu</a>
        <a href="/locales" onclick="navResponse()">Locales</a>
        <a href="/cart" onclick="navResponse()">Cart</a>
        <?php
            $html = '<a href="';
            if(isset($user_data)) {
                $html .= '/user';
                $html .= '" onclick="myFunction()">myAccount</a>';
            } else {
                $html .= '/login';
                $html .= '" onclick="myFunction()">Log in</a>';
            }
            echo $html;
        ?>
    </div>
</div>
