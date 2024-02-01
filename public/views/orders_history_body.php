


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
                $html .= '<output>User email: ' . $order->getUserEmail() . '</output>';

                if (!is_null($order->getProducts()) && is_array($order->getProducts())) {
                    foreach ($order->getProducts() as $item) {
                        $html .= '<div class="item">';
                        $html .= '<div class="img-container">';
                        $html .= '<img src="' . $item->getImage() . '" alt="Product Image">';
                        $html .= '</div>';
                        $html .= '<output>' . $item->getName() . '</output>';
                        if (isset($locations) && is_array($locations)) {
                            foreach ($locations as $location) {
                                if ($location->getId() == $item->getStoreId()) {
                                    $html .= '<output>';
                                    $html .= $location->getPostalCode() . ' ' . $location->getCity() . ', ' . $location->getAddress();
                                    $html .= '</output>';
                                }
                            }
                        }
                        $html .= '<output>' . $item->getQuantity() . 'pcs.</output>';
                        $html .= '<output>x</output>';
                        $html .= '<output>' . $item->getPrice() . ' $</output>';
                        $html .= '</div>';
                    }
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
