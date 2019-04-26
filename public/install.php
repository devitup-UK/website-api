<?php
require_once('../_extensions/pclzip.lib.php');




$archive = new PclZip('../release.zip');
if ($archive->extract(PCLZIP_OPT_PATH, '../') == 0) {
    die("Error : ".$archive->errorInfo(true));
}else{
    unlink('../release.zip');
    require_once("../vendor/autoload.php");
    $app = require_once("../bootstrap/app.php");
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();
    echo 'Installing...<br>';
    $kernel->call('migrate', ['--force' => true]);
    echo 'Seeding...<br>';
    $kernel->call('db:seed', ['--force' => true]);
    echo("Website unzipped successfully!");
}
