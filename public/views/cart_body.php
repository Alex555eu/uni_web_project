

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
                $html .= '<output id="name">' . $item->getName() . '</output>';
                $html .= '<output id="price">' . $item->getPrice() . '</output>';
                $html .= '<output>x</output>';
                $html .= '<output id="amount">' . $item->getAmountInCart() . '</output>';
                $html .= '<form action="removeItemFromCart" method="POST">';
                $html .= '<input name="cart_item_id" type="hidden" value="' . $item->getCartItemId() . '">';
                $html .= '<button id="submit-btn" type="submit">X</button>';
                $html .= '</form>';

                $html .= '</div>';
            }

            // Additional section for order information
            $html .= '<div class="cart-order-info">';
            $html .= '<textarea placeholder="Additional information for recipient"></textarea>';
            $html .= '</div>';

            $html .= '<output id="total-sum"></output>';

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

<script>
    var cartItems = document.querySelectorAll('.cart-items');
    var totalSum = Array.from(cartItems).reduce(function (sum, cartItem) {
        var price = parseFloat(cartItem.querySelector('#price').innerText);
        var amount = parseFloat(cartItem.querySelector('#amount').innerText);

        if (!isNaN(price) && !isNaN(amount)) {
            return sum + (price * amount);
        } else {
            return sum;
        }
    }, 0);
    var totalSumOutput = document.getElementById('total-sum');
    if (totalSumOutput) {
        totalSumOutput.innerText = 'Total Sum: ' + totalSum.toFixed(2); // Format to two decimal places
    }
</script>