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

<div class="py-5">
    <h1 class="display-4 text-primary"><i class="fas fa-info-circle me-2"></i>API Pix Simples e Econômica</h1>

    <section class="mb-5">
        <p class="lead">
            Nascemos para simplificar a integração de pagamentos Pix para desenvolvedores e pequenos negócios.
        </p>
    </section>

    <!-- Seção: Nossa Proposta de Valor -->
    <section class="mb-5">
        <h2 class="card-title text-success"><i class="fas fa-award me-2"></i>Nossa Proposta de Valor</h2>

        <p class="mb-4">
            A PixGo oferece uma API simples, rápida e barata para gerar QR Codes Pix e links de pagamento.
        </p>

        <div class="row">

            <!-- Facilidade de Integração -->
            <div class="col-md-4 mb-4">
                <div class="card p-4 h-100 shadow-sm border-primary">
                    <h4 class="text-primary"><i class="fas fa-plug me-2"></i> Facilidade de Integração</h4>
                    <p>Oferecemos uma API simples, com boa documentação e exemplos de código prontos. Integre o Pix em seus projetos em poucas horas.</p>
                </div>
            </div>

            <!-- Preço Justo -->
            <div class="col-md-4 mb-4">
                <div class="card p-4 h-100 shadow-sm border-success">
                    <h4 class="text-success"><i class="fas fa-tags me-2"></i>Preço Justo</h4>
                    <p>Adotamos um modelo de créditos pré-pagos, onde você paga por requisição (ex: R$ 0,02 ou R$ 0,05), eliminando assinaturas mensais caras.</p>
                </div>
            </div>

            <!-- Foco no Mercado Pago e Escalabilidade -->
            <div class="col-md-4 mb-4">
                <div class="card p-4 h-100 shadow-sm border-info">
                    <h4 class="text-info"><i class="fas fa-chart-line me-2"></i>Escalabilidade</h4>
                    <p>Utilizamos a infraestrutura confiável do Mercado Pago para gerar os Pix. O sistema é ideal para pequenos sites e aplicativos que não querem manter um servidor próprio para a geração de QR Code Pix.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Seção: Para Quem é o PixGo? -->
    <section class="mb-5">
        <h2 class="h3 mb-4">Para Quem é o PixGo?</h2>

        <ul class="list-group list-group-flush">
            <li class="list-group-item bg-light">
                <strong>Desenvolvedores Freelancers:</strong> Que precisam integrar Pix em projetos em poucas horas, sem a complexidade da documentação oficial do Mercado Pago.
            </li>
            <li class="list-group-item">
                <strong>Pequenos E-commerces:</strong> Que buscam automatizar pagamentos Pix sem plugins pesados ou mensalidades altas de gateways.
            </li>
            <li class="list-group-item bg-light">
                <strong>Prestadores de Serviço Autônomos:</strong> Que precisam gerar cobranças avulsas de forma rápida e automatizada, como consultores ou criadores de conteúdo.
            </li>
            <li class="list-group-item">
                <strong>Startups e MVPs:</strong> Que precisam validar o produto rapidamente e integrar pagamentos de forma confiável e barata, com foco na escalabilidade futura.
            </li>
        </ul>
    </section>

    <!-- CTA Final -->
    <section class="text-center mt-5">
        <a href="/register" class="btn btn-success btn-lg">
            Comece a Integrar Agora!
        </a>
    </section>

</div>

<?php
get_footer(); // Carrega o footer.php
?>
