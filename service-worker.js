const CACHE_NAME = 'pixgo-pwa-cache-v8';

// Arquivos críticos do sistema, incluindo os assets listados na estrutura
const urlsToCache = [
    //'https://pixgo.api.br/'
];

// Evento de Instalação: Adiciona recursos ao cache
self.addEventListener('install', event => {
  console.log('[Service Worker] Instalando...');
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(cache => {
        return cache.addAll(urlsToCache);
      })
      .catch(error => {
          console.error('[Service Worker] Falha ao adicionar recursos ao cache:', error);
      })
  );
  self.skipWaiting();
});

// Evento de Ativação: Limpeza de caches antigos
self.addEventListener('activate', event => {
    console.log('[Service Worker] Ativando...');
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames.map(cache => {
                    if (cache !== CACHE_NAME) {
                        console.log('[Service Worker] Limpando cache antigo:', cache);
                        return caches.delete(cache);
                    }
                })
            );
        })
    );
});

// Evento Fetch: Servir do cache primeiro, depois tentar a rede
self.addEventListener('fetch', event => {
    // Apenas intercepta requisições GET (não POSTs de ações PHP como acoes/login.php)
    if (event.request.method !== 'GET') return;

    event.respondWith(
        caches.match(event.request)
            .then(cachedResponse => {
                // Se estiver no cache, retorna a versão cacheadora
                if (cachedResponse) {
                    return cachedResponse;
                }
                // Caso contrário, busca na rede
                return fetch(event.request);
            })
    );
});
