<?php

// Opens a remote log via sftp & searches for lines containing a string
$username = "admin";
$password = "passw0rd";
$domain   = "secure-site.com";

$dateStart    = new \DateTime();
$dateInterval = \DateInterval::createFromDateString("-1 day");
$datePeriod   = new \DatePeriod($dateStart, $dateInterval, 30);

foreach ($datePeriod as $date) {
    $file = "sftp://{$username}:{$password}@{$domain}/path/to/auth-" . $date->format('Y-m-d') . ".log.gz";

    if (file_exists($file)) {
        $handle = fopen($file, 'rb');
        stream_filter_append($handle, 'zlib.inflate');

        while (feof($handle) !== true) {
            $line = fgets($handle);
            if (strpos($line, "agent.smith@secure-site.com")) {
                fwrite(STDOUT, $line);
            }
        }
    }
}