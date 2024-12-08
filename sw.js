const cacheName = "cache1"; // Change value to force update

self.addEventListener("install", event => {
	// Kick out the old service worker
	self.skipWaiting();

	event.waitUntil(
		caches.open(cacheName).then(cache => {
			return cache.addAll([
				"/",
				"assets/media/images/icons/android-chrome-192x192.png", // Favicon, Android Chrome M39+ with 4.0 screen density
				"assets/media/images/icons/android-chrome-512x512.png", // Favicon, Android Chrome M47+ Splash screen with 4.0 screen density
				"assets/media/images/icons/apple-touch-icon.png", // Favicon, Apple default
				"assets/media/images/icons/browserconfig.xml", // IE11 icon configuration file
				"assets/media/images/icons/favicon.ico", // Favicon, IE and fallback for other browsers
				"assets/media/images/icons/favicon-16x16.png", // Favicon, default
				"assets/media/images/icons/favicon-32x32.png", // Favicon, Safari on Mac OS
				"index.php", // Main HTML file
                "sw.js",
				"offline.html",
				"assets/style/main.js", // Main Javascript file
                "assets/style/js/bootstrap_5.js",
                "assets/style/js/jquery.js",
                "assets/style/js/sweetalert.js",
				"manifest.json", // Manifest file
				"assets/media/images/icons/mstile-150x150.png", // Favicon, Windows 8 / IE11
				"safari-pinned-tab.svg", // Favicon, Safari pinned tab
				"assets/style/main.css", // Main CSS file
                "assets/style/css/animate.min.css",
                "assets/style/css/bootstrap_5.css",
                "assets/style/css/font_awesome.css",
                "assets/style/css/sweetalert.css",
			]);
		})
	);
});

self.addEventListener("activate", event => {
	// Delete any non-current cache
	event.waitUntil(
		caches.keys().then(keys => {
			Promise.all(
				keys.map(key => {
					if (![cacheName].includes(key)) {
						return caches.delete(key);
					}
				})
			)
		})
	);
});

// Offline-first, cache-first strategy
// Kick off two asynchronous requests, one to the cache and one to the network
// If there's a cached version available, use it, but fetch an update for next time.
// Gets data on screen as quickly as possible, then updates once the network has returned the latest data. 
self.addEventListener("fetch", event => {
	event.respondWith(
		caches.open(cacheName).then(cache => {
			return cache.match(event.request).then(response => {
				return response || fetch(event.request).then(networkResponse => {
					cache.put(event.request, networkResponse.clone());
					return networkResponse;
				});
			})
		})
	);
});




