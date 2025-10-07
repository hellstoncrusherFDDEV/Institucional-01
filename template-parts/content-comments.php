<?php
if (!defined('ABSPATH')) exit; // segurança

global $post;

if (comments_open() || get_comments_number()) : ?>

<div id="comments" class="mt-5">

    <h3 class="h5 text-primary mb-4">
        <i class="fas fa-comments me-2"></i>
        <?php
        $num_comments = get_comments_number($post->ID);
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
            'max_depth'   => 3,
            'callback'    => function($comment, $args, $depth) {
                $GLOBALS['comment'] = $comment;
                $has_children = $args['max_depth'] > $depth && get_comments(['parent' => $comment->comment_ID, 'status'=>'approve']);
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
                                    <a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)); ?>" class="text-decoration-none text-muted">
                                        <?php printf('%1$s às %2$s', get_comment_date('', $comment), get_comment_time('', $comment)); ?>
                                    </a>
                                </small>
                            </div>
                            <?php if ($has_children) : ?>
                                <button class="btn btn-sm btn-outline-secondary ms-2 toggle-replies">
                                    <i class="fas fa-chevron-down"></i> Ver respostas
                                </button>
                            <?php endif; ?>
                        </div>

                        <div class="comment-body collapse show">
                            <?php comment_text(); ?>
                        </div>

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