
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="public/css/navbar.css">
    <link rel="stylesheet" type="text/css" href="public/css/register.css">
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
            <a href="/main#products-container">Menu</a>
            <a href="/locales">Locales</a>      
            <a href="/cart">Cart</a>
            <a href="/login">Log in</a>
        </div>
    </div>


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





</body>


</html>
