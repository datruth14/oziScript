<?php 

$commands = [
    // Starting a new server, default is port 3000
    'serve' => function ($port = "3000") {
        $command = "php -S " . escapeshellarg("localhost") . ":" . escapeshellarg($port);
        exec($command);
    },

    'widget' => function ($widgetName, $folder = "system_files/widgets") {
        // Step 1: Construct the URL dynamically based on the widget name
        $baseUrl = "https://vomp.ng/dependencies/widgets/";
        $url = $baseUrl . $widgetName . ".php";

        // Step 2: Create the folder if it doesn't exist
        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        // Step 3: Define file paths
        $fileName = $widgetName . ".php";
        $filePath = $folder . DIRECTORY_SEPARATOR . $fileName;

        // Step 4: Download the file and save it
        $fileContent = file_get_contents($url);
        if ($fileContent === false) {
            echo "Failed to download the widget: $widgetName from $url.\n";
            return;
        }
        file_put_contents($filePath, $fileContent);

        echo "Widget downloaded to: $filePath\n";

        // Step 5: Update system_config.php
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

            file_put_contents($configFile, $newContent);
            echo "The widget has been added to the widgets array in $configFile with an appropriate comment.\n";
        } else {
            echo "The widgets array was not found in $configFile.\n";
        }
    },
];
