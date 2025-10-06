<?php get_header(); ?>

<div class="container py-2">
    <div class="row">
        <div class="col-lg-8">

            <header class="mb-4 border-bottom pb-2">
                <?php if ( is_category() ) : ?>
                    <h1 class="display-5 mb-2">
                        <i class="fas fa-folder-open text-primary me-2"></i>
                        Categoria: <?php single_cat_title(); ?>
                    </h1>
                    <?php if ( category_description() ) : ?>
                        <p class="lead text-muted"><?php echo category_description(); ?></p>
                    <?php endif; ?>

                <?php elseif ( is_tag() ) : ?>
                    <h1 class="display-5 mb-2">
                        <i class="fas fa-tags text-info me-2"></i>
                        Tag: <?php single_tag_title(); ?>
                    </h1>

                <?php elseif ( is_author() ) : ?>
                    <h1 class="display-5 mb-2">
                        <i class="fas fa-user-edit text-secondary me-2"></i>
                        Publicações de <?php the_author(); ?>
                    </h1>

                <?php elseif ( is_date() ) : ?>
                    <h1 class="display-5 mb-2">
                        <i class="fas fa-calendar-alt text-success me-2"></i>
                        Arquivo de <?php echo get_the_date('F \d\e Y'); ?>
                    </h1>

                <?php else : ?>
                    <h1 class="display-5 mb-2">
                        <i class="fas fa-archive text-muted me-2"></i>
                        Arquivos
                    </h1>
                <?php endif; ?>
            </header>

            <?php if ( have_posts() ) : ?>
                <?php while ( have_posts() ) : the_post(); ?>
                    <article class="mb-4 border-bottom pb-3">
                        <h2 class="h4">
                            <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark">
                                <?php the_title(); ?>
                            </a>
                        </h2>
                        <p class="text-muted small mb-2">
                            <i class="fas fa-user me-1"></i> <?php the_author(); ?>
                            <i class="fas fa-clock ms-3 me-1"></i> <?php echo get_the_date(); ?>
                        </p>
                        <p><?php echo wp_trim_words( get_the_excerpt(), 25, '...' ); ?></p>
                        <a href="<?php the_permalink(); ?>" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-arrow-right me-1"></i> Ler mais
                        </a>
                    </article>
                <?php endwhile; ?>

                <div class="mt-4">
                    <?php
                    the_posts_navigation([
                        'prev_text' => '<i class="fas fa-arrow-left me-1"></i> Anterior',
                        'next_text' => 'Próximo <i class="fas fa-arrow-right ms-1"></i>',
                    ]);
                    ?>
                </div>

            <?php else : ?>
                <div class="alert alert-secondary mt-4" role="alert">
                    <h4 class="alert-heading">Nenhum conteúdo encontrado</h4>
                    <p>Não há posts disponíveis nesta categoria ou filtro.</p>
                    <hr>
                    <p class="mb-0">
                        Volte à <a href="<?php echo esc_url( home_url( '/' ) ); ?>">página inicial</a> ou explore outros conteúdos.
                    </p>
                </div>
            <?php endif; ?>
        </div>

        <!-- SIDEBAR -->
        <div class="col-lg-4">
            <?php get_sidebar(); ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
