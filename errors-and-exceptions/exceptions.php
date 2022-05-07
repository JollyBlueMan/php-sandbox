<?php
// this would be included in index.php
set_exception_handler(function (Exception $exception) {
    $handle = fopen('./log/error_log.txt', 'a');
    fwrite($handle, implode(PHP_EOL, [
        "=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-",
        "Uncaught Exception " . $exception->getCode(),
        "=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-",
        "Error was:",
        $exception->getMessage() . " on line " . $exception->getLine(),
        $exception->getTraceAsString()
    ]));
    fwrite($handle, PHP_EOL);
    fclose($handle);
});

// example of exception in action
$credentials = [];
try {
    //$ try to get credentials
    if (empty($credentials['mysql'])) { //validate credentials exist
        throw new Exception('No credentials provided...');
    }
    $pdo = new PDO('mysql://host='.$credentials['wrong_host'].';db_name='.$credentials['wrong_db']); //attempt mysql login
} catch (PDOException $exception) {
    echo "Caught PDO exception: " . $exception->getMessage() . PHP_EOL; //mysql login failed
    //$ log issue
    //$ report login failure admin
    //$ redirect user with warning
} catch (Exception $exception) {
    echo "Caught generic exception: " . $exception->getMessage() . PHP_EOL; //triggered by "No credentials provided..."
    //$ log issue
    //$ redirect user with warning
} finally {
    $message = isset($exception) ? "failure" : "success";
    echo "Your attempt to log-in was a " . $message . PHP_EOL; //this runs regardless of error state
}

throw new Exception('Random uncaught exception'); // this is logged by the custom handler
