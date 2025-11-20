<?php
/**
 * Template de resultados de pesquisa
 * Tema: Institutional 01
 */

get_header();
?>

<div class="container my-2">
    <div class="row">
        <!-- Conteúdo principal -->
        <div class="col-lg-8">
            <article class="card shadow-sm p-4 mb-4">
                <header class="mb-4 border-bottom pb-2">
                    <?php if (have_posts()) : ?>
                        <h1 class="h3 text-primary mb-0">
                            <i class="fas fa-search me-2"></i>
                            Resultados para: 
                            <span class="text-dark">"<?php echo esc_html(get_search_query()); ?>"</span>
                        </h1>
                    <?php else : ?>
                        <h1 class="h3 text-danger mb-0">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Nenhum resultado encontrado
                        </h1>
                    <?php endif; ?>
                </header>

                <?php if (have_posts()) : ?>
                    <div class="row g-4">
                    <?php while (have_posts()) : the_post(); ?>
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
                                            <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="text-decoration-none text-muted fw-semibold hover-text-primary">
                                                <?php the_author(); ?>
                                            </a>
                                        </span>
                                        <span class="mx-2">•</span>
                                        <span>
                                            <i class="fas fa-clock me-1 text-primary"></i>
                                            <a href="<?php echo esc_url(get_day_link(get_the_time('Y'), get_the_time('m'), get_the_time('d'))); ?>" class="text-decoration-none text-muted fw-semibold hover-text-primary">
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

                    <!-- Paginação -->
                    <div class="mt-4">
                        <?php
                        the_posts_pagination([
                            'mid_size' => 2,
                            'prev_text' => '<i class="fas fa-angle-left"></i> Anterior',
                            'next_text' => 'Próximo <i class="fas fa-angle-right"></i>',
                            'class' => 'pagination justify-content-center',
                        ]);
                        ?>
                    </div>
                <?php else : ?>
                    <div class="alert alert-warning mt-3">
                        <p>Não encontramos resultados para sua pesquisa. Tente usar outras palavras-chave ou refine os termos buscados.</p>
                    </div>

                    <!-- Campo de pesquisa dentro do alerta -->
                    <form role="search" method="get" class="d-flex mt-3" action="<?php echo esc_url(home_url('/')); ?>">
                        <input type="search" class="form-control me-2" placeholder="Pesquisar novamente..." value="<?php echo esc_attr(get_search_query()); ?>" name="s">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                <?php endif; ?>
            </article>
        </div>

        <!-- Barra lateral -->
        <div class="col-lg-4">
            <?php get_sidebar(); ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
