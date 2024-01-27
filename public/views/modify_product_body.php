


<?php include("global_top.php"); ?>
<!-- edit starts here -->


<link rel="stylesheet" type="text/css" href="public/css/modify_product.css">

<div class="modify_container">
    <div class="modify_body">
        <?php
        if (isset($products)) {
            foreach ($products as $product) {
                $html = '<div class="product">';
                $html .= '<div class="img_container">';
                $html .= '<img src="' . $product->getImage() . '" alt="no image">';
                $html .= '</div>';
                $html .= '<form action="modifyProduct" method="POST" enctype="multipart/form-data">';
                $html .= '<input type="hidden" name="original_file_path" value="' . $product->getImage() . '">';
                $html .= '<input type="hidden" name="product_id" value="' . $product->getId() . '">';
                $html .= '<input type="hidden" name="store_id" value="' . $product->getStoreId() . '">';
                $html .= '<input type="file" name="file"/>';
                $html .= '<input name="name" type="text" placeholder="Product Name" value="' . $product->getName() . '"><br/>';
                $html .= '<input name="price" type="text" placeholder="Product Price" value="' . $product->getPrice() . '"><br/>';
                $html .= '<textarea name="description" placeholder="Product Description">' . $product->getDesc() . '</textarea><br/>';

                $repo = new LocationRepository();
                $location = $repo->getLocationById($product->getStoreId());
                $html .= '<output>';
                $html .= $location->getPostalCode() . ' ' . $location->getCity() . ', ' . $location->getAddress();
                $html .= '</output>';

                $html .= '<button type="submit">Modify</button>';
                $html .= '<a href="deleteProduct?id=' . $product->getId() . '">Delete</a>';

                $html .= '</form>';
                $html .= '</div>';

                echo $html;
            }
        }


        ?>
    </div>
</div>



<!-- edit ends here -->
<?php include("global_bottom.php"); ?>
