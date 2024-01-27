
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link href='https://fonts.googleapis.com/css?family=Knewave' rel='stylesheet'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="public/css/navbar.css">
  <link rel="stylesheet" type="text/css" href="public/css/main-page.css">
  <script src="public/scripts/main.js"></script>
</head>

<body>

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
    <div class="image-container-09">
         <img id="img09" src="public/images/slice_09.svg">
        <img id="img09mob" src="public/images/slice_09_mob.svg">
    </div>
    <div class="image-container-01">
         <img id="img01" src="public/images/slice_01.svg">
        <img id="img01mob" src="public/images/slice_01_mob.svg">
    </div>



    <form id="store_select_form" action="/main#products-container" method="POST">
        <select id="choose_store_id" name="selected_store" onchange="submitStoreSelectForm();">
            <option>Choose location</option>
            <option value="1">Krakow, ul.Warszawska</option>
            <option value="2">Krakow, ul.Starowka</option>
        </select>
    </form>
    <script>
        function submitStoreSelectForm() {
            document.getElementById("store_select_form").submit();
        }
    </script>

    <div class="products-container" id="products-container">
        <?php
        require_once __DIR__.'/../../src/models/Product.php';
        require_once __DIR__.'/../../src/repository/ProductRepository.php';

        $cookie_name = "user_token";
        if(!isset($_COOKIE[$cookie_name])) {
            echo "Cookie named '" . $cookie_name . "' is not set!<br>";
        } else {
            echo "Cookie '" . $cookie_name . "' is set!<br>";
            echo "Value is: " . $_COOKIE[$cookie_name] . "<br>";
        }

        if ($_SERVER["REQUEST_METHOD"] == 'POST') {
            $store_id = intval($_POST['selected_store']);
            echo $store_id;
        } else {
            $store_id = 1;
        }
        $productsRepository = new ProductRepository();
        $products = $productsRepository->getProductsFromStoreByCategoryName($store_id, "donuts");

        $html = '<div class="product-list">';

        foreach ($products as $product) {
            $html .= '<div class=product_wrapper>';
                $html .= '<a href="/select_product?id=' . $product->getId() . '">';
                    $html .= '<div class="product">';
                        $html .= '<div class="product_img">';
                            $html .= '<img src="' . $product->getImage() . '">';
                        $html .= '</div>';
                        $html .= '<h2>' . $product->getName() . '</h2>';
                        $html .= '<p>'. $product->getPrice() . ' pln</p>';
                    $html .= '</div>';
                $html .= '</a>';
            $html .= '</div>';
        }

        $html .= '</div>';

        echo $html;
        ?>

    </div>



<!-- edit ends here -->
<?php include("global_bottom.php"); ?>