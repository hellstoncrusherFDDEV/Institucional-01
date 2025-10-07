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

<?php
if (comments_open() || get_comments_number()) : ?>
    <div id="comments" class="mt-5">

        <h3 class="h5 text-primary mb-4">
            <i class="fas fa-comments me-2"></i>
            <?php
            $num_comments = get_comments_number();
            if ($num_comments === 0) {
                echo 'Seja o primeiro a comentar';
            } elseif ($num_comments === 1) {
                echo '1 comentário';
            } else {
                echo $num_comments . ' comentários';
            }
            ?>
        </h3>

        <!-- Lista de comentários -->
        <ul class="list-unstyled">
            <?php
            wp_list_comments([
                'style'       => 'ul',
                'short_ping'  => true,
                'avatar_size' => 48,
                'callback'    => function($comment, $args, $depth) {
                    $GLOBALS['comment'] = $comment;
                    $has_children = $args['max_depth'] > $depth && get_comments(array('parent' => $comment->comment_ID));
                    ?>
                    <li <?php comment_class('mb-3'); ?> id="comment-<?php comment_ID(); ?>">
                        <div class="card shadow-sm p-3">
                            <div class="d-flex align-items-center mb-2">
                                <?php echo get_avatar($comment, 48, '', '', ['class'=>'rounded-circle me-2', 'loading'=>'lazy']); ?>
                                <div class="flex-grow-1">
                                    <strong><?php comment_author(); ?></strong>
                                    <br>
                                    <small class="text-muted">
                                        <i class="fas fa-clock me-1"></i>
                                        <a href="<?php echo htmlspecialchars( get_comment_link($comment->comment_ID) ); ?>" class="text-decoration-none text-muted">
                                            <?php printf('%1$s às %2$s', get_comment_date(), get_comment_time()); ?>
                                        </a>
                                    </small>
                                </div>
                                <?php if ($has_children) : ?>
                                    <button class="btn btn-sm btn-outline-secondary ms-2 toggle-replies">
                                        <i class="fas fa-chevron-down"></i> Ver respostas
                                    </button>
                                <?php endif; ?>
                            </div>

                            <!-- Corpo do comentário -->
                            <div class="comment-body collapse show">
                                <?php comment_text(); ?>
                            </div>

                            <!-- Botão responder -->
                            <div class="mt-2">
                                <?php comment_reply_link(array_merge($args, [
                                    'depth'     => $depth,
                                    'max_depth' => $args['max_depth'],
                                    'before'    => '<button class="btn btn-sm btn-outline-primary">',
                                    'after'     => '</button>'
                                ])); ?>
                            </div>

                        </div>
                    </li>
                <?php }
            ]); ?>
        </ul>

        <!-- Formulário de comentários -->
        <?php
        comment_form([
            'class_form' => 'mt-4',
            'title_reply' => '<h4 class="h6 text-primary mb-3"><i class="fas fa-pen me-2"></i>Deixe seu comentário</h4>',
            'comment_field' => '<div class="mb-3"><textarea class="form-control" name="comment" rows="4" placeholder="Escreva seu comentário..." required></textarea></div>',
            'fields' => [
                'author' => '<div class="mb-3"><input class="form-control" name="author" type="text" placeholder="Nome" required></div>',
                'email'  => '<div class="mb-3"><input class="form-control" name="email" type="email" placeholder="Email" required></div>',
                'url'    => '<div class="mb-3"><input class="form-control" name="url" type="url" placeholder="Website"></div>',
            ],
            'class_submit' => 'btn btn-primary',
            'label_submit' => 'Enviar Comentário'
        ]);
        ?>
    </div>

<?php endif; ?>

<!-- Modal para visualizar imagens internas -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content bg-transparent border-0">
      <img id="modalImage" src="" class="img-fluid rounded shadow" alt="Imagem ampliada">
    </div>
  </div>
</div>

