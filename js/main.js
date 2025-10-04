// Registro do Service Worker (para PWA)
if ('serviceWorker' in navigator) {
  window.addEventListener('load', function() {
    navigator.serviceWorker.register('https://pixgo.api.br/wp-content/themes/Institucional-01/service-worker.js').then(function(registration) {
      // Registro bem-sucedido
      console.log('ServiceWorker registrado com sucesso. Escopo:', registration.scope);
    }, function(err) {
      // Falha no registro
      console.log('Falha no registro do ServiceWorker:', err);
    });
  });
}