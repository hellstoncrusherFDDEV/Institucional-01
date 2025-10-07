<?php
/**
 * Template part para exibir o conteúdo das páginas e posts com foco em imagens modernas.
 *
 * Tema: Institutional 01
 */

// Obtém o tipo de post (post, page, custom post type)
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
        if ( 'post' === $post_type ) {
            echo '<small class="text-muted">Publicado em: ' . get_the_date() . '</small>';
        }
        ?>
    </header>

    <div class="entry-content px-4 pb-4">
        <?php
        // Exibe o conteúdo principal do post/página
        the_content();

        // Links de paginação (caso o conteúdo tenha <!--nextpage-->)
        wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Páginas:', 'pixgo-theme'),
            'after'  => '</div>',
        ));
        ?>
    </div><!-- .entry-content -->

    <footer class="entry-footer mt-4 p-4 bg-light border-top">
        <div class="alert alert-info mb-0" role="alert">
            <h4 class="alert-heading">Pronto para Integrar?</h4>
            <p>A PixGo oferece facilidade de integração e preço justo por requisição. Nosso modelo de créditos pré-pagos garante que você pague somente pelo uso.</p>
            <hr>
            <a href="/register" class="btn btn-success me-2 mb-2">Começar Grátis</a>
            <a href="/como-funciona" class="btn btn-primary mb-2">Ver Documentação da API</a>
        </div>
    </footer>

</article>

<?php get_template_part('content', 'comments'); ?>

<!-- Modal para visualizar imagens internas -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content bg-transparent border-0">
      <img id="modalImage" src="" class="img-fluid rounded shadow" alt="Imagem ampliada">
    </div>
  </div>
</div>
