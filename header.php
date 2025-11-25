<?php ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header>
    <!-- Menu Bootstrap 5 Fixo e Responsivo -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top shadow navbar-custom">
        <div class="container">
            
            <!-- Logo -->
			<a class="navbar-brand d-flex align-items-center" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php
				if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
					the_custom_logo(); // Mostra o logo definido no Personalizar
				} else {
					// Fallback caso não tenha logo definida
					?>
					<img src="<?php echo esc_url( get_template_directory_uri() . '/img/Logo-PixGo.png' ); ?>" 
						 alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
					<span class="ms-2"><?php bloginfo( 'name' ); ?></span>
					<?php
				}
				?>
			</a>
            
            <!-- Botão Hamburguer -->
            <button class="navbar-toggler mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#pixgoNavbar" 
                    aria-controls="pixgoNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="pixgoNavbar">

                <?php
                // Se tiver menu registrado no WP
                if ( has_nav_menu( 'primary' ) ) {

                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'depth'          => 2,
                        'container'      => false,
                        'menu_class'     => 'navbar-nav nav-pills ms-auto mb-2 mb-lg-0',
                        'fallback_cb'    => false,
                        'walker'         => class_exists( 'WP_Bootstrap_Navwalker' ) ? new WP_Bootstrap_Navwalker() : null,
                    ) );

                } else {
                    // Fallback manual (caso não haja menu configurado no WP)
                    ?>
                    <ul class="navbar-nav nav-pills ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link fw-bold <?php if( is_front_page() ) echo 'active'; ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>"><i class="fas fa-home me-1"></i> <?php esc_html_e( 'Home', 'institucional-01' ); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-bold <?php if( is_page_template('page-templates/template-sobre.php') ) echo 'active'; ?>" href="<?php echo esc_url( home_url( '/sobre' ) ); ?>"><i class="fas fa-info-circle me-1"></i> <?php esc_html_e( 'Sobre', 'institucional-01' ); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-bold <?php if( is_page_template('page-templates/template-precos.php') ) echo 'active'; ?>" href="<?php echo esc_url( home_url( '/precos' ) ); ?>"><i class="fas fa-tag me-1"></i> <?php esc_html_e( 'Preços', 'institucional-01' ); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-bold <?php if( is_page_template('page-templates/template-como-funciona.php') ) echo 'active'; ?>" href="<?php echo esc_url( home_url( '/como-funciona' ) ); ?>"><i class="fas fa-question-circle me-1"></i> <?php esc_html_e( 'Docs API', 'institucional-01' ); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-bold <?php if( is_page_template('page-templates/template-afiliados.php') ) echo 'active'; ?>" href="<?php echo esc_url( home_url( '/afiliados' ) ); ?>"><i class="fas fa-handshake me-1"></i> <?php esc_html_e( 'Afiliados', 'institucional-01' ); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-bold <?php if( is_page_template('page-templates/template-contato.php') ) echo 'active'; ?>" href="<?php echo esc_url( home_url( '/contato' ) ); ?>"><i class="fas fa-envelope me-1"></i> <?php esc_html_e( 'Contato', 'institucional-01' ); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-bold <?php if( is_category('blog') ) echo 'active'; ?>" href="<?php echo esc_url(get_category_link(get_category_by_slug('blog')->term_id)); ?>">
                                <i class="fas fa-book me-1"></i> <?php esc_html_e( 'Blog', 'institucional-01' ); ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-warning ms-lg-3 text-bold" href="<?php echo esc_url( home_url( '/register' ) ); ?>"><i class="fas fa-rocket me-1"></i> <?php esc_html_e( 'Começar Grátis', 'institucional-01' ); ?></a>
                        </li>
                    </ul>
                    <?php
                }
                ?>

            </div>
        </div>
    </nav>
</header>

<!-- Conteúdo começa após a barra fixa -->
<main class="pt-5 mt-5">
    <div class="container">
