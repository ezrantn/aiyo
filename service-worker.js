const CACHE_NAME = 'gp-basketball-cache-v1';
const urlsToCache = [
    '/goldenphoenix/',
    '/goldenphoenix/index.php',
    '/goldenphoenix/favicon-32x32.png',
    '/goldenphoenix/favicon-16x16.png',
];

self.addEventListener('install', function(event) {
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then(function(cache) {
                console.log('Opened cache');
                return cache.addAll(urlsToCache);
            })
    );
});

self.addEventListener('fetch', function(event) {
    event.respondWith(
        caches.match(event.request)
            .then(function(response) {
                return response || fetch(event.request);
            })
    );
});

self.addEventListener('activate', function(event) {
    event.waitUntil(
        caches.keys()
            .then((keyList) => {
                return Promise.all(keyList.map((key) => {
                    if (key !== CACHE_NAME) {
                        console.log('[ServiceWorker] Deleting old cache:', key);
                        return caches.delete(key);
                    }
                }));
            })
            .then(() => self.clients.claim())
    );
});
