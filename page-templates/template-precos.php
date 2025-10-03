<?php
/*
Template Name: Tabela de Preços
Template Post Type: page
*/

get_header();

$pricingTiers = [
    ['Recarga (R$)', 10.00, 'Requisições a (R$)', 0.05],
    ['Recarga (R$)', 100.00, 'Requisições a (R$)', 0.04],
    ['Recarga (R$)', 250.00, 'Requisições a (R$)', 0.03],
    ['Recarga (R$)', 500.00, 'Requisições a (R$)', 0.02],
    ['Recarga (R$)', 1000.00, 'Requisições a (R$)', 0.01]
];
?>

<div class="py-5">
    <h1 class="display-4 mb-4">Preços PixGo: Pague Apenas Pelo Uso</h1>
    <p class="lead">Nosso modelo é de *créditos pré-pagos*, permitindo total controle de custos sem mensalidades fixas.</p>

    <h2 class="mt-5 mb-3">Tabela de Recarga e Custo por Requisição</h2>
    <p>Quanto maior a recarga, menor o custo por requisição.</p>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Valor da Recarga</th>
                    <th>Custo por Requisição à API</th>
                    <th>Requisições Obtidas</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pricingTiers as $tier): 
                    $value = $tier[1];
                    $cost = $tier[3];
                    $calls = $value / $cost;
                ?>
                <tr>
                    <td>R$ <?php echo number_format($value, 2, ',', '.'); ?></td>
                    <td>R$ <?php echo number_format($cost, 2, ',', '.'); ?></td>
                    <td><?php echo number_format($calls, 0, '', '.'); ?> chamadas</td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <p class="alert alert-info mt-4">Nota: O valor mínimo de recarga é de R$ 10,00.</p>
    <a href="/topup-credits" class="btn btn-success btn-lg">Recarregar Créditos Agora</a>
    
</div>

<?php get_footer(); ?>