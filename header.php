<?php
// Define a classe do body para suportar Dark Mode via JS/CSS
$body_class = get_theme_mod( 'enable_dark_mode', false ) ? 'dark-mode' : '';
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class( $body_class ); ?>>

<header>
    <!-- Menu Bootstrap 5 Fixo e Responsivo -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top shadow navbar-custom">
        <div class="container">
            <!-- Logo (exemplo de uso da imagem do sistema) -->
            <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/img/Logo-PixGo.png" alt="PixGo Logo" height="30">
                PixGo
            </a>
            
            <!-- Botão Hamburguer para Responsividade -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#pixgoNavbar" 
                    aria-controls="pixgoNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="pixgoNavbar">
                
                <?php
                // Menu dinâmico do WordPress
                wp_nav_menu( array(
                    'theme_location'    => 'primary',
                    'depth'             => 2, // Limita a profundidade
                    'container'         => false,
                    'menu_class'        => 'navbar-nav ms-auto mb-2 mb-lg-0',
                    'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                    'walker'            => new WP_Bootstrap_Navwalker(), // Requer a inclusão de um Walker Bootstrap customizado (assumindo que será adicionado)
                ) );

                // Se não usar um walker customizado, use a estrutura manual simples:
                ?>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?php if( is_page_template('page-templates/template-home.php') || is_front_page() ) echo 'active'; ?>" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if( is_page_template('page-templates/template-sobre.php') ) echo 'active'; ?>" href="/sobre">Sobre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if( is_page_template('page-templates/template-precos.php') ) echo 'active'; ?>" href="/precos">Preços</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if( is_page_template('page-templates/template-como-funciona.php') ) echo 'active'; ?>" href="/como-funciona">Docs API</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if( is_page_template('page-templates/template-contato.php') ) echo 'active'; ?>" href="/contato">Contato</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if( is_page_template('page-templates/template-afiliados.php') ) echo 'active'; ?>" href="/afiliados">Afiliados</a>
                    </li>
                    <!-- Botões de Ação (Login/Registro, conforme o sistema original) -->
                    <li class="nav-item">
                        <a class="btn btn-warning ms-lg-3" href="/register">Começar Grátis</a>
                    </li>
                </ul>
                
                <!-- Botão de Toggle Dark Mode (lógica implementada via JS/Session/Cookie) -->
                <button id="darkModeToggle" class="btn btn-sm btn-outline-light ms-3" title="Alternar Modo Escuro">
                    <span class="visually-hidden">Modo Dark</span> 🌙
                </button>

            </div>
        </div>
    </nav>
</header>

<!-- Conteúdo começa após a barra fixa -->
<main class="pt-5 mt-5">
    <div class="container">