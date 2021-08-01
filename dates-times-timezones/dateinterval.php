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

/* $interval = \DateInterval::createFromDateString("two weeks"); // false
 *
 * $interval = new \DateInterval('P2M12S'); //2 months, 12 seconds
 * $datetime->sub($interval);
 * var_dump($datetime->format('Y-m-d H:i:s')); // Fatal error
 *
 * $interval = new \DateInterval('P-14D'); // -14 days
 * $datetime->add($interval);
 * var_dump($datetime->format('Y-m-d H:i:s')); // Fatal error
 */

// Inverted interval
$dateStart    = new \DateTime();
$dateInterval = \DateInterval::createFromDateString('-1 day');
$datePeriod   = new \DatePeriod($dateStart, $dateInterval, 3);
foreach ($datePeriod as $date) {
    var_dump($date->format('Y-m-d'));
}
/* string(10) "2021-08-01"
 * string(10) "2021-07-31"
 * string(10) "2021-07-30"
 * string(10) "2021-07-29"
 */

