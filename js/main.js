if ('serviceWorker' in navigator) {
  window.addEventListener('load', function() {
    var url = (typeof pixgoTheme !== 'undefined' && pixgoTheme.swUrl) ? pixgoTheme.swUrl : '/service-worker.js';
    navigator.serviceWorker.register(url).then(function(registration) {
      console.log('ServiceWorker registrado:', registration.scope);
    }, function(err) {
      console.log('ServiceWorker erro:', err);
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
  var toggle = document.getElementById('darkModeToggle');
  if (toggle) {
    var saved = localStorage.getItem('pixgoDark') === '1';
    if (saved) { document.body.classList.add('dark-mode'); }
    toggle.setAttribute('aria-pressed', saved ? 'true' : 'false');
    toggle.addEventListener('click', function () {
      var isDark = document.body.classList.toggle('dark-mode');
      localStorage.setItem('pixgoDark', isDark ? '1' : '0');
      toggle.setAttribute('aria-pressed', isDark ? 'true' : 'false');
    });
  }
});

