<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link href='https://fonts.googleapis.com/css?family=Knewave' rel='stylesheet'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="public/css/navbar.css">
  <link rel="stylesheet" type="text/css" href="public/css/main-page.css">
  <script type="text/javascript" src="public/scripts/main.js" defer></script>
  <script type="text/javascript" src="public/scripts/search_bar.js" defer></script>

</head>

<body>

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
    <div class="image-container-09">
         <img id="img09" src="public/images/slice_09.svg">
        <img id="img09mob" src="public/images/slice_09_mob.svg">
    </div>
    <div class="image-container-01">
         <img id="img01" src="public/images/slice_01.svg">
        <img id="img01mob" src="public/images/slice_01_mob.svg">
    </div>


    <?php
    $html = '<div class="products-container" id="products-container">';
        $html .= '<div class="search-bar-container">';
            $html .= '<select id="choose_category_id" name="selected_category"">';
                $html .= '<option value="-1">All Products</option>';
                if (isset($categories)) {
                    foreach ($categories as $category) {
                        $html .= '<option value="' . $category->getId() . '">' . $category->getName() . '</option>';
                    }
                }
            $html .= '</select>';
            $html .= '<select id="choose_store_id" name="selected_store"">';
                $html .= '<option value="-1">All Locations</option>';
                if (isset($locales)) {
                    foreach ($locales as $locale) {
                        $html .= '<option value="' . $locale->getId() . '">' . $locale . '</option>';
                    }
                }
            $html .= '</select>';
        $html .= '<input id="search-bar" type="text" placeholder="Search">';
    $html .= '</div>';

    $html .= '<div class="product-list">';
    if (isset($products)) {
        foreach ($products as $product) {
            $html .= '<div class=product_wrapper>';
            $html .= '<a href="/select_product?id=' . $product->getId() . '">';
            $html .= '<div class="product">';
            $html .= '<div class="product_img">';
            $html .= '<img src="' . $product->getImage() . '">';
            $html .= '</div>';
            $html .= '<h2>' . $product->getName() . '</h2>';
            $html .= '<p>' . $product->getPrice() . ' $</p>';
            $html .= '</div>';
            $html .= '</a>';
            $html .= '</div>';
        }
    }
    $html .= '</div>';

    echo $html;
    ?>



    <template id="product-template">
        <div class="product_wrapper">
            <a href="">
                <div class="product">
                    <div class="product_img">
                        <img src="">
                    </div>
                    <h2>name</h2>
                    <p>price</p>
                </div>
            </a>
        </div>
    </template>


<!-- edit ends here -->
<?php include("global_bottom.php"); ?>