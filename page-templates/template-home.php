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

<div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">

                <section class="hero-section py-5 text-center bg-light-subtle rounded-3 shadow-sm">
                    <div class="container">
                        <!-- Título principal baseado no conteúdo institucional -->
                        <h1 class="display-4 fw-bold text-primary"><i class="fas fa-qrcode me-2"></i>PixGo: Sua API Pix Simples e Econômica</h1>
                        
                        <!-- Proposta de valor principal -->
                        <p class="lead mt-3 mb-4">
                            Gere QR Codes Pix e links de pagamento em segundos. Integre de forma fácil e pague apenas pelo que usar.
                        </p>

                        <hr class="my-4"> 
                        <p>
                            Ideal para desenvolvedores, pequenos e-commerces e empreendedores que buscam uma solução rápida, confiável e com preço justo.
                        </p>

                        <!-- CTAs - Usamos os slugs definidos no sistema original, assumindo que as páginas foram criadas no WP -->
                        <a href="/register" class="btn btn-primary btn-lg me-3">
                            Comece Grátis Agora!
                        </a>
                        <a href="/login" class="btn btn-outline-secondary btn-lg">
                            Já sou Cliente
                        </a>
                    </div>
                </section>

                <?php
                // Lógica para ajuste de cor no Dark Mode: O CSS dinâmico em functions.php cuida disso.
                ?>

                <!-- 2. Por Que Escolher a PixGo? (Proposta de Valor) -->
                <section class="value-prop mt-5 py-5">
                    <div class="container">
                        <h2 class="text-center mb-5">Por Que Escolher a PixGo?</h2>
                        <div class="row text-center">
                            
                            <!-- Facilidade de Integração -->
                            <div class="col-md-4 mb-4">
                                <div class="card h-100 shadow-sm p-4">
                                    <i class="bi bi-code-slash text-primary display-4 mb-3"></i>
                                    <h3 class="h4">Facilidade de Integração</h3>
                                    <p class="card-text">
                                        Nossa API é simples, com documentação clara e exemplos de código prontos. Integre o Pix em seus projetos em poucas horas, sem dor de cabeça.
                                    </p>
                                    <a href="/como-funciona" class="btn btn-sm btn-outline-primary mt-auto">Ver Documentação</a>
                                </div>
                            </div>

                            <!-- Preço Justo por Requisição -->
                            <div class="col-md-4 mb-4">
                                <div class="card h-100 shadow-sm p-4">
                                    <i class="bi bi-currency-dollar text-success display-4 mb-3"></i>
                                    <h3 class="h4">Preço Justo por Requisição</h3>
                                    <p class="card-text">
                                        Você paga apenas R$ 0,02 ou R$ 0,05 por requisição, como um modelo de créditos pré-pagos, eliminando assinaturas mensais caras.
                                    </p>
                                    <a href="/precos" class="btn btn-sm btn-outline-success mt-auto">Ver Tabela de Preços</a>
                                </div>
                            </div>

                            <!-- Escalabilidade e Confiabilidade -->
                            <div class="col-md-4 mb-4">
                                <div class="card h-100 shadow-sm p-4">
                                    <i class="bi bi-cloud-check text-info display-4 mb-3"></i>
                                    <h3 class="h4">Escalabilidade e Confiabilidade</h3>
                                    <p class="card-text">
                                        Construído com PHP 8 e MySQL, ideal para pequenos apps e e-commerces que precisam escalar sem manter um servidor próprio.
                                    </p>
                                    <a href="/sobre" class="btn btn-sm btn-outline-info mt-auto">Saiba Mais</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>

                <!-- 3. Quem se Beneficia? (Foco nas Personas) -->
                <section class="target-audience bg-light-subtle py-5">
                    <div class="container">
                        <h2 class="text-center mb-5">Quem se Beneficia com PixGo?</h2>
                        <div class="row">
                            
                            <!-- Desenvolvedores Freelancers -->
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card h-100 p-3">
                                    <div class="card-body">
                                        <h4 class="card-title">Desenvolvedores Freelancers</h4>
                                        <p class="card-text text-muted">
                                            "Use esta API e gere QR Codes Pix com 3 linhas de código. Sem complicação."
                                        </p>
                                        <small>Ideal para integrar Pix em projetos em poucas horas, evitando a complexidade da documentação oficial do Mercado Pago.</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Pequenos E-commerces -->
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card h-100 p-3">
                                    <div class="card-body">
                                        <h4 class="card-title">Pequenos E-commerces</h4>
                                        <p class="card-text text-muted">
                                            "Transforme pedidos em pagamentos Pix em segundos e pague só pelo que usar."
                                        </p>
                                        <small>Automação de pagamentos Pix sem plugins pesados ou mensalidades altas de gateways.</small>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Prestadores de Serviço / Startups -->
                            <div class="col-md-12 col-lg-4 mb-4">
                                <div class="card h-100 p-3">
                                    <div class="card-body">
                                        <h4 class="card-title">Serviços Autônomos e Startups</h4>
                                        <p class="card-text text-muted">
                                            "Pare de gerar Pix manualmente." / "Integre Pix em minutos e foque no crescimento."
                                        </p>
                                        <small>Gere cobranças avulsas rapidamente ou valide seu MVP integrando pagamentos de forma confiável e barata.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- 4. Como Funciona (Mecanismo e Chamada Final para Registro) -->
                <section class="how-it-works py-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 offset-md-2 text-center">
                                <h2>Como Funciona?</h2>
                                <p class="lead">
                                    Com a PixGo, você cadastra sua chave do Mercado Pago na plataforma e usa nossa API para gerar QR Codes e links de pagamento. Nós cuidamos da complexidade, você foca no seu negócio.
                                </p>
                                <div class="alert alert-warning mt-4">
                                    <h5 class="mb-2">Modelo de Créditos Pré-Pagos</h5>
                                    <p class="mb-1">
                                        Você carrega um valor (ex: R$ 10,00) e recebe um número correspondente de chamadas à API (ex: 500 chamadas a R$ 0,02 cada).
                                    </p>
                                    <a href="/topup_credits" class="alert-link">Ver Recarga de Créditos.</a>
                                </div>
                                <a href="/register" class="btn btn-success btn-lg mt-4">
                                    Quero Começar Agora!
                                </a>
                            </div>
                        </div>
                    </div>
                </section>

        </div>
    </div>
</div>

<?php 
get_footer(); // Carrega o footer.php
?>