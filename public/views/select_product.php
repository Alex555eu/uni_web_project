<?php include("global_top.php"); ?>
<!-- edit starts here -->


<link rel="stylesheet" type="text/css" href="public/css/select_product.css">


<div class="pane">
    <div class="product">
        <?php
        if (isset($product)) {
            $html = '<div class="img_container">';
                $html .= '<img src="' . $product->getImage() . '" alt="no image">';
            $html .= '</div>';

            $html .= '<div class="product_info">';
                $html .= '<output id="name">' . $product->getName() . '</output>';
                $html .= '<output id="price">' . $product->getPrice() . ' $</output>';
                $html .= '<output id="quantity">only ' . $product->getQuantity() . ' left</output>';

                $html .= '<form action="addProductToCart" method="post">';
                    $html .= '<input type="hidden" name="product_id" value="' . $product->getId() . '">';
                    $html .= '<input type="number" step="1" min="1" max="' . $product->getQuantity() . '" value="1" name="quantity">';
                    $html .= '<button type="submit">add</button>';
                $html .= '</form>';
                $html .= '<output id="description">' . $product->getDesc() . '</output>';
            $html .= '</div>';

            echo $html;
        } else {
            echo "No such product";
        }
        ?>
    </div>
</div>



<!-- edit ends here -->
<?php include("global_bottom.php"); ?>
