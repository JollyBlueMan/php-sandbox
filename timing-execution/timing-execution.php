<?php

/** From unix timestamp */
$m = -microtime(true);

// do something

$m += microtime(true);
$m_execution_time_milliseconds = ($m * 1000);


/** From high resolution time (more accurate for performance) */
$h = -hrtime(true);

// do something

$h += hrtime(true);
$h_execution_time_milliseconds = ($h / 1e+6);

