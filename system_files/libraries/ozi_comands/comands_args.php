<?php

$args = $argv;
array_shift($args); // Remove the script name
$command = $args[0] ?? null; // First argument is the command
$params = array_slice($args, 1); // Remaining arguments are parameters
