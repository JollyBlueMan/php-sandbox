<?php
require '../vendor/autoload.php';

$urls = [
    'https://isitgeorgemichael.today',
    'https://google.com',
    'http://amazing.example.org.uk'
];

$scanner = new \JollyBlueMan\UrlValidator\Scanner($urls);
print_r($scanner->getInvalidUrls());