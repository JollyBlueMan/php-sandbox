<?php

include "../tools/StringTools.php";

$string = "Iñtërnâtiônàlizætiøn";

$strlen = [
    ["method" => "strlen",    "result"  => strlen($string)], //27
    ["method" => "mb strlen", "result"  => mb_strlen($string)], //20
    ["method" => "--------",  "result"  => "--------"],
    ["method" => "eyes",      "result"  => "20"]
];

echo StringTools::toAsciiTable($strlen, ["method", "result"], 30) . PHP_EOL;

$convertCase = [
    ["method" => "strtoupper",   "result"  => strtoupper($string)],
    ["method" => "mb strtopper", "result"  => mb_strtoupper($string)],
    ["method" => "--------",     "result"  => "--------"],
    ["method" => "strpos",       "result"  => strpos($string, "z")], //19
    ["method" => "mb strpos",    "result"  => mb_strpos($string, "z")], //14
];

echo StringTools::toAsciiTable($convertCase, ["method", "result"], 60);

// TL;DR use the mb_ string functions instead of the native PHP ones for operations with strings