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

// Modal da imagens nos Posts
document.addEventListener('DOMContentLoaded', function () {
    const imageModal = document.getElementById('imageModal');
    imageModal.addEventListener('show.bs.modal', function (event) {
        const trigger = event.relatedTarget;
        const imgSrc = trigger.getAttribute('data-img');
        const modalImg = document.getElementById('modalImage');
        modalImg.src = imgSrc;
    });
});

