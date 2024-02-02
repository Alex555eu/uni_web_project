
<?php include("global_top.php"); ?>
<!-- edit starts here -->

<link rel="stylesheet" type="text/css" href="public/css/locales.css">


<div class="locales-container">

    <?php
    $html = '';
    if (isset($locales)) {
        foreach ($locales as $local) {
            $html .= '<div class="locale">';
                $html .= '<output>' . $local->getPostalCode() . '</output>';
                $html .= '<output>' . $local->getCity() . '</output>';
                $html .= '<output>' . $local->getAddress() . '</output>';
            $html .= '</div>';
        }
    }
    echo $html;
    ?>
</div>



<!-- edit ends here -->
<?php include("global_bottom.php"); ?>