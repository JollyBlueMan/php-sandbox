<?php
require '../vendor/autoload.php';

use Ifsnop\Mysqldump as IMysqldump;

$credentials = [];

$credentialsFilters = [
    'host'     => FILTER_SANITIZE_ENCODED,
    'database' => FILTER_SANITIZE_STRING,
    'username' => FILTER_SANITIZE_STRING,
    'password' => FILTER_SANITIZE_STRING
];

$dumperSettings = [
    'add-drop-table'  => true,
    'complete-insert' => true
];

$shortOpts  = "";
$shortOpts .= "d::"; // Database
$shortOpts .= "w::";   // Where

$longOpts = [
    "database::", // Path to database configuration (.php)
    "where::"       // Path to "where" configuration (.json)
];

if ($argc == 1) {
    echoManPage();
} else {
    $options = getopt($shortOpts, $longOpts);

    $database    = $options['d'] ?? $options['database'] ?? false;
    // validate filepath
    if ($database === false) {
        echoManPage();
    } else {
        require $database;
    }

    $credentials = filter_var_array($credentials, $credentialsFilters);
    if ($credentials === false) {
        echoManPage();
    }

    $dumper = new IMysqldump\Mysqldump("mysql:host={$credentials['host']};dbname={$credentials['database']}", $credentials['username'], $credentials['password']);

    $wheres = $options['w'] ?? $options['where'] ?? false;
    // validate filepath
    if ($wheres !== false) {
        $arguments = json_decode(file_get_contents($wheres), JSON_OBJECT_AS_ARRAY);
        // validate/sanitise wheres
        $dumper->setTableWheres($arguments);
    }

    $dumper->setInfoHook(function($object, $info) {
        if ($object === 'table') {
            // change to log
            echo $info['name'], $info['rowCount'];
        }
    });

    $dumper->start('output.sql');

    // log completion
}

function echoManPage() {
    echo("
    Thumper...\r\n
    MySQL dumps with wheres\r\n
    ----------------------------
    -d || --database  Path to php file with database credentials\r\n
    -w || --where     Path to json file with where arguments");
    die;
}
