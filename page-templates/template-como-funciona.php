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
    <h1 class="display-4 text-primary text-center"><i class="fas fa-question-circle me-2"></i><?php echo esc_html( get_theme_mod('como_title','Como Funciona?') ); ?></h1>
    <p class="lead text-center mb-5"><?php echo esc_html( get_theme_mod('como_lead','Conheça nosso processo em 3 passos.') ); ?></p>

    <div class="row">
        <!-- Passo 1: Configuração -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow">
                <div class="card-body">
                    <h3 class="card-title text-primary"><i class="fas fa-key me-2"></i><?php echo esc_html( get_theme_mod('como_step1_title', __( '1. Configure Suas Chaves', 'institucional-01' ) ) ); ?></h3>
                    <p>Após o registro, acesse "Minha Chave" para duas configurações essenciais:</p>
                    <ul>
                        <li><i class="fas fa-lock me-1 text-primary"></i> <strong>Sua chave de acesso da plataforma:</strong> Chave gerada automaticamente no registro e usada para autenticar seu acesso.</li>
                        <li><i class="fas fa-shield-alt me-1 text-primary"></i> <strong>Sua chave do provedor de pagamentos (ex: Mercado Pago):</strong> É armazenada de forma <strong>criptografada</strong> em nosso banco de dados.</li>
                    </ul>
                    <a href="<?php echo esc_url( get_theme_mod('como_link_keys','/api_key') ); ?>" class="btn btn-sm btn-outline-primary"><i class="fas fa-cog me-1"></i><?php echo esc_html( get_theme_mod('como_step1_btn', __( 'Gerenciar Chaves', 'institucional-01' ) ) ); ?></a>
                </div>
            </div>
        </div>

        <!-- Passo 2: Recarga de Créditos -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow">
                <div class="card-body">
                    <h3 class="card-title text-primary"><i class="fas fa-wallet me-2"></i><?php echo esc_html( get_theme_mod('como_step2_title', __( '2. Recarregue Seus Crédititos', 'institucional-01' ) ) ); ?></h3>
                    <p>Nosso sistema opera com créditos pré-pagos. Você recarrega um valor (mínimo R$ 10,00) e esse valor é convertido em uso de recursos, conforme a tabela de preços.</p>
                    <p>O processo de recarga gera um pedido de pagamento, e seus créditos são adicionados após a <strong>confirmação</strong> do pagamento.</p>
                    <a href="<?php echo esc_url( get_theme_mod('como_link_topup','/topup_credits') ); ?>" class="btn btn-sm btn-outline-primary"><i class="fas fa-coins me-1"></i><?php echo esc_html( get_theme_mod('como_step2_btn', __( 'Recarregar', 'institucional-01' ) ) ); ?></a>
                </div>
            </div>
        </div>

        
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow">
                <div class="card-body">
                    <h3 class="card-title text-primary"><i class="fas fa-code me-2"></i><?php echo esc_html( get_theme_mod('como_step3_title', __( '3. Utilize os Recursos', 'institucional-01' ) ) ); ?></h3>
                    <p>Acesse as funcionalidades disponíveis na plataforma conforme sua necessidade.</p>
                    <p>Defina os parâmetros necessários de acordo com a operação que deseja realizar.</p>
                    <p>Você recebe o resultado e pode acompanhá-lo no painel.</p>
                    <p class="mt-2 text-success"><i class="fas fa-check-circle me-1"></i> As operações seguem as regras do seu plano e saldo.</p>
                    <a href="<?php echo esc_url( get_theme_mod('como_link_generate','/generate_pix') ); ?>" class="btn btn-sm btn-outline-primary"><i class="fas fa-qrcode me-1"></i><?php echo esc_html( get_theme_mod('como_step3_btn', __( 'Ver Recursos', 'institucional-01' ) ) ); ?></a>
                </div>
            </div>
        </div>
    </div>

    <h2 class="mt-2 mb-4"><?php echo esc_html( get_theme_mod('como_doc_title', __( 'Guia de Uso da Plataforma', 'institucional-01' ) ) ); ?></h2>



	<p class="lead">Conheça os principais recursos e fluxos operacionais disponíveis na plataforma.</p>

	<div class="accordion" id="apiDocumentationAccordion">


		<div class="accordion-item">
			<h2 class="accordion-header" id="headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    <strong>Recurso 1</strong> &mdash; Operações
                </button>
			</h2>
			<div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#apiDocumentationAccordion">
				<div class="accordion-body">

                    <h5 class="mb-3">Detalhes do Recurso</h5>
                    <p>Este recurso consome créditos conforme o uso e retorna o resultado da operação realizada.</p>



                    <h6>Acesso</h6>
                    <p>Autenticação e permissões são aplicadas conforme seu plano e perfil.</p>





                    <h5 class="mt-4">Como utilizar</h5>

                    <p>As operações podem ser executadas diretamente pelo painel e integradas aos seus processos internos.</p>





				</div>
			</div>
		</div>


		<div class="accordion-item">
			<h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    <strong>Recurso 2</strong> &mdash; Acompanhamento
                </button>
			</h2>
			<div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#apiDocumentationAccordion">
				<div class="accordion-body">
                    <h5 class="mb-3">Detalhes do Recurso</h5>
                    <p>Utilize este recurso para acompanhar resultados e históricos das operações realizadas na plataforma.</p>



                    <h6>Acesso</h6>
                    <p>Disponível conforme permissões do usuário e plano contratado.</p>



                    <p class="text-muted small">Você pode visualizar estados, valores e datas diretamente no painel.</p>

                    <h5 class="mt-4">Como utilizar</h5>

                    <p>Use o painel para filtrar, consultar e exportar informações conforme sua rotina.</p>





				</div>
			</div>
		</div>
	</div>

    <div class="row mt-2">
        <div class="col-lg-12">
            <h2 class="mt-4"><i class="fas fa-server me-2"></i>Tecnologia e Escalabilidade</h2>
            <p><i class="fas fa-shield-alt me-1 text-muted"></i> A plataforma é desenvolvida usando tecnologias atuais sem abrir mão da segurança, robustez e confiabilidade para gerenciar clientes e transações. A arquitetura é preparada para futuras integrações (como Stripe e/ou PayPal) e para monitoramento de logs e métricas.</p>
            <p><i class="fas fa-book me-1 text-muted"></i> Nossos materiais de apoio são claros e voltados para quem utiliza a plataforma no dia a dia.</p>
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
