<?php
/**
 * Template Name: Sobre a Empresa
 * Template Post Type: page
 *
 * Esta página fornece informações sobre a empresa e sua proposta de valor,
 * utilizando o conteúdo de pages/sobre.php do sistema original.
 *
 * Tema: PixGo Institutional Theme
 *
 */

get_header(); // Carrega o header.php, incluindo o menu fixo e responsivo
?>

<div class="py-2">
    <h1 class="display-4 text-primary"><i class="fas fa-info-circle me-2"></i><?php echo esc_html( get_theme_mod('sobre_title','API Pix Simples e Econômica') ); ?></h1>

    <section class="mb-5">
        <p class="lead">
            <?php echo esc_html( get_theme_mod('sobre_intro_lead','Nascemos para simplificar a integração de pagamentos Pix para desenvolvedores e pequenos negócios.') ); ?>
        </p>
    </section>

    <!-- Seção: Nossa Proposta de Valor -->
    <section class="mb-5">
        <h2 class="card-title text-success"><i class="fas fa-award me-2"></i><?php echo esc_html( get_theme_mod('sobre_value_prop_title', __( 'Nossa Proposta de Valor', 'institucional-01' ) ) ); ?></h2>

        <p class="mb-4">
            A PixGo oferece uma API simples, rápida e barata para gerar QR Codes Pix e links de pagamento.
        </p>

        <div class="row">

            <!-- Facilidade de Integração -->
            <div class="col-md-4 mb-4">
                <div class="card p-4 h-100 shadow-sm border-primary">
                    <h4 class="text-primary"><i class="fas fa-plug me-2"></i> <?php echo esc_html( get_theme_mod('sobre_value_prop_1_title', __( 'Facilidade de Integração', 'institucional-01' ) ) ); ?></h4>
                    <p><?php echo wp_kses_post( get_theme_mod('sobre_value_prop_1_desc', __( 'Oferecemos uma API simples, com boa documentação e exemplos de código prontos. Integre o Pix em seus projetos em poucas horas.', 'institucional-01' ) ) ); ?></p>
                </div>
            </div>

            <!-- Preço Justo -->
            <div class="col-md-4 mb-4">
                <div class="card p-4 h-100 shadow-sm border-success">
                    <h4 class="text-success"><i class="fas fa-tags me-2"></i><?php echo esc_html( get_theme_mod('sobre_value_prop_2_title', __( 'Preço Justo', 'institucional-01' ) ) ); ?></h4>
                    <p><?php echo wp_kses_post( get_theme_mod('sobre_value_prop_2_desc', __( 'Adotamos um modelo de créditos pré-pagos, onde você paga por requisição, eliminando assinaturas mensais caras.', 'institucional-01' ) ) ); ?></p>
                </div>
            </div>

            <!-- Foco no Mercado Pago e Escalabilidade -->
            <div class="col-md-4 mb-4">
                <div class="card p-4 h-100 shadow-sm border-info">
                    <h4 class="text-info"><i class="fas fa-chart-line me-2"></i><?php echo esc_html( get_theme_mod('sobre_value_prop_3_title', __( 'Escalabilidade', 'institucional-01' ) ) ); ?></h4>
                    <p><?php echo wp_kses_post( get_theme_mod('sobre_value_prop_3_desc', __( 'Utilizamos a infraestrutura confiável do Mercado Pago para gerar os Pix. Ideal para pequenos sites e aplicativos.', 'institucional-01' ) ) ); ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Seção: Para Quem é o PixGo? -->
    <section class="mb-5">
        <h2 class="card-title text-success mb-3"><i class="fas fa-users me-2"></i><?php echo esc_html( get_theme_mod('sobre_target_title', __( 'Para Quem é o PixGo?', 'institucional-01' ) ) ); ?></h2>

        <ul class="list-group list-group-flush">
            <li class="list-group-item bg-light">
                <strong><i class="fas fa-laptop-code me-2 text-info"></i> <?php echo esc_html( get_theme_mod('sobre_target_1_title', __( 'Desenvolvedores Freelancers', 'institucional-01' ) ) ); ?>:</strong> <?php echo esc_html( get_theme_mod('sobre_target_1_desc', __( 'Precisam integrar Pix em projetos em poucas horas, sem complexidade.', 'institucional-01' ) ) ); ?>
            </li>
            <li class="list-group-item">
                <strong><i class="fas fa-shopping-cart me-2 text-info"></i> <?php echo esc_html( get_theme_mod('sobre_target_2_title', __( 'Pequenos E-commerces', 'institucional-01' ) ) ); ?>:</strong> <?php echo esc_html( get_theme_mod('sobre_target_2_desc', __( 'Buscam automatizar pagamentos Pix sem plugins pesados ou mensalidades altas.', 'institucional-01' ) ) ); ?>
            </li>
            <li class="list-group-item bg-light">
                <strong><i class="fas fa-user-tie me-2 text-info"></i> <?php echo esc_html( get_theme_mod('sobre_target_3_title', __( 'Prestadores de Serviço Autônomos', 'institucional-01' ) ) ); ?>:</strong> <?php echo esc_html( get_theme_mod('sobre_target_3_desc', __( 'Precisam gerar cobranças avulsas de forma rápida e automatizada.', 'institucional-01' ) ) ); ?>
            </li>
            <li class="list-group-item">
                <strong><i class="fas fa-user-tie me-2 text-info"></i> <?php echo esc_html( get_theme_mod('sobre_target_4_title', __( 'Startups e MVPs', 'institucional-01' ) ) ); ?>:</strong> <?php echo esc_html( get_theme_mod('sobre_target_4_desc', __( 'Precisam validar o produto rapidamente e integrar pagamentos de forma confiável e barata.', 'institucional-01' ) ) ); ?>
            </li>
        </ul>
    </section>

    <!-- CTA Final -->
    <section class="text-center mt-5">
        <a href="<?php echo esc_url( get_theme_mod('sobre_cta_url', home_url('/register') ) ); ?>" class="btn btn-success btn-lg">
            <i class="fas fa-rocket me-2"></i> <?php echo esc_html( get_theme_mod('sobre_cta_text', __( 'Comece a Integrar Agora!', 'institucional-01' ) ) ); ?>
        </a>
    </section>

</div>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
    $raw = get_the_content();
    if ( has_blocks( get_the_ID() ) || strlen( trim( wp_strip_all_tags( $raw ) ) ) ) : ?>
    <section class="container my-5">
        <?php the_content(); ?>
    </section>
    <?php endif; endwhile; endif; ?>

<?php
get_footer(); // Carrega o footer.php
?>
