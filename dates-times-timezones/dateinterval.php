<?php
date_default_timezone_set('Europe/London');
$datetime = new \DateTime('2021-12-02 20:21:12');

// Create interval
$interval = new \DateInterval('P2W'); // 2 weeks
$interval = \DateInterval::createFromDateString("2 weeks"); // 2 weeks

// Modify DateTime instance
$datetime->add($interval);
var_dump($datetime->format('Y-m-d H:i:s')); // 2021-12-16 20:21:12

$interval = new \DateInterval('P14D'); // 14 days
$datetime->sub($interval);
var_dump($datetime->format('Y-m-d H:i:s')); //2021-12-02 20:21:12


/* ------------------- Don't do what Donny Don't Does -------------------
 *
 * $interval = \DateInterval::createFromDateString("two weeks"); // false
 *
 * $interval = new \DateInterval('P2M12S'); //2 months, 12 seconds
 * $datetime->sub($interval);
 * var_dump($datetime->format('Y-m-d H:i:s')); // Fatal error
 *
 * $interval = new \DateInterval('P-14D'); // -14 days
 * $datetime->add($interval);
 * var_dump($datetime->format('Y-m-d H:i:s')); // Fatal error
 */
