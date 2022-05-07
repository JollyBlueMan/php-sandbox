<?php

// Turn off all error reporting
//error_reporting(0); // \Exception: Call to undefined function someNoneExistentFunction()

// Report simple running errors
//error_reporting(E_ERROR | E_WARNING | E_PARSE); // \ErrorException: Undefined variable $someNotSetVariable

// Reporting E_NOTICE can be good too (to report uninitialized
// variables or catch variable name misspellings ...)
//error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE); // \ErrorException: Undefined variable $someNotSetVariable

// Report all errors except E_NOTICE
//error_reporting(E_ALL & ~E_NOTICE); // \ErrorException: Undefined variable $someNotSetVariable

// Report all PHP errors
error_reporting(E_ALL); // \ErrorException: Undefined variable $someNotSetVariable

// Report all PHP errors
//error_reporting(-1); // \ErrorException: Undefined variable $someNotSetVariable

set_error_handler(function ($errno, $errstr, $errfile, $errline) {
    if (!(error_reporting() & $errno)) {
        // Error is not specified in the error_reporting settings, so we ignore it
        return;
    }

    $handle = fopen('./log/error_log.txt', 'a');
    fwrite($handle, implode(PHP_EOL, [
        "=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-",
        "Error Exception " . $errno,
        "=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-",
        "Error was:",
        $errstr . " on line " . $errline,
        $errfile
    ]));
    fwrite($handle, PHP_EOL);
    fclose($handle);

    throw new \ErrorException($errstr, $errno, 0, $errfile, $errline);
});


try {
    echo $someNotSetVariable; // Try terminates here and throws \ErrorException
    someNoneExistentFunction();
} catch (\ErrorException $e) {
    echo "Error Exception" . PHP_EOL . $e->getMessage() . PHP_EOL ; // Undefined variable $someNotSetVariable
} catch (Throwable $e) {
    echo "Exception" . PHP_EOL . $e->getMessage() . PHP_EOL ;
}

echo "That's that" . PHP_EOL;

echo PHP_EOL . PHP_EOL . PHP_EOL;

restore_error_handler(); // Restore previous handler to be polite

