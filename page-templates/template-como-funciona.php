<?php
/**
 * Template Name: Como Funciona / Documentação
 * Template Post Type: page
 *
 * Esta página apresenta de forma geral como a plataforma funciona.
 *
 * Tema: Institucional 01
 *
 */

get_header(); // Carrega o header.php, incluindo o menu fixo e responsivo
?>

<div class="container my-2">
    <h1 class="display-4 text-primary text-center"><i class="<?php echo esc_attr( get_theme_mod('como_title_icon','fas fa-question-circle me-2') ); ?>"></i><?php echo esc_html( get_theme_mod('como_title','Como Funciona?') ); ?></h1>
    <p class="lead text-center mb-5"><?php echo esc_html( get_theme_mod('como_lead','Ideal para micro e pequenas empresas e profissionais liberais.') ); ?></p>

    <div class="row">
        <!-- Passo 1: Configuração -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow">
                <div class="card-body">
                    <h3 class="card-title text-primary"><i class="<?php echo esc_attr( get_theme_mod('como_step1_icon','fas fa-key me-2') ); ?>"></i><?php echo esc_html( get_theme_mod('como_step1_title', __( '1. Configure Suas Chaves', 'institucional-01' ) ) ); ?></h3>
                    <p><?php echo wp_kses_post( get_theme_mod('como_step1_intro', 'Após o registro, cadastre sua forma de recebimento e defina acessos:') ); ?></p>
                    <ul class="list-unstyled">
                        <li><?php echo wp_kses_post( get_theme_mod('como_step1_item1', '<strong>Chave de acesso da plataforma:</strong> Gerada automaticamente e usada para entrar no painel com segurança.') ); ?></li>
                        <li><?php echo wp_kses_post( get_theme_mod('como_step1_item2', '<strong>Dados do seu provedor de pagamentos (ex: Mercado Pago):</strong> Armazenados de forma <strong>criptografada</strong> e utilizados apenas nas operações autorizadas.') ); ?></li>
                    </ul>
                    <a href="<?php echo esc_url( get_theme_mod('como_link_keys','/api_key') ); ?>" class="btn btn-sm btn-outline-primary"><i class="fas fa-cog me-1"></i><?php echo esc_html( get_theme_mod('como_step1_btn', __( 'Configurar Recebimentos', 'institucional-01' ) ) ); ?></a>
                </div>
            </div>
        </div>

        <!-- Passo 2: Recarga de Créditos -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow">
                <div class="card-body">
                    <h3 class="card-title text-primary"><i class="<?php echo esc_attr( get_theme_mod('como_step2_icon','fas fa-wallet me-2') ); ?>"></i><?php echo esc_html( get_theme_mod('como_step2_title', __( '2. Ajuste seu Saldo', 'institucional-01' ) ) ); ?></h3>
                    <p><?php echo wp_kses_post( get_theme_mod('como_step2_desc1', 'Trabalhamos com créditos pré-pagos, garantindo previsibilidade de custos para o seu negócio.') ); ?></p>
                    <p><?php echo wp_kses_post( get_theme_mod('como_step2_desc2', 'Recarregue a partir de R$ 10,00 e utilize conforme a demanda. Os créditos entram após a <strong>confirmação</strong> do pagamento.') ); ?></p>
                    <a href="<?php echo esc_url( get_theme_mod('como_link_topup','/topup_credits') ); ?>" class="btn btn-sm btn-outline-primary"><i class="fas fa-coins me-1"></i><?php echo esc_html( get_theme_mod('como_step2_btn', __( 'Recarregar', 'institucional-01' ) ) ); ?></a>
                </div>
            </div>
        </div>

        
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow">
                <div class="card-body">
                    <h3 class="card-title text-primary"><i class="<?php echo esc_attr( get_theme_mod('como_step3_icon','fas fa-code me-2') ); ?>"></i><?php echo esc_html( get_theme_mod('como_step3_title', __( '3. Utilize os Recursos', 'institucional-01' ) ) ); ?></h3>
                    <p><?php echo wp_kses_post( get_theme_mod('como_step3_desc1', 'Utilize o painel para realizar ações do dia a dia: emitir cobranças, organizar atendimentos e acompanhar vendas.') ); ?></p>
                    <p><?php echo wp_kses_post( get_theme_mod('como_step3_desc2', 'Defina apenas o essencial para cada operação e deixe o restante por nossa conta.') ); ?></p>
                    <p><?php echo wp_kses_post( get_theme_mod('como_step3_desc3', 'Acompanhe resultados em tempo real no painel e exporte relatórios quando precisar.') ); ?></p>
                    <p class="mt-2 text-success"><i class="<?php echo esc_attr( get_theme_mod('como_step3_note_icon','fas fa-check-circle me-1') ); ?>"></i> <?php echo esc_html( get_theme_mod('como_step3_note', 'Tudo respeita as regras do seu plano e saldo.') ); ?></p>
                    <a href="<?php echo esc_url( get_theme_mod('como_link_generate','/generate_pix') ); ?>" class="btn btn-sm btn-outline-primary"><i class="fas fa-qrcode me-1"></i><?php echo esc_html( get_theme_mod('como_step3_btn', __( 'Ver Recursos', 'institucional-01' ) ) ); ?></a>
                </div>
            </div>
        </div>
    </div>

    <h2 class="mt-2 mb-4"><?php echo esc_html( get_theme_mod('como_doc_title', __( 'Guia de Uso da Plataforma', 'institucional-01' ) ) ); ?></h2>



	<p class="lead"><?php echo wp_kses_post( get_theme_mod('como_doc_lead', 'Conheça os principais recursos e fluxos operacionais disponíveis na plataforma.') ); ?></p>

	<div class="accordion" id="apiDocumentationAccordion">


		<div class="accordion-item">
			<h2 class="accordion-header" id="headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    <strong><?php echo esc_html( get_theme_mod('como_res1_title', 'Recurso 1 — Operações') ); ?></strong>
                </button>
			</h2>
			<div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#apiDocumentationAccordion">
				<div class="accordion-body">

                    <h5 class="mb-3"><?php echo esc_html( get_theme_mod('como_res1_details_title', __( 'Detalhes do Recurso', 'institucional-01' ) ) ); ?></h5>
                    <p><?php echo wp_kses_post( get_theme_mod('como_res1_details_desc', 'Este recurso consome créditos conforme o uso e retorna o resultado da operação realizada.') ); ?></p>



                    <h6><?php echo esc_html( get_theme_mod('como_res1_access_title', __( 'Acesso', 'institucional-01' ) ) ); ?></h6>
                    <p><?php echo wp_kses_post( get_theme_mod('como_res1_access_desc', 'Autenticação e permissões são aplicadas conforme seu plano e perfil.') ); ?></p>





                    <h5 class="mt-4"><?php echo esc_html( get_theme_mod('como_res1_use_title', __( 'Como utilizar', 'institucional-01' ) ) ); ?></h5>

                    <p><?php echo wp_kses_post( get_theme_mod('como_res1_use_desc', 'As operações podem ser executadas diretamente pelo painel e integradas aos seus processos internos.') ); ?></p>





				</div>
			</div>
		</div>


		<div class="accordion-item">
			<h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    <strong><?php echo esc_html( get_theme_mod('como_res2_title', 'Recurso 2 — Acompanhamento') ); ?></strong>
                </button>
			</h2>
			<div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#apiDocumentationAccordion">
				<div class="accordion-body">
                    <h5 class="mb-3"><?php echo esc_html( get_theme_mod('como_res2_details_title', __( 'Detalhes do Recurso', 'institucional-01' ) ) ); ?></h5>
                    <p><?php echo wp_kses_post( get_theme_mod('como_res2_details_desc', 'Utilize este recurso para acompanhar resultados e históricos das operações realizadas na plataforma.') ); ?></p>



                    <h6><?php echo esc_html( get_theme_mod('como_res2_access_title', __( 'Acesso', 'institucional-01' ) ) ); ?></h6>
                    <p><?php echo wp_kses_post( get_theme_mod('como_res2_access_desc', 'Disponível conforme permissões do usuário e plano contratado.') ); ?></p>



                    <p class="text-muted small"><?php echo wp_kses_post( get_theme_mod('como_res2_note', 'Você pode visualizar estados, valores e datas diretamente no painel.') ); ?></p>

                    <h5 class="mt-4"><?php echo esc_html( get_theme_mod('como_res2_use_title', __( 'Como utilizar', 'institucional-01' ) ) ); ?></h5>

                    <p><?php echo wp_kses_post( get_theme_mod('como_res2_use_desc', 'Use o painel para filtrar, consultar e exportar informações conforme sua rotina.') ); ?></p>





				</div>
			</div>
		</div>
	</div>

    <div class="row mt-2">
        <div class="col-lg-12">
            <h2 class="mt-4"><i class="<?php echo esc_attr( get_theme_mod('como_tech_icon', 'fas fa-server me-2') ); ?>"></i><?php echo esc_html( get_theme_mod('como_tech_title', __( 'Tecnologia e Escalabilidade', 'institucional-01' ) ) ); ?></h2>
            <p><i class="fas fa-shield-alt me-1 text-muted"></i> <?php echo wp_kses_post( get_theme_mod('como_tech_desc1', 'A plataforma é desenvolvida usando tecnologias atuais sem abrir mão da segurança, robustez e confiabilidade para gerenciar clientes e transações. A arquitetura é preparada para futuras integrações (como Stripe e/ou PayPal) e para monitoramento de logs e métricas.') ); ?></p>
            <p><i class="fas fa-book me-1 text-muted"></i> <?php echo wp_kses_post( get_theme_mod('como_tech_desc2', 'Nossos materiais de apoio são claros e voltados para quem utiliza a plataforma no dia a dia.') ); ?></p>
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

<?php
get_footer(); // Carrega o footer.php
?>
