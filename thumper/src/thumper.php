<?php
require '../vendor/autoload.php';

use Ifsnop\Mysqldump as IMysqldump;

$credentials = [
    'host'     => 'localhost',
    'database' => 'thumper_test',
    'username' => 'test',
    'password' => 'test'
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
    if ($database === false) {
        echoManPage();
    } else {
        require $database;
    }

    //localhost thumper_test test test
    $dumper = new IMysqldump\Mysqldump("mysql:host={$credentials['host']};dbname={$credentials['database']}", $credentials['username'], $credentials['test']);

    $dumper->setInfoHook(function($object, $info) {
        if ($object === 'table') {
            // change to monolog
            echo $info['name'], $info['rowCount'];
        }
    });

    $wheres = $options['w'] ?? $options['where'] ?? false;
    if ($wheres) {
        $dumper->setTableWheres(json_decode($wheres));
    }

    $dumper->start('storage/work/dump.sql');

    // log completion
}

function echoManPage() {
    echo("Thumper...");
    die;
}
