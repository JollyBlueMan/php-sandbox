<?php
date_default_timezone_set('Europe/London');
$local = new \DateTime();
var_dump($local->format('Y-m-d H:i:s'));

// Create new DateTime in different timezone
$timezone = new \DateTimeZone('America/New_York');
$datetime = new \DateTime('now', $timezone);
var_dump($datetime->format('Y-m-d H:i:s'));

// Modify timezone of existing DateTime
$datetime->setTimezone(new \DateTimeZone('Europe/Amsterdam'));
var_dump($datetime->format('Y-m-d H:i:s'));

// Time warp (again??)
$datetime  = new \DateTime();
$timezones = [
    new \DateTimeZone('Europe/London'),
    new \DateTimeZone('Europe/Amsterdam'),
    new \DateTimeZone('Europe/Brussels'),
    new \DateTimeZone('America/Toronto'),
    new \DateTimeZone('Australia/Sydney'),
];
foreach ($timezones as $timezone) {
    $datetime->setTimezone($timezone);
    echo "{$timezone->getName()}:\t{$datetime->format('Y-m-d H:i:s')} ({$timezone->getOffset($local)})" . PHP_EOL;
}
