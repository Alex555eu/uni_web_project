

<?php include("global_top.php"); ?>
<!-- edit starts here -->

<link rel="stylesheet" type="text/css" href="public/css/locales.css">


<div class="locales-container">
    <?php
    if(isset($locales)) {
        foreach ($locales as $local) {
            var_dump($local);
        }
    }
    ?>
</div>



<!-- edit ends here -->
<?php include("global_bottom.php"); ?>