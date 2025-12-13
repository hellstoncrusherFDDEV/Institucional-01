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

<div class="container my-2">
    <h1 class="display-4 text-primary text-center"><i class="fas fa-tags me-2"></i><?php echo esc_html( get_theme_mod('precos_title','Pague Apenas Pelo Uso') ); ?></h1>
    <p class="lead text-center mb-5"><?php echo wp_kses_post( get_theme_mod('precos_lead','Nosso modelo é de <strong>créditos pré-pagos</strong>, permitindo total controle de custos sem mensalidades fixas.') ); ?></p>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0"><i class="fas fa-table me-2"></i><?php echo esc_html( get_theme_mod('precos_table_title', __( 'Tabela de Recarga e Custo por Uso', 'institucional-01' ) ) ); ?></h3>
                    <p class="mb-0"><?php echo esc_html( get_theme_mod('precos_table_subtitle', __( 'Quanto maior a recarga, menor o custo por uso.', 'institucional-01' ) ) ); ?></p>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="text-center"><i class="fas fa-dollar-sign me-1"></i> <?php echo esc_html( get_theme_mod('precos_col_recarga_label', __( 'Valor da Recarga', 'institucional-01' ) ) ); ?></th>
                                <th class="text-center"><i class="fas fa-coins me-1"></i> <?php echo esc_html( get_theme_mod('precos_col_custo_label', __( 'Custo por Uso', 'institucional-01' ) ) ); ?></th>
                                <th class="text-center"><i class="fas fa-calculator me-1"></i> <?php echo esc_html( get_theme_mod('precos_col_calls_label', __( 'Usos Obtidos', 'institucional-01' ) ) ); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; foreach ($pricingTiers as $tier): $i++;
                                $value = $tier[1];
                                $cost = $tier[3];
                                $calls = $value / $cost;
                            ?>
                            <tr>
                                <td class="text-center font-weight-bold">R$ <?php echo number_format($value, 2, ',', '.'); ?></td>
                                <td class="text-center">R$ <?php echo number_format($cost, 2, ',', '.'); ?></td>
                                <td class="text-center text-success">
                                    <?php
                                        $prazo = get_theme_mod('precos_row_' . $i . '_prazo', '');
                                        if ( is_string($prazo) && strlen(trim($prazo)) ) {
                                            echo wp_kses_post( $prazo );
                                        } else {
                                            echo number_format($calls, 0, ',', '.') . ' ' . esc_html( get_theme_mod('precos_calls_suffix', __( 'usos', 'institucional-01' ) ) );
                                        }
                                    ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <p class="mt-3 text-muted"><?php echo wp_kses_post( get_theme_mod('precos_note', __( 'Nota: O valor mínimo de recarga é de R$ 10,00. O controle de uso garante que requisições sejam bloqueadas quando os créditos chegarem a zero.', 'institucional-01' ) ) ); ?></p>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-md-12 text-center">
            <h2><i class="fas fa-question-circle me-2"></i><?php echo esc_html( get_theme_mod('precos_why_title', __( 'Por Que Créditos Pré-Pagos?', 'institucional-01' ) ) ); ?></h2>
            <p><?php echo wp_kses_post( get_theme_mod('precos_why_desc', __( 'Este modelo garante que você pague somente quando usar os recursos da plataforma.', 'institucional-01' ) ) ); ?></p>
            <a href="<?php echo esc_url( get_theme_mod('precos_cta_url', home_url('/topup_credits') ) ); ?>" class="btn btn-lg btn-success"><i class="<?php echo esc_attr( get_theme_mod('precos_cta_icon', 'fas fa-wallet me-2') ); ?>"></i><?php echo esc_html( get_theme_mod('precos_cta_text', __( 'Recarregar Créditos Agora', 'institucional-01' ) ) ); ?></a>
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
