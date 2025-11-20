<?php
/**
 * Template part para exibir o conteúdo das páginas e posts com foco em imagens modernas e comentários.
 *
 * Tema: Institutional 01
 */

if (!defined('ABSPATH')) exit; // segurança
$post_type = get_post_type();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('mb-2 card shadow-sm overflow-hidden'); ?>>

    <?php if ( has_post_thumbnail() ) : ?>
        <div class="post-hero position-relative mb-3">
            <?php the_post_thumbnail('large', [
                'class' => 'img-fluid w-100 rounded-0',
                'loading' => 'lazy',
                'alt' => get_the_title()
            ]); ?>
        </div>
    <?php endif; ?>

    <header class="entry-header mb-4 px-4 pt-3">
        <?php
        the_title('<h1 class="entry-title display-5 fw-bold">', '</h1>');

        if ( 'post' === get_post_type() ) : ?>
            <p class="text-muted small mb-2">
                <i class="fas fa-user me-1"></i>
                <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="text-decoration-none text-muted">
                    <?php the_author(); ?>
                </a>
                <i class="fas fa-clock ms-3 me-1"></i>
                <a href="<?php echo esc_url(get_permalink()); ?>" class="text-decoration-none text-muted">
                    <?php echo get_the_date(); ?>
                </a>
            </p>
        <?php endif; ?>
    </header>

    <div class="entry-content px-4 pb-4">
        <?php
        // Exibe o conteúdo principal
        the_content();

        // Paginação dentro do post
        wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Páginas:', 'pixgo-theme'),
            'after'  => '</div>',
        ));
        ?>
    </div><!-- .entry-content -->


    <!-- 🔽 BLOCO DE TAGS (NOVO) -->
    <?php
    $post_tags = get_the_tags();
    if ( $post_tags ) : ?>
        <div class="post-tags px-4 pb-4">
            <h5 class="fw-semibold mb-3">
                <i class="fas fa-tags me-2 text-primary"></i>Tags relacionadas:
            </h5>
            <?php foreach ( $post_tags as $tag ) : ?>
                <a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>"
                   class="badge rounded-pill bg-secondary text-decoration-none me-1 mb-1 p-2">
                    <i class="fa-solid fa-hashtag me-1"></i><?php echo esc_html( $tag->name ); ?>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <!-- 🔼 FIM BLOCO DE TAGS -->
	
	<?php pixgo_share_buttons(); ?>

    <footer class="entry-footer mt-4 p-4 border-top cta-block">
        <div class="mb-0" role="region">
            <h4 class="alert-heading"><?php echo esc_html( get_theme_mod( 'cta_footer_title', 'Pronto para Integrar?' ) ); ?></h4>
            <p><?php echo wp_kses_post( get_theme_mod( 'cta_footer_text', 'A PixGo oferece facilidade de integração e preço justo por requisição. Nosso modelo de créditos pré-pagos garante que você pague somente pelo uso.' ) ); ?></p>
            <hr>
            <a href="<?php echo esc_url( get_theme_mod( 'cta_footer_primary_url', '/register' ) ); ?>" class="btn btn-success me-2 mb-2"><?php echo esc_html( get_theme_mod( 'cta_footer_primary_text', 'Começar Grátis' ) ); ?></a>
            <a href="<?php echo esc_url( get_theme_mod( 'cta_footer_secondary_url', '/como-funciona' ) ); ?>" class="btn btn-primary mb-2"><?php echo esc_html( get_theme_mod( 'cta_footer_secondary_text', 'Ver Documentação da API' ) ); ?></a>
        </div>
    </footer>

</article>

<?php pixgo_author_box(); ?>

<?php 
// Exibe comentários apenas se houver ou se estiverem abertos
if ( comments_open() || get_comments_number() ) :
    comments_template();
endif;
?>

<!-- Modal para visualizar imagens internas -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content bg-transparent border-0">
      <img id="modalImage" src="" class="img-fluid rounded shadow" alt="Imagem ampliada">
    </div>
  </div>
</div>
