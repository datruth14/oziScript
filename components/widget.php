<?php
/**
 * Demo: Advanced Ozi UI Gallery
 * This screen showcases the premium-feel advanced widgets.
 */

// 1. Navigation
ozi_nav_simple("Ozi Advanced", [
    "Home" => linkTo("homepage"),
    "Cyberpunk" => "#cyber",
    "Aurora" => "#aurora",
    "Glass" => "#glass"
]);

// 2. Cyberpunk Section
echo '<div id="cyber">';
heroSection5(
    title: "OZI SCRIPT",
    subTitle: "PUSH THE LIMITS OF THE WEB",
    btnText: "LAUNCH CONSOLE"
);
echo '</div>';

// 3. Aurora Section
echo '<div id="aurora">';
heroSection11(
    title: "Fluid Experiences",
    subTitle: "Beautiful moving gradients for modern SaaS landing pages.",
    btnText: "Explore Aurora"
);
echo '</div>';

// 4. Glassmorphism Section
echo '<div id="glass">';
heroSection30(
    title: "Frosted Future",
    subTitle: "Elegant glassmorphism UI for premium apps.",
    btnText: "Get Translucent"
);
echo '</div>';

// 5. Footer
ozi_footer_clean("Ozi Script Advanced UI Kit");
