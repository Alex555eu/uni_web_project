



<?php
if (isset($user_data)) {
    if ($user_data['authorization'] == 2) { // if authorized, include the body of this scripts caller file
        $callingFilePath = debug_backtrace()[0]['file'];
        $callingFileName = basename($callingFilePath, ".php");
        include($callingFileName . "_body.php");
        return ;
    }
}
echo "wrong url!";
?>
