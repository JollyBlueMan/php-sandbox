<?php

include './../tools/StringTools.php';

$hello = fopen('php://memory', 'r+'); // $hello, $php, $world are all different streams
$world = fopen('php://memory', 'r+');

fputs($hello, "Hello "); // add data to the streams
fputs($world, "World!");

rewind($hello); // move the file pointer back to the start of the file
rewind($world);

echo StringTools::toAsciiTable(
    [["stream" => stream_get_contents($hello)], ["stream" => stream_get_contents($world)]],
    ["stream"],
    30
) . PHP_EOL;

fclose($hello); // close the stream and delete data
fclose($world);

#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-

$temp = fopen('php://temp', 'r+'); // temp is better, it will create a temporary file to save php memory
fputs($temp, "Temporary data");
rewind($temp);

echo StringTools::toAsciiTable(
    [["stream" => stream_get_contents($temp)]],
    ["stream"],
    30
) . PHP_EOL;

fclose($temp);