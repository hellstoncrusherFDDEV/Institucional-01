<?php
/**
 * Template de resultados de pesquisa
 * Tema: Institutional 01
 */

get_header();
?>

<div class="container my-5">
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
                    <?php while (have_posts()) : the_post(); ?>
                        <div class="border-bottom py-4">
                            <h2 class="h5 mb-2 fw-bold">
                                <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark">
                                    <?php the_title(); ?>
                                </a>
                            </h2>

                            <p class="text-muted small mb-3">
                                <i class="far fa-calendar-alt me-1"></i> <?php echo get_the_date(); ?>
                                <?php if (has_category()) : ?>
                                    &nbsp;|&nbsp;
                                    <i class="fas fa-folder-open me-1"></i> <?php the_category(', '); ?>
                                <?php endif; ?>
                            </p>

                            <?php if (has_post_thumbnail()) : ?>
                                <div class="mb-3">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('medium_large', [
                                            'class' => 'img-fluid rounded shadow-sm',
                                            'alt' => get_the_title()
                                        ]); ?>
                                    </a>
                                </div>
                            <?php endif; ?>

                            <?php
                            // Exibe o conteúdo processando shortcodes e vídeos
                            $content = apply_filters('the_content', get_the_content());
                            echo wp_kses_post(wp_trim_words($content, 50, '...'));
                            ?>

                            <div class="mt-3">
                                <a href="<?php the_permalink(); ?>" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-arrow-right me-1"></i> Ler mais
                                </a>
                            </div>
                        </div>
                    <?php endwhile; ?>

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
