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
    'screen' => function () {
        global $argv;

        if (php_sapi_name() !== 'cli') {
            echo "This script can only be run from the command line.\n";
            return;
        }

        $args = $argv;

        if (count($args) < 4 || $args[1] !== 'screen') {
            echo "Usage:\n";
            echo "  php ozi screen <screenName> create\n";
            echo "  php ozi screen <screenName> delete\n";
            return;
        }

        $screenName = $args[2];
        $action = strtolower($args[3]); // 'create' or 'delete'
    
        $viewFile = 'view.php';
        $componentsFolder = 'components';
        $screensFolder = 'screens';
        $dbConfigPath = "system_files/libraries/db_config.php";

        if ($action === 'create') {
            // Ensure function name is valid (PHP functions can't start with numbers)
            $functionName = preg_match('/^[0-9]/', $screenName) ? "screen_$screenName" : $screenName;

            // Step 1: Append the function to view.php with spacing
            $functionContent = "function $functionName() {\n    //require \"$dbConfigPath\";\n    require \"$componentsFolder/$screenName.php\";\n}\n\n\n";

            if (!file_exists($viewFile)) {
                echo "The file $viewFile does not exist. Creating it...\n";
                file_put_contents($viewFile, "<?php\n\n" . $functionContent);
            } else {
                $viewContent = file_get_contents($viewFile);
                if (strpos($viewContent, "function $functionName()") !== false) {
                    echo "The function $functionName already exists in $viewFile.\n";
                } else {
                    file_put_contents($viewFile, $functionContent, FILE_APPEND);
                    echo "Function $functionName added to $viewFile with appropriate spacing.\n";
                }
            }

            // Step 2: Create components file
            $componentFile = "$componentsFolder/$screenName.php";
            if (!is_dir($componentsFolder)) {
                mkdir($componentsFolder, 0777, true);
                echo "Created folder: $componentsFolder\n";
            }

            if (!file_exists($componentFile)) {
                file_put_contents($componentFile, "<?php\n// This is the $screenName component.\n");
                echo "Created component file: $componentFile\n";
            } else {
                echo "Component file $componentFile already exists.\n";
            }

            // Step 3: Create screens file (without an extension)
            if (!is_dir($screensFolder)) {
                mkdir($screensFolder, 0777, true);
                echo "Created folder: $screensFolder\n";
            }

            $screenFile = "$screensFolder/$screenName"; // File without extension
            if (!file_exists($screenFile)) {
                file_put_contents($screenFile, "<?php $functionName(); // calling $screenName component ?>");
                echo "Created screen file: $screenFile (no extension)\n";
            } else {
                echo "Screen file $screenFile already exists.\n";
            }
        } elseif ($action === 'delete') {
            // Step 1: Remove the function from view.php
            if (file_exists($viewFile)) {
                $viewContent = file_get_contents($viewFile);
                $functionPattern = "/function $screenName\(\) \{[^\}]+\}\n\n\n/s";

                if (preg_match($functionPattern, $viewContent)) {
                    $updatedViewContent = preg_replace($functionPattern, '', $viewContent);
                    file_put_contents($viewFile, $updatedViewContent);
                    echo "Function $screenName removed from $viewFile.\n";
                } else {
                    echo "The function $screenName was not found in $viewFile.\n";
                }
            } else {
                echo "The file $viewFile does not exist.\n";
            }

            // Step 2: Remove components file
            $componentFile = "$componentsFolder/$screenName.php";
            if (file_exists($componentFile)) {
                unlink($componentFile);
                echo "Deleted component file: $componentFile\n";
            } else {
                echo "Component file $componentFile does not exist.\n";
            }

            // Step 3: Remove screens file (without an extension)
            $screenFile = "$screensFolder/$screenName";
            if (file_exists($screenFile)) {
                unlink($screenFile);
                echo "Deleted screen file: $screenFile (no extension)\n";
            } else {
                echo "Screen file $screenFile does not exist.\n";
            }
        } else {
            echo "Invalid action. Use 'create' or 'delete'.\n";
        }
    },


    // Command-line config for backend requests
    'create_bk_request' => function () {
        global $argv;
        if (!isset($argv[2])) {
            echo "Usage: php ozi create_bk_request <request_name>\n";
            return;
        }
        create_bk_request($argv[2]);
    },


    // Command-line config for backend requests delete
    'delete_bk_request' => function () {
        global $argv;
        if (!isset($argv[2])) {
            echo "Usage: php ozi delete_bk_request <request_name>\n";
            return;
        }
        delete_bk_request($argv[2]);
    },

    //comand line to build/package apps
    'build' => function () {
        global $argv;

        if (php_sapi_name() !== 'cli') {
            echo "This script can only be run from the command line.\n";
            return;
        }

        $args = $argv;

        if (count($args) < 3 || $args[1] !== 'build') {
            echo "Usage:\n";
            echo "  php ozi build apk [url]\n";
            echo "  php ozi build ios [url]\n";
            echo "  php ozi build mac [url]\n";
            echo "  php ozi build windows [url]\n";
            echo "  php ozi build linux [url]\n";
            return;
        }

        $platform = strtolower($args[2]);

        if (!in_array($platform, ['apk', 'ios', 'mac', 'windows', 'linux'])) {
            echo "Unsupported platform: $platform\n";
            echo "Supported platforms: apk, ios, mac, windows, linux.\n";
            return;
        }

        if (count($args) < 4) {
            echo "Error: Please provide a URL for the build.\n";
            echo "Example: php ozi build $platform https://websitename.com\n";
            return;
        }

        $url = $args[3];

        // Function to ensure required tools are installed
        $ensureTools = function ($commands) {
            foreach ($commands as $command => $installCommand) {
                if (!shell_exec("command -v $command")) {
                    echo "Tool '$command' is missing. Installing...\n";
                    shell_exec($installCommand);
                    if (!shell_exec("command -v $command")) {
                        echo "Failed to install '$command'. Please install it manually.\n";
                        exit(1);
                    }
                    echo "Tool '$command' installed successfully.\n";
                }
            }
        };

        // Function to initialize Electron project
        $initializeElectronProject = function () use ($url) {
            if (!file_exists('package.json')) {
                echo "Initializing Electron project...\n";

                $packageJson = [
                    'name' => 'myapp',
                    'version' => '1.0.0',
                    'main' => 'main.js',
                    'dependencies' => [],
                    'devDependencies' => [
                        'electron' => '^23.1.1',
                        'electron-packager' => '^17.1.1'
                    ]
                ];

                file_put_contents('package.json', json_encode($packageJson, JSON_PRETTY_PRINT));

                // Create a basic Electron main process file
                $mainJs = <<<JS
            const { app, BrowserWindow } = require('electron');

            function createWindow() {
                const win = new BrowserWindow({
                    width: 800,
                    height: 600,
                    webPreferences: {
                        nodeIntegration: true
                    }
                });

                win.loadURL('$url');
            }

            app.on('ready', createWindow);
            JS;
                file_put_contents('main.js', $mainJs);

                echo "Installing dependencies...\n";
                shell_exec("npm install");
            }
        };

        switch ($platform) {
            case 'mac':
            case 'windows':
            case 'linux':
                $ensureTools([
                    'npm' => 'sudo apt install npm -y || brew install npm',
                    'electron-packager' => 'npm install -g electron-packager'
                ]);
                $initializeElectronProject();

                echo "Building for $platform...\n";
                $command = "electron-packager . MyApp --platform=$platform";
                shell_exec($command);

                $outputDir = "./MyApp-$platform";
                if (is_dir($outputDir)) {
                    echo ucfirst($platform) . " app built successfully in '$outputDir'.\n";
                } else {
                    echo "Error: Failed to build for $platform. Check logs for details.\n";
                }
                break;

            default:
                echo "Error: Platform $platform is not yet supported with Electron.\n";
                break;
        }
    },



];
