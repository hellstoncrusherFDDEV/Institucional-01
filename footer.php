</div> <!-- Fecha div.container aberta em header.php -->
</main>

<footer class="footer-custom mt-5">
    <div class="container text-center">
        <p class="mb-0">
            © <?php echo esc_html( get_theme_mod( 'company_name', 'PixGo' ) ); ?>. Todos os direitos reservados.
            <small class="d-block mt-1">
                <?php echo esc_html( get_theme_mod( 'company_tagline', 'API simples e econômica de pagamentos Pix via Mercado Pago.' ) ); ?>
            </small>
            <?php if ( $url = get_theme_mod( 'company_website', '' ) ) : ?>
                <small class="d-block mt-2">
                    <a href="<?php echo esc_url( $url ); ?>" class="text-decoration-none"><?php echo esc_html( $url ); ?></a>
                </small>
            <?php endif; ?>
        </p>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
