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
            
            <!-- Logo -->
			<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php
				if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
					the_custom_logo();
				} else {
					// Fallback caso não tenha logo definida
					?>
					<img src="<?php echo get_template_directory_uri(); ?>/img/Logo-PixGo.png" alt="<?php bloginfo( 'name' ); ?>" height="30">
					<?php bloginfo( 'name' ); ?>
					<?php
				}
				?>
			</a>
            
            <!-- Botão Hamburguer -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#pixgoNavbar" 
                    aria-controls="pixgoNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="pixgoNavbar">

                <?php
                // Se tiver menu registrado no WP
                if ( has_nav_menu( 'primary' ) ) {

                    $args = array(
                        'theme_location' => 'primary',
                        'depth'          => 2,
                        'container'      => false,
                        'menu_class'     => 'navbar-nav ms-auto mb-2 mb-lg-0',
                        'fallback_cb'    => false,
                    );

                    // Usa o Navwalker se ele estiver disponível
                    if ( class_exists( 'WP_Bootstrap_Navwalker' ) ) {
                        $args['walker'] = new WP_Bootstrap_Navwalker();
                    }

                    wp_nav_menu( $args );

                } else {
                    // Fallback manual (caso não haja menu configurado no WP)
                    ?>
                    <ul class="navbar-nav nav-pills ms-auto mb-2 mb-lg-0">
						<li class="nav-item">
							<a class="nav-link fw-bold <?php if( is_front_page() ) echo 'active'; ?>" href="/">Home</a>
						</li>
						<li class="nav-item">
							<a class="nav-link fw-bold <?php if( is_page_template('page-templates/template-sobre.php') ) echo 'active'; ?>" href="/sobre">Sobre</a>
						</li>
						<li class="nav-item">
							<a class="nav-link fw-bold <?php if( is_page_template('page-templates/template-precos.php') ) echo 'active'; ?>" href="/precos">Preços</a>
						</li>
						<li class="nav-item">
							<a class="nav-link fw-bold <?php if( is_page_template('page-templates/template-como-funciona.php') ) echo 'active'; ?>" href="/como-funciona">Docs API</a>
						</li>
						<li class="nav-item">
							<a class="nav-link fw-bold <?php if( is_page_template('page-templates/template-afiliados.php') ) echo 'active'; ?>" href="/afiliados">Afiliados</a>
						</li>
						<li class="nav-item">
							<a class="nav-link fw-bold p-3 <?php if( is_page_template('page-templates/template-contato.php') ) echo 'active'; ?>" href="/contato">Contato</a>
						</li>
						<li class="nav-item">
							<a class="btn btn-warning ms-lg-3" href="/register">Começar Grátis</a>
						</li>
					</ul>
                    <?php
                }
                ?>

                <!-- Botão de Toggle Dark Mode --> 
				<!--
                <button id="darkModeToggle" class="btn btn-sm btn-outline-light ms-3" title="Alternar Modo Escuro">
                    <span class="visually-hidden">Modo Dark</span> 🌙
                </button>
				-->

            </div>
        </div>
    </nav>
</header>

<!-- Conteúdo começa após a barra fixa -->
<main class="pt-5 mt-5">
    <div class="container">
