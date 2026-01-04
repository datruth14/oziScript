<?php
/**
 * Ozi Script Base UI Kit
 * Standardized high-quality widgets for quick app assembly.
 */

/**
 * Modern Navigation Bar
 */
function ozi_nav_simple($brand = "oziScript", $links = ['Home' => '/', 'About' => '/about']) {
    echo '
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm sticky-top animate__animated animate__fadeInDown">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">' . $brand . '</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav01">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="nav01">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">';
                foreach ($links as $label => $url) {
                    echo '<li class="nav-item"><a class="nav-link text-uppercase font-monospace" style="font-size: 0.85rem;" href="' . $url . '">' . $label . '</a></li>';
                }
    echo '      </ul>
            </div>
        </div>
    </nav>';
}

/**
 * Modern Hero Section
 */
function ozi_hero_modern($title = "Build Hybrid Apps Effortlessly", $desc = "The first framework designed for creators who hate complex coding. Use simple functions to build beautiful experiences.", $cta = "Get Started", $img = "assets/media/images/icons/android-chrome-192x192.png") {
    echo '
    <div class="container col-xxl-8 px-4 py-5">
        <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
            <div class="col-10 col-sm-8 col-lg-6 animate__animated animate__fadeInRight">
                <img src="' . $img . '" class="d-block mx-lg-auto img-fluid animate__animated animate__pulse animate__infinite animate__slow" alt="Hero Image" width="400" loading="lazy">
            </div>
            <div class="col-lg-6 animate__animated animate__fadeInLeft">
                <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3">' . $title . '</h1>
                <p class="lead">' . $desc . '</p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                    <button type="button" class="btn btn-primary btn-lg px-4 me-md-2 shadow-sm">' . $cta . '</button>
                    <button type="button" class="btn btn-outline-secondary btn-lg px-4 border-2">Documentation</button>
                </div>
            </div>
        </div>
    </div>';
}

/**
 * Clean Professional Footer
 */
function ozi_footer_clean($copyright = "oziScript Framework") {
    echo '
    <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top animate__animated animate__fadeInUp">
            <p class="col-md-4 mb-0 text-body-secondary">&copy; ' . date("Y") . ' ' . $copyright . '</p>

            <a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                <img src="assets/media/images/icons/favicon-32x32.png" alt="logo" width="30">
            </a>

            <ul class="nav col-md-4 justify-content-end">
                <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Privacy</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Terms</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Contact</a></li>
            </ul>
        </footer>
    </div>';
}
