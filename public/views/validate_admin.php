



<?php
if (isset($user_data)) {
    if ($user_data['authorization'] == 1) {
        $callingFilePath = debug_backtrace()[0]['file'];
        $callingFileName = basename($callingFilePath, ".php");
        include($callingFileName . "_body.php");
        return ;
    }
}
echo "wrong url!";
?>
