<?php
require_once('../_extensions/pclzip.lib.php');
require_once('../_extensions/move-directory.php');

$archive = new PclZip('../release.zip');
if ($archive->extract(PCLZIP_OPT_PATH, '../') == 0) {
    die("Error : ".$archive->errorInfo(true));
}else{
    rcopy("../../shared/.env", "../.env");
    unlink('../release.zip');
    require_once("../vendor/autoload.php");
    $app = require_once("../bootstrap/app.php");
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();
    $kernel->call('migrate', ['--force' => true]);
    $kernel->call('db:seed', ['--force' => true]);
    echo json_encode([
        'message' => 'Website unzipped and seeded successfully!'
    ]);
}
