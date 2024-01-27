



<?php
//    if (isset($user_data)) {
//        if ($user_data['authorization'] == 1) {
//            $callingFilePath = debug_backtrace()[0]['file'];
//            $dir = basename(dirname($callingFilePath));
//            if ($dir != "views") {
//                include("admin_body.php");
//                return;
//            }
//            $file = basename($callingFilePath, ".php");
//            include($file . "_body.php");
//            return ;
//        }
//    }
//    echo "wrong url!";
//?>

<?php
    include('validate_admin.php');
?>
