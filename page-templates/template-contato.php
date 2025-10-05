<?php
/*
Template Name: Contato
Template Post Type: page
*/

get_header();
?>

<div class="py-2 bg-light">
  <div class="container">
    <h1 class="display-4 mb-4 text-center fw-bold">
      <i class="fas fa-envelope-open-text text-primary me-2"></i> Entre em Contato com a PixGo
    </h1>
    <p class="lead text-center mb-5">
      Tem dúvidas sobre integração, preços ou precisa de suporte? Fale conosco agora mesmo.
    </p>

    <div class="row">
      <!-- Coluna de Informações -->
      <div class="col-md-5 mb-4">
        <h2 class="h4 fw-bold mb-3 text-primary">
          <i class="fas fa-info-circle me-2"></i> Informações de Contato
        </h2>
        <ul class="list-unstyled">
          <li class="mb-3">
            <i class="fas fa-envelope text-danger me-2"></i>
            <strong>E-mail de Suporte:</strong>
            <a href="mailto:contato@fddev.com.br" class="text-decoration-none">contato@fddev.com.br</a>
          </li>
          <li class="mb-3">
            <i class="fas fa-headset text-success me-2"></i>
            <strong>Atendimento:</strong> Segunda a Sexta, 9h às 18h
          </li>
        </ul>
      </div>

      <!-- Coluna do Formulário -->
      <div class="col-md-7">
        <h2 class="h4 fw-bold mb-3 text-primary">
          <i class="fas fa-paper-plane me-2"></i> Envie sua Mensagem
        </h2>
        <!-- Contact Form 7 shortcode -->
        <?php echo do_shortcode('[contact-form-7 id="2184b1f" title="Formulário de contato"]'); ?>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>
