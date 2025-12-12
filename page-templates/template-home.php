<?php
/**
 * Template Name: Home (Institucional)
 * Template Post Type: page
 *
 * Este modelo exibe o conteúdo da Home Page com foco em soluções para micro e pequenas empresas e profissionais liberais.
 *
 */

get_header(); // Carrega o header.php, incluindo o menu fixo e responsivo

// 1. Hero Section (Destaque Principal)
?>
<section class="hero-section py-2 text-center bg-light-subtle rounded-3 shadow-sm">
    <div class="container">
        <!-- Título principal baseado no conteúdo institucional -->
        <h1 class="display-4 fw-bold text-primary"><i class="<?php echo esc_attr( get_theme_mod('home_hero_icon','fas fa-briefcase me-2') ); ?>"></i><?php echo esc_html( get_theme_mod('home_hero_title','Soluções para Micro e Pequenas Empresas') ); ?></h1>

        <!-- Proposta de valor principal -->
        <p class="lead mt-3 mb-4">
            <?php echo wp_kses_post( get_theme_mod('home_hero_lead','Organize cobranças, atendimentos e recebimentos com simplicidade. Pague apenas pelo uso.') ); ?>
        </p>

        <hr class="my-4">

        <?php echo lazy_youtube_video( get_theme_mod('home_hero_video_url','https://www.youtube.com/watch?v=S86zAxbwa3k') ); ?>

        <p>
            <?php echo wp_kses_post( get_theme_mod('home_hero_subtext', __( 'Ideal para micro e pequenas empresas, empreendedores e profissionais liberais que buscam praticidade e preço justo.', 'institucional-01' ) ) ); ?>
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
        <h2 class="text-center mb-5 text-primary"><i class="fas fa-check-circle me-2"></i><?php echo esc_html( get_theme_mod('home_value_prop_title', __( 'Por Que Escolher Nossa Plataforma?', 'institucional-01' ) ) ); ?></h2>
        <div class="row text-center">

            <!-- Facilidade de Integração -->
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm p-4">
                    <i class="<?php echo esc_attr( get_theme_mod('home_value_prop_1_icon','fas fa-thumbs-up fa-3x text-success mb-3') ); ?>"></i>
                    <h5 class="card-title text-success"><?php echo esc_html( get_theme_mod('home_value_prop_1_title', __( 'Facilidade de Uso', 'institucional-01' ) ) ); ?></h5>
                    <p class="card-text"><?php echo wp_kses_post( get_theme_mod('home_value_prop_1_desc', __( 'Interface simples e fluxos objetivos para o dia a dia. Emita cobranças, organize atendimentos e receba com poucos passos.', 'institucional-01' ) ) ); ?></p>
                    <a href="<?php echo esc_url( home_url( '/como-funciona' ) ); ?>" class="btn btn-sm btn-outline-primary mt-auto"><?php echo esc_html( get_theme_mod('home_value_prop_1_btn', __( 'Saiba como funciona', 'institucional-01' ) ) ); ?></a>
                </div>
            </div>

            <!-- Preço Justo por Requisição -->
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm p-4">
                    <i class="<?php echo esc_attr( get_theme_mod('home_value_prop_2_icon','fas fa-coins fa-3x text-info mb-3') ); ?>"></i>
                    <h5 class="card-title text-info"><?php echo esc_html( get_theme_mod('home_value_prop_2_title', __( 'Preço Justo por Uso', 'institucional-01' ) ) ); ?></h5>
                    <p class="card-text"><?php echo wp_kses_post( get_theme_mod('home_value_prop_2_desc', __( 'Pague somente pelo que usar, com créditos pré-pagos. Sem mensalidades altas nem surpresas.', 'institucional-01' ) ) ); ?></p>
                    <a href="<?php echo esc_url( home_url( '/precos' ) ); ?>" class="btn btn-sm btn-outline-success mt-auto"><?php echo esc_html( get_theme_mod('home_value_prop_2_btn', __( 'Ver Tabela de Preços', 'institucional-01' ) ) ); ?></a>
                </div>
            </div>

            <!-- Escalabilidade e Confiabilidade -->
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm p-4">
                    <i class="<?php echo esc_attr( get_theme_mod('home_value_prop_3_icon','fas fa-rocket fa-3x text-warning mb-3') ); ?>"></i>
                    <h5 class="card-title text-warning"><?php echo esc_html( get_theme_mod('home_value_prop_3_title', __( 'Escalabilidade e Confiabilidade', 'institucional-01' ) ) ); ?></h5>
                    <p class="card-text"><?php echo wp_kses_post( get_theme_mod('home_value_prop_3_desc', __( 'Tecnologia confiável e pronta para crescer com seu negócio, sem exigir equipe técnica dedicada.', 'institucional-01' ) ) ); ?></p>
                    <a href="<?php echo esc_url( home_url( '/sobre' ) ); ?>" class="btn btn-sm btn-outline-info mt-auto"><?php echo esc_html( get_theme_mod('home_value_prop_3_btn', __( 'Saiba Mais', 'institucional-01' ) ) ); ?></a>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- 3. Quem se Beneficia? (Foco nas Personas) -->
<section class="target-audience bg-light-subtle py-4">
    <div class="container">
        <h2 class="text-center mb-5 text-primary"><i class="fas fa-users me-2"></i><?php echo esc_html( get_theme_mod('home_target_title', __( 'Quem se Beneficia?', 'institucional-01' ) ) ); ?></h2>
        <div class="row">

            <!-- Desenvolvedores Freelancers -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 p-3">
                    <div class="card-body">
                        <h3 class="h4 text-secondary"><i class="<?php echo esc_attr( get_theme_mod('home_target_1_icon','fas fa-laptop-code me-2') ); ?>"></i><?php echo esc_html( get_theme_mod('home_target_1_title', __( 'Profissionais e Pequenos Times', 'institucional-01' ) ) ); ?></h3>
                        <p class="card-text text-muted">
                            <?php echo wp_kses_post( get_theme_mod('home_target_1_quote', __( 'Simplifique tarefas do dia a dia e evite soluções complexas. Foque no que importa.', 'institucional-01' ) ) ); ?>
                        </p>
                            <small><?php echo wp_kses_post( get_theme_mod('home_target_1_small', __( 'Ferramentas práticas para agilizar rotinas sem precisar de conhecimentos técnicos avançados.', 'institucional-01' ) ) ); ?></small>
                    </div>
                </div>
            </div>

            <!-- Pequenos E-commerces -->
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 p-3">
                    <div class="card-body">
                        <h3 class="h4 text-secondary"><i class="<?php echo esc_attr( get_theme_mod('home_target_2_icon','fas fa-store me-2') ); ?>"></i><?php echo esc_html( get_theme_mod('home_target_2_title', __( 'Pequenos Negócios e Lojas Virtuais', 'institucional-01' ) ) ); ?></h3>
                        <p class="card-text text-muted">
                            <?php echo wp_kses_post( get_theme_mod('home_target_2_quote', __( 'Transforme pedidos em vendas com processos simples e previsíveis.', 'institucional-01' ) ) ); ?>
                        </p>
                            <small><?php echo wp_kses_post( get_theme_mod('home_target_2_small', __( 'Automatize tarefas comerciais sem plugins pesados ou custos fixos elevados.', 'institucional-01' ) ) ); ?></small>
                    </div>
                </div>
            </div>

            <!-- Prestadores de Serviço / Startups -->
            <div class="col-md-12 col-lg-4 mb-4">
                <div class="card h-100 p-3">
                    <div class="card-body">
                        <h3 class="h4 text-secondary"><i class="<?php echo esc_attr( get_theme_mod('home_target_3_icon','fas fa-briefcase me-2') ); ?>"></i><?php echo esc_html( get_theme_mod('home_target_3_title', __( 'Serviços Autônomos e Startups', 'institucional-01' ) ) ); ?></h3>
                        <p class="card-text text-muted">
                            <?php echo wp_kses_post( get_theme_mod('home_target_3_quote', __( 'Pare de fazer tudo manualmente. Automatize operações e foque no crescimento.', 'institucional-01' ) ) ); ?>
                        </p>
                        <small><?php echo wp_kses_post( get_theme_mod('home_target_3_small', __( 'Gere cobranças avulsas rapidamente e valide seu MVP com processos simples e confiáveis.', 'institucional-01' ) ) ); ?></small>
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
        <p class="lead"><?php echo wp_kses_post( get_theme_mod('home_how_desc', __( 'Cadastre sua forma de recebimento, ajuste o saldo de créditos e utilize os recursos pelo painel. Nós cuidamos da complexidade, você foca no seu negócio.', 'institucional-01' ) ) ); ?></p>
        <div class="alert alert-warning shadow-sm mt-4">
          <h5 class="mb-2">
            <i class="<?php echo esc_attr( get_theme_mod('home_model_icon','fas fa-coins me-2') ); ?>"></i> <?php echo esc_html( get_theme_mod('home_model_title', __( 'Modelo de Créditos Pré-Pagos', 'institucional-01' ) ) ); ?>
          </h5>
          <p class="mb-1">
            <?php echo wp_kses_post( get_theme_mod('home_model_text', 'Você recarrega um valor (ex: <strong>R$ 10,00</strong>) e obtém um número correspondente de usos/operacões (ex: <strong>500 usos</strong> a R$ 0,02 cada).') ); ?>
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
