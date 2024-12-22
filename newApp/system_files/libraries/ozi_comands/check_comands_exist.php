<?php 

if (isset($commands[$command])) {
    call_user_func_array($commands[$command], $params);
} else {
    echo "Command '$command' not found.\n";
    echo "Available commands are:\n";
    foreach (array_keys($commands) as $cmd) {
        echo "  - $cmd\n";
    }

    
}