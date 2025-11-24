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

    // --- Seção de Informações da Empresa ---
    $wp_customize->add_section( 'pixgo_company_settings', array(
        'title' => __( 'Informações da Empresa', 'pixgo-theme' ),
        'panel' => 'pixgo_theme_settings',
    ) );
    $wp_customize->add_setting( 'company_name', array(
        'default' => 'PixGo',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'company_name_control', array(
        'label' => __( 'Nome da Empresa', 'pixgo-theme' ),
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
        'label' => __( 'Slogan / Descrição Curta', 'pixgo-theme' ),
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
        'label' => __( 'Website da Empresa (opcional)', 'pixgo-theme' ),
        'section' => 'pixgo_company_settings',
        'type' => 'url',
        'settings' => 'company_website',
    ) );

    // --- Seção de CTA do Conteúdo ---
    $wp_customize->add_section( 'pixgo_cta_settings', array(
        'title' => __( 'CTA de Conteúdo', 'pixgo-theme' ),
        'panel' => 'pixgo_theme_settings',
    ) );
    $wp_customize->add_setting( 'cta_footer_title', array(
        'default' => 'Pronto para Integrar?',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cta_footer_title_control', array(
        'label' => __( 'Título do CTA', 'pixgo-theme' ),
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
        'label' => __( 'Texto do CTA', 'pixgo-theme' ),
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
        'label' => __( 'Texto do Botão Primário', 'pixgo-theme' ),
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
        'label' => __( 'URL do Botão Primário', 'pixgo-theme' ),
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
        'label' => __( 'Texto do Botão Secundário', 'pixgo-theme' ),
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
        'label' => __( 'URL do Botão Secundário', 'pixgo-theme' ),
        'section' => 'pixgo_cta_settings',
        'type' => 'url',
        'settings' => 'cta_footer_secondary_url',
    ) );

    $wp_customize->add_section( 'pixgo_footer_settings', array(
        'title' => __( 'Rodapé', 'pixgo-theme' ),
        'panel' => 'pixgo_theme_settings',
    ) );
    $wp_customize->add_setting( 'footer_about_text', array(
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'wp_kses_post',
    ) );
    $wp_customize->add_control( 'footer_about_text_control', array(
        'label' => __( 'Texto Sobre a Empresa', 'pixgo-theme' ),
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
        'label' => __( 'Título da Coluna de Links', 'pixgo-theme' ),
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
            'label' => sprintf( __( 'Link %d - Texto', 'pixgo-theme' ), $i ),
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
            'label' => sprintf( __( 'Link %d - URL', 'pixgo-theme' ), $i ),
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
        'label' => __( 'Título da Coluna de Contato', 'pixgo-theme' ),
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
        'label' => __( 'E-mail', 'pixgo-theme' ),
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
        'label' => __( 'Telefone/WhatsApp', 'pixgo-theme' ),
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
        'label' => __( 'Endereço', 'pixgo-theme' ),
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
        'label' => __( 'Título da Coluna Social', 'pixgo-theme' ),
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
		'title' => __( 'Scripts Personalizados', 'pixgo-theme' ),
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
			'label' => __( 'JS no Rodapé (antes de </body>)', 'pixgo-theme' ),
			'section' => 'pixgo_custom_code_settings',
			'code_type' => 'text/javascript',
		) ) );
	} else {
		$wp_customize->add_control( 'pixgo_footer_js', array(
			'label' => __( 'JS no Rodapé (antes de </body>)', 'pixgo-theme' ),
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
                    <a href="<?php echo esc_url($author_url); ?>" class="btn btn-sm author-btn d-flex align-items-center gap-1">
                        <i class="fas fa-user"></i> Mais posts
                    </a>

                    <?php if ($author_website) : ?>
                        <a href="<?php echo esc_url($author_website); ?>" target="_blank" class="btn btn-sm author-btn d-flex align-items-center gap-1">
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
                            <a href="<?php echo esc_url($url); ?>" target="_blank" class="btn btn-sm author-btn d-flex align-items-center gap-1">
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
        echo '<a href="' . esc_url($link) . '" target="_blank" class="btn btn-sm share-btn d-flex align-items-center gap-1">';
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



