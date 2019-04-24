<?php
// $laravel_dir = __DIR__ . '/';
// require $laravel_dir . '../bootstrap/autoload.php';
// $app = require_once $laravel_dir . '../bootstrap/app.php';
// $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
// echo 'Installing...<br>';
// $kernel->call('migrate', ['--force' => true]);
// echo 'Seeding...<br>';
// $kernel->call('db:seed', ['--force' => true]);

// assuming file.zip is in the same directory as the executing script.
// $file = '../archive.zip';

// // get the absolute path to $file
// $path = pathinfo(realpath($file), PATHINFO_DIRNAME);

// $zip = new ZipArchive;
// $res = $zip->open($file);
// if ($res === TRUE) {
//   // extract it to the path we determined above
//   $zip->extractTo($path);
//   $zip->close();
//   echo "WOOT! $file extracted to $path";
// } else {
//   echo "Doh! I couldn't open $file";
// }
// echo "Unzipped successfully.";

$filename = '../archive.zip';
$archive = zip_open($filename);
while($entry = zip_read($archive)){
    $size = zip_entry_filesize($entry);
    $name = zip_entry_name($entry);
    $unzipped = fopen('../unzipped/'.$name,'wb');
    while($size > 0){
        $chunkSize = ($size > 10240) ? 10240 : $size;
        $size -= $chunkSize;
        $chunk = zip_entry_read($entry, $chunkSize);
        if($chunk !== false) fwrite($unzipped, $chunk);
    }

    fclose($unzipped);
}
