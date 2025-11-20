<?php
/**
 * The main template file (Fallback)
 *
 * Este arquivo é o principal fallback do tema.
 * Ele carrega o cabeçalho, o loop de posts/páginas e o rodapé.
 *
 * Tema: Institucional 01
 *
 */

get_header();
?>

    <div class="row">

        <div class="col-lg-8">
            
            <?php
            // 2. O Loop do WordPress
            if ( have_posts() ) :
                
                // Exibe o conteúdo
                while ( have_posts() ) :
                    the_post();
                    
                    // Carrega a parte do template para exibir o post/página (template-parts/content.php)
                    get_template_part( 'template-parts/content', get_post_type() );

                endwhile;
                
                // Navegação entre posts/páginas (se necessário)
                the_posts_navigation();

            else :
                // 3. Conteúdo não encontrado (fallback para páginas 404 genéricas, se o 404.php não existir)
                ?>
                <section class="mt-0">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h4 class="card-title mb-2">Conteúdo Não Encontrado</h4>
                            <p class="mb-3">Lamentamos, mas não foi encontrado nenhum conteúdo para exibir nesta área.</p>
                            <div class="cta-block p-3 rounded">
                                <h4 class="mb-2"><?php echo esc_html( get_theme_mod( 'cta_footer_title', 'Pronto para Integrar?' ) ); ?></h4>
                                <p class="mb-2"><?php echo wp_kses_post( get_theme_mod( 'cta_footer_text', 'A PixGo oferece facilidade de integração e preço justo por requisição. Nosso modelo de créditos pré-pagos garante que você pague somente pelo uso.' ) ); ?></p>
                                <a href="<?php echo esc_url( get_theme_mod( 'cta_footer_primary_url', '/register' ) ); ?>" class="btn btn-success me-2 mb-2"><?php echo esc_html( get_theme_mod( 'cta_footer_primary_text', 'Começar Grátis' ) ); ?></a>
                                <a href="<?php echo esc_url( get_theme_mod( 'cta_footer_secondary_url', '/como-funciona' ) ); ?>" class="btn btn-primary mb-2"><?php echo esc_html( get_theme_mod( 'cta_footer_secondary_text', 'Ver Documentação da API' ) ); ?></a>
                            </div>
                        </div>
                    </div>
                </section>
                <?php
            endif;
            ?>

        </div>
        
        <!-- Sidebar Simples de Contexto -->
        <div class="col-lg-4 pt-5 pt-lg-0">
            <?php get_sidebar(); ?>
        </div>
        
    </div>

<?php
get_footer();
