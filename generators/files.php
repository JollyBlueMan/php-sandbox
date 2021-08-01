<?php
$file = 'path/to/file.txt';

function getLines($file) {
    $f = fopen($file, 'r');
    try {
        while ($line = fgets($f)) {
            yield $line;
        }
    } finally {
        fclose($f);
    }
}

$count = 0;
foreach (getLines($file) as $n => $line) {
    printf("%s: %s\n",$count, $line);
    $count++;
}

$lines = getLines($file);
echo $lines->current(); // Line 1
$lines->next();
echo $lines->current(); // Line 2