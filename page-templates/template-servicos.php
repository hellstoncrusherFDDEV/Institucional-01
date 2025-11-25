<?php
/*
Template Name: Serviços
Template Post Type: page
*/

get_header();
?>

<div class="container my-2">
  <h1 class="display-4 text-primary text-center"><i class="fas fa-tools me-2"></i><?php echo esc_html( get_theme_mod('servicos_title', __( 'Serviços PixGo', 'institucional-01' ) ) ); ?></h1>
  <p class="lead text-center mb-4"><?php echo esc_html( get_theme_mod('servicos_lead', __( 'Soluções para integrar Pix em sites, apps e lojas.', 'institucional-01' ) ) ); ?></p>

  <div class="row">
    <?php for($i=1;$i<=3;$i++): ?>
      <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm p-4">
          <i class="<?php echo esc_attr( get_theme_mod("servico{$i}_icon", 'fas fa-cog') ); ?> fa-2x text-primary mb-3"></i>
          <h5 class="card-title"><?php echo esc_html( get_theme_mod("servico{$i}_title", sprintf( __( 'Serviço %d', 'institucional-01' ), $i ) ) ); ?></h5>
          <p class="card-text"><?php echo wp_kses_post( get_theme_mod("servico{$i}_desc", __( 'Descrição breve do serviço.', 'institucional-01' ) ) ); ?></p>
        </div>
      </div>
    <?php endfor; ?>
  </div>

  <div class="text-center mt-3">
    <a href="<?php echo esc_url( get_theme_mod('servicos_cta_url', home_url('/register') ) ); ?>" class="btn btn-success btn-lg">
      <i class="fas fa-rocket me-2"></i> <?php echo esc_html( get_theme_mod('servicos_cta_text', __( 'Quero Integrar Agora', 'institucional-01' ) ) ); ?>
    </a>
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
