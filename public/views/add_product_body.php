


<?php include("global_top.php"); ?>
<!-- edit starts here -->


<link rel="stylesheet" type="text/css" href="public/css/add_product.css">

<div class="add_prod_container">
    <div class="add_prod_body">
        <form action="addProduct" method="POST" ENCTYPE="multipart/form-data">
            <div class="messages">
                <?php
                if(isset($messages)){
                    foreach($messages as $message) {
                        echo $message;
                    }
                }
                ?>
            </div>
            <input name="name" type="text" placeholder="Product Name">
            <input name="price" type="text" placeholder="Product Price" oninput="replaceCommas(this)">
            <script>
                function replaceCommas(input) {
                    // Replace commas with decimal points
                    input.value = input.value.replace(/,/g, '.');
                }
            </script>
            <input name="quantity" type="number" step="1" placeholder="Product Quantity">
            <textarea name="description" rows=5 placeholder="Product Description"></textarea><br/>
            <?php
                $html = '<select id="store_locations" name="store_id">';
                $repo = new LocationRepository();
                $locations = $repo->getAllLocations();
                foreach ($locations as $location) {
                    $html .= "<option value=\"{$location->getId()}\">{$location}</option>";

                }
                $html .= '</select><br/>';
                echo $html;
            ?>
            <label>Product Image</label>
            <input type="file" name="file"/><br/>

            <button type="submit">add</button>
        </form>
    </div>
</div>



<!-- edit ends here -->
<?php include("global_bottom.php"); ?>
