<?php get_header(); ?>

<div class="container py-2">
    <div class="row">
        <div class="col-lg-8">

            <header class="mb-4 border-bottom pb-2">
                <?php if ( is_category() ) : ?>
                    <h1 class="display-5 mb-2">
                        <i class="fas fa-folder-open text-primary me-2"></i>
                        <?php single_cat_title(); ?>
                    </h1>
                    <?php if ( category_description() ) : ?>
                        <p class="lead text-muted"><?php echo category_description(); ?></p>
                    <?php endif; ?>

                <?php elseif ( is_tag() ) : ?>
                    <h1 class="display-5 mb-2">
                        <i class="fas fa-tags text-info me-2"></i>
                        <?php single_tag_title(); ?>
                    </h1>
                    <?php if ( tag_description() ) : ?>
                        <p class="lead text-muted"><?php echo tag_description(); ?></p>
                    <?php endif; ?>

                <?php elseif ( is_author() ) : ?>
                    <h1 class="display-5 mb-2">
                        <i class="fas fa-user-edit text-secondary me-2"></i>
                        Publicações
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
			
                <div class="row g-4">
				<?php if ( is_author() ) : pixgo_author_box(); endif; ?>
                    <?php while ( have_posts() ) : the_post(); ?>
                        <div class="col-md-6">
                            <article class="card h-100 shadow-sm border-0 overflow-hidden post-card">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <div class="post-thumb overflow-hidden">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('medium_large', [
                                                'class' => 'img-fluid w-100',
                                                'loading' => 'lazy',
                                                'alt' => get_the_title()
                                            ]); ?>
                                        </a>
                                    </div>
                                <?php else : ?>
                                    <div class="post-thumb overflow-hidden text-center bg-light-subtle">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php
                                                $logo_id = get_theme_mod('custom_logo');
                                                $logo_src = '';
                                                if ( $logo_id ) {
                                                    $img = wp_get_attachment_image_src( $logo_id, 'medium_large' );
                                                    if ( $img ) $logo_src = $img[0];
                                                }
                                                if ( ! $logo_src ) {
                                                    $logo_src = get_template_directory_uri() . '/img/Logo-PixGo.png';
                                                }
                                            ?>
                                            <img src="<?php echo esc_url( $logo_src ); ?>" class="img-fluid p-3" alt="<?php bloginfo('name'); ?>">
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <div class="card-body">
                                    <h2 class="h5 card-title">
                                        <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark">
                                            <?php the_title(); ?>
                                        </a>
                                    </h2>
                                    <p class="text-muted small mb-2 d-flex align-items-center flex-wrap gap-2">
                                        <span>
                                            <i class="fas fa-user me-1 text-primary"></i>
                                            <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" 
                                            class="text-decoration-none text-muted fw-semibold hover-text-primary">
                                                <?php the_author(); ?>
                                            </a>
                                        </span>

                                        <span class="mx-2">•</span>

                                        <span>
                                            <i class="fas fa-clock me-1 text-primary"></i>
                                            <a href="<?php echo esc_url(get_day_link(get_the_time('Y'), get_the_time('m'), get_the_time('d'))); ?>" 
                                            class="text-decoration-none text-muted fw-semibold hover-text-primary">
                                                <?php echo get_the_date(); ?>
                                            </a>
                                        </span>
                                    </p>

                                    <p class="card-text"><?php echo wp_trim_words( get_the_excerpt(), 25, '...' ); ?></p>
                                </div>

                                <div class="card-footer bg-transparent border-0 pb-3 px-3">
                                    <a href="<?php the_permalink(); ?>" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-arrow-right me-1"></i> Ler mais
                                    </a>
                                </div>
                            </article>
                        </div>
                    <?php endwhile; ?>
                </div>

                <?php $prev = get_previous_posts_link('<i class="fas fa-arrow-left me-1"></i> Anterior'); $next = get_next_posts_link('Próximo <i class="fas fa-arrow-right ms-1"></i>'); $justify_class = ($prev && $next) ? 'justify-content-center justify-content-md-between' : 'justify-content-center'; $center_single = ($prev && $next) ? '' : ' mx-auto'; ?>
                <div class="mt-4 d-flex gap-2 <?php echo $justify_class; ?>">
                    <?php if ( $prev ) : ?>
                        <div><?php echo preg_replace('/<a /', '<a class="btn btn-outline-secondary btn-sm' . $center_single . '" ', $prev); ?></div>
                    <?php endif; ?>
                    <?php if ( $next ) : ?>
                        <div><?php echo preg_replace('/<a /', '<a class="btn btn-outline-secondary btn-sm' . $center_single . '" ', $next); ?></div>
                    <?php endif; ?>
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
