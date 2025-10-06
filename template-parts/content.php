<?php
/**
 * Template part para exibir o conteúdo das páginas.
 *
 * Usado em index.php e outros templates de loop.
 *
 * Tema: Institutional 01
 *
 */

// Obtém o tipo de post (post, page, custom post type)
$post_type = get_post_type();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('mb-5 card shadow-sm p-4 p-md-5'); ?>>
    
    <header class="entry-header mb-4">
        <?php
        // Exibe o título do post ou da página
        the_title( '<h1 class="entry-title display-5">', '</h1>' );
        
        // Se fosse um blog, você incluiria metadados aqui:
        if ( 'post' === $post_type ) {
            echo '<small class="text-muted">Publicado em: ' . get_the_date() . '</small>';
        }
        ?>
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php
        // Exibe o conteúdo principal do post/página
        the_content( sprintf(
            wp_kses(
                // Link "Continue Lendo" (útil para listagens de blog)
                __( 'Continue lendo %s <span class="meta-nav">&rarr;</span>', 'pixgo-theme' ),
                array( 'span' => array( 'class' => array() ) )
            ),
            get_the_title()
        ) );

        // Adiciona links de paginação para conteúdos longos
        wp_link_pages( array(
            'before' => '<div class="page-links">' . esc_html__( 'Páginas:', 'pixgo-theme' ),
            'after'  => '</div>',
        ) );
        ?>
    </div><!-- .entry-content -->
    
    <footer class="entry-footer mt-4">
        <div class="alert alert-info" role="alert">
            <h4 class="alert-heading">Pronto para Integrar?</h4>
            <p>A PixGo oferece facilidade de integração e preço justo por requisição. Nosso modelo de créditos pré-pagos garante que você pague somente pelo uso.</p>
            <hr>
            <a href="/register" class="btn btn-success me-2">Começar Grátis</a>
            <a href="/como-funciona" class="btn btn-outline-info">Ver Documentação da API</a>
        </div>
    </footer><!-- .entry-footer -->

</article><!-- #post-<?php the_ID(); ?> -->