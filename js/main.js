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
  const modal = document.getElementById('imageModal');
  const modalImg = document.getElementById('modalImage');

  // Quando qualquer link com data-bs-target="#imageModal" for clicado
  document.body.addEventListener('click', function (e) {
    const link = e.target.closest('[data-bs-toggle="modal"][data-bs-target="#imageModal"]');
    if (!link) return;

    e.preventDefault(); // Evita subir pro topo
    const imgSrc = link.getAttribute('data-img');
    modalImg.src = imgSrc;

    // Força abertura manual da modal (garantido em todos contextos)
    const bsModal = new bootstrap.Modal(modal);
    bsModal.show();
  });
});

