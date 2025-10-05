<?php
/*
Template Name: Programa de Afiliados
Template Post Type: page
*/

get_header();
?>

<div class="py-5 bg-light">
  <div class="container">
    <h1 class="display-4 fw-bold mb-4 text-center">
      <i class="fas fa-handshake text-success me-2"></i> Programa de Afiliados PixGo
    </h1>
    <div class="container my-4">
    <div class="ratio ratio-16x9 mx-auto" style="max-width: 900px;">
        <iframe
        src="https://www.youtube.com/embed/JS9IETTXC1Q?si=Cp-xaQ7wzE2dYH9_"
        title="YouTube video player"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
        referrerpolicy="strict-origin-when-cross-origin"
        allowfullscreen>
        </iframe>
    </div>
    </div>
    <p class="lead text-center">
      <i class="fas fa-bullhorn me-2 text-primary"></i> Ajude a promover a API Pix mais simples do mercado e <strong>ganhe comissões recorrentes</strong>!
    </p>

    <div class="row mt-5">
      <!-- Coluna 1: Benefícios -->
      <div class="col-md-6 mb-4">
        <h2 class="fw-semibold mb-3">
          <i class="fas fa-star text-warning me-2"></i> Por que ser um Afiliado PixGo?
        </h2>
        <ul class="list-unstyled">
          <li class="mb-3">
            <i class="fas fa-coins text-success me-2"></i>
            <strong>Comissões Competitivas:</strong> Ganhe porcentagem de até 30% em todas as requisições da API feitas pelos seus indicados.
          </li>
          <li class="mb-3">
            <i class="fas fa-bolt text-danger me-2"></i>
            <strong>Fácil de Promover:</strong> A PixGo simplifica a burocracia da API oficial do Mercado Pago, e outros gateways de pagamento.
          </li>
          <li>
            <i class="fas fa-users text-info me-2"></i>
            <strong>Público-Alvo Definido:</strong> Ideal para quem tem audiência em comunidades dev e e-commerces.
          </li>
        </ul>
      </div>

      <!-- Coluna 2: Como funciona -->
      <div class="col-md-6 mb-4">
        <h2 class="fw-semibold mb-3">
          <i class="fas fa-cogs text-secondary me-2"></i> Como Funciona?
        </h2>
        <ol class="ps-3">
          <li><i class="fas fa-user-plus text-success me-1"></i> Cadastre-se no Programa.</li>
          <li><i class="fas fa-link text-primary me-1"></i> Receba seu link e materiais de divulgação.</li>
          <li><i class="fas fa-key text-warning me-1"></i> Seus indicados recebem a API Key inicial.</li>
          <li><i class="fas fa-wallet text-danger me-1"></i> Eles recarregam créditos para usar a API.</li>
          <li><i class="fas fa-hand-holding-usd text-success me-1"></i> Você ganha comissão sobre cada consumo efetivado na API.</li>
        </ol>
        <p class="text-muted mt-3">
          <i class="fas fa-briefcase me-2"></i> Parcerias com freelancers e agências digitais são parte da estratégia da PixGo.
        </p>
      </div>
    </div>

    <!-- CTA central -->
    <div class="text-center mt-4">
      <a href="/register" class="btn btn-success btn-lg px-4 shadow">
        <i class="fas fa-rocket me-2"></i> Quero me Cadastrar como Afiliado
      </a>
    </div>
  </div>
</div>

<?php get_footer(); ?>
