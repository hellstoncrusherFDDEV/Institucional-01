<?php
/*
Template Name: Serviços
Template Post Type: page
*/

get_header();
?>

<div class="container my-2">
  <h1 class="display-4 text-primary text-center"><i class="fas fa-tools me-2"></i><?php echo esc_html( get_theme_mod('servicos_title','Serviços PixGo') ); ?></h1>
  <p class="lead text-center mb-4"><?php echo esc_html( get_theme_mod('servicos_lead','Soluções para integrar Pix em sites, apps e lojas.') ); ?></p>

  <div class="row">
    <?php for($i=1;$i<=3;$i++): ?>
      <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm p-4">
          <i class="<?php echo esc_attr( get_theme_mod("servico{$i}_icon", 'fas fa-cog') ); ?> fa-2x text-primary mb-3"></i>
          <h5 class="card-title"><?php echo esc_html( get_theme_mod("servico{$i}_title", "Serviço {$i}") ); ?></h5>
          <p class="card-text"><?php echo wp_kses_post( get_theme_mod("servico{$i}_desc", 'Descrição breve do serviço.') ); ?></p>
        </div>
      </div>
    <?php endfor; ?>
  </div>

  <div class="text-center mt-3">
    <a href="<?php echo esc_url( get_theme_mod('servicos_cta_url','/register') ); ?>" class="btn btn-success btn-lg">
      <i class="fas fa-rocket me-2"></i> <?php echo esc_html( get_theme_mod('servicos_cta_text','Quero Integrar Agora') ); ?>
    </a>
  </div>
</div>

<?php get_footer(); ?>