<?php

function ScreenRouter()
{
    // Output the required JavaScript once
    echo '
    <script>
      function linkTo(page, query = "") {
        const fullURL = "?s=" + page + query;
        history.pushState(null, "", fullURL);
        loadPage(fullURL);
      }

      function loadPage(url) {
        fetch(url)
          .then(response => response.text())
          .then(data => {
            const parser = new DOMParser();
            const html = parser.parseFromString(data, "text/html");
            const appContent = html.querySelector("#app");
            if (appContent) {
              document.querySelector("#app").innerHTML = appContent.innerHTML;
            }
          })
          .catch(error => {
            document.querySelector("#app").innerHTML = "<p>Error loading page.</p>";
            console.error("Load error:", error);
          });
      }

      window.addEventListener("popstate", () => {
        loadPage(location.search);
      });
    </script>
    ';

    // Start the app wrapper
    echo '<div id="app">';

    // Get the screen name from URL
    if (isset($_GET['s'])) {
        $screen = $_GET['s'];
        $screenPath = "screens/{$screen}";

        if (file_exists($screenPath)) {
            require_once $screenPath;

            if (function_exists($screen)) {
                $screen(); // Call the screen's function (e.g. home())
            } else {
                echo "<p>Function <strong>{$screen}()</strong> not found in <code>{$screenPath}</code>.</p>";
            }
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

    } else {
        // Default page (home)
        homepage();
    }

    // Close the app wrapper
    echo '</div>';
}

// linkTo function as a global helper
function linkTo($page, $query = '')
{
    return "javascript:linkTo('{$page}', '{$query}')";
}
