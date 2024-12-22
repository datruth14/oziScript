<?php

//functions to handle widget installation and uninstallation
//functions to handle widget installation and uninstallation
//functions to handle widget installation and uninstallation
        function installWidget($widgetName, $folder, $configFile) {
            $githubUser = "datruth14";
            $repository = "oziDependencies";
            $branch = "main";
            $filePathOnGitHub = "dependencies/widgets/" . $widgetName . ".php";
            $url = "https://raw.githubusercontent.com/$githubUser/$repository/$branch/$filePathOnGitHub";

            // Validate widget name
            if (preg_match('/[^a-zA-Z0-9_\-]/', $widgetName)) {
                echo "Invalid widget name: $widgetName\n";
                return;
            }

            // Create folder if it doesn't exist
            if (!is_dir($folder)) {
                mkdir($folder, 0777, true);
                echo "Created folder: $folder\n";
            }

            // Download the widget
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            $fileContent = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($httpCode !== 200 || $fileContent === false) {
                echo "Failed to download the widget. HTTP Code: $httpCode\n";
                return;
            }

            // Save widget to file
            $fileName = $widgetName . ".php";
            $filePath = $folder . DIRECTORY_SEPARATOR . $fileName;
            if (file_put_contents($filePath, $fileContent) === false) {
                echo "Failed to save the widget to $filePath.\n";
                return;
            }
            echo "Widget $widgetName installed successfully.\n";

            // Update system_config.php
            updateConfigFile($configFile, $widgetName, $folder, 'add');
        }

        function removeWidget($widgetName, $folder, $configFile) {
            $fileName = $widgetName . ".php";
            $filePath = $folder . DIRECTORY_SEPARATOR . $fileName;

            // Remove the widget file
            if (file_exists($filePath)) {
                unlink($filePath);
                echo "Widget $widgetName removed successfully.\n";
            } else {
                echo "Widget $widgetName does not exist in the folder.\n";
            }

            // Update system_config.php
            updateConfigFile($configFile, $widgetName, $folder, 'remove');
        }

        function updateConfigFile($configFile, $widgetName, $folder, $action) {
            if (!file_exists($configFile)) {
                echo "Config file not found: $configFile.\n";
                return;
            }

            $configContent = file_get_contents($configFile);
            $fileName = $widgetName . ".php";
            $entry = "        require \"$folder/$fileName\",\n";

            if ($action === 'add') {
                if (strpos($configContent, $entry) !== false) {
                    echo "Widget $widgetName is already included in the config file.\n";
                    return;
                }

                // Locate the widgets array and add the entry
                $pattern = '/(\'widgets\'\s*=>\s*\[\s*\/\*\s*=======\s*GETTING\s*WIDGETS\s*FILES\s*\.\.\.\.\s*============\s*\*\/\s*)/i';
                if (preg_match($pattern, $configContent, $matches, PREG_OFFSET_CAPTURE)) {
                    $insertPosition = $matches[0][1] + strlen($matches[0][0]);
                    $widgetComment = "// Getting $widgetName widget\n";

                    $newContent = substr($configContent, 0, $insertPosition)
                        . $widgetComment
                        . $entry
                        . substr($configContent, $insertPosition);

                    if (file_put_contents($configFile, $newContent) !== false) {
                        echo "Widget $widgetName added to $configFile.\n";
                    } else {
                        echo "Failed to update $configFile.\n";
                    }
                } else {
                    echo "The widgets array was not found in $configFile.\n";
                }
            } elseif ($action === 'remove') {
                if (strpos($configContent, $entry) === false) {
                    echo "Widget $widgetName is not in the config file.\n";
                    return;
                }

                // Remove the entry from the config file
                $configContent = str_replace("// Getting $widgetName widget\n" . $entry, '', $configContent);

                if (file_put_contents($configFile, $configContent) !== false) {
                    echo "Widget $widgetName removed from $configFile.\n";
                } else {
                    echo "Failed to update $configFile.\n";
                }
            }
        }



        
//functions to handle plugin installation and uninstallation
//functions to handle plugin installation and uninstallation
//functions to handle plugin installation and uninstallation
        function installPluginFolder($pluginName, $folder, $configFile) {
            $githubUser = "datruth14";
            $repository = "oziDependencies";
            $branch = "main";
            $apiUrl = "https://api.github.com/repos/$githubUser/$repository/contents/dependencies/plugins/$pluginName?ref=$branch";

            echo "Fetching plugin folder from GitHub API: $apiUrl\n";

            // Recursively download the folder and its contents
            downloadFolderRecursively($apiUrl, $folder . DIRECTORY_SEPARATOR . $pluginName);

            // Update system_config.php
            updatePluginConfigFile($configFile, $pluginName, $folder, 'add');
        }

        function removePluginFolder($pluginName, $folder, $configFile) {
            $pluginFolder = $folder . DIRECTORY_SEPARATOR . $pluginName;

            // Remove the plugin folder
            if (is_dir($pluginFolder)) {
                $files = new RecursiveIteratorIterator(
                    new RecursiveDirectoryIterator($pluginFolder, RecursiveDirectoryIterator::SKIP_DOTS),
                    RecursiveIteratorIterator::CHILD_FIRST
                );

                foreach ($files as $file) {
                    $file->isFile() ? unlink($file->getRealPath()) : rmdir($file->getRealPath());
                }

                rmdir($pluginFolder);
                echo "Plugin $pluginName removed successfully.\n";
            } else {
                echo "Plugin $pluginName does not exist in the folder.\n";
            }

            // Update system_config.php
            updatePluginConfigFile($configFile, $pluginName, $folder, 'remove');
        }

        function downloadFolderRecursively($apiUrl, $localFolder) {
            // Fetch directory contents from GitHub API
            $ch = curl_init($apiUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            curl_setopt($ch, CURLOPT_USERAGENT, 'PHP');
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($httpCode !== 200) {
                echo "Failed to fetch directory from GitHub. HTTP Code: $httpCode\n";
                return;
            }

            $files = json_decode($response, true);

            if (!is_array($files)) {
                echo "Invalid response from GitHub API.\n";
                return;
            }

            // Ensure local folder exists
            if (!is_dir($localFolder)) {
                mkdir($localFolder, 0777, true);
                echo "Created folder: $localFolder\n";
            }

            foreach ($files as $file) {
                if ($file['type'] === 'file') {
                    $fileUrl = $file['download_url'];
                    $fileName = $localFolder . DIRECTORY_SEPARATOR . $file['name'];

                    echo "Downloading file: $fileUrl\n";

                    $fileContent = file_get_contents($fileUrl);
                    if ($fileContent === false) {
                        echo "Failed to download file: $fileUrl\n";
                        continue;
                    }

                    file_put_contents($fileName, $fileContent);
                    echo "Saved file: $fileName\n";
                } elseif ($file['type'] === 'dir') {
                    $subfolderUrl = $file['url'];
                    $subfolderLocal = $localFolder . DIRECTORY_SEPARATOR . $file['name'];
                    downloadFolderRecursively($subfolderUrl, $subfolderLocal);
                }
            }
        }

        function updatePluginConfigFile($configFile, $pluginName, $folder, $action) {
            $entry = "        require \"$folder/$pluginName/index.php\",\n";
            $comment = "// Getting $pluginName plugin\n";

            if (!file_exists($configFile)) {
                echo "Config file not found: $configFile.\n";
                return;
            }

            $configContent = file_get_contents($configFile);

            if ($action === 'add') {
                // Check if 'plugins' array exists and if not, create it
                $pattern = '/\'plugins\'\s*=>\s*\[\s*\/\*\s*=======\s*GETTING\s*PLUGIN\s*FILES\s*\.\.\.\.\s*============\s*\*\/\s*/i';
                if (preg_match($pattern, $configContent, $matches, PREG_OFFSET_CAPTURE)) {
                    $insertPosition = $matches[0][1] + strlen($matches[0][0]);
                    $newContent = substr($configContent, 0, $insertPosition)
                        . $comment
                        . $entry
                        . substr($configContent, $insertPosition);

                    if (file_put_contents($configFile, $newContent) !== false) {
                        echo "Plugin $pluginName added to $configFile.\n";
                    } else {
                        echo "Failed to update $configFile.\n";
                    }
                } else {
                    echo "'plugins' array not found. Creating it...\n";
                    // Add 'plugins' array if not present
                    $configContent = str_replace(
                        "'widgets' => [",
                        "'widgets' => [\n    'plugins' => [\n        /*=======  GETTING PLUGIN FILES ....  ============*/\n    ],",
                        $configContent
                    );

                    // Now add the plugin entry
                    $configContent = str_replace(
                        "'plugins' => [",
                        "'plugins' => [\n    /*=======  GETTING PLUGIN FILES ....  ============*/\n    $comment$entry",
                        $configContent
                    );

                    if (file_put_contents($configFile, $configContent) !== false) {
                        echo "Plugin $pluginName added to $configFile.\n";
                    } else {
                        echo "Failed to update $configFile.\n";
                    }
                }
            } elseif ($action === 'remove') {
                if (strpos($configContent, $entry) === false) {
                    echo "Plugin $pluginName is not in the config file.\n";
                    return;
                }

                $configContent = str_replace($comment . $entry, '', $configContent);

                if (file_put_contents($configFile, $configContent) !== false) {
                    echo "Plugin $pluginName removed from $configFile.\n";
                } else {
                    echo "Failed to update $configFile.\n";
                }
            }
        }



