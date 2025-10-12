<?php
function ScreenRouter() {
    if (isset($_GET['s'])) {
        $screen = basename($_GET['s']);
        $file = "screens/" . $screen . ".ozi";

        if (file_exists($file)) {
            include $file;
        } else {
            echo '
            <div style="min-height: 100vh;" class="page-wrap d-flex flex-row align-items-center">
              <div class="container text-center">
                <span class="display-1 d-block">404</span>
                <div class="mb-4 lead">The page you are looking for was not found.</div>
                <a href="./" class="btn btn-link">Back to Home</a>
              </div>
            </div>';
        }
    } else {
        homepage();
    }
}
?>
