<?php
// Make sure you define the default timezone for the app/script
date_default_timezone_set('Europe/London');

// Current date & time
$datetime = new \DateTime();
var_dump($datetime); //object(DateTime)

// Just the date
$datetime = $datetime->format('Y-m-d');
var_dump($datetime); // string

// Create DateTime from string in random formats
$dates = [
    'Aug 20, 2021 23:59:59', // object(DateTime)
    '2420-04-20 16:19:59',   // object(DateTime)
    '1st January 2001',      // object(DateTime)
    '1/08/21'                // object(DateTime)
];
foreach ($dates as $date) {
    $datetime = new \DateTime($date);
    var_dump($datetime);
}

// Create DateTime from string & specified format
$dates = [
    'Aug 20, 2021 23:59:59', // object(DateTime)
    'Aug 21, 2021 23:59:59', // object(DateTime)
    '2420-04-20 16:20:00'    // false
];
foreach ($dates as $date) {
    $datetime = \DateTime::createFromFormat('M j, Y H:i:s', $date);
    var_dump($datetime);
}
