<?php
require_once('../_extensions/pclzip.lib.php');

$archive = new PclZip('../release.zip');
if ($archive->extract(PCLZIP_OPT_PATH, '../') == 0) {
    die("Error : ".$archive->errorInfo(true));
}else{
    echo("Website unzipped successfully!");
}
