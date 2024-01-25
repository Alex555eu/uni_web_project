<?php include("global_top.php"); ?>
<!-- edit starts here -->

<link rel="stylesheet" type="text/css" href="public/css/select_product.css">


<div class="pane">

    <?php
    require_once __DIR__.'/../../src/models/Product.php';
    require_once __DIR__.'/../../src/repository/ProductRepository.php';

    if (!empty($args)) {
        $productsRepository = new ProductRepository();
        $products = $productsRepository->getProductsById($args[0]);

        if ($products) { //todo: implement html/css

            var_dump($products);

            //echo $html;
            return;
        }
    }

    echo "No such product";



    ?>
</div>



<!-- edit ends here -->
<?php include("global_bottom.php"); ?>
