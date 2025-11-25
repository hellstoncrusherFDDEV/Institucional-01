<?php
/**
 * Template Name: PixGo: Home (Institucional)
 * Template Post Type: page
 *
 * Este modelo exibe o conteúdo da Home Page, focando na Proposta de Valor da PixGo:
 * API Pix Simples, Econômica e Fácil de Integrar.
 *
 */

get_header(); // Carrega o header.php, incluindo o menu fixo e responsivo

// 1. Hero Section (Destaque Principal)
?>
<section class="hero-section py-2 text-center bg-light-subtle rounded-3 shadow-sm">
    <div class="container">
        <!-- Título principal baseado no conteúdo institucional -->
        <h1 class="display-4 fw-bold text-primary"><i class="<?php echo esc_attr( get_theme_mod('home_hero_icon','fas fa-qrcode me-2') ); ?>"></i><?php echo esc_html( get_theme_mod('home_hero_title','PixGo: Sua API Pix Simples e Econômica') ); ?></h1>

        <!-- Proposta de valor principal -->
        <p class="lead mt-3 mb-4">
            <?php echo wp_kses_post( get_theme_mod('home_hero_lead','Gere QR Codes Pix e links de pagamento em segundos. Integre de forma fácil e pague apenas pelo que usar.') ); ?>
        </p>

        <hr class="my-4">

        <?php echo lazy_youtube_video( get_theme_mod('home_hero_video_url','https://www.youtube.com/watch?v=S86zAxbwa3k') ); ?>

        <p>
            Ideal para desenvolvedores, pequenos e-commerces e empreendedores que buscam uma solução rápida, confiável e com preço justo.
        </p>

        <!-- CTAs - Usamos os slugs definidos no sistema original, assumindo que as páginas foram criadas no WP -->
        <a href="<?php echo esc_url( get_theme_mod('home_cta_primary_url','/register') ); ?>" class="btn btn-primary btn-lg me-3 mb-2">
            <?php echo esc_html( get_theme_mod('home_cta_primary_text','Comece Grátis Agora!') ); ?>
        </a>
        <a href="<?php echo esc_url( get_theme_mod('home_cta_secondary_url','/login') ); ?>" class="btn btn-outline-secondary btn-lg mb-2">
            <?php echo esc_html( get_theme_mod('home_cta_secondary_text','Já sou Cliente') ); ?>
        </a>

    </div>
</section>

<?php
// Lógica para ajuste de cor no Dark Mode: O CSS dinâmico em functions.php cuida disso.
?>

<!-- 2. Por Que Escolher a PixGo? (Proposta de Valor) -->
<section class="value-prop mt-1 py-4">
    <div class="container">
        <h2 class="text-center mb-5 text-primary"><i class="fas fa-check-circle me-2"></i><?php echo esc_html( get_theme_mod('home_value_prop_title', __( 'Por Que Escolher a PixGo?', 'institucional-01' ) ) ); ?></h2>
        <div class="row text-center">

            <!-- Facilidade de Integração -->
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm p-4">
                    <i class="<?php echo esc_attr( get_theme_mod('home_value_prop_1_icon','fas fa-code fa-3x text-success mb-3') ); ?>"></i>
                    <h5 class="card-title text-success"><?php echo esc_html( get_theme_mod('home_value_prop_1_title', __( 'Facilidade de Integração', 'institucional-01' ) ) ); ?></h5>
                    <p class="card-text"><?php echo wp_kses_post( get_theme_mod('home_value_prop_1_desc', __( 'Nossa API é simples, com documentação clara e exemplos de código prontos. Integre o Pix em seus projetos em poucas horas, sem dor de cabeça.', 'institucional-01' ) ) ); ?></p>
                    <a href="<?php echo esc_url( home_url( '/como-funciona' ) ); ?>" class="btn btn-sm btn-outline-primary mt-auto"><?php echo esc_html( get_theme_mod('home_value_prop_1_btn', __( 'Ver Documentação', 'institucional-01' ) ) ); ?></a>
                </div>
            </div>

            <!-- Preço Justo por Requisição -->
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm p-4">
                    <i class="<?php echo esc_attr( get_theme_mod('home_value_prop_2_icon','fas fa-coins fa-3x text-info mb-3') ); ?>"></i>
                    <h5 class="card-title text-info"><?php echo esc_html( get_theme_mod('home_value_prop_2_title', __( 'Preço Justo por Requisição', 'institucional-01' ) ) ); ?></h5>
                    <p class="card-text"><?php echo wp_kses_post( get_theme_mod('home_value_prop_2_desc', __( 'Você paga apenas R$ 0,02 ou R$ 0,05 por requisição, como um modelo de créditos pré-pagos, eliminando assinaturas mensais caras.', 'institucional-01' ) ) ); ?></p>
                    <a href="<?php echo esc_url( home_url( '/precos' ) ); ?>" class="btn btn-sm btn-outline-success mt-auto"><?php echo esc_html( get_theme_mod('home_value_prop_2_btn', __( 'Ver Tabela de Preços', 'institucional-01' ) ) ); ?></a>
                </div>
            </div>

            <!-- Escalabilidade e Confiabilidade -->
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm p-4">
                    <i class="<?php echo esc_attr( get_theme_mod('home_value_prop_3_icon','fas fa-rocket fa-3x text-warning mb-3') ); ?>"></i>
                    <h5 class="card-title text-warning"><?php echo esc_html( get_theme_mod('home_value_prop_3_title', __( 'Escalabilidade e Confiabilidade', 'institucional-01' ) ) ); ?></h5>
                    <p class="card-text"><?php echo wp_kses_post( get_theme_mod('home_value_prop_3_desc', __( 'Construído com PHP 8 e MySQL, ideal para pequenos apps e e-commerces que precisam escalar sem manter um servidor próprio.', 'institucional-01' ) ) ); ?></p>
                    <a href="<?php echo esc_url( home_url( '/sobre' ) ); ?>" class="btn btn-sm btn-outline-info mt-auto"><?php echo esc_html( get_theme_mod('home_value_prop_3_btn', __( 'Saiba Mais', 'institucional-01' ) ) ); ?></a>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- 3. Quem se Beneficia? (Foco nas Personas) -->
<section class="target-audience bg-light-subtle py-4">
    <div class="container">
        <h2 class="text-center mb-5 text-primary"><i class="fas fa-users me-2"></i><?php echo esc_html( get_theme_mod('home_target_title', __( 'Quem se Beneficia com PixGo?', 'institucional-01' ) ) ); ?></h2>
        <div class="row">

            <!-- Desenvolvedores Freelancers -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 p-3">
                    <div class="card-body">
                        <h3 class="h4 text-secondary"><i class="<?php echo esc_attr( get_theme_mod('home_target_1_icon','fas fa-laptop-code me-2') ); ?>"></i><?php echo esc_html( get_theme_mod('home_target_1_title', __( 'Desenvolvedores Freelancers e Pequenos Times', 'institucional-01' ) ) ); ?></h3>
                        <p class="card-text text-muted">
                            <?php echo wp_kses_post( get_theme_mod('home_target_1_quote', __( 'Use esta API e gere QR Codes Pix com 3 linhas de código. Sem complicação.', 'institucional-01' ) ) ); ?>
                        </p>
                            <small><?php echo wp_kses_post( get_theme_mod('home_target_1_small', __( 'Ideal para integrar Pix em projetos em poucas horas, evitando a complexidade da documentação oficial do Mercado Pago.', 'institucional-01' ) ) ); ?></small>
                    </div>
                </div>
            </div>

            <!-- Pequenos E-commerces -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 p-3">
                    <div class="card-body">
                        <h3 class="h4 text-secondary"><i class="<?php echo esc_attr( get_theme_mod('home_target_2_icon','fas fa-store me-2') ); ?>"></i><?php echo esc_html( get_theme_mod('home_target_2_title', __( 'Pequenos E-commerces e Lojas Virtuais', 'institucional-01' ) ) ); ?></h3>
                        <p class="card-text text-muted">
                            <?php echo wp_kses_post( get_theme_mod('home_target_2_quote', __( 'Transforme pedidos em pagamentos Pix em segundos e pague só pelo que usar.', 'institucional-01' ) ) ); ?>
                        </p>
                            <small><?php echo wp_kses_post( get_theme_mod('home_target_2_small', __( 'Automação de pagamentos Pix sem plugins pesados ou mensalidades altas de gateways.', 'institucional-01' ) ) ); ?></small>
                    </div>
                </div>
            </div>

            <!-- Prestadores de Serviço / Startups -->
            <div class="col-md-12 col-lg-4 mb-4">
                <div class="card h-100 p-3">
                    <div class="card-body">
                        <h3 class="h4 text-secondary"><i class="<?php echo esc_attr( get_theme_mod('home_target_3_icon','fas fa-briefcase me-2') ); ?>"></i><?php echo esc_html( get_theme_mod('home_target_3_title', __( 'Serviços Autônomos e Startups', 'institucional-01' ) ) ); ?></h3>
                        <p class="card-text text-muted">
                            <?php echo wp_kses_post( get_theme_mod('home_target_3_quote', __( 'Pare de gerar Pix manualmente. / Integre Pix em minutos e foque no crescimento.', 'institucional-01' ) ) ); ?>
                        </p>
                        <small>Gere cobranças avulsas rapidamente ou valide seu MVP integrando pagamentos de forma confiável e barata.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 4. Como Funciona (Mecanismo e Chamada Final para Registro) -->
<section class="how-it-works py-4 bg-light">
  <div class="container">
    <div class="row">
      <div class="col-md-8 offset-md-2 text-center">
        <h2 class="fw-bold mb-3">
          <i class="<?php echo esc_attr( get_theme_mod('home_how_icon','fas fa-cogs me-2 text-success') ); ?>"></i> <?php echo esc_html( get_theme_mod('home_how_title', __( 'Como Funciona?', 'institucional-01' ) ) ); ?>
        </h2>
        <p class="lead"><?php echo wp_kses_post( get_theme_mod('home_how_desc', __( 'Com a PixGo, você cadastra sua chave do Mercado Pago na plataforma e usa nossa API para gerar QR Codes e links de pagamento. Nós cuidamos da complexidade, você foca no seu negócio.', 'institucional-01' ) ) ); ?></p>
        <div class="alert alert-warning shadow-sm mt-4">
          <h5 class="mb-2">
            <i class="<?php echo esc_attr( get_theme_mod('home_model_icon','fas fa-coins me-2') ); ?>"></i> <?php echo esc_html( get_theme_mod('home_model_title', __( 'Modelo de Créditos Pré-Pagos', 'institucional-01' ) ) ); ?>
          </h5>
          <p class="mb-1">
            <?php echo wp_kses_post( get_theme_mod('home_model_text', 'Você carrega um valor (ex: <strong>R$ 10,00</strong>) e recebe um número correspondente de chamadas à API (ex: <strong>500 chamadas</strong> a R$ 0,02 cada).') ); ?>
          </p>
        </div>
        <div class="d-flex justify-content-center">
          <a href="<?php echo esc_url( get_theme_mod('home_bottom_cta_url', home_url('/register') ) ); ?>" class="btn btn-success btn-lg mt-4 px-4 shadow">
            <i class="<?php echo esc_attr( get_theme_mod('home_bottom_cta_icon','fas fa-rocket me-2') ); ?>"></i> <?php echo esc_html( get_theme_mod('home_bottom_cta_text', __( 'Quero Começar Agora!', 'institucional-01' ) ) ); ?>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

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
