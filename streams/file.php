<?php

// This...
$handle = fopen('./test/example.csv', 'rb');
while (feof($handle) !== true) {
    echo ftell($handle) . ": " . fgets($handle);
}
fclose($handle);
echo PHP_EOL;

// ... is the same as this - "file://" is just the default identifier
$handle = fopen('file://' . __DIR__ .'/test/example.csv', 'rb');
while (feof($handle) !== true) {
    echo fgets($handle);
}
fclose($handle);
echo PHP_EOL;

#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-

// Copy large files safely
$source = fopen('./test/example.csv', 'r');
$dest = fopen('./test/copy.csv', 'w');

stream_copy_to_stream($source, $dest);

fclose($dest);
fclose($source);

#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-

// create 'encrypted.txt' containing the data encoded by rot13
file_put_contents("php://filter/write=string.rot13/resource=encrypted.txt", "P455W0RD123");

#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-

// read a remote file and change the case
$i = 0;
$handle = fopen("php://filter/read=string.toupper/resource=https://jollyblueman.com", 'rb');
while ($i < 10) {
    echo ftell($handle) . ": " . fgets($handle);
    $i++;
}
fclose($handle);
echo PHP_EOL;
