<?php

// this is useful for something https://www.google.com/maps/place/52%C2%B033'54.6%22N+2%C2%B011'53.1%22W/@52.5648583,-2.1986948,18.21z/data=!4m13!1m6!3m5!1s0x487085f15b9582cd:0x5c634194fb8e43f!2sTree+Patrol+Limited!8m2!3d52.5651758!4d-2.1980745!3m5!1s0x0:0x0!7e2!8m2!3d52.5651699!4d-2.1980844


var_dump(password_hash("cassyn", PASSWORD_DEFAULT));
var_dump(password_verify("cassyn", '$2y$10$z0Pn0OHe8zZtauZJTt5Tuei37LHrZW2R6MdDCb.dTPQ7CgEX05YmS'));

var_dump(password_hash("52.565170, -2.198084", PASSWORD_DEFAULT));
var_dump(password_verify("52.565170, -2.198084", '$2y$10$MusbxE1hSaVgaHV5NF3SXuRq7StvW2r/5PtzOJbBP0j3lM6SmQ4pm'));

/*$key = "16yw4633";
$iv  = "1234546wtr6666c4";

$message = "console:report elevation -data-acoords data-bhandle";
$encMessage = "GgzZrlf06xhLyD+dQ/pVrOh0VB2fBDMdYc8QdpSkiRMBaOMrCEn2b2eN63rua/lOcwuOK+Vfoi9Lky1fbLtHvQ==";

var_dump(openssl_encrypt($message, "AES-256-CBC", $key, false, $iv));

var_dump(openssl_decrypt($encMessage, "AES-256-CBC", $key, false, $iv));*/

/*var_dump(round(12309*(1-.3456))); //8055
var_dump(round(2043*(1-.3456))); //1337
var_dump(round(6409*(1-.3456))); //4194
var_dump(round(12796*(1-.3456))); //8374*/

/*$string = "jollyblueman";

var_dump(ord($string) * ord(json_decode(file_get_contents("composer.json"), true)["name"]));

var_dump(base_convert($string, 26, 10));*/


/*$iOriginal = ["c","o","m","p","o","s","e","r"];
$iiOriginal = ["j","s","o","n"];
$iiiOriginal = ["n","a","m","e"];

var_dump(encode($iOriginal));
var_dump(encode($iiOriginal));
var_dump(encode($iiiOriginal));

$iCypher = [3,15,13,16,15,19,5,18];
$iiCypher = [10,19,15,14];
$iiCypher = [14,1,13,5];


function encode($input): array
{
    $output = [];
    foreach ($input as $item) {
        $converted = ord($item) - 96;
        //var_dump($converted);

        $output[] = $converted;
    }

    return $output;
}*/

function decode($input): array
{
    $output = [];
    foreach ($input as $item) {
        $converted = strtolower(chr($item + 64));
        //var_dump($converted);
        $output[] = $converted;
    }

    return $output;
}