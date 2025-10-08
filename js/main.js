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

// Videos do Youtube
document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('.lazy-video .play-btn').forEach(function (btn) {
    btn.addEventListener('click', function () {
      const container = btn.closest('.lazy-video');
      const videoSrc = container.getAttribute('data-src');
      if (!videoSrc) return;

      // Cria o iframe dinamicamente
      const iframe = document.createElement('iframe');
      iframe.setAttribute('src', videoSrc);
      iframe.setAttribute('title', 'YouTube video player');
      iframe.setAttribute('allow', 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture');
      iframe.setAttribute('allowfullscreen', '');
      iframe.className = 'w-100 h-100 rounded shadow-sm';

      // Substitui todo o conteúdo do container
      container.innerHTML = '';
      container.appendChild(iframe);
    });
  });
});

