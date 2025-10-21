<?php

/*********************************************************************************************************
TO DO LIST
--------------------

**********************************************************************************************************/

// 1. Configuração do Tema e Enqueue de Scripts
function pixgo_theme_setup() {
    // Suporte a Título Dinâmico
    add_theme_support( 'title-tag' );

    // Suporte a Miniaturas de Posts
    add_theme_support( 'post-thumbnails' );

    // Suporte a Logo Personalizada
    add_theme_support( 'custom-logo', array(
        //'height'      => 150,
        //'width'      => 150,
        'class'          => 'custom-logo',
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    ) );

    // Suporte ao Site Icon (Favicon)
    add_theme_support( 'site-icon' );

    // Registra menus
    register_nav_menus( array(
        'primary' => __( 'Menu Principal', 'pixgo-theme' ),
    ) );
}
add_action( 'after_setup_theme', 'pixgo_theme_setup' );

// 2. Enqueue do Bootstrap e Arquivos Customizados
function pixgo_scripts() {
    // Bootstrap 5 CSS (Via CDN para simplicidade)
    wp_enqueue_style( 'bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css', array(), '5.3.3' );

    //Font Awesome Free
    wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css', array(), '6.5.1' );

    // CSS do Tema
    //wp_enqueue_style( 'pixgo-style', get_stylesheet_uri(), array( 'bootstrap-css' ), '1.0' );
    // sem cache - força atualizar a cada edição
    wp_enqueue_style( 'theme-style', get_stylesheet_uri(), [], filemtime(get_stylesheet_directory() . '/style.css') 
);


    // Bootstrap 5 JS Bundle
    wp_enqueue_script( 'bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array( 'jquery' ), '5.3.3', true );

    // Script principal do tema
    //wp_enqueue_script( 'pixgo-main', get_template_directory_uri() . '/js/main.js', array( 'jquery', 'bootstrap-js' ), '1.0', true );
    // sem cache - força atualizar a cada edição
    wp_enqueue_script( 'pixgo-main', get_template_directory_uri() . '/js/main.js', array( 'jquery', 'bootstrap-js' ), time(), true );

}
add_action( 'wp_enqueue_scripts', 'pixgo_scripts' );

// Scripts para comentários
function pixgo_enqueue_comment_reply() {
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'pixgo_enqueue_comment_reply' );

// Permite shortcodes nas descrições de tags e categorias
add_filter('term_description', 'do_shortcode');

// Registrar menu
function meu_tema_registrar_menus() {
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'textdomain' ),
    ) );
}
add_action( 'after_setup_theme', 'meu_tema_registrar_menus' );

// Incluir Navwalker com segurança (ajuste o caminho se necessário)
$navwalker_file = get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';
if ( file_exists( $navwalker_file ) ) {
    require_once $navwalker_file;
}

// 3. Registro dos Modelos de Página Personalizados
// Inclui modelos para as páginas institucionais existentes e as novas solicitadas.
function pixgo_register_page_templates( $templates ) {

    $templates['page-templates/template-home.php'] = 'Home (Institucional)';
    $templates['page-templates/template-sobre.php'] = 'Sobre a Empresa';
    $templates['page-templates/template-precos.php'] = 'Tabela de Preços';
    $templates['page-templates/template-como-funciona.php'] = 'Como Funciona / Documentação';
    $templates['page-templates/template-afiliados.php'] = 'Programa de Afiliados';
	$templates['page-templates/template-contato.php'] = 'Contato';

    return $templates;
}
add_filter( 'theme_page_templates', 'pixgo_register_page_templates' );

// 4. WordPress Customizer para Opções de Design
function pixgo_customize_register( $wp_customize ) {

    // --- Painel de Configurações ---
    $wp_customize->add_panel( 'pixgo_theme_settings', array(
        'title' => __( 'Opções de Design', 'pixgo-theme' ),
        'priority' => 160,
    ) );

    // --- Seção de Cores ---
    $wp_customize->add_section( 'pixgo_color_settings', array(
        'title' => __( 'Cores do Header e Footer', 'pixgo-theme' ),
        'panel' => 'pixgo_theme_settings',
    ) );

    // Configuração da Cor da Barra Superior (Header)
    $wp_customize->add_setting( 'header_bg_color', array(
        'default' => '#007bff', // Cor primária do Bootstrap como default
        'transport' => 'refresh',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_bg_color_control', array(
        'label' => __( 'Cor de Fundo da Barra Superior', 'pixgo-theme' ),
        'section' => 'pixgo_color_settings',
        'settings' => 'header_bg_color',
    ) ) );

    // Configuração da Cor do Rodapé (Footer)
    $wp_customize->add_setting( 'footer_bg_color', array(
        'default' => '#343a40', // Cor escura do Bootstrap (dark) como default
        'transport' => 'refresh',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_bg_color_control', array(
        'label' => __( 'Cor de Fundo do Rodapé', 'pixgo-theme' ),
        'section' => 'pixgo_color_settings',
        'settings' => 'footer_bg_color',
    ) ) );

    // --- Seção de Modo Dark ---
    $wp_customize->add_section( 'pixgo_dark_mode_settings', array(
        'title' => __( 'Modo Dark', 'pixgo-theme' ),
        'panel' => 'pixgo_theme_settings',
    ) );

    // Opção para Ativar/Desativar Dark Mode
    $wp_customize->add_setting( 'enable_dark_mode', array(
        'default' => false,
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_validate_boolean',
    ) );
    $wp_customize->add_control( 'enable_dark_mode_control', array(
        'label' => __( 'Ativar Tema Escuro (Dark Mode)', 'pixgo-theme' ),
        'section' => 'pixgo_dark_mode_settings',
        'type' => 'checkbox',
        'settings' => 'enable_dark_mode',
    ) );
	
	// --- Seção do Google AdSense ---
    $wp_customize->add_section( 'pixgo_adsense_settings', array(
        'title' => __( 'Google AdSense', 'pixgo-theme' ),
        'panel' => 'pixgo_theme_settings',
    ) );

    // Campo para inserir o ID do AdSense (ca-pub-xxxxx)
    $wp_customize->add_setting( 'adsense_account_id', array(
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'adsense_account_id_control', array(
        'label' => __( 'ID da conta AdSense (ex: ca-pub-1234567890)', 'pixgo-theme' ),
        'section' => 'pixgo_adsense_settings',
        'settings' => 'adsense_account_id',
        'type' => 'text',
    ) );
	
	// Título BARRA LATERAL CHAMADA PRA AÇÃO
    $wp_customize->add_setting('pixgo_focus_title', array(
        'default' => 'Foco do PixGo',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('pixgo_focus_title', array(
        'label' => 'Título do Card',
        'section' => 'title_tagline', // você pode criar uma seção custom
        'type' => 'text',
    ));

    // Primeiro parágrafo
    $wp_customize->add_setting('pixgo_focus_text1', array(
        'default' => 'Nossa proposta de valor é a <strong>facilidade de integração</strong> e o <strong>preço justo por requisição</strong>.',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('pixgo_focus_text1', array(
        'label' => 'Texto 1 do Card',
        'section' => 'title_tagline',
        'type' => 'textarea',
    ));

    // Segundo parágrafo
    $wp_customize->add_setting('pixgo_focus_text2', array(
        'default' => 'Com o modelo de <strong>créditos pré-pagos</strong>, você paga apenas pelo uso real da API.',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('pixgo_focus_text2', array(
        'label' => 'Texto 2 do Card',
        'section' => 'title_tagline',
        'type' => 'textarea',
    ));

    // Texto do botão
    $wp_customize->add_setting('pixgo_focus_button', array(
        'default' => 'Começar Grátis Agora',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('pixgo_focus_button', array(
        'label' => 'Texto do Botão',
        'section' => 'title_tagline',
        'type' => 'text',
    ));
	// FIM BARRA LATERAL CHAMADA PRA AÇÃO

}
add_action( 'customize_register', 'pixgo_customize_register' );

// Garante que a categoria "Blog" exista
function pixgo_ensure_blog_category_exists() {
    $category_name = 'Blog';

    // Verifica se a categoria já existe (não diferencia maiúsculas/minúsculas)
    $category = get_term_by('name', $category_name, 'category');

    // Caso não exista, cria a categoria
    if (!$category) {
        wp_insert_term(
            $category_name,      // Nome da categoria
            'category',          // Taxonomia
            array(
                'slug' => 'blog',
                'description' => 'Publicações gerais do blog.'
            )
        );
    }
}
add_action('after_setup_theme', 'pixgo_ensure_blog_category_exists');

// Insere a meta tag do AdSense no <head>
function pixgo_add_adsense_meta_tag() {
    $adsense_id = get_theme_mod( 'adsense_account_id' );

    if ( ! empty( $adsense_id ) ) {
        echo '<meta name="google-adsense-account" content="' . esc_attr( $adsense_id ) . '">' . "\n";
    }
}
add_action( 'wp_head', 'pixgo_add_adsense_meta_tag' );

// 5. Gera CSS Dinâmico para as Cores
function pixgo_customizer_css() {
    $header_bg_color = get_theme_mod( 'header_bg_color', '#007bff' );
    $footer_bg_color = get_theme_mod( 'footer_bg_color', '#343a40' );
    $dark_mode_enabled = get_theme_mod( 'enable_dark_mode', false );

    $css = '';

    // Cores dinâmicas do Bootstrap Navbar (Header)
    $css .= ".navbar-custom { background-color: {$header_bg_color} !important; }";
    $css .= ".navbar-custom .nav-link, .navbar-custom .navbar-brand { color: #fff; }";

    // Cores dinâmicas do Footer
    $css .= ".footer-custom { background-color: {$footer_bg_color} !important; color: #f8f9fa; padding: 20px 0; }";
    $css .= ".footer-custom a { color: #ccc; }";

    // Dark Mode
    if ( $dark_mode_enabled ) {
        $css .= "
        body { background-color: #121212; color: #f8f9fa; }
        .card, .bg-light { background-color: #1e1e1e !important; color: #f8f9fa !important; border-color: #444; }
        .table { color: #f8f9fa; }
        ";
    }

    if ( ! empty( $css ) ) {
        echo '<style type="text/css">' . $css . '</style>';
    }
}
add_action( 'wp_head', 'pixgo_customizer_css' );

// Adiciona classes Bootstrap aos elementos do CF7
add_filter('wpcf7_form_elements', function($content) {
    // Inputs e textarea
    $content = preg_replace('/<(input|textarea|select)(.*?)class="(.*?)"/', '<$1$2class="$3 form-control"', $content);

    // Botão de envio
    $content = str_replace('wpcf7-submit', 'wpcf7-submit btn btn-primary btn-sm', $content);

    return $content;
});

// ============================================================================
// 🔧 Filtro global para imagens modernas e shortcodes em posts e páginas
// ============================================================================
add_filter('the_content', function($content) {
    // --- Executa shortcodes primeiro ---
    $content = do_shortcode($content);

    // --- Melhora todas as imagens dentro do conteúdo ---
    $content = preg_replace_callback(
        '/<img(.*?)>/i',
        function ($matches) {
            $img = $matches[0];

            // Adiciona lazy loading
            if (strpos($img, 'loading=') === false) {
                $img = str_replace('<img', '<img loading="lazy"', $img);
            }

            // Adiciona classes modernas
            if (strpos($img, 'class=') === false) {
                $img = str_replace('<img', '<img class="img-fluid rounded shadow-sm my-3"', $img);
            } else {
                $img = preg_replace('/class="(.*?)"/', 'class="$1 img-fluid rounded shadow-sm my-3"', $img);
            }

            // Obtém o src
            if (preg_match('/src=["\'](.*?)["\']/', $img, $srcMatch)) {
                $src = $srcMatch[1];

                // Tenta obter a versão full da imagem
                $attachment_id = attachment_url_to_postid($src);
                if ($attachment_id) {
                    $full_src = wp_get_attachment_image_url($attachment_id, 'full');
                    $src = $full_src ?: $src;
                }

                // Envolve a imagem com link para modal (lightbox)
                $img = '<a href="#" data-bs-toggle="modal" data-bs-target="#imageModal" data-img="' . esc_url($src) . '">' . $img . '</a>';
            }

            return $img;
        },
        $content
    );

    return $content;
}, 12);

// Máscaras para o Contact Form 7
function cf7_enqueue_mask_script() {
    wp_enqueue_script('jquery-mask', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js', ['jquery'], '1.14.16', true);
    wp_add_inline_script('jquery-mask', "
        jQuery(function($){
            $('input[name=\"tel-105\"]').mask('(00) 00000-0000');
        });
    ");
}
add_action('wp_enqueue_scripts', 'cf7_enqueue_mask_script');

// ============================================================================
// Função para exibir vídeos do YouTube com lazy loading e thumbnail
// ============================================================================
function lazy_youtube_video($url) {
    // Extrai o ID do vídeo do YouTube
    preg_match('/(?:youtu\.be\/|v=)([^&]+)/', $url, $matches);
    if (empty($matches[1])) return ''; // URL inválida
    $video_id = $matches[1];

    // URLs de imagem
    $thumb_hd = "https://img.youtube.com/vi/{$video_id}/maxresdefault.jpg";
    $thumb_hq = "https://img.youtube.com/vi/{$video_id}/hqdefault.jpg";

    ob_start(); ?>
    <div class="ratio ratio-16x9 mx-auto lazy-video my-4" 
         data-src="https://www.youtube.com/embed/<?php echo esc_attr($video_id); ?>?rel=0">
        <picture>
            <!-- Tenta carregar imagem HD, e se falhar, usa a HQ -->
            <img loading="lazy" src="<?php echo esc_url($thumb_hd); ?>" 
                 onerror="this.onerror=null;this.src='<?php echo esc_url($thumb_hq); ?>';"
                 class="img-fluid rounded shadow-sm"
                 alt="Thumbnail do vídeo">
        </picture>
        <button class="play-btn" aria-label="Reproduzir vídeo"></button>
    </div>
    <?php
    return ob_get_clean();
}

// ============================================================================
// Shortcode: [youtube_lazy url="https://youtu.be/abc123XYZ"]
// ============================================================================
function shortcode_lazy_youtube($atts) {
    $atts = shortcode_atts(
        array(
            'url' => '',
        ),
        $atts,
        'youtube_lazy'
    );

    return lazy_youtube_video($atts['url']);
}
add_shortcode('youtube_lazy', 'shortcode_lazy_youtube');

// Função para exibir o perfil do autor
function pixgo_author_box($author_id = null) {
    if (!$author_id) {
        $author_id = get_the_author_meta('ID');
    }

    $author_name = get_the_author_meta('display_name', $author_id);
    $author_bio = get_the_author_meta('description', $author_id);
    $author_avatar = get_avatar_url($author_id, array('size' => 220));
    $author_url = get_author_posts_url($author_id);
    $author_website = get_the_author_meta('user_url', $author_id);

    // Redes sociais e outros links
    $socials = array(
        'twitter'   => get_the_author_meta('twitter', $author_id),
        'facebook'  => get_the_author_meta('facebook', $author_id),
        'linkedin'  => get_the_author_meta('linkedin', $author_id),
        'email'     => get_the_author_meta('user_email', $author_id),
        'instagram' => get_the_author_meta('instagram', $author_id),
        'pinterest' => get_the_author_meta('pinterest', $author_id),
        'myspace'   => get_the_author_meta('myspace', $author_id),
        'soundcloud'=> get_the_author_meta('soundcloud', $author_id),
        'tumblr'    => get_the_author_meta('tumblr', $author_id),
        'wikipedia' => get_the_author_meta('wikipedia', $author_id),
        'youtube'   => get_the_author_meta('youtube', $author_id),
    );

    // Ícones correspondentes
    $icons = array(
        'twitter'   => 'fab fa-twitter text-info',
        'facebook'  => 'fab fa-facebook-f text-primary',
        'linkedin'  => 'fab fa-linkedin-in text-primary',
        'email'     => 'fas fa-envelope text-danger',
        'instagram' => 'fab fa-instagram text-danger',
        'pinterest' => 'fab fa-pinterest text-danger',
        'myspace'   => 'fab fa-myspace text-secondary',
        'soundcloud'=> 'fab fa-soundcloud text-warning',
        'tumblr'    => 'fab fa-tumblr text-primary',
        'wikipedia' => 'fab fa-wikipedia-w text-dark',
        'youtube'   => 'fab fa-youtube text-danger',
    );

    ?>
    <section class="author-box card border-0 shadow-sm mt-1">
        <div class="card-body d-flex flex-wrap align-items-center">

            <!-- Avatar -->
            <div class="author-avatar me-4 mb-3 mb-md-0">
                <img src="<?php echo esc_url($author_avatar); ?>" 
                     alt="<?php echo esc_attr($author_name); ?>" 
                     class="rounded-circle shadow-sm border border-light">
            </div>

            <!-- Infos -->
            <div class="author-info flex-grow-1">
                <h5 class="fw-bold mb-2">
                    <a href="<?php echo esc_url($author_url); ?>" class="text-decoration-none text-dark">
                        <?php echo esc_html($author_name); ?>
                    </a>
                </h5>

                <?php if ($author_bio) : ?>
                    <p class="text-muted mb-3 fs-6"><?php echo wp_kses_post( wp_trim_words( $author_bio, 50, '...' ) );  ?></p>
                <?php else : ?>
                    <p class="text-muted mb-3">Autor deste artigo no blog PixGo.</p>
                <?php endif; ?>

                <!-- Botões de Links -->
                <div class="d-flex flex-wrap gap-2 author-buttons">

                    <!-- Sempre mostrar "Mais posts" -->
                    <a href="<?php echo esc_url($author_url); ?>" class="btn btn-outline-primary btn-sm d-flex align-items-center gap-1">
                        <i class="fas fa-user"></i> Mais posts
                    </a>

                    <?php if ($author_website) : ?>
                        <a href="<?php echo esc_url($author_website); ?>" target="_blank" class="btn btn-outline-secondary btn-sm d-flex align-items-center gap-1">
                            <i class="fas fa-globe"></i> Site pessoal
                        </a>
                    <?php endif; ?>

                    <?php
                    // Loop para redes sociais adicionais
                    foreach ($socials as $key => $link) {
                        if ($link) {
                            $url = $link;
                            if ($key === 'twitter') $url = "https://twitter.com/" . esc_attr($link);
                            if ($key === 'email') $url = "mailto:" . esc_attr($link);
                            if ($key === 'instagram') $url = "https://instagram.com/" . esc_attr($link);
                            if ($key === 'pinterest') $url = "https://pinterest.com/" . esc_attr($link);
                            if ($key === 'myspace') $url = "https://myspace.com/" . esc_attr($link);
                            if ($key === 'soundcloud') $url = "https://soundcloud.com/" . esc_attr($link);
                            if ($key === 'tumblr') $url = "https://" . esc_attr($link) . ".tumblr.com/";
                            if ($key === 'wikipedia') $url = esc_url($link); // Espera link completo
                            if ($key === 'youtube') $url = "https://youtube.com/" . esc_attr($link);
                            ?>
                            <a href="<?php echo esc_url($url); ?>" target="_blank" class="btn btn-outline-dark btn-sm d-flex align-items-center gap-1">
                                <i class="<?php echo esc_attr($icons[$key]); ?>"></i> <?php echo ucfirst($key); ?>
                            </a>
                            <?php
                        }
                    }
                    ?>

                </div>
            </div>
        </div>
    </section>
    <?php
}

// Função para exibir botões de compartilhamento social
function pixgo_share_buttons($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $post_url = urlencode(get_permalink($post_id));
    $post_title = urlencode(get_the_title($post_id));

    // Lista de redes sociais e sites de compartilhamento
    $social_sites = array(
        'facebook'   => 'https://www.facebook.com/sharer/sharer.php?u=' . $post_url,
        'twitter'    => 'https://twitter.com/intent/tweet?text=' . $post_title . '&url=' . $post_url,
        'linkedin'   => 'https://www.linkedin.com/sharing/share-offsite/?url=' . $post_url,
        'reddit'     => 'https://www.reddit.com/submit?url=' . $post_url . '&title=' . $post_title,
        'pinterest'  => 'https://pinterest.com/pin/create/button/?url=' . $post_url . '&description=' . $post_title,
        'tumblr'     => 'https://www.tumblr.com/widgets/share/tool?canonicalUrl=' . $post_url . '&title=' . $post_title,
        'whatsapp'   => 'https://api.whatsapp.com/send?text=' . $post_title . '%20' . $post_url,
        'telegram'   => 'https://t.me/share/url?url=' . $post_url . '&text=' . $post_title,
        'email'      => 'mailto:?subject=' . $post_title . '&body=' . $post_url,
        'hackernews' => 'https://news.ycombinator.com/submitlink?u=' . $post_url . '&t=' . $post_title,
    );

    // Ícones Font Awesome correspondentes
    $icons = array(
        'facebook'   => 'fab fa-facebook-f text-primary',
        'twitter'    => 'fab fa-twitter text-info',
        'linkedin'   => 'fab fa-linkedin-in text-primary',
        'reddit'     => 'fab fa-reddit-alien text-danger',
        'pinterest'  => 'fab fa-pinterest-p text-danger',
        'tumblr'     => 'fab fa-tumblr text-primary',
        'whatsapp'   => 'fab fa-whatsapp text-success',
        'telegram'   => 'fab fa-telegram-plane text-info',
        'email'      => 'fas fa-envelope text-secondary',
        'hackernews' => 'fab fa-hacker-news text-warning',
    );

    echo '<div class="pixgo-share-buttons d-flex flex-wrap justify-content-center gap-2 mt-3 ps-2 pe-2">';
    foreach ($social_sites as $key => $link) {
        echo '<a href="' . esc_url($link) . '" target="_blank" class="btn btn-outline-dark btn-sm d-flex align-items-center gap-1">';
        echo '<i class="' . esc_attr($icons[$key]) . '"></i> ' . ucfirst($key);
        echo '</a>';
    }
    echo '</div>';
}

// Função para exibir o card "Foco do PixGo"
function pixgo_sidebar_focus_card($register_url = null) {
    if (!$register_url) {
        $register_url = esc_url(home_url('/register'));
    }

    ?>
    <aside class="card p-4 shadow-sm mb-4">
        <h4 class="mb-3 text-primary">
            <i class="fas fa-bolt me-2"></i> <?php echo esc_html(get_theme_mod('pixgo_focus_title', 'Foco do PixGo')); ?>
        </h4>
        <p><?php echo wp_kses_post(get_theme_mod('pixgo_focus_text1', 'Nossa proposta de valor é a <strong>facilidade de integração</strong> e o <strong>preço justo por requisição</strong>.')); ?></p>
        <p><?php echo wp_kses_post(get_theme_mod('pixgo_focus_text2', 'Com o modelo de <strong>créditos pré-pagos</strong>, você paga apenas pelo uso real da API.')); ?></p>
        <div class="text-center mt-3">
            <a href="<?php echo esc_url($register_url); ?>" class="btn btn-warning btn-sm px-4">
                <i class="fas fa-rocket me-2"></i> <?php echo esc_html(get_theme_mod('pixgo_focus_button', 'Começar Grátis Agora')); ?>
            </a>
        </div>
    </aside>
    <?php
}



