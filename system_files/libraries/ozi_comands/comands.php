<?php

//all functions needed to do the lifting::::::::::::::::
require "functions.php";

$commands = [
    // Starting a new server, default is port 3000
    'serve' => function ($port = "3000") {
        $command = "php -S " . escapeshellarg("localhost") . ":" . escapeshellarg($port);
        exec($command);
    },

    //comand line config for widget installation
    'widget' => function () {
        global $argv;

        if (php_sapi_name() !== 'cli') {
            echo "This script can only be run from the command line.\n";
            return;
        }

        $args = $argv;

        if (count($args) < 4 || $args[1] !== 'widget') {
            echo "Usage:\n";
            echo "  php ozi widget <widgetName> install\n";
            echo "  php ozi widget <widgetName> remove\n";
            return;
        }

        $widgetName = $args[2];
        $action = strtolower($args[3] ?? '');

        $folder = "system_files/widgets";
        $configFile = 'system_config.php';

        if ($action === 'install') {
            installWidget($widgetName, $folder, $configFile);
        } elseif ($action === 'remove') {
            removeWidget($widgetName, $folder, $configFile);
        } else {
            echo "Invalid action. Use 'install' or 'remove'.\n";
        }
    },

    //comand line config for plugin installation
    'plugin' => function () {
        global $argv;

        if (php_sapi_name() !== 'cli') {
            echo "This script can only be run from the command line.\n";
            return;
        }

        $args = $argv;

        if (count($args) < 4 || $args[1] !== 'plugin') {
            echo "Usage:\n";
            echo "  php ozi plugin <pluginName> install\n";
            echo "  php ozi plugin <pluginName> remove\n";
            return;
        }

        $pluginName = $args[2];
        $action = strtolower($args[3] ?? '');

        $folder = "system_files/plugins";
        $configFile = 'system_config.php';

        if ($action === 'install') {
            installPluginFolder($pluginName, $folder, $configFile);
        } elseif ($action === 'remove') {
            removePluginFolder($pluginName, $folder, $configFile);
        } else {
            echo "Invalid action. Use 'install' or 'remove'.\n";
        }
    },







    //comand line config for screens creation
    'screen' => function () {},

];
