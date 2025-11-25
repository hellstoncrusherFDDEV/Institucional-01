<?php

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
    add_theme_support( 'automatic-feed-links' );

    load_theme_textdomain( 'institucional-01', get_template_directory() . '/languages' );

    // Registra menus
    register_nav_menus( array(
        'primary' => __( 'Menu Principal', 'institucional-01' ),
    ) );

    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'script', 'style' ) );
    add_theme_support( 'custom-header', array( 'width' => 1920, 'height' => 300, 'flex-height' => true, 'uploads' => true ) );
    add_theme_support( 'custom-background', array( 'default-color' => 'ffffff' ) );
    add_theme_support( 'align-wide' );
    add_editor_style( 'style.css' );
}
add_action( 'after_setup_theme', 'pixgo_theme_setup' );

function pixgo_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Primary Sidebar', 'institucional-01' ),
        'id'            => 'primary-sidebar',
        'description'   => __( 'Área de widgets principal.', 'institucional-01' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s card p-4 shadow-sm mb-4">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h5 class="mb-3">',
        'after_title'   => '</h5>',
    ) );
}
add_action( 'widgets_init', 'pixgo_widgets_init' );

function pixgo_register_block_assets() {
    if ( function_exists( 'register_block_style' ) ) {
        register_block_style( 'core/button', array( 'name' => 'btn-outline-primary', 'label' => __( 'Botão Outline Primário', 'institucional-01' ), 'style_handle' => 'theme-style' ) );
        register_block_style( 'core/image', array( 'name' => 'image-shadow', 'label' => __( 'Imagem com Sombra', 'institucional-01' ), 'style_handle' => 'theme-style' ) );
    }
    if ( function_exists( 'register_block_pattern_category' ) ) {
        register_block_pattern_category( 'pixgo', array( 'label' => __( 'PixGo', 'institucional-01' ) ) );
    }
    if ( function_exists( 'register_block_pattern' ) ) {
        register_block_pattern( 'pixgo/cta-primary', array(
            'title'       => __( 'CTA Primário', 'institucional-01' ),
            'description' => __( 'Chamada para ação com botão centralizado.', 'institucional-01' ),
            'content'     => '<!-- wp:group --><div class="wp-block-group"><!-- wp:heading {"textAlign":"center"} --><h2 class="has-text-align-center">' . esc_html__( 'Pronto para começar?', 'institucional-01' ) . '</h2><!-- /wp:heading --><!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} --><div class="wp-block-buttons"><!-- wp:button {"className":"is-style-outline"} --><div class="wp-block-button is-style-outline"><a class="wp-block-button__link" href="/register">' . esc_html__( 'Começar Grátis', 'institucional-01' ) . '</a></div><!-- /wp:button --></div><!-- /wp:buttons --></div><!-- /wp:group -->',
        ) );
    }
}
add_action( 'init', 'pixgo_register_block_assets' );

// 2. Enqueue do Bootstrap e Arquivos Customizados
function pixgo_scripts() {
    
    wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '5.3.3' );

    //Font Awesome Free
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/fontawesome.min.css', array(), '6.5.1' );

    // CSS do Tema
    //wp_enqueue_style( 'pixgo-style', get_stylesheet_uri(), array( 'bootstrap-css' ), '1.0' );
    // sem cache - força atualizar a cada edição
    wp_enqueue_style( 'theme-style', get_stylesheet_uri(), [], filemtime(get_stylesheet_directory() . '/style.css') 
);


    // Bootstrap 5 JS Bundle
    wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array( 'jquery' ), '5.3.3', true );

    // Script principal do tema
    //wp_enqueue_script( 'pixgo-main', get_template_directory_uri() . '/js/main.js', array( 'jquery', 'bootstrap-js' ), '1.0', true );
    // sem cache - força atualizar a cada edição
    wp_enqueue_script( 'pixgo-main', get_template_directory_uri() . '/js/main.js', array( 'jquery', 'bootstrap-js' ), filemtime( get_template_directory() . '/js/main.js' ), true );
    wp_enqueue_script( 'jquery-mask', get_template_directory_uri() . '/assets/js/jquery.mask.min.js', array( 'jquery' ), '1.0.0', true );
    wp_add_inline_script( 'jquery-mask', 'jQuery(function($){$("input[name=\"tel-105\"]").mask("(00) 00000-0000");});' );
   
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

// Incluir Navwalker com segurança (ajuste o caminho se necessário)
$navwalker_file = get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';
if ( file_exists( $navwalker_file ) ) {
    require_once $navwalker_file;
}
function pixgo_nav_link_attrs( $atts, $item, $args, $depth ) {
    if ( isset($args->theme_location) && $args->theme_location === 'primary' ) {
        $classes = isset($atts['class']) ? $atts['class'] : '';
        $classes .= ( $classes ? ' ' : '' ) . 'nav-link fw-bold';
        if ( !empty($item->current) || !empty($item->current_item_ancestor) ) {
            $classes .= ' active';
        }
        $atts['class'] = $classes;
    }
    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'pixgo_nav_link_attrs', 10, 4 );
function pixgo_nav_item_classes( $classes, $item, $args, $depth ) {
    if ( isset($args->theme_location) && $args->theme_location === 'primary' ) {
        $classes[] = 'nav-item';
        if ( !empty($item->current) || in_array('current-menu-item', (array)$classes, true) ) {
            $classes[] = 'active';
        }
    }
    return $classes;
}
add_filter( 'nav_menu_css_class', 'pixgo_nav_item_classes', 10, 4 );
function pixgo_nav_item_icon( $item_output, $item, $depth, $args ) {
    if ( isset($args->theme_location) && $args->theme_location === 'primary' && !empty($item->classes) ) {
        $icons = array();
        foreach ( (array) $item->classes as $class ) {
            if ( strpos($class, 'fa-') !== false || $class === 'fas' || $class === 'far' || $class === 'fab' ) {
                $icons[] = $class;
            }
        }
        if ( !empty($icons) ) {
            $icon_html = '<i class="' . esc_attr( implode(' ', $icons) ) . ' me-1"></i> ';
            $item_output = preg_replace( '/(<a[^>]*>)/', '$1' . $icon_html, $item_output, 1 );
        }
    }
    return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'pixgo_nav_item_icon', 10, 4 );

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
        'title' => __( 'Opções de Design', 'institucional-01' ),
        'priority' => 160,
    ) );

    $wp_customize->add_panel( 'pixgo_pages_content', array(
        'title' => __( 'Conteúdo das Páginas', 'institucional-01' ),
        'priority' => 165,
    ) );

    // Conteúdo: Home
    $wp_customize->add_section('pixgo_home_section', array(
        'title' => 'Página: Home',
        'panel' => 'pixgo_pages_content',
        'priority' => 10,
    ));
    $wp_customize->add_setting('home_hero_title', array('default' => 'PixGo: Sua API Pix Simples e Econômica', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('home_hero_title', array('label' => 'Título do Hero', 'section' => 'pixgo_home_section', 'type' => 'text'));
    $wp_customize->add_setting('home_hero_lead', array('default' => 'Gere QR Codes Pix e links de pagamento em segundos. Integre de forma fácil e pague apenas pelo que usar.', 'sanitize_callback' => 'wp_kses_post'));
    $wp_customize->add_control('home_hero_lead', array('label' => 'Descrição do Hero', 'section' => 'pixgo_home_section', 'type' => 'textarea'));
    $wp_customize->add_setting('home_hero_video_url', array('default' => 'https://www.youtube.com/watch?v=S86zAxbwa3k', 'sanitize_callback' => 'esc_url_raw'));
    $wp_customize->add_control('home_hero_video_url', array('label' => 'URL do Vídeo do Hero', 'section' => 'pixgo_home_section', 'type' => 'url'));
    $wp_customize->add_setting('home_cta_primary_text', array('default' => 'Comece Grátis Agora!', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('home_cta_primary_text', array('label' => 'Texto CTA Primário', 'section' => 'pixgo_home_section', 'type' => 'text'));
    $wp_customize->add_setting('home_cta_primary_url', array('default' => '/register', 'sanitize_callback' => 'esc_url_raw'));
    $wp_customize->add_control('home_cta_primary_url', array('label' => 'Link CTA Primário', 'section' => 'pixgo_home_section', 'type' => 'url'));
    $wp_customize->add_setting('home_cta_secondary_text', array('default' => 'Já sou Cliente', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('home_cta_secondary_text', array('label' => 'Texto CTA Secundário', 'section' => 'pixgo_home_section', 'type' => 'text'));
    $wp_customize->add_setting('home_cta_secondary_url', array('default' => '/login', 'sanitize_callback' => 'esc_url_raw'));
    $wp_customize->add_control('home_cta_secondary_url', array('label' => 'Link CTA Secundário', 'section' => 'pixgo_home_section', 'type' => 'url'));

    $wp_customize->add_setting('home_value_prop_title', array('default' => __('Por Que Escolher a PixGo?', 'institucional-01'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('home_value_prop_title', array('label' => __('Título Por Que Escolher', 'institucional-01'), 'section' => 'pixgo_home_section', 'type' => 'text'));
    $wp_customize->add_setting('home_value_prop_1_title', array('default' => __('Facilidade de Integração', 'institucional-01'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('home_value_prop_1_title', array('label' => __('Card 1 - Título', 'institucional-01'), 'section' => 'pixgo_home_section', 'type' => 'text'));
    $wp_customize->add_setting('home_value_prop_1_desc', array('default' => __('Nossa API é simples, com documentação clara e exemplos de código prontos. Integre o Pix em seus projetos em poucas horas, sem dor de cabeça.', 'institucional-01'), 'sanitize_callback' => 'wp_kses_post'));
    $wp_customize->add_control('home_value_prop_1_desc', array('label' => __('Card 1 - Texto', 'institucional-01'), 'section' => 'pixgo_home_section', 'type' => 'textarea'));
    $wp_customize->add_setting('home_value_prop_1_btn', array('default' => __('Ver Documentação', 'institucional-01'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('home_value_prop_1_btn', array('label' => __('Card 1 - Texto Botão', 'institucional-01'), 'section' => 'pixgo_home_section', 'type' => 'text'));
    $wp_customize->add_setting('home_value_prop_2_title', array('default' => __('Preço Justo por Requisição', 'institucional-01'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('home_value_prop_2_title', array('label' => __('Card 2 - Título', 'institucional-01'), 'section' => 'pixgo_home_section', 'type' => 'text'));
    $wp_customize->add_setting('home_value_prop_2_desc', array('default' => __('Você paga apenas R$ 0,02 ou R$ 0,05 por requisição, como um modelo de créditos pré-pagos, eliminando assinaturas mensais caras.', 'institucional-01'), 'sanitize_callback' => 'wp_kses_post'));
    $wp_customize->add_control('home_value_prop_2_desc', array('label' => __('Card 2 - Texto', 'institucional-01'), 'section' => 'pixgo_home_section', 'type' => 'textarea'));
    $wp_customize->add_setting('home_value_prop_2_btn', array('default' => __('Ver Tabela de Preços', 'institucional-01'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('home_value_prop_2_btn', array('label' => __('Card 2 - Texto Botão', 'institucional-01'), 'section' => 'pixgo_home_section', 'type' => 'text'));
    $wp_customize->add_setting('home_value_prop_3_title', array('default' => __('Escalabilidade e Confiabilidade', 'institucional-01'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('home_value_prop_3_title', array('label' => __('Card 3 - Título', 'institucional-01'), 'section' => 'pixgo_home_section', 'type' => 'text'));
    $wp_customize->add_setting('home_value_prop_3_desc', array('default' => __('Construído com PHP 8 e MySQL, ideal para pequenos apps e e-commerces que precisam escalar sem manter um servidor próprio.', 'institucional-01'), 'sanitize_callback' => 'wp_kses_post'));
    $wp_customize->add_control('home_value_prop_3_desc', array('label' => __('Card 3 - Texto', 'institucional-01'), 'section' => 'pixgo_home_section', 'type' => 'textarea'));
    $wp_customize->add_setting('home_value_prop_3_btn', array('default' => __('Saiba Mais', 'institucional-01'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('home_value_prop_3_btn', array('label' => __('Card 3 - Texto Botão', 'institucional-01'), 'section' => 'pixgo_home_section', 'type' => 'text'));
    $wp_customize->add_setting('home_target_title', array('default' => __('Quem se Beneficia com PixGo?', 'institucional-01'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('home_target_title', array('label' => __('Título Personas', 'institucional-01'), 'section' => 'pixgo_home_section', 'type' => 'text'));
    $wp_customize->add_setting('home_target_1_title', array('default' => __('Desenvolvedores Freelancers e Pequenos Times', 'institucional-01'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('home_target_1_title', array('label' => __('Persona 1 - Título', 'institucional-01'), 'section' => 'pixgo_home_section', 'type' => 'text'));
    $wp_customize->add_setting('home_target_1_quote', array('default' => __('Use esta API e gere QR Codes Pix com 3 linhas de código. Sem complicação.', 'institucional-01'), 'sanitize_callback' => 'wp_kses_post'));
    $wp_customize->add_control('home_target_1_quote', array('label' => __('Persona 1 - Texto', 'institucional-01'), 'section' => 'pixgo_home_section', 'type' => 'textarea'));
    $wp_customize->add_setting('home_target_1_small', array('default' => __('Ideal para integrar Pix em projetos em poucas horas, evitando a complexidade da documentação oficial do Mercado Pago.', 'institucional-01'), 'sanitize_callback' => 'wp_kses_post'));
    $wp_customize->add_control('home_target_1_small', array('label' => __('Persona 1 - Complemento', 'institucional-01'), 'section' => 'pixgo_home_section', 'type' => 'textarea'));
    $wp_customize->add_setting('home_target_2_title', array('default' => __('Pequenos E-commerces e Lojas Virtuais', 'institucional-01'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('home_target_2_title', array('label' => __('Persona 2 - Título', 'institucional-01'), 'section' => 'pixgo_home_section', 'type' => 'text'));
    $wp_customize->add_setting('home_target_2_quote', array('default' => __('Transforme pedidos em pagamentos Pix em segundos e pague só pelo que usar.', 'institucional-01'), 'sanitize_callback' => 'wp_kses_post'));
    $wp_customize->add_control('home_target_2_quote', array('label' => __('Persona 2 - Texto', 'institucional-01'), 'section' => 'pixgo_home_section', 'type' => 'textarea'));
    $wp_customize->add_setting('home_target_2_small', array('default' => __('Automação de pagamentos Pix sem plugins pesados ou mensalidades altas de gateways.', 'institucional-01'), 'sanitize_callback' => 'wp_kses_post'));
    $wp_customize->add_control('home_target_2_small', array('label' => __('Persona 2 - Complemento', 'institucional-01'), 'section' => 'pixgo_home_section', 'type' => 'textarea'));
    $wp_customize->add_setting('home_target_3_title', array('default' => __('Serviços Autônomos e Startups', 'institucional-01'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('home_target_3_title', array('label' => __('Persona 3 - Título', 'institucional-01'), 'section' => 'pixgo_home_section', 'type' => 'text'));
    $wp_customize->add_setting('home_target_3_quote', array('default' => __('Pare de gerar Pix manualmente. / Integre Pix em minutos e foque no crescimento.', 'institucional-01'), 'sanitize_callback' => 'wp_kses_post'));
    $wp_customize->add_control('home_target_3_quote', array('label' => __('Persona 3 - Texto', 'institucional-01'), 'section' => 'pixgo_home_section', 'type' => 'textarea'));
    $wp_customize->add_setting('home_target_3_small', array('default' => __('Gere cobranças avulsas rapidamente ou valide seu MVP integrando pagamentos de forma confiável e barata.', 'institucional-01'), 'sanitize_callback' => 'wp_kses_post'));
    $wp_customize->add_control('home_target_3_small', array('label' => __('Persona 3 - Complemento', 'institucional-01'), 'section' => 'pixgo_home_section', 'type' => 'textarea'));
    $wp_customize->add_setting('home_how_title', array('default' => __('Como Funciona?', 'institucional-01'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('home_how_title', array('label' => __('Título Como Funciona', 'institucional-01'), 'section' => 'pixgo_home_section', 'type' => 'text'));
    $wp_customize->add_setting('home_how_desc', array('default' => __('Com a PixGo, você cadastra sua chave do Mercado Pago na plataforma e usa nossa API para gerar QR Codes e links de pagamento. Nós cuidamos da complexidade, você foca no seu negócio.', 'institucional-01'), 'sanitize_callback' => 'wp_kses_post'));
    $wp_customize->add_control('home_how_desc', array('label' => __('Como Funciona - Texto', 'institucional-01'), 'section' => 'pixgo_home_section', 'type' => 'textarea'));
    $wp_customize->add_setting('home_model_title', array('default' => __('Modelo de Créditos Pré-Pagos', 'institucional-01'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('home_model_title', array('label' => __('Como Funciona - Modelo Créditos', 'institucional-01'), 'section' => 'pixgo_home_section', 'type' => 'text'));
    $wp_customize->add_setting('home_bottom_cta_text', array('default' => __('Quero Começar Agora!', 'institucional-01'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('home_bottom_cta_text', array('label' => __('Botão Final - Texto', 'institucional-01'), 'section' => 'pixgo_home_section', 'type' => 'text'));
    $wp_customize->add_setting('home_bottom_cta_url', array('default' => home_url('/register'), 'sanitize_callback' => 'esc_url_raw'));
    $wp_customize->add_control('home_bottom_cta_url', array('label' => __('Botão Final - URL', 'institucional-01'), 'section' => 'pixgo_home_section', 'type' => 'url'));

    // Conteúdo: Sobre
    $wp_customize->add_section('pixgo_sobre_section', array(
        'title' => 'Página: Sobre',
        'panel' => 'pixgo_pages_content',
        'priority' => 20,
    ));
    $wp_customize->add_setting('sobre_title', array('default' => 'API Pix Simples e Econômica', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('sobre_title', array('label' => 'Título', 'section' => 'pixgo_sobre_section', 'type' => 'text'));
    $wp_customize->add_setting('sobre_intro_lead', array('default' => 'Nascemos para simplificar a integração de pagamentos Pix para desenvolvedores e pequenos negócios.', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('sobre_intro_lead', array('label' => 'Introdução/Lead', 'section' => 'pixgo_sobre_section', 'type' => 'text'));
    $wp_customize->add_setting('sobre_cta_text', array('default' => 'Comece a Integrar Agora!', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('sobre_cta_text', array('label' => 'Texto CTA', 'section' => 'pixgo_sobre_section', 'type' => 'text'));
    $wp_customize->add_setting('sobre_cta_url', array('default' => '/register', 'sanitize_callback' => 'esc_url_raw'));
    $wp_customize->add_control('sobre_cta_url', array('label' => 'Link CTA', 'section' => 'pixgo_sobre_section', 'type' => 'url'));

    $wp_customize->add_setting('sobre_value_prop_title', array('default' => __('Nossa Proposta de Valor', 'institucional-01'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('sobre_value_prop_title', array('label' => __('Título Proposta de Valor', 'institucional-01'), 'section' => 'pixgo_sobre_section', 'type' => 'text'));
    $wp_customize->add_setting('sobre_value_prop_1_title', array('default' => __('Facilidade de Integração', 'institucional-01'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('sobre_value_prop_1_title', array('label' => __('Bloco 1 - Título', 'institucional-01'), 'section' => 'pixgo_sobre_section', 'type' => 'text'));
    $wp_customize->add_setting('sobre_value_prop_1_desc', array('default' => __('Oferecemos uma API simples, com boa documentação e exemplos de código prontos. Integre o Pix em seus projetos em poucas horas.', 'institucional-01'), 'sanitize_callback' => 'wp_kses_post'));
    $wp_customize->add_control('sobre_value_prop_1_desc', array('label' => __('Bloco 1 - Texto', 'institucional-01'), 'section' => 'pixgo_sobre_section', 'type' => 'textarea'));
    $wp_customize->add_setting('sobre_value_prop_2_title', array('default' => __('Preço Justo', 'institucional-01'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('sobre_value_prop_2_title', array('label' => __('Bloco 2 - Título', 'institucional-01'), 'section' => 'pixgo_sobre_section', 'type' => 'text'));
    $wp_customize->add_setting('sobre_value_prop_2_desc', array('default' => __('Adotamos um modelo de créditos pré-pagos, onde você paga por requisição, eliminando assinaturas mensais caras.', 'institucional-01'), 'sanitize_callback' => 'wp_kses_post'));
    $wp_customize->add_control('sobre_value_prop_2_desc', array('label' => __('Bloco 2 - Texto', 'institucional-01'), 'section' => 'pixgo_sobre_section', 'type' => 'textarea'));
    $wp_customize->add_setting('sobre_value_prop_3_title', array('default' => __('Escalabilidade', 'institucional-01'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('sobre_value_prop_3_title', array('label' => __('Bloco 3 - Título', 'institucional-01'), 'section' => 'pixgo_sobre_section', 'type' => 'text'));
    $wp_customize->add_setting('sobre_value_prop_3_desc', array('default' => __('Utilizamos a infraestrutura confiável do Mercado Pago para gerar os Pix. Ideal para pequenos sites e aplicativos.', 'institucional-01'), 'sanitize_callback' => 'wp_kses_post'));
    $wp_customize->add_control('sobre_value_prop_3_desc', array('label' => __('Bloco 3 - Texto', 'institucional-01'), 'section' => 'pixgo_sobre_section', 'type' => 'textarea'));
    $wp_customize->add_setting('sobre_target_title', array('default' => __('Para Quem é o PixGo?', 'institucional-01'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('sobre_target_title', array('label' => __('Título Personas', 'institucional-01'), 'section' => 'pixgo_sobre_section', 'type' => 'text'));
    $wp_customize->add_setting('sobre_target_1_title', array('default' => __('Desenvolvedores Freelancers', 'institucional-01'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('sobre_target_1_title', array('label' => __('Persona 1 - Título', 'institucional-01'), 'section' => 'pixgo_sobre_section', 'type' => 'text'));
    $wp_customize->add_setting('sobre_target_1_desc', array('default' => __('Precisam integrar Pix em projetos em poucas horas, sem complexidade.', 'institucional-01'), 'sanitize_callback' => 'wp_kses_post'));
    $wp_customize->add_control('sobre_target_1_desc', array('label' => __('Persona 1 - Texto', 'institucional-01'), 'section' => 'pixgo_sobre_section', 'type' => 'textarea'));
    $wp_customize->add_setting('sobre_target_2_title', array('default' => __('Pequenos E-commerces', 'institucional-01'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('sobre_target_2_title', array('label' => __('Persona 2 - Título', 'institucional-01'), 'section' => 'pixgo_sobre_section', 'type' => 'text'));
    $wp_customize->add_setting('sobre_target_2_desc', array('default' => __('Buscam automatizar pagamentos Pix sem plugins pesados ou mensalidades altas.', 'institucional-01'), 'sanitize_callback' => 'wp_kses_post'));
    $wp_customize->add_control('sobre_target_2_desc', array('label' => __('Persona 2 - Texto', 'institucional-01'), 'section' => 'pixgo_sobre_section', 'type' => 'textarea'));
    $wp_customize->add_setting('sobre_target_3_title', array('default' => __('Prestadores de Serviço Autônomos', 'institucional-01'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('sobre_target_3_title', array('label' => __('Persona 3 - Título', 'institucional-01'), 'section' => 'pixgo_sobre_section', 'type' => 'text'));
    $wp_customize->add_setting('sobre_target_3_desc', array('default' => __('Precisam gerar cobranças avulsas de forma rápida e automatizada.', 'institucional-01'), 'sanitize_callback' => 'wp_kses_post'));
    $wp_customize->add_control('sobre_target_3_desc', array('label' => __('Persona 3 - Texto', 'institucional-01'), 'section' => 'pixgo_sobre_section', 'type' => 'textarea'));
    $wp_customize->add_setting('sobre_target_4_title', array('default' => __('Startups e MVPs', 'institucional-01'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('sobre_target_4_title', array('label' => __('Persona 4 - Título', 'institucional-01'), 'section' => 'pixgo_sobre_section', 'type' => 'text'));
    $wp_customize->add_setting('sobre_target_4_desc', array('default' => __('Precisam validar o produto rapidamente e integrar pagamentos de forma confiável e barata.', 'institucional-01'), 'sanitize_callback' => 'wp_kses_post'));
    $wp_customize->add_control('sobre_target_4_desc', array('label' => __('Persona 4 - Texto', 'institucional-01'), 'section' => 'pixgo_sobre_section', 'type' => 'textarea'));

    // Conteúdo: Serviços
    $wp_customize->add_section('pixgo_servicos_section', array(
        'title' => 'Página: Serviços',
        'panel' => 'pixgo_pages_content',
        'priority' => 30,
    ));
    $wp_customize->add_setting('servicos_title', array('default' => 'Serviços PixGo', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('servicos_title', array('label' => 'Título', 'section' => 'pixgo_servicos_section', 'type' => 'text'));
    $wp_customize->add_setting('servicos_lead', array('default' => 'Soluções para integrar Pix em sites, apps e lojas.', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('servicos_lead', array('label' => 'Descrição/Lead', 'section' => 'pixgo_servicos_section', 'type' => 'text'));
    for ($i=1; $i<=3; $i++) {
        $wp_customize->add_setting("servico{$i}_icon", array('default' => 'fas fa-cog', 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("servico{$i}_icon", array('label' => "Serviço {$i} - Ícone (classe)", 'section' => 'pixgo_servicos_section', 'type' => 'text'));
        $wp_customize->add_setting("servico{$i}_title", array('default' => "Serviço {$i}", 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control("servico{$i}_title", array('label' => "Serviço {$i} - Título", 'section' => 'pixgo_servicos_section', 'type' => 'text'));
        $wp_customize->add_setting("servico{$i}_desc", array('default' => 'Descrição breve do serviço.', 'sanitize_callback' => 'wp_kses_post'));
        $wp_customize->add_control("servico{$i}_desc", array('label' => "Serviço {$i} - Descrição", 'section' => 'pixgo_servicos_section', 'type' => 'textarea'));
    }
    $wp_customize->add_setting('servicos_cta_text', array('default' => 'Quero Integrar Agora', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('servicos_cta_text', array('label' => 'Texto CTA', 'section' => 'pixgo_servicos_section', 'type' => 'text'));
    $wp_customize->add_setting('servicos_cta_url', array('default' => '/register', 'sanitize_callback' => 'esc_url_raw'));
    $wp_customize->add_control('servicos_cta_url', array('label' => 'Link CTA', 'section' => 'pixgo_servicos_section', 'type' => 'url'));

    // Conteúdo: Preços
    $wp_customize->add_section('pixgo_precos_section', array(
        'title' => 'Página: Preços',
        'panel' => 'pixgo_pages_content',
        'priority' => 40,
    ));
    $wp_customize->add_setting('precos_title', array('default' => 'Pague Apenas Pelo Uso', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('precos_title', array('label' => 'Título', 'section' => 'pixgo_precos_section', 'type' => 'text'));
    $wp_customize->add_setting('precos_lead', array('default' => 'Nosso modelo é de <strong>créditos pré-pagos</strong>, permitindo total controle de custos sem mensalidades fixas.', 'sanitize_callback' => 'wp_kses_post'));
    $wp_customize->add_control('precos_lead', array('label' => 'Descrição/Lead', 'section' => 'pixgo_precos_section', 'type' => 'textarea'));
    $wp_customize->add_setting('precos_cta_text', array('default' => 'Recarregar Créditos Agora', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('precos_cta_text', array('label' => 'Texto CTA', 'section' => 'pixgo_precos_section', 'type' => 'text'));
    $wp_customize->add_setting('precos_cta_url', array('default' => '/topup_credits', 'sanitize_callback' => 'esc_url_raw'));
    $wp_customize->add_control('precos_cta_url', array('label' => 'Link CTA', 'section' => 'pixgo_precos_section', 'type' => 'url'));

    $wp_customize->add_setting('precos_table_title', array('default' => __('Tabela de Recarga e Custo por Requisição', 'institucional-01'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('precos_table_title', array('label' => __('Tabela - Título', 'institucional-01'), 'section' => 'pixgo_precos_section', 'type' => 'text'));
    $wp_customize->add_setting('precos_table_subtitle', array('default' => __('Quanto maior a recarga, menor o custo por requisição.', 'institucional-01'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('precos_table_subtitle', array('label' => __('Tabela - Subtítulo', 'institucional-01'), 'section' => 'pixgo_precos_section', 'type' => 'text'));
    $wp_customize->add_setting('precos_col_recarga_label', array('default' => __('Valor da Recarga', 'institucional-01'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('precos_col_recarga_label', array('label' => __('Coluna 1', 'institucional-01'), 'section' => 'pixgo_precos_section', 'type' => 'text'));
    $wp_customize->add_setting('precos_col_custo_label', array('default' => __('Custo por Requisição à API', 'institucional-01'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('precos_col_custo_label', array('label' => __('Coluna 2', 'institucional-01'), 'section' => 'pixgo_precos_section', 'type' => 'text'));
    $wp_customize->add_setting('precos_col_calls_label', array('default' => __('Requisições Obtidas', 'institucional-01'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('precos_col_calls_label', array('label' => __('Coluna 3', 'institucional-01'), 'section' => 'pixgo_precos_section', 'type' => 'text'));
    $wp_customize->add_setting('precos_calls_suffix', array('default' => __('chamadas', 'institucional-01'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('precos_calls_suffix', array('label' => __('Sufixo Requisições', 'institucional-01'), 'section' => 'pixgo_precos_section', 'type' => 'text'));
    $wp_customize->add_setting('precos_note', array('default' => __('Nota: O valor mínimo de recarga é de R$ 10,00. O controle de uso garante que requisições sejam bloqueadas quando os créditos chegarem a zero.', 'institucional-01'), 'sanitize_callback' => 'wp_kses_post'));
    $wp_customize->add_control('precos_note', array('label' => __('Texto Nota', 'institucional-01'), 'section' => 'pixgo_precos_section', 'type' => 'textarea'));
    $wp_customize->add_setting('precos_why_title', array('default' => __('Por Que Créditos Pré-Pagos?', 'institucional-01'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('precos_why_title', array('label' => __('Título Por Que Créditos', 'institucional-01'), 'section' => 'pixgo_precos_section', 'type' => 'text'));
    $wp_customize->add_setting('precos_why_desc', array('default' => __('Este modelo é similar ao de APIs de SMS, garantindo que você pague somente quando vender ou usar a funcionalidade.', 'institucional-01'), 'sanitize_callback' => 'wp_kses_post'));
    $wp_customize->add_control('precos_why_desc', array('label' => __('Texto Por Que Créditos', 'institucional-01'), 'section' => 'pixgo_precos_section', 'type' => 'textarea'));

    // Conteúdo: Como Funciona
    $wp_customize->add_section('pixgo_como_section', array(
        'title' => 'Página: Como Funciona',
        'panel' => 'pixgo_pages_content',
        'priority' => 50,
    ));
    $wp_customize->add_setting('como_title', array('default' => 'Como Funciona o PixGo?', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('como_title', array('label' => 'Título', 'section' => 'pixgo_como_section', 'type' => 'text'));
    $wp_customize->add_setting('como_lead', array('default' => 'Integre Pix em 3 passos e gere QR Codes em tempo real.', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('como_lead', array('label' => 'Descrição/Lead', 'section' => 'pixgo_como_section', 'type' => 'text'));
    $wp_customize->add_setting('como_video_url', array('default' => 'https://www.youtube.com/watch?v=ogpV6boXtXs', 'sanitize_callback' => 'esc_url_raw'));
    $wp_customize->add_control('como_video_url', array('label' => 'URL Vídeo', 'section' => 'pixgo_como_section', 'type' => 'url'));
    $wp_customize->add_setting('como_link_keys', array('default' => '/api_key', 'sanitize_callback' => 'esc_url_raw'));
    $wp_customize->add_control('como_link_keys', array('label' => 'Link Gerenciar Chaves', 'section' => 'pixgo_como_section', 'type' => 'url'));
    $wp_customize->add_setting('como_link_topup', array('default' => '/topup_credits', 'sanitize_callback' => 'esc_url_raw'));
    $wp_customize->add_control('como_link_topup', array('label' => 'Link Recarregar Créditos', 'section' => 'pixgo_como_section', 'type' => 'url'));
    $wp_customize->add_setting('como_link_generate', array('default' => '/generate_pix', 'sanitize_callback' => 'esc_url_raw'));
    $wp_customize->add_control('como_link_generate', array('label' => 'Link Ver Geração Pix', 'section' => 'pixgo_como_section', 'type' => 'url'));

    $wp_customize->add_setting('como_step1_title', array('default' => __('1. Configure Suas Chaves', 'institucional-01'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('como_step1_title', array('label' => __('Passo 1 - Título', 'institucional-01'), 'section' => 'pixgo_como_section', 'type' => 'text'));
    $wp_customize->add_setting('como_step1_btn', array('default' => __('Gerenciar Chaves', 'institucional-01'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('como_step1_btn', array('label' => __('Passo 1 - Botão', 'institucional-01'), 'section' => 'pixgo_como_section', 'type' => 'text'));
    $wp_customize->add_setting('como_step2_title', array('default' => __('2. Recarregue Seus Créditos', 'institucional-01'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('como_step2_title', array('label' => __('Passo 2 - Título', 'institucional-01'), 'section' => 'pixgo_como_section', 'type' => 'text'));
    $wp_customize->add_setting('como_step2_btn', array('default' => __('Recarregar', 'institucional-01'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('como_step2_btn', array('label' => __('Passo 2 - Botão', 'institucional-01'), 'section' => 'pixgo_como_section', 'type' => 'text'));
    $wp_customize->add_setting('como_step3_title', array('default' => __('3. Chame o Endpoint', 'institucional-01'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('como_step3_title', array('label' => __('Passo 3 - Título', 'institucional-01'), 'section' => 'pixgo_como_section', 'type' => 'text'));
    $wp_customize->add_setting('como_step3_btn', array('default' => __('Ver Geração Pix', 'institucional-01'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('como_step3_btn', array('label' => __('Passo 3 - Botão', 'institucional-01'), 'section' => 'pixgo_como_section', 'type' => 'text'));
    $wp_customize->add_setting('como_doc_title', array('default' => __('Documentação Técnica da API PixGo', 'institucional-01'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('como_doc_title', array('label' => __('Título Documentação Técnica', 'institucional-01'), 'section' => 'pixgo_como_section', 'type' => 'text'));

    // Conteúdo: Afiliados
    $wp_customize->add_section('pixgo_afiliados_section', array(
        'title' => 'Página: Afiliados',
        'panel' => 'pixgo_pages_content',
        'priority' => 60,
    ));
    $wp_customize->add_setting('afiliados_title', array('default' => 'Programa de Afiliados PixGo', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('afiliados_title', array('label' => 'Título', 'section' => 'pixgo_afiliados_section', 'type' => 'text'));
    $wp_customize->add_setting('afiliados_lead', array('default' => 'Ajude a promover a API Pix mais simples do mercado e <strong>ganhe comissões recorrentes</strong>!', 'sanitize_callback' => 'wp_kses_post'));
    $wp_customize->add_control('afiliados_lead', array('label' => 'Descrição/Lead', 'section' => 'pixgo_afiliados_section', 'type' => 'textarea'));
    $wp_customize->add_setting('afiliados_video_main', array('default' => 'https://www.youtube.com/watch?v=JS9IETTXC1Q', 'sanitize_callback' => 'esc_url_raw'));
    $wp_customize->add_control('afiliados_video_main', array('label' => 'URL Vídeo Principal', 'section' => 'pixgo_afiliados_section', 'type' => 'url'));
    $wp_customize->add_setting('afiliados_video_beneficios', array('default' => 'https://www.youtube.com/watch?v=BXEJ_diYqRc', 'sanitize_callback' => 'esc_url_raw'));
    $wp_customize->add_control('afiliados_video_beneficios', array('label' => 'URL Vídeo Benefícios', 'section' => 'pixgo_afiliados_section', 'type' => 'url'));
    $wp_customize->add_setting('afiliados_video_como', array('default' => 'https://www.youtube.com/watch?v=S86zAxbwa3k', 'sanitize_callback' => 'esc_url_raw'));
    $wp_customize->add_control('afiliados_video_como', array('label' => 'URL Vídeo Como Funciona', 'section' => 'pixgo_afiliados_section', 'type' => 'url'));
    $wp_customize->add_setting('afiliados_cta_text', array('default' => 'Quero me Cadastrar como Afiliado', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('afiliados_cta_text', array('label' => 'Texto CTA', 'section' => 'pixgo_afiliados_section', 'type' => 'text'));
    $wp_customize->add_setting('afiliados_cta_url', array('default' => '/register', 'sanitize_callback' => 'esc_url_raw'));
    $wp_customize->add_control('afiliados_cta_url', array('label' => 'Link CTA', 'section' => 'pixgo_afiliados_section', 'type' => 'url'));

    $wp_customize->add_setting('afiliados_why_title', array('default' => __('Por que ser um Afiliado?', 'institucional-01'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('afiliados_why_title', array('label' => __('Por que ser um Afiliado - Título', 'institucional-01'), 'section' => 'pixgo_afiliados_section', 'type' => 'text'));
    $wp_customize->add_setting('afiliados_beneficio_1', array('default' => __('Comissões Competitivas: Ganhe porcentagem de até 30% em todas as requisições da API feitas pelos seus indicados.', 'institucional-01'), 'sanitize_callback' => 'wp_kses_post'));
    $wp_customize->add_control('afiliados_beneficio_1', array('label' => __('Benefício 1', 'institucional-01'), 'section' => 'pixgo_afiliados_section', 'type' => 'textarea'));
    $wp_customize->add_setting('afiliados_beneficio_2', array('default' => __('Fácil de Promover: A PixGo simplifica a burocracia da API oficial do Mercado Pago, e outros gateways de pagamento.', 'institucional-01'), 'sanitize_callback' => 'wp_kses_post'));
    $wp_customize->add_control('afiliados_beneficio_2', array('label' => __('Benefício 2', 'institucional-01'), 'section' => 'pixgo_afiliados_section', 'type' => 'textarea'));
    $wp_customize->add_setting('afiliados_beneficio_3', array('default' => __('Público-Alvo Definido: Ideal para quem tem audiência em comunidades dev e e-commerces.', 'institucional-01'), 'sanitize_callback' => 'wp_kses_post'));
    $wp_customize->add_control('afiliados_beneficio_3', array('label' => __('Benefício 3', 'institucional-01'), 'section' => 'pixgo_afiliados_section', 'type' => 'textarea'));
    $wp_customize->add_setting('afiliados_how_title', array('default' => __('Como Funciona?', 'institucional-01'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('afiliados_how_title', array('label' => __('Como Funciona - Título', 'institucional-01'), 'section' => 'pixgo_afiliados_section', 'type' => 'text'));
    $wp_customize->add_setting('afiliados_how_step_1', array('default' => __('Cadastre-se no Programa.', 'institucional-01'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('afiliados_how_step_1', array('label' => __('Passo 1', 'institucional-01'), 'section' => 'pixgo_afiliados_section', 'type' => 'text'));
    $wp_customize->add_setting('afiliados_how_step_2', array('default' => __('Receba seu link e materiais de divulgação.', 'institucional-01'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('afiliados_how_step_2', array('label' => __('Passo 2', 'institucional-01'), 'section' => 'pixgo_afiliados_section', 'type' => 'text'));
    $wp_customize->add_setting('afiliados_how_step_3', array('default' => __('Seus indicados recebem a API Key inicial.', 'institucional-01'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('afiliados_how_step_3', array('label' => __('Passo 3', 'institucional-01'), 'section' => 'pixgo_afiliados_section', 'type' => 'text'));
    $wp_customize->add_setting('afiliados_how_step_4', array('default' => __('Eles recarregam créditos para usar a API.', 'institucional-01'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('afiliados_how_step_4', array('label' => __('Passo 4', 'institucional-01'), 'section' => 'pixgo_afiliados_section', 'type' => 'text'));
    $wp_customize->add_setting('afiliados_how_step_5', array('default' => __('Você ganha comissão sobre cada consumo efetivado na API.', 'institucional-01'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('afiliados_how_step_5', array('label' => __('Passo 5', 'institucional-01'), 'section' => 'pixgo_afiliados_section', 'type' => 'text'));
    $wp_customize->add_setting('afiliados_faq_title', array('default' => __('Dúvidas Frequentes - Programa de Afiliados', 'institucional-01'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('afiliados_faq_title', array('label' => __('FAQ - Título', 'institucional-01'), 'section' => 'pixgo_afiliados_section', 'type' => 'text'));
    $wp_customize->add_setting('afiliados_faq_q1', array('default' => __('Quais são os benefícios de ser afiliado?', 'institucional-01'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('afiliados_faq_q1', array('label' => __('FAQ - Pergunta 1', 'institucional-01'), 'section' => 'pixgo_afiliados_section', 'type' => 'text'));
    $wp_customize->add_setting('afiliados_faq_q2', array('default' => __('Vídeo: Como funciona o programa?', 'institucional-01'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('afiliados_faq_q2', array('label' => __('FAQ - Pergunta 2', 'institucional-01'), 'section' => 'pixgo_afiliados_section', 'type' => 'text'));
    $wp_customize->add_setting('afiliados_faq_q3', array('default' => __('Como recebo minhas comissões?', 'institucional-01'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('afiliados_faq_q3', array('label' => __('FAQ - Pergunta 3', 'institucional-01'), 'section' => 'pixgo_afiliados_section', 'type' => 'text'));
    $wp_customize->add_setting('afiliados_faq_q4', array('default' => __('Dicas para divulgar melhor', 'institucional-01'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('afiliados_faq_q4', array('label' => __('FAQ - Pergunta 4', 'institucional-01'), 'section' => 'pixgo_afiliados_section', 'type' => 'text'));

    // Conteúdo: Contato
    $wp_customize->add_section('pixgo_contato_section', array(
        'title' => 'Página: Contato',
        'panel' => 'pixgo_pages_content',
        'priority' => 70,
    ));
    $wp_customize->add_setting('contato_title', array('default' => 'Entre em Contato com a PixGo', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('contato_title', array('label' => 'Título', 'section' => 'pixgo_contato_section', 'type' => 'text'));
    $wp_customize->add_setting('contato_lead', array('default' => 'Tem dúvidas sobre integração, preços ou precisa de suporte? Fale conosco agora mesmo.', 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('contato_lead', array('label' => 'Descrição/Lead', 'section' => 'pixgo_contato_section', 'type' => 'text'));
    $wp_customize->add_setting('contato_email', array('default' => 'contato@fddev.com.br', 'sanitize_callback' => 'sanitize_email'));
    $wp_customize->add_control('contato_email', array('label' => 'E-mail de Suporte', 'section' => 'pixgo_contato_section', 'type' => 'text'));
    $wp_customize->add_setting('contato_form_shortcode', array('default' => '[contact-form-7 id="2184b1f" title="Formulário de contato"]', 'sanitize_callback' => 'wp_kses_post'));
    $wp_customize->add_control('contato_form_shortcode', array('label' => 'Shortcode do Formulário', 'section' => 'pixgo_contato_section', 'type' => 'text'));

    $wp_customize->add_setting('contato_info_title', array('default' => __('Informações de Contato', 'institucional-01'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('contato_info_title', array('label' => __('Título Informações', 'institucional-01'), 'section' => 'pixgo_contato_section', 'type' => 'text'));
    $wp_customize->add_setting('contato_email_label', array('default' => __('E-mail de Suporte:', 'institucional-01'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('contato_email_label', array('label' => __('Rótulo E-mail', 'institucional-01'), 'section' => 'pixgo_contato_section', 'type' => 'text'));
    $wp_customize->add_setting('contato_support_label', array('default' => __('Atendimento:', 'institucional-01'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('contato_support_label', array('label' => __('Rótulo Atendimento', 'institucional-01'), 'section' => 'pixgo_contato_section', 'type' => 'text'));
    $wp_customize->add_setting('contato_support_text', array('default' => __('Segunda a Sexta, 9h às 18h', 'institucional-01'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('contato_support_text', array('label' => __('Texto Atendimento', 'institucional-01'), 'section' => 'pixgo_contato_section', 'type' => 'text'));
    $wp_customize->add_setting('contato_form_title', array('default' => __('Envie sua Mensagem', 'institucional-01'), 'sanitize_callback' => 'sanitize_text_field'));
    $wp_customize->add_control('contato_form_title', array('label' => __('Título Formulário', 'institucional-01'), 'section' => 'pixgo_contato_section', 'type' => 'text'));

    // --- Seção de Cores ---
    $wp_customize->add_section( 'pixgo_color_settings', array(
        'title' => __( 'Cores do Header e Footer', 'institucional-01' ),
        'panel' => 'pixgo_theme_settings',
    ) );

    // Configuração da Cor da Barra Superior (Header)
    $wp_customize->add_setting( 'header_bg_color', array(
        'default' => '#007bff',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_bg_color_control', array(
        'label' => __( 'Cor de Fundo da Barra Superior', 'institucional-01' ),
        'section' => 'pixgo_color_settings',
        'settings' => 'header_bg_color',
    ) ) );

    // Configuração da Cor do Rodapé (Footer)
    $wp_customize->add_setting( 'footer_bg_color', array(
        'default' => '#343a40',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_bg_color_control', array(
        'label' => __( 'Cor de Fundo do Rodapé', 'institucional-01' ),
        'section' => 'pixgo_color_settings',
        'settings' => 'footer_bg_color',
    ) ) );

    // --- Seção de Informações da Empresa ---
    $wp_customize->add_section( 'pixgo_company_settings', array(
        'title' => __( 'Informações da Empresa', 'institucional-01' ),
        'panel' => 'pixgo_theme_settings',
    ) );
    $wp_customize->add_setting( 'company_name', array(
        'default' => 'PixGo',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'company_name_control', array(
        'label' => __( 'Nome da Empresa', 'institucional-01' ),
        'section' => 'pixgo_company_settings',
        'type' => 'text',
        'settings' => 'company_name',
    ) );
    $wp_customize->add_setting( 'company_tagline', array(
        'default' => 'API simples e econômica de pagamentos Pix via Mercado Pago.',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'company_tagline_control', array(
        'label' => __( 'Slogan / Descrição Curta', 'institucional-01' ),
        'section' => 'pixgo_company_settings',
        'type' => 'text',
        'settings' => 'company_tagline',
    ) );
    $wp_customize->add_setting( 'company_website', array(
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'company_website_control', array(
        'label' => __( 'Website da Empresa (opcional)', 'institucional-01' ),
        'section' => 'pixgo_company_settings',
        'type' => 'url',
        'settings' => 'company_website',
    ) );

    // --- Seção de CTA do Conteúdo ---
    $wp_customize->add_section( 'pixgo_cta_settings', array(
        'title' => __( 'CTA de Conteúdo', 'institucional-01' ),
        'panel' => 'pixgo_theme_settings',
    ) );
    $wp_customize->add_setting( 'cta_footer_title', array(
        'default' => 'Pronto para Integrar?',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cta_footer_title_control', array(
        'label' => __( 'Título do CTA', 'institucional-01' ),
        'section' => 'pixgo_cta_settings',
        'type' => 'text',
        'settings' => 'cta_footer_title',
    ) );
    $wp_customize->add_setting( 'cta_footer_text', array(
        'default' => 'A PixGo oferece facilidade de integração e preço justo por requisição. Nosso modelo de créditos pré-pagos garante que você pague somente pelo uso.',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ) );
    $wp_customize->add_control( 'cta_footer_text_control', array(
        'label' => __( 'Texto do CTA', 'institucional-01' ),
        'section' => 'pixgo_cta_settings',
        'type' => 'textarea',
        'settings' => 'cta_footer_text',
    ) );
    $wp_customize->add_setting( 'cta_footer_primary_text', array(
        'default' => 'Começar Grátis',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cta_footer_primary_text_control', array(
        'label' => __( 'Texto do Botão Primário', 'institucional-01' ),
        'section' => 'pixgo_cta_settings',
        'type' => 'text',
        'settings' => 'cta_footer_primary_text',
    ) );
    $wp_customize->add_setting( 'cta_footer_primary_url', array(
        'default' => '/register',
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'cta_footer_primary_url_control', array(
        'label' => __( 'URL do Botão Primário', 'institucional-01' ),
        'section' => 'pixgo_cta_settings',
        'type' => 'url',
        'settings' => 'cta_footer_primary_url',
    ) );
    $wp_customize->add_setting( 'cta_footer_secondary_text', array(
        'default' => 'Ver Documentação da API',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cta_footer_secondary_text_control', array(
        'label' => __( 'Texto do Botão Secundário', 'institucional-01' ),
        'section' => 'pixgo_cta_settings',
        'type' => 'text',
        'settings' => 'cta_footer_secondary_text',
    ) );
    $wp_customize->add_setting( 'cta_footer_secondary_url', array(
        'default' => '/como-funciona',
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'cta_footer_secondary_url_control', array(
        'label' => __( 'URL do Botão Secundário', 'institucional-01' ),
        'section' => 'pixgo_cta_settings',
        'type' => 'url',
        'settings' => 'cta_footer_secondary_url',
    ) );

    $wp_customize->add_section( 'pixgo_footer_settings', array(
        'title' => __( 'Rodapé', 'institucional-01' ),
        'panel' => 'pixgo_theme_settings',
    ) );
    $wp_customize->add_setting( 'footer_about_text', array(
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ) );
    $wp_customize->add_control( 'footer_about_text_control', array(
        'label' => __( 'Texto Sobre a Empresa', 'institucional-01' ),
        'section' => 'pixgo_footer_settings',
        'type' => 'textarea',
        'settings' => 'footer_about_text',
    ) );
    $wp_customize->add_setting( 'footer_links_title', array(
        'default' => 'Links',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'footer_links_title_control', array(
        'label' => __( 'Título da Coluna de Links', 'institucional-01' ),
        'section' => 'pixgo_footer_settings',
        'type' => 'text',
        'settings' => 'footer_links_title',
    ) );
    $link_fields = array(1,2,3,4);
    foreach ($link_fields as $i) {
        $wp_customize->add_setting( "footer_link{$i}_label", array(
            'default' => '',
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( "footer_link{$i}_label_control", array(
            'label' => sprintf( __( 'Link %d - Texto', 'institucional-01' ), $i ),
            'section' => 'pixgo_footer_settings',
            'type' => 'text',
            'settings' => "footer_link{$i}_label",
        ) );
        $wp_customize->add_setting( "footer_link{$i}_url", array(
            'default' => '',
            'transport' => 'refresh',
            'sanitize_callback' => 'esc_url_raw',
        ) );
        $wp_customize->add_control( "footer_link{$i}_url_control", array(
            'label' => sprintf( __( 'Link %d - URL', 'institucional-01' ), $i ),
            'section' => 'pixgo_footer_settings',
            'type' => 'url',
            'settings' => "footer_link{$i}_url",
        ) );
    }
    $wp_customize->add_setting( 'footer_contact_title', array(
        'default' => 'Contato',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'footer_contact_title_control', array(
        'label' => __( 'Título da Coluna de Contato', 'institucional-01' ),
        'section' => 'pixgo_footer_settings',
        'type' => 'text',
        'settings' => 'footer_contact_title',
    ) );
    $wp_customize->add_setting( 'footer_contact_email', array(
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_email',
    ) );
    $wp_customize->add_control( 'footer_contact_email_control', array(
        'label' => __( 'E-mail', 'institucional-01' ),
        'section' => 'pixgo_footer_settings',
        'type' => 'text',
        'settings' => 'footer_contact_email',
    ) );
    $wp_customize->add_setting( 'footer_contact_phone', array(
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'footer_contact_phone_control', array(
        'label' => __( 'Telefone/WhatsApp', 'institucional-01' ),
        'section' => 'pixgo_footer_settings',
        'type' => 'text',
        'settings' => 'footer_contact_phone',
    ) );
    $wp_customize->add_setting( 'footer_contact_address', array(
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'footer_contact_address_control', array(
        'label' => __( 'Endereço', 'institucional-01' ),
        'section' => 'pixgo_footer_settings',
        'type' => 'textarea',
        'settings' => 'footer_contact_address',
    ) );
    $wp_customize->add_setting( 'footer_social_title', array(
        'default' => 'Siga-nos',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'footer_social_title_control', array(
        'label' => __( 'Título da Coluna Social', 'institucional-01' ),
        'section' => 'pixgo_footer_settings',
        'type' => 'text',
        'settings' => 'footer_social_title',
    ) );
    $socials = array('facebook','instagram','linkedin','youtube','twitter','whatsapp');
    foreach ($socials as $s) {
        $wp_customize->add_setting( "footer_social_{$s}", array(
            'default' => '',
            'transport' => 'refresh',
            'sanitize_callback' => 'esc_url_raw',
        ) );
        $wp_customize->add_control( "footer_social_{$s}_control", array(
            'label' => ucfirst($s),
            'section' => 'pixgo_footer_settings',
            'type' => 'url',
            'settings' => "footer_social_{$s}",
        ) );
    }

    // --- Seção do Google AdSense ---
    $wp_customize->add_section( 'pixgo_adsense_settings', array(
        'title' => __( 'Google AdSense', 'institucional-01' ),
        'panel' => 'pixgo_theme_settings',
    ) );

    // Campo para inserir o ID do AdSense (ca-pub-xxxxx)
    $wp_customize->add_setting( 'adsense_account_id', array(
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'adsense_account_id_control', array(
        'label' => __( 'ID da conta AdSense (ex: ca-pub-1234567890)', 'institucional-01' ),
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

    // Link do botão
    $wp_customize->add_setting('pixgo_focus_button_url', array(
        'default' => '/register',
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('pixgo_focus_button_url', array(
        'label' => 'URL do Botão',
        'section' => 'title_tagline',
        'type' => 'url',
    ));
    // FIM BARRA LATERAL CHAMADA PRA AÇÃO

	// Scripts Personalizados
    $wp_customize->add_section( 'pixgo_custom_code_settings', array(
        'title' => __( 'Scripts Personalizados', 'institucional-01' ),
        'panel' => 'pixgo_theme_settings',
    ) );

	$wp_customize->add_setting( 'pixgo_footer_js', array(
		'default' => '',
		'transport' => 'refresh',
		'capability' => 'unfiltered_html',
		'sanitize_callback' => function( $input ) {
			if ( current_user_can( 'unfiltered_html' ) ) { return $input; }
			return wp_kses_post( $input );
		},
	) );

	if ( class_exists( 'WP_Customize_Code_Editor_Control' ) ) {
        $wp_customize->add_control( new WP_Customize_Code_Editor_Control( $wp_customize, 'pixgo_footer_js', array(
            'label' => __( 'JS no Rodapé (antes de </body>)', 'institucional-01' ),
            'section' => 'pixgo_custom_code_settings',
            'code_type' => 'text/javascript',
        ) ) );
	} else {
        $wp_customize->add_control( 'pixgo_footer_js', array(
            'label' => __( 'JS no Rodapé (antes de </body>)', 'institucional-01' ),
            'section' => 'pixgo_custom_code_settings',
            'type' => 'textarea',
        ) );
	}

}
add_action( 'customize_register', 'pixgo_customize_register' );

function pixgo_print_custom_footer_js() {
	if ( is_admin() ) return;
	$js = get_theme_mod( 'pixgo_footer_js', '' );
	if ( empty( $js ) ) return;
	if ( strpos( $js, '<script' ) !== false ) {
		echo $js;
	} else {
		echo '<script>' . $js . '</script>';
	}
}
add_action( 'wp_footer', 'pixgo_print_custom_footer_js', 100 );

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

// 5. Gera CSS Dinâmico para as Cores com contraste automático
function pixgo_hex_to_rgb($hex) {
    $hex = ltrim($hex, '#');
    if (strlen($hex) === 3) {
        $hex = $hex[0].$hex[0].$hex[1].$hex[1].$hex[2].$hex[2];
    }
    $int = hexdec($hex);
    return [($int >> 16) & 255, ($int >> 8) & 255, $int & 255];
}
function pixgo_contrast_color($hex, $dark = '#000000', $light = '#ffffff') {
    list($r,$g,$b) = pixgo_hex_to_rgb($hex);
    $yiq = (($r*299)+($g*587)+($b*114))/1000;
    return ($yiq >= 128) ? $dark : $light;
}
function pixgo_customizer_css() {
    $header_bg_color = get_theme_mod( 'header_bg_color', '#007bff' );
    $footer_bg_color = get_theme_mod( 'footer_bg_color', '#343a40' );
    /* Modo escuro automático (prefers-color-scheme) */

    $header_text_color = pixgo_contrast_color($header_bg_color);
    $footer_text_color = pixgo_contrast_color($footer_bg_color);
    $footer_link_color = ($footer_text_color === '#000000') ? '#0d6efd' : '#cccccc';
    $footer_border_color = ($footer_text_color === '#000000') ? 'rgba(0,0,0,.1)' : 'rgba(255,255,255,.15)';

    $css = '';

    // Header
    $css .= ".navbar-custom { background-color: {$header_bg_color} !important; }";
    $css .= ".navbar-custom .nav-link, .navbar-custom .navbar-brand { color: {$header_text_color}; }";
    if ($header_text_color === '#000000') {
        $css .= ".navbar-custom .navbar-toggler-icon{ filter: invert(1); }";
    } else {
        $css .= ".navbar-custom .navbar-toggler-icon{ filter: none; }";
    }

    // Footer
    $footer_inset_shadow = ($footer_text_color === '#000000') ? 'inset 0 1px 0 rgba(0,0,0,.08)' : 'inset 0 1px 0 rgba(255,255,255,.06)';
    $footer_overlay = ($footer_text_color === '#000000') ? 'linear-gradient(rgba(0,0,0,.03), rgba(0,0,0,.03))' : 'linear-gradient(rgba(255,255,255,.04), rgba(255,255,255,.04))';
    $footer_icon_color = $footer_text_color;
    $footer_hover_bg = ($footer_text_color === '#000000') ? 'rgba(0,0,0,.08)' : 'rgba(255,255,255,.15)';
    $css .= ".footer-custom { background-color: {$footer_bg_color} !important; color: {$footer_text_color}; padding: 32px 0; box-shadow: {$footer_inset_shadow}; background-image: {$footer_overlay}; --footer-text: {$footer_text_color}; --footer-link: {$footer_link_color}; }";
    $css .= ".footer-custom a { color: var(--footer-link); }";
    $css .= ".footer-custom a:hover { text-decoration: underline; }";
    $css .= ".footer-custom .footer-columns h5, .footer-custom p, .footer-custom li { color: var(--footer-text); }";
    $css .= ".footer-custom small { color: var(--footer-text) !important; opacity: .9; }";
    $css .= ".footer-custom .footer-columns h5 { font-weight: 600; margin-bottom: .75rem; }";
    $css .= ".footer-custom .footer-links li { margin-bottom: .35rem; }";
    $css .= ".footer-custom .footer-social .social-btn { width:36px; height:36px; display:inline-flex; align-items:center; justify-content:center; border:1px solid {$footer_icon_color}; color: {$footer_icon_color}; border-radius:50%; margin-right:.4rem; background: transparent; }";
    $css .= ".footer-custom .footer-social .social-btn:hover { background: {$footer_hover_bg}; }";
    $css .= ".footer-custom .footer-bottom { border-top: 1px solid {$footer_hover_bg}; margin-top: 24px; padding-top: 12px; font-size: .9rem; }";

    // Share buttons (light mode)
    $css .= ".pixgo-share-buttons .share-btn { border-color: #212529; color: #212529; background-color: transparent; }";
    $css .= ".pixgo-share-buttons .share-btn:hover { background-color: #212529; color: #fff; }";
    // Author social buttons (light mode)
    $css .= ".author-box .author-btn { border-color: #212529; color: #212529; background-color: transparent; }";
    $css .= ".author-box .author-btn:hover { background-color: #212529; color: #fff; }";

    $cta_bg_color = $header_bg_color;
    $cta_text_color = pixgo_contrast_color($cta_bg_color);
    $cta_hr_color = ($cta_text_color === '#000000') ? 'rgba(0,0,0,.15)' : 'rgba(255,255,255,.3)';
    $css .= ".cta-block { background-color: {$cta_bg_color} !important; color: {$cta_text_color}; }";
    $css .= ".cta-block .alert-heading, .cta-block p { color: {$cta_text_color}; }";
    $css .= ".cta-block hr { border-color: {$cta_hr_color}; }";

    // Dark Mode automático
    $css .= "@media (prefers-color-scheme: dark) {\n        body { background-color: #121212; color: #f8f9fa; }\n        .card, .bg-light { background-color: #1e1e1e !important; color: #f8f9fa !important; border-color: #444; }\n        .table { color: #f8f9fa; }\n        a { color: #0d6efd; }\n        a:hover { color: #64a1ff; }\n        .text-dark { color: #e9ecef !important; }\n        .text-secondary { color: #cfd6dc !important; }\n        .text-muted, small, .small { color: #bfc7cd !important; }\n        .border, .border-top, .border-bottom { border-color: #444 !important; }\n        .form-control { background-color: #2a2a2a; color: #f8f9fa; border-color: #444; }\n        .form-control:focus { background-color: #2a2a2a; color: #f8f9fa; border-color: #6c757d; box-shadow: 0 0 0 .2rem rgba(108,117,125,.25); }\n        .form-select, textarea.form-control { background-color: #2a2a2a; color: #f8f9fa; border-color: #444; }\n        .form-select:focus, textarea.form-control:focus { background-color: #2a2a2a; color: #f8f9fa; border-color: #6c757d; box-shadow: 0 0 0 .2rem rgba(108,117,125,.25); }\n        .form-control::placeholder { color: #9aa0a6; }\n        .form-control:-webkit-autofill, .form-control:-webkit-autofill:hover, .form-control:-webkit-autofill:focus { -webkit-box-shadow: 0 0 0px 1000px #2a2a2a inset; -webkit-text-fill-color: #f8f9fa; caret-color: #f8f9fa; }\n        .list-group-item { background-color: #1f1f1f; color: #e9ecef; border-color: #444; }\n        .pixgo-share-buttons .share-btn { border-color: #e9ecef; color: #e9ecef; background-color: transparent; }\n        .pixgo-share-buttons .share-btn:hover { background-color: #e9ecef; color: #121212; }\n        .author-box .author-btn { border-color: #e9ecef; color: #e9ecef; background-color: transparent; }\n        .author-box .author-btn:hover { background-color: #e9ecef; color: #121212; }\n        .footer-custom a { color: {$footer_link_color}; }\n        .footer-custom a:hover { color: {$footer_link_color}; text-decoration: underline; }\n        .footer-custom .footer-columns h5, .footer-custom p, .footer-custom li { color: var(--footer-text); }\n        .footer-custom small { opacity: .95; }\n        .cta-block { box-shadow: inset 0 1px 0 rgba(255,255,255,.05); }\n    }";

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
                    <p class="text-muted mb-3"><?php esc_html_e( 'Autor deste artigo no blog PixGo.', 'institucional-01' ); ?></p>
                <?php endif; ?>

                <!-- Botões de Links -->
                <div class="d-flex flex-wrap gap-2 author-buttons">

                    <!-- Sempre mostrar "Mais posts" -->
                    <a href="<?php echo esc_url($author_url); ?>" class="btn btn-sm author-btn d-flex align-items-center gap-1">
                        <i class="fas fa-user"></i> <?php esc_html_e( 'Mais posts', 'institucional-01' ); ?>
                    </a>

                    <?php if ($author_website) : ?>
            <a href="<?php echo esc_url($author_website); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-sm author-btn d-flex align-items-center gap-1">
                            <i class="fas fa-globe"></i> <?php esc_html_e( 'Site pessoal', 'institucional-01' ); ?>
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
                            <a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-sm author-btn d-flex align-items-center gap-1">
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
        echo '<a href="' . esc_url($link) . '" target="_blank" rel="noopener noreferrer" class="btn btn-sm share-btn d-flex align-items-center gap-1">';
        echo '<i class="' . esc_attr($icons[$key]) . '"></i> ' . ucfirst($key);
        echo '</a>';
    }
    echo '</div>';
}

// Função para exibir o card "Foco do PixGo"
function pixgo_sidebar_focus_card($register_url = null) {
    if (!$register_url) {
        $register_url = esc_url( get_theme_mod('pixgo_focus_button_url', home_url('/register')) );
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



