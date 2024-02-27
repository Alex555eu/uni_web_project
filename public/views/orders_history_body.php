


<?php include("global_top.php"); ?>
<!-- edit starts here -->


<link rel="stylesheet" type="text/css" href="public/css/orders_history.css">

<div class="history-container">
    <div class="history-content">
        <?php
        $html = '';
        if (isset($orders) && is_array($orders)) {
            foreach ($orders as $order) {
                $html .= '<div class="order">';
                $html .= '<output>Order no. ' . $order->getId() . '</output>';
                $html .= '<output>User email: ' . $order->getUser()->getEmail() . '</output>';

                try {
                    $date = new DateTime($order->getPlacementDate());
                } catch (Exception $e) {}
                $formattedDate = $date->format('Y-m-d H:i:d');
                $html .= '<output>Order placement date: ' . $formattedDate . '</output>';

                foreach ($order->getProductItems() as $productItem) {
                    $product = $productItem->getProduct();
                        $html .= '<div class="item">';
                        $html .= '<div class="img-container">';
                        $html .= '<img src="' . $product->getImage() . '" alt="Product Image">';
                        $html .= '</div>';
                        $html .= '<output>' . $product->getName() . '</output>';
                        $html .= '<output>';
                        $html .= $product->getProductInventory()->getStore()->getPostalCode() . ' '
                               . $product->getProductInventory()->getStore()->getCity() . ', '
                               . $product->getProductInventory()->getStore()->getAddress();
                        $html .= '</output>';
                        $html .= '<output>' . $productItem->getProductQuantity() . 'pcs.</output>';
                        $html .= '<output>x</output>';
                        $html .= '<output>' . $product->getPrice() . ' $</output>';
                        $html .= '</div>';

                }
                if (!empty($order->getAdditionalInfo())) {
                    $html .= '<output> Additional info from customer:</br></br>' . $order->getAdditionalInfo() . '</output></br>';
                }
                $html .= '<output>Total: ' . $order->getTotal() . ' $</output>';
                $html .= '</div>';
            }
        } else {
            $html .= '<p>No order history available.</p>';
        }

        echo $html;
        ?>
    </div>
</div>


<!-- edit ends here -->
<?php include("global_bottom.php"); ?>
