<?php

include './DirtyWordsFilter.php';

stream_filter_register('string.dirty_words_filter', 'DirtyWordsFilter');

$handle = fopen('./test/example.csv', 'r+');
stream_filter_append($handle, 'string.dirty_words_filter');
while (feof($handle) !== true) {
    echo fgets($handle);
}
echo PHP_EOL;

$handle = fopen("php://filter/read=string.dirty_words_filter/resource=test/example.csv", 'rb');
while (feof($handle) !== true) {
    echo fgets($handle);
}
echo PHP_EOL;
