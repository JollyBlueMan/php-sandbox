<?php
date_default_timezone_set('Europe/London');

// Iterate over date period
$dateStart    = new \DateTime();
$dateInterval = new \DateInterval('P2W');
$datePeriod   = new \DatePeriod($dateStart, $dateInterval, 3);
foreach ($datePeriod as $date) {
    var_dump($date->format('Y-m-d')); // Today & 3 dates (2 weeks apart)
}

// Iterate over date period with specified end time
$dateStart    = new \DateTime('2001-01-01 00:00:00');
$dateEnd      = new \DateTime('2001-02-02 00:00:00');
$dateInterval = new \DateInterval('P2W');
$datePeriod   = new \DatePeriod($dateStart, $dateInterval, $dateEnd);
foreach ($datePeriod as $date) {
    var_dump($date->format('Y-m-d')); // "2001-01-01" & 2 weeks after
}

// Iterate over date period, ignoring start
$dateStart    = new \DateTime();
$dateInterval = new \DateInterval('P1D');
$datePeriod   = new \DatePeriod($dateStart, $dateInterval, 3, \DatePeriod::EXCLUDE_START_DATE);
foreach ($datePeriod as $date) {
    var_dump($date->format('Y-m-d')); // The next 3 days
}
