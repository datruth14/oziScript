<?php
/**
 * oziScript Homepage
 * This file uses the Base UI Kit widgets to assemble the homepage.
 */

// 1. Navigation
ozi_nav_simple(
    brand: "oziScript",
    links: [
        "Home" => linkTo("homepage"),
        "Widgets" => linkTo("widgets"),
        "About" => linkTo("about")
    ]
);

// 2. Hero Section (Content from original index)
ozi_hero_modern(
    title: "Congratulations!",
    desc: "You have successfully downloaded and installed the oziScript project structure. Let's start by editing this component to build your dream app.",
    cta: "Explore Widgets",
    img: "assets/media/images/icons/android-chrome-192x192.png"
);

// 3. Footer
ozi_footer_clean(
    copyright: "oziScript Framework"
);