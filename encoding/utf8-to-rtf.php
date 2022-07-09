<?php

/**
 * Converts accented characters to RTF safe non-accented characters
 *
 * Adapted version of this https://www.php.net/manual/en/function.ord.php#124749
 */

$contents = ""; // some RTF file
$characters = []; // array of special characters

foreach ($characters as $character) {
    $result = null;

    $k   = mb_convert_encoding($character, 'UCS-2LE', 'UTF-8');
    $k1  = ord(substr($k, 0, 1));
    $k2  = ord(substr($k, 1, 1));
    $ord = $k2 * 256 + $k1;

    if ($ord > 255) {
        $result .= '\\uc1\\u' . $ord . '?';
    } elseif ($ord > 32768) {
        $result .= '\\uc1\\u' . ($ord - 65535) . '?';
    } else {
        $result .= "\\'" . dechex($ord);
    }

    $contents = mb_ereg_replace($character, $result, $contents);
}
