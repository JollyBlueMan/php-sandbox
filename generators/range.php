<?php
// From https://alanstorm.com/php-generators-from-scratch/

# 1. Define a Generator Function
function generator_range($min, $max)
{
    #3b. Start executing once `current`'s been called
    for ($i = $min; $i <= $max; $i++) {
        echo "Starting Loop", "\n";
        yield $i;   #3c. Return execution to the main program
        #4b. Return execution to the main program again
        #4a. Resume exection when `next is called
        echo "Ending Loop", "\n";
    }
}

#2. Call the generator function
$generator = generator_range(1, 5);

#3a. Call the `current` method on the generator function
echo $generator->current(), "\n";

#4a. Resume execution and call `next` on the generator object
$generator->next();

#5 echo out value we yielded when calling `next` above
echo $generator->current(), "\n";

// give this a try when you have some free time
// foreach(generator_range(1, 5) as $value) {
//    echo $value, "\n";
// }