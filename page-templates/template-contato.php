<?php
/*
Template Name: Contato
Template Post Type: page
*/

get_header();
?>

<div class="py-2 bg-light">
  <div class="container">
    <h1 class="display-4 mb-4 text-center text-primary fw-bold">
      <i class="fas fa-envelope-open-text me-2"></i> <?php echo esc_html( get_theme_mod('contato_title','Entre em Contato') ); ?>
    </h1>
    <p class="lead mb-5">
      <?php echo esc_html( get_theme_mod('contato_lead','Tem dúvidas sobre integração, preços ou precisa de suporte? Fale conosco agora mesmo.') ); ?>
    </p>

    <div class="row">
      <!-- Coluna de Informações -->
      <div class="col-md-4 mb-4">
        <h2 class="h4 fw-bold mb-3 text-primary">
          <i class="fas fa-info-circle me-2"></i> <?php echo esc_html( get_theme_mod('contato_info_title', __( 'Informações de Contato', 'institucional-01' ) ) ); ?>
        </h2>
        <ul class="list-unstyled">
          <li class="mb-3">
            <i class="fas fa-envelope text-danger me-2"></i>
            <strong><?php echo esc_html( get_theme_mod('contato_email_label', __( 'E-mail de Suporte:', 'institucional-01' ) ) ); ?></strong>
            <?php $email = get_theme_mod('contato_email','contato@fddev.com.br'); ?>
            <a href="mailto:<?php echo esc_attr($email); ?>" class="text-decoration-none"><?php echo esc_html($email); ?></a>
          </li>
          <li class="mb-3">
            <i class="fas fa-headset text-success me-2"></i>
            <strong><?php echo esc_html( get_theme_mod('contato_support_label', __( 'Atendimento:', 'institucional-01' ) ) ); ?></strong> <?php echo esc_html( get_theme_mod('contato_support_text', __( 'Segunda a Sexta, 9h às 18h', 'institucional-01' ) ) ); ?>
          </li>
        </ul>
      </div>

      <!-- Coluna do Formulário -->
      <div class="col-md-8">

        <h2 class="h4 fw-bold mb-3 text-primary">
          <i class="fas fa-paper-plane me-2"></i> <?php echo esc_html( get_theme_mod('contato_form_title', __( 'Envie sua Mensagem', 'institucional-01' ) ) ); ?>
        </h2>

        <div class="row justify-content-center">
          <div class="col-md-6">
            <!-- Contact Form 7 shortcode -->
            <?php echo do_shortcode( get_theme_mod('contato_form_shortcode','[contact-form-7 id="2184b1f" title="Formulário de contato"]') ); ?>
          </div>
        </div>

      </div>
    </div>

</div>
</div>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
    $raw = get_the_content();
    if ( has_blocks( get_the_ID() ) || strlen( trim( wp_strip_all_tags( $raw ) ) ) ) : ?>
    <section class="container my-5">
        <?php the_content(); ?>
    </section>
    <?php endif; endwhile; endif; ?>

<?php get_footer(); ?>
