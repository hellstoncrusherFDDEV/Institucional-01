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
            
            <?php if ( !is_single() || !is_page() ) : ?>

            <header class="mb-4">
                <h1 class="display-5">Conteúdo Principal</h1>
                <p class="lead">Página padrão do tema. Para conteúdos específicos (Home, Preços, Contato), utilize os Modelos de Página.</p>
            </header>

            <?php endif; ?>
            
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
                <section class="mt-5">
                    <div class="alert alert-secondary" role="alert">
                        <h4 class="alert-heading">Conteúdo Não Encontrado</h4>
                        <p>Lamentamos, mas não foi encontrado nenhum conteúdo para exibir nesta área.</p>
                        <hr>
                        <p class="mb-0">Verifique a <a href="<?php echo esc_url( home_url( '/' ) ); ?>page=como_funciona">Documentação da API</a> ou a <a href="<?php echo esc_url( home_url( '/' ) ); ?>page=precos">Tabela de Preços</a>, que são o foco institucional do PixGo.</p>
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
