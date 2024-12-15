<?php

$commands = [
    // Starting a new server, default is port 3000
    'serve' => function ($port = "3000") {
        $command = "php -S " . escapeshellarg("localhost") . ":" . escapeshellarg($port);
        exec($command);
    },

    'widget' => function ($widgetName, $folder = "system_files/widgets") {
        // Step 1: Construct the GitHub raw URL dynamically
        $githubUser = "datruth14"; // Replace with the GitHub username
        $repository = "oziDependencies"; // Replace with the repository name
        $branch = "main"; // Replace with the branch name (e.g., main, master, etc.)
        $filePathOnGitHub = "dependencies/widgets/" . $widgetName . ".php"; // Update to your repo's widget path
        $url = "https://raw.githubusercontent.com/$githubUser/$repository/$branch/$filePathOnGitHub";

        // Debug: Show the URL
        echo "Downloading widget from GitHub URL: $url\n";

        // Step 2: Create the folder if it doesn't exist
        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
            echo "Created folder: $folder\n";
        }

        // Step 3: Define file paths
        $fileName = $widgetName . ".php";
        $filePath = $folder . DIRECTORY_SEPARATOR . $fileName;

        // Step 4: Download the file using cURL
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30); // Set a timeout
        $fileContent = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch); // Capture any cURL errors
        curl_close($ch);

        // Debug: Check HTTP response and cURL errors
        if ($httpCode !== 200 || $fileContent === false) {
            echo "Failed to download the widget: $widgetName from $url.\n";
            echo "HTTP Code: $httpCode\n";
            echo "cURL Error: $curlError\n";
            return;
        }

        // Step 5: Write the content to the file
        $writeStatus = file_put_contents($filePath, $fileContent);
        if ($writeStatus === false) {
            echo "Failed to write the widget content to: $filePath.\n";
            return;
        }

        echo "Widget downloaded and saved to: $filePath\n";

        // Step 6: Update system_config.php
        $configFile = 'system_config.php';
        if (!file_exists($configFile)) {
            echo "The system_config.php file does not exist.\n";
            return;
        }

        $configContent = file_get_contents($configFile);

        // Prepare the comment and array entry
        $widgetComment = "// Getting $widgetName widget\n";
        $arrayEntry = "        require \"$folder/$fileName\",\n";

        // Locate the widgets array
        $pattern = '/(\'widgets\'\s*=>\s*\[\s*\/\*=======\s*GETTING\s*WIDGETS\s*FILES\s*\.\.\.\.\s*============\*\/\s*)/i';
        if (preg_match($pattern, $configContent, $matches, PREG_OFFSET_CAPTURE)) {
            // Insert the comment and entry after the matched start of the array
            $insertPosition = $matches[0][1] + strlen($matches[0][0]);
            $newContent = substr($configContent, 0, $insertPosition)
                . $widgetComment
                . $arrayEntry
                . substr($configContent, $insertPosition);

            $fileWriteStatus = file_put_contents($configFile, $newContent);
            if ($fileWriteStatus === false) {
                echo "Failed to update the config file: $configFile.\n";
                return;
            }

            echo "The widget has been added to the widgets array in $configFile with an appropriate comment.\n";
        } else {
            echo "The widgets array was not found in $configFile.\n";
        }
    },




    'plugin' => function ($pluginName, $folder = "system_files/plugins") {},
];
