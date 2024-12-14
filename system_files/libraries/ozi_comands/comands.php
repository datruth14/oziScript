<?php 

$commands = [
    'hello' => function () {
        echo "Hello, World!\n";
    },
    'greet' => function ($name = 'Guest') {
        echo "Hello, $name!\n";
    },
    'sum' => function ($a, $b) {
        echo "The sum of $a and $b is " . ($a + $b) . "\n";
    },
];

