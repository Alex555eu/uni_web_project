

<link rel="stylesheet" type="text/css" href="public/css/cart.css">


<div class="cart-container">
    <div class="cart-content">
        <?php
        if (isset($message)) {
            //$script = '<script>' . 'alert("' . $message . '") </script>';
            echo '<p style="text-align: center;">' . $message . '</p>';
        }
        if (isset($cart_data)) {
            $html = '';
            foreach ($cart_data as $item) {
                $html .= '<div class="cart-items">';
                $html .= '<div class="img-container">';
                $html .= '<img src="' . $item->getImage() . '" alt="no image">';
                $html .= '</div>';
                $html .= '<output>' . $item->getName() . '</output>';
                $html .= '<output>' . $item->getPrice() . '</output>';
                $html .= '<output>' . $item->getAmountInCart() . '</output>';
                $html .= '<form action="removeItemFromCart" method="POST">';
                $html .= '<input name="cart_item_id" type="hidden" value="' . $item->getCartItemId() . '">';
                $html .= '<button type="submit">Delete</button>';
                $html .= '</form>';

                $html .= '</div>';
            }

            // Additional section for order information
            $html .= '<div class="cart-order-info">';
            $html .= '<textarea placeholder="Additional information for recipient"></textarea>';
            $html .= '</div>';

            // Additional section for confirmation button
            $html .= '<form action="placeAnOrder" method="POST">';
            $html .= '<button type="submit">Place Your Order</button>';
            $html .= '</form>';

            echo $html;
        } else {
            echo 'Your cart is empty';
        }
        ?>
    </div>
</div>