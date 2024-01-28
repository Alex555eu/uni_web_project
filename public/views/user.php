

<?php include("global_top.php"); ?>
<!-- edit starts here -->


<?php
if(isset($user_data))
    include ('user_body.php');
else {
    $url = "http://" . $_SERVER['HTTP_HOST'];
    header("Location: {$url}/login");
}
?>




<!-- edit ends here -->
<?php include("global_bottom.php"); ?>
