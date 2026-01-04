<?php

function ScreenRouter()
{
  // Support for Pretty URLs
  $requestUri = $_SERVER['REQUEST_URI'];
  $baseDir = dirname($_SERVER['SCRIPT_NAME']);

  // Remove baseDir from the start of the requestUri
  if ($baseDir !== "/" && strpos($requestUri, $baseDir) === 0) {
    $path = substr($requestUri, strlen($baseDir));
  } else {
    $path = $requestUri;
  }

  $path = trim(explode('?', $path)[0], '/');
  $urlParts = explode('/', $path);

  // If path is empty, default to homepage or use ?s= query param
  if (empty($path)) {
    if (isset($_GET['s'])) {
      $screenName = $_GET['s'];
    } else {
      homepage();
      return;
    }
  } else {
    $screenName = array_shift($urlParts);
    // Populate $_GET with remaining path parts as key/value pairs
    for ($i = 0; $i < count($urlParts); $i += 2) {
      if (isset($urlParts[$i]) && isset($urlParts[$i + 1])) {
        $_GET[$urlParts[$i]] = $urlParts[$i + 1];
      }
    }
  }

  // Handle sanitization and loading
  $screen = preg_replace('/[^a-zA-Z0-9_\-]/', '', $screenName);

  if (!empty($screen) && file_exists("screens/" . $screen)) {
    require "screens/" . $screen;
  } else {
    if (file_exists("screens/404")) {
      require "screens/404";
    } else {
      echo '
        <div style="min-height: 100vh;" class="page-wrap d-flex flex-row align-items-center">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-md-12 text-center">
                <span class="display-1 d-block">404</span>
                <div class="mb-4 lead">The page you are looking for was not found.</div>
                <a href="./" class="btn btn-link">Back to Home</a>
              </div>
            </div>
          </div>
        </div>';
    }
  }
}
