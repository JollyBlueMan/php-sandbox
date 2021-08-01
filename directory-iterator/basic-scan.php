<?php
$it = new DirectoryIterator("glob://{$argv[1]}/*.{$argv[2]}");

foreach($it as $f) {
    printf("%s: %.1FK\n", $f->getFilename(), $f->getSize()/1024);
}

