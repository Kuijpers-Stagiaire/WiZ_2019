var staticCacheName = "wiz-v" + new Date().getTime();
var filesToCache = [
    
    
    '/offline',
    // '/meta',
    
    // '/home',
    // '/shop',
    // '/overons',
    // '/profiel',
    // '/controlpanel',
    // '/search',
    // '/allproducts',
    // '/productdetail',

    '/401',
    // '/403',
    '/404',
    '/419',
    '/429',
    '/500',
    // '/503',

    '/img/icons/icon-72x72.png',
    '/img/icons/icon-96x96.png',
    '/img/icons/icon-128x128.png',
    '/img/icons/icon-144x144.png',
    '/img/icons/icon-152x152.png',
    '/img/icons/icon-192x192.png',
    '/img/icons/icon-384x384.png',
    '/img/icons/icon-512x512.png',

    '/img/background.jpg',
    '/img/plain.jpg',
    '/img/BoomOverOnsKnipsel.jpg',
    '/img/img-placeholder.png',
    '/img/kuijpers-error.jpg',
    '/img/logo_wiz2.png',
    '/img/logo_wiz3.png',
    '/img/logo-small.png',
    '/img/default.jpg',
    '/img/pwa-icon.png',

    '/fontawesome/css/all.min.css',
    '/fontawesome/webfonts/fa-brands-400.woff2',
    '/fontawesome/webfonts/fa-regular-400.woff2',
    '/fontawesome/webfonts/fa-solid-900.woff2',

    '/css/bootstrap.min.css',

    '/css/app.css',
    '/css/main.css',
    '/css/footer.css',

    '/css/controlpanel.css',
    '/css/homegraphs.css',
    '/css/login.css',
    // '/css/modalproduct.css',
    '/css/profile.css',
    '/css/shop.css',

    '/js/bootstrap.min.js',
    '/js/raphael-2.1.4.min.js',
    '/js/justgage.js',
    '/js/tab.js',
    '/js/chart.js',
    // '/js/shopmodals.js',
    '/js/main.js',
    '/js/charts.js',
];

// Cache on install
self.addEventListener("install", event => {
    this.skipWaiting();
    event.waitUntil(
        caches.open(staticCacheName)
            .then(cache => {
                return cache.addAll(filesToCache);
            })
    )
});

// Clear cache on activate
self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames
                    .filter(cacheName => (cacheName.startsWith("wiz-")))
                    .filter(cacheName => (cacheName !== staticCacheName))
                    .map(cacheName => caches.delete(cacheName))
            );
        })
    );
});

// Serve from Cache
self.addEventListener("fetch", event => {
    event.respondWith(
        caches.match(event.request)
            .then(response => {
                return response || fetch(event.request);
            })
            .catch(() => {
                return caches.match('offline');
            })
    )
});