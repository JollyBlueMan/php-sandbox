<?php
// Defaults
$path = "./";
$type = "*";

// CLI Options
$shortopts  = "";
$shortopts .= "p::"; // Path
$shortopts .= "t::"; // Type
$shortopts .= "s::"; // Search for...
$shortopts .= "e";   // Exact match (search)
$shortopts .= "o";   // Output file contents

$longopts  = [
    "path::",   // Path
    "type::",   // Type
    "search::", // Search for...
    "exact",    // Exact match (search)
    "output",   // Output file contents
];

// Script
function getLines($file) {
    $f = fopen($file, 'r');
    try {
        while ($line = fgets($f)) {
            yield $line;
        }
    } finally {
        fclose($f);
    }
}

if ($argc == 1) {
    print(
        "
        Search for/in files 
        ---------------------------------------\n
        -p (--path)   = Path/to/directory to search in
        -t (--type)   = Type of file (extension)
        -s (--search) = String to search for
        -e (--exact)  = Exact match (for search)
        -o (--output) = Output file contents
        \n\n"
    );
} else {
    $options    = getopt($shortopts, $longopts);
    $path      .= $options['p'] ?? $options['path'] ?? "";
    $type       = $options['t'] ?? $options['type'] ?? "*";
    $search     = $options['s'] ?? $options['search'] ?? false;
    $exactMatch = array_key_exists('e', $options) ?? array_key_exists('exact', $options);
    $output     = array_key_exists('o', $options) ?? array_key_exists('output', $options);

    $it = new DirectoryIterator("glob://{$path}/*.{$type}");

    foreach($it as $f) {
        $printInfo = false;

        if ($search) {
            foreach (getLines($f->getPath() . $f->getFilename()) as $n => $line) {
                if (!$exactMatch) {
                    $line   = strtolower($line);
                    $search = strtolower($search);
                }
                if (strpos($line, $search)) {
                    $printInfo = true;
                }
            }
        } else {
            $printInfo = true;
        }

        if ($printInfo) {
            printf("%s: %.1FK\n", $f->getFilename(), $f->getSize()/1024);

            if ($output) {
                $count = 0;
                foreach (getLines($f->getPath() . $f->getFilename()) as $n => $line) {
                    printf("%s: %s\n",$count, $line);
                    $count++;
                }
            }
        }
    }
}
