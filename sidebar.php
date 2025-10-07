<aside class="card p-3 shadow-sm mb-4">
    <form role="search" method="get" class="d-flex" action="<?php echo esc_url(home_url('/')); ?>">
        <input 
            type="search" 
            class="form-control me-2" 
            placeholder="Pesquisar..." 
            value="<?php echo get_search_query(); ?>" 
            name="s"
        >
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-search"></i>
        </button>
    </form>
</aside>

<aside class="card p-4 shadow-sm mb-4">
    <h4 class="mb-3 text-primary">
        <i class="fas fa-bolt me-2"></i> Foco do PixGo
    </h4>
    <p>Nossa proposta de valor é a <strong>facilidade de integração</strong> e o <strong>preço justo por requisição</strong>.</p>
    <p>Com o modelo de <strong>créditos pré-pagos</strong>, você paga apenas pelo uso real da API.</p>
    <div class="text-center mt-3">
        <a href="<?php echo esc_url( home_url( '/register' ) ); ?>" class="btn btn-warning btn-sm px-4">
            <i class="fas fa-rocket me-2"></i> Começar Grátis Agora
        </a>
    </div>
</aside>

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
    <div class="d-flex flex-wrap gap-2">
        <?php
        $tags = get_tags(array('number' => 10));
        if ($tags) :
            foreach ($tags as $tag) :
                echo '<a href="' . get_tag_link($tag->term_id) . '" class="badge bg-light text-dark border">
                        #' . esc_html($tag->name) . '
                      </a>';
            endforeach;
        else :
            echo '<span class="text-muted">Nenhuma tag disponível.</span>';
        endif;
        ?>
    </div>
</aside>
