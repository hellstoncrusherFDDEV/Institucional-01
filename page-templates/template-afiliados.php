<?php
/*
Template Name: Programa de Afiliados
Template Post Type: page
*/

get_header();
?>

<div class="py-2 bg-light">
  <div class="container">
    <h1 class="display-4 fw-bold mb-4 text-center text-primary">
      <i class="fas fa-handshake me-2"></i> <?php echo esc_html( get_theme_mod('afiliados_title','Programa de Afiliados') ); ?>
    </h1>
    <div class="container my-4">

    <?php echo lazy_youtube_video( get_theme_mod('afiliados_video_main','https://www.youtube.com/watch?v=JS9IETTXC1Q') ); ?>

    </div>
    <p class="lead text-center">
      <i class="fas fa-bullhorn me-2 text-primary"></i> <?php echo wp_kses_post( get_theme_mod('afiliados_lead','Ajude a promover nossa plataforma e <strong>ganhe comissões recorrentes</strong>!') ); ?>
    </p>

    <div class="row mt-5">
      <!-- Coluna 1: Benefícios -->
      <div class="col-md-6 mb-4">
        <h2 class="fw-semibold mb-3">
          <i class="fas fa-star text-warning me-2"></i> <?php echo esc_html( get_theme_mod('afiliados_why_title', __( 'Por que ser um Afiliado?', 'institucional-01' ) ) ); ?>
        </h2>
        <ul class="list-unstyled">
          <li class="mb-3">
            <i class="fas fa-coins text-success me-2"></i>
            <?php echo wp_kses_post( get_theme_mod('afiliados_beneficio_1', __( 'Comissões Competitivas: Ganhe porcentagem de até 30% em todas as operações realizadas na plataforma pelos seus indicados.', 'institucional-01' ) ) ); ?>
          </li>
          <li class="mb-3">
            <i class="fas fa-bolt text-danger me-2"></i>
            <?php echo wp_kses_post( get_theme_mod('afiliados_beneficio_2', __( 'Fácil de Promover: Nossa solução simplifica a burocracia dos provedores oficiais e outros gateways de pagamento.', 'institucional-01' ) ) ); ?>
          </li>
          <li>
            <i class="fas fa-users text-info me-2"></i>
            <?php echo wp_kses_post( get_theme_mod('afiliados_beneficio_3', __( 'Público-Alvo Definido: Ideal para quem tem audiência em comunidades dev e e-commerces.', 'institucional-01' ) ) ); ?>
          </li>
        </ul>
      </div>

      <!-- Coluna 2: Como funciona -->
      <div class="col-md-6 mb-4">
        <h2 class="fw-semibold mb-3">
          <i class="fas fa-cogs text-secondary me-2"></i> <?php echo esc_html( get_theme_mod('afiliados_how_title', __( 'Como Funciona?', 'institucional-01' ) ) ); ?>
        </h2>
        <ol class="ps-3 list-unstyled">
          <li><i class="fas fa-user-plus text-success me-1"></i> <?php echo esc_html( get_theme_mod('afiliados_how_step_1', __( 'Cadastre-se no Programa.', 'institucional-01' ) ) ); ?></li>
          <li><i class="fas fa-link text-primary me-1"></i> <?php echo esc_html( get_theme_mod('afiliados_how_step_2', __( 'Receba seu link e materiais de divulgação.', 'institucional-01' ) ) ); ?></li>
          <li><i class="fas fa-key text.warning me-1"></i> <?php echo esc_html( get_theme_mod('afiliados_how_step_3', __( 'Seus indicados recebem a chave de acesso inicial.', 'institucional-01' ) ) ); ?></li>
          <li><i class="fas fa-wallet text-danger me-1"></i> <?php echo esc_html( get_theme_mod('afiliados_how_step_4', __( 'Eles recarregam créditos para usar a plataforma.', 'institucional-01' ) ) ); ?></li>
          <li><i class="fas fa-hand-holding-usd text-success me-1"></i> <?php echo esc_html( get_theme_mod('afiliados_how_step_5', __( 'Você ganha comissão sobre cada consumo efetivado na plataforma.', 'institucional-01' ) ) ); ?></li>
        </ol>
        <p class="text-muted mt-3">
          <i class="fas fa-briefcase me-2"></i> Parcerias com freelancers e agências digitais são parte da estratégia da plataforma.
        </p>
      </div>
    </div>

    <div class="container my-2">
    <h2 class="text-center mb-4">
      <i class="fas fa-info-circle text-success me-2"></i> <?php echo esc_html( get_theme_mod('afiliados_faq_title', __( 'Dúvidas Frequentes - Programa de Afiliados', 'institucional-01' ) ) ); ?>
    </h2>

    <div class="accordion" id="accordionAfiliados">

      <!-- Item 1 -->
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
          <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <i class="fas fa-star text-warning me-2"></i> <?php echo esc_html( get_theme_mod('afiliados_faq_q1', __( 'Quais são os benefícios de ser afiliado?', 'institucional-01' ) ) ); ?>
          </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionAfiliados">
          <div class="accordion-body">
            <p>Você recebe <strong>comissões recorrentes</strong> a cada operação realizada na plataforma pelos seus indicados.
            Além disso, tem acesso ao cupom de afiliado, que presenteia os indicados com valores entre R$10,00 e R$30,00.</p>

            <?php echo lazy_youtube_video( get_theme_mod('afiliados_video_beneficios','https://www.youtube.com/watch?v=BXEJ_diYqRc') ); ?>
            
          </div>
        </div>
      </div>

      <!-- Item 2 -->
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingTwo">
          <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            <i class="fas fa-play-circle text-danger me-2"></i> <?php echo esc_html( get_theme_mod('afiliados_faq_q2', __( 'Vídeo: Como funciona o programa?', 'institucional-01' ) ) ); ?>
          </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionAfiliados">
          <div class="accordion-body">
            <p class="mt-2">Nesse vídeo mostramos como o programa de afiliados funciona passo a passo.</p>

            <?php echo lazy_youtube_video( get_theme_mod('afiliados_video_como','https://www.youtube.com/watch?v=S86zAxbwa3k') ); ?>
            
          </div>
        </div>
      </div>

      <!-- Item 3 -->
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingThree">
          <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="#collapseThree">
            <i class="fas fa-question-circle text-primary me-2"></i> <?php echo esc_html( get_theme_mod('afiliados_faq_q3', __( 'Como recebo minhas comissões?', 'institucional-01' ) ) ); ?>
          </button>
        </h2>
        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionAfiliados">
          <div class="accordion-body">
            <p>As comissões são creditadas em sua conta Pix cadastrada ao solicitar um saque, sempre que atingir o valor de R$50,00 em comissões.
            <strong>Pagamento rápido e transparente!</strong></p>

            <?php echo lazy_youtube_video('https://www.youtube.com/watch?v=mcp6fHu7x1Q'); ?>
            
          </div>
        </div>
      </div>

      <!-- Item 4 -->
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingFour">
          <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
            <i class="fas fa-bullhorn text-success me-2"></i> <?php echo esc_html( get_theme_mod('afiliados_faq_q4', __( 'Dicas para divulgar melhor', 'institucional-01' ) ) ); ?>
          </button>
        </h2>
        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionAfiliados">
          <div class="accordion-body">
            <ul class="list-unstyled">
              <li><i class="fas fa-check-circle text-success me-2"></i> Compartilhe seu link em grupos dev no WhatsApp e Telegram.</li>
              <li><i class="fas fa-check-circle text-success me-2"></i> Produza conteúdo no YouTube ou blog sobre integração de pagamentos.</li>
              <li><i class="fas fa-check-circle text-success me-2"></i> Utilize o seu cupom que presenteia os indicados com valores entre R$10,00 e R$30,00 reais.</li>
            </ul>
          </div>
        </div>
      </div>

      <!-- CTA central -->
      <div class="text-center mt-4">
        <a href="<?php echo esc_url( get_theme_mod('afiliados_cta_url', home_url('/register') ) ); ?>" class="btn btn-success btn-lg px-4 shadow">
          <i class="fas fa-rocket me-2"></i> <?php echo esc_html( get_theme_mod('afiliados_cta_text', __( 'Quero me Cadastrar como Afiliado', 'institucional-01' ) ) ); ?>
        </a>
      </div>
</div>
  </div>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
    $raw = get_the_content();
    if ( has_blocks( get_the_ID() ) || strlen( trim( wp_strip_all_tags( $raw ) ) ) ) : ?>
    <section class="container my-5">
        <?php the_content(); ?>
    </section>
    <?php endif; endwhile; endif; ?>

<?php get_footer(); ?>
