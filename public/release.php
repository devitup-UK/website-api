<?php
require_once('../_extensions/pclzip.lib.php');
require_once('../_extensions/move-directory.php');

$currentDate = date("Y-m-d H:i:s");
$backupRelease = new PclZip($currentDate . '.zip');
$v_list = $backupRelease->create('../');
if($v_list == 0) {
    die("Error:" . $archive->errorInfo(true));
}else{
    rrmdir('../');
    echo json_encode([
        message => 'Website cleared successfully.'
    ]);
}
