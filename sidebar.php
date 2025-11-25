<aside class="card p-3 shadow-sm mb-4">
    <?php get_search_form(); ?>
</aside>

<?php if ( is_active_sidebar( 'primary-sidebar' ) ) { dynamic_sidebar( 'primary-sidebar' ); } ?>

<?php
	// Exibe o card na sidebar
	pixgo_sidebar_focus_card();
?>

<aside class="card p-4 shadow-sm mb-4">
    <h5 class="mb-3 text-success">
        <i class="fas fa-newspaper me-2"></i> Últimos Posts
    </h5>
    <ul class="list-unstyled mb-0">
        <?php
        $recent_posts = wp_get_recent_posts(array(
            'numberposts' => 5,
            'post_status' => 'publish',
        ));
        if (!empty($recent_posts)) :
            foreach ($recent_posts as $post) :
                echo '<li class="mb-2">
                        <i class="fas fa-angle-right text-muted me-1"></i>
                        <a href="' . get_permalink($post["ID"]) . '" class="text-decoration-none">
                            ' . esc_html($post["post_title"]) . '
                        </a>
                      </li>';
            endforeach;
        else :
            echo '<li class="text-muted">Nenhum post recente.</li>';
        endif;
        ?>
    </ul>
</aside>

<aside class="card p-4 shadow-sm mb-4">
    <h5 class="mb-3 text-secondary">
        <i class="fas fa-comments me-2"></i> Últimos Comentários
    </h5>
    <ul class="list-unstyled mb-0">
        <?php
        $recent_comments = get_comments([
            'number'  => 5,
            'status'  => 'approve',
            'post_status' => 'publish'
        ]);

        if (!empty($recent_comments)) :
            foreach ($recent_comments as $comment) :
                $author_url = get_author_posts_url($comment->user_id);
                $post_link = get_permalink($comment->comment_post_ID);
                ?>
                <li class="mb-3 d-flex align-items-start">
                    <?php echo get_avatar($comment, 40, '', '', ['class'=>'rounded-circle me-2']); ?>
                    <div class="flex-grow-1">
                        <p class="mb-1 small">
                            <strong>
                                <a href="<?php echo esc_url($author_url); ?>" class="text-decoration-none text-dark fw-semibold hover-text-primary">
                                    <?php echo esc_html($comment->comment_author); ?>
                                </a>
                            </strong>
                            em
                            <a href="<?php echo esc_url($post_link); ?>#comment-<?php echo $comment->comment_ID; ?>" class="text-decoration-none text-muted">
                                <?php echo get_the_title($comment->comment_post_ID); ?>
                            </a>
                        </p>
                        <small class="text-muted">
                            <i class="fas fa-clock me-1"></i> <?php echo get_comment_date('', $comment); ?>
                        </small>
                    </div>
                </li>
            <?php endforeach;
        else : ?>
            <li class="text-muted">Nenhum comentário recente.</li>
        <?php endif; ?>
    </ul>
</aside>

<aside class="card p-4 shadow-sm">
    <h5 class="mb-3 text-secondary">
        <i class="fas fa-hashtag me-2"></i> Tags Populares
    </h5>

    <div class="tag-cloud d-flex flex-wrap gap-2">
        <?php
        // Obtém todas as tags, limitando a 30 para performance
        $tags = get_tags(array(
            'orderby' => 'count',
            'order'   => 'DESC',
            'number'  => 30
        ));

        if ( $tags ) :
            // Descobre os limites mínimo e máximo de posts
            $min_count = min( wp_list_pluck( $tags, 'count' ) );
            $max_count = max( wp_list_pluck( $tags, 'count' ) );

            // Define tamanho mínimo e máximo da fonte (em px)
            $min_font = 12;
            $max_font = 28;

            foreach ( $tags as $tag ) :
                $count = $tag->count;

                // Calcula o tamanho da fonte proporcional ao número de posts
                if ( $max_count > $min_count ) {
                    $font_size = $min_font + ( ( $count - $min_count ) / ( $max_count - $min_count ) ) * ( $max_font - $min_font );
                } else {
                    $font_size = ($min_font + $max_font) / 2;
                }

                // Cor levemente ajustada para dar dinamismo
                $opacity = 0.6 + ( ( $count - $min_count ) / max( 1, ( $max_count - $min_count ) ) ) * 0.4;
                $color = 'rgba(33,37,41,' . number_format($opacity, 2) . ')'; // tom de cinza Bootstrap
                ?>
                <a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>"
                   class="fw-semibold text-decoration-none"
                   style="font-size: <?php echo round($font_size, 1); ?>px; color: <?php echo esc_attr( $color ); ?>;">
                    #<?php echo esc_html( $tag->name ); ?>
                </a>
            <?php endforeach;
        else :
            echo '<span class="text-muted">Nenhuma tag disponível.</span>';
        endif;
        ?>
    </div>
</aside>
