self.addEventListener('install', event => {
    console.log("Service Worker installed.");
    self.skipWaiting();
});

self.addEventListener('activate', event => {
    console.log("Service Worker activated.");
    return self.clients.claim();
});

self.addEventListener('push', function(event) {
    const data = event.data ? event.data.json() : {};
    const title = data.title || "Air Quality Alert";
    const options = {
        body: data.body || "Tap to view more details.",
        icon: data.icon || "/icon.png",
        tag: "push-alert"
    };

    event.waitUntil(self.registration.showNotification(title, options));
});
