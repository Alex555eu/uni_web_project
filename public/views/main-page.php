
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
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
            <a href="/main#products-container">Menu</a>
            <a href="/locales">Locales</a>      
            <a href="/cart">Cart</a>
            <a href="/login">Log in</a>
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




    <div class="products-container" id="products-container">
        <?php
        require_once __DIR__.'/../../src/models/Product.php';
        require_once __DIR__.'/../../src/repository/ProductRepository.php';


        $productsRepository = new ProductRepository();
        $products = $productsRepository->getProducts("donuts");
        // HTML generation
        $html = '<div class="product-list">';

        foreach ($products as $product) {
            $html .= '<div class="product">';
            $html .= '<h2>' . $product['name'] . '</h2>';
            $html .= '<p><strong>Price:</strong> $' . $product['price'] . '</p>';
            $html .= '</div>';
        }

        $html .= '</div>';

        echo $html;
        ?>
        <h1>product</h1>
        <h1>product</h1>
        <h1>product</h1>
        <h1>product</h1>
        <h1>product</h1>
        <h1>product</h1>
        <h1>product</h1>
        <h1>product</h1>
        <h1>product</h1>
        <h1>product</h1>
        <h1>product</h1>
        <h1>product</h1>
        <h1>product</h1>


    </div>


</body>


</html>
