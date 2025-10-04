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
    wp_enqueue_style( 'pixgo-style', get_stylesheet_uri(), array( 'bootstrap-css' ), '1.0' );

    // Bootstrap 5 JS Bundle
    wp_enqueue_script( 'bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array( 'jquery' ), '5.3.3', true );
    
    // Script principal do tema
    wp_enqueue_script( 'pixgo-main', get_template_directory_uri() . '/js/main.js', array( 'jquery', 'bootstrap-js' ), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'pixgo_scripts' );

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

}
add_action( 'customize_register', 'pixgo_customize_register' );


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