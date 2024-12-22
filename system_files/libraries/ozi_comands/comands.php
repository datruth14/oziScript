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
            // Step 1: Append the function to view.php with spacing
            $functionContent = "function $screenName() {\n    //require \"$dbConfigPath\";\n    require \"$componentsFolder/$screenName.php\";\n}\n\n\n";

            if (!file_exists($viewFile)) {
                echo "The file $viewFile does not exist. Creating it...\n";
                file_put_contents($viewFile, "<?php\n\n" . $functionContent);
            } else {
                $viewContent = file_get_contents($viewFile);
                if (strpos($viewContent, "function $screenName()") !== false) {
                    echo "The function $screenName already exists in $viewFile.\n";
                } else {
                    file_put_contents($viewFile, $functionContent, FILE_APPEND);
                    echo "Function $screenName added to $viewFile with appropriate spacing.\n";
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
                file_put_contents($screenFile, "<?php $screenName(); // calling $screenName component ?>");
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


    //comand line config 
    'build' => function () {
        global $argv;

        if (php_sapi_name() !== 'cli') {
            echo "This script can only be run from the command line.\n";
            return;
        }

        $args = $argv;

        if (count($args) < 3 || $args[1] !== 'build') {
            echo "Usage:\n";
            echo "  php ozi build android\n";
            echo "  php ozi build ios\n";
            echo "  php ozi build mac\n";
            echo "  php ozi build windows\n";
            echo "  php ozi build linux\n";
            return;
        }

        $platform = strtolower($args[2]);

        // Function to check and install missing tools
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

        switch ($platform) {
            case 'android':
                $ensureTools([
                    'cordova' => 'npm install -g cordova',
                    'java' => 'sudo apt install default-jdk -y || brew install openjdk',
                    'android' => 'echo "Please install the Android SDK manually if not already installed."'
                ]);
                echo "Building for Android...\n";
                shell_exec("cordova build android");
                echo "Android build completed. APK is in the 'platforms/android/app/build/outputs/apk' folder.\n";
                break;

            case 'ios':
                $ensureTools([
                    'cordova' => 'npm install -g cordova',
                    'xcodebuild' => 'echo "Xcode needs to be installed from the App Store."'
                ]);
                echo "Building for iOS...\n";
                shell_exec("cordova build ios");
                echo "iOS build completed. Use Xcode to finalize and deploy the app.\n";
                break;

            case 'mac':
                $ensureTools([
                    'electron-packager' => 'npm install -g electron-packager'
                ]);
                echo "Building for macOS...\n";
                shell_exec("electron-packager . MyApp --platform=darwin");
                echo "macOS build completed. Check the output folder for the app.\n";
                break;

            case 'windows':
                $ensureTools([
                    'electron-packager' => 'npm install -g electron-packager'
                ]);
                echo "Building for Windows...\n";
                shell_exec("electron-packager . MyApp --platform=win32");
                echo "Windows build completed. Check the output folder for the app.\n";
                break;

            case 'linux':
                $ensureTools([
                    'electron-packager' => 'npm install -g electron-packager'
                ]);
                echo "Building for Linux...\n";
                shell_exec("electron-packager . MyApp --platform=linux");
                echo "Linux build completed. Check the output folder for the app.\n";
                break;

            default:
                echo "Unsupported platform: $platform\n";
                echo "Supported platforms: android, ios, mac, windows, linux.\n";
                break;
        }
    },




];
