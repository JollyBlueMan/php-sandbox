<?php

/**
 * -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
 *      Array To Nice String
 * -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-
 *
 * This takes an array and turns it into a comma separated
 * list, BUT, with "and" as the last separator.
 *
 * */

$array = ['php', 'html', 'css', 'javascript'];

$m = -microtime(true);
$h = -hrtime(true);

$output = substr_replace(
    $string = implode(', ', $array),
    ' and',
    strpos($string, ',', (strlen($array[count($array) - 1]) + 1)),
    1
);

$m += microtime(true);
$h += hrtime(true);

$m_execution_time_milliseconds = ($m * 1000);
$h_execution_time_milliseconds = ($h / 1e+6);

echo $output . PHP_EOL;
echo 'microtime says: ' . $m_execution_time_milliseconds . ' (milliseconds)' . PHP_EOL;
echo 'hrtime says: ' . $h_execution_time_milliseconds . ' (milliseconds)' . PHP_EOL;

echo PHP_EOL . PHP_EOL;

$m2 = -microtime(true);
$h2 = -hrtime(true);

$output = "";
$runCount = 0;
$arrayCount = count($array) - 1;
$penultimateItem = $arrayCount - 1;
foreach ($array as $item) {
//    $separator = ($penultimateItem == $runCount) ? ' and ' : ", ";
//    if ($runCount == $arrayCount) {
//        $separator = "";
//    }

    $separator = ", ";
    if ($penultimateItem == $runCount) {
        $separator = ' and ';
    } elseif ($runCount == $arrayCount) {
        $separator = "";
    }

    $output .= $item . $separator;
    $runCount++;
}

$m2 += microtime(true);
$h2 += hrtime(true);

$m2_execution_time_milliseconds = ($m2 * 1000);
$h2_execution_time_milliseconds = ($h2 / 1e+6);

echo $output . PHP_EOL;
echo 'microtime says: ' . $m2_execution_time_milliseconds . ' (milliseconds)' . PHP_EOL;
echo 'hrtime says: ' . $h2_execution_time_milliseconds . ' (milliseconds)' . PHP_EOL;
