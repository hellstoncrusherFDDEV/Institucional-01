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

<!-- 🔽 BLOCO DE PERFIL DO AUTOR -->
<?php
$author_id = get_the_author_meta('ID');
$author_name = get_the_author();
$author_bio = get_the_author_meta('description');
$author_avatar = get_avatar_url($author_id, array('size' => 128));
$author_url = get_author_posts_url($author_id);
$author_website = get_the_author_meta('user_url');
?>

<section class="author-box card mt-4 shadow-sm border-0">
    <div class="card-body d-flex flex-wrap align-items-center">
        <div class="author-avatar me-3 mb-3">
            <img src="<?php echo esc_url($author_avatar); ?>" alt="<?php echo esc_attr($author_name); ?>" class="rounded-circle shadow-sm" width="96" height="96">
        </div>

        <div class="author-info flex-grow-1">
            <h5 class="fw-bold mb-1">
                <a href="<?php echo esc_url($author_url); ?>" class="text-decoration-none text-dark">
                    <?php echo esc_html($author_name); ?>
                </a>
            </h5>

            <?php if ($author_bio) : ?>
                <p class="mb-2 text-muted"><?php echo wp_kses_post($author_bio); ?></p>
            <?php else : ?>
                <p class="text-muted mb-2">Autor deste artigo no blog PixGo.</p>
            <?php endif; ?>

            <div class="author-links d-flex flex-wrap gap-2">
                <a href="<?php echo esc_url($author_url); ?>" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-user me-1"></i> Mais posts
                </a>

                <?php if ($author_website) : ?>
                    <a href="<?php echo esc_url($author_website); ?>" target="_blank" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-globe me-1"></i> Site pessoal
                    </a>
                <?php endif; ?>

                <?php if (get_the_author_meta('twitter')) : ?>
                    <a href="https://twitter.com/<?php echo esc_attr(get_the_author_meta('twitter')); ?>" target="_blank" class="btn btn-outline-info btn-sm">
                        <i class="fab fa-twitter"></i> Twitter
                    </a>
                <?php endif; ?>

                <?php if (get_the_author_meta('facebook')) : ?>
                    <a href="<?php echo esc_url(get_the_author_meta('facebook')); ?>" target="_blank" class="btn btn-outline-primary btn-sm">
                        <i class="fab fa-facebook-f"></i> Facebook
                    </a>
                <?php endif; ?>

                <?php if (get_the_author_meta('linkedin')) : ?>
                    <a href="<?php echo esc_url(get_the_author_meta('linkedin')); ?>" target="_blank" class="btn btn-outline-primary btn-sm">
                        <i class="fab fa-linkedin-in"></i> LinkedIn
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<!-- 🔼 FIM BLOCO DE PERFIL DO AUTOR -->

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
