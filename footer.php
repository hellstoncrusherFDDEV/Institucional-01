</div> <!-- Fecha div.container aberta em header.php -->
</main>

<footer class="footer-custom mt-5">
    <div class="container">
        <div class="row footer-columns g-4">
            <div class="col-md-4">
                <h5><?php echo esc_html( get_theme_mod( 'company_name', 'PixGo' ) ); ?></h5>
                <p class="mb-2"><small><?php echo esc_html( get_theme_mod( 'company_tagline', 'API simples e econômica de pagamentos Pix via Mercado Pago.' ) ); ?></small></p>
                <?php $about = get_theme_mod( 'footer_about_text', '' ); if ( $about ) : ?>
                    <p class="mb-0"><?php echo wp_kses_post( $about ); ?></p>
                <?php endif; ?>
            </div>
            <div class="col-md-2">
                <h5><?php echo esc_html( get_theme_mod( 'footer_links_title', 'Links' ) ); ?></h5>
                <ul class="list-unstyled footer-links mb-0">
                    <?php for ( $i=1; $i<=4; $i++ ) : $label = get_theme_mod( "footer_link{$i}_label", '' ); $link = get_theme_mod( "footer_link{$i}_url", '' ); if ( $label && $link ) : ?>
                        <li><a class="text-decoration-none" href="<?php echo esc_url( $link ); ?>"><?php echo esc_html( $label ); ?></a></li>
                    <?php endif; endfor; ?>
                </ul>
            </div>
            <div class="col-md-3">
                <h5><?php echo esc_html( get_theme_mod( 'footer_contact_title', 'Contato' ) ); ?></h5>
                <ul class="list-unstyled mb-0">
                    <?php if ( $email = get_theme_mod( 'footer_contact_email', '' ) ) : ?>
                        <li><i class="fas fa-envelope me-2"></i><a class="text-decoration-none" href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></li>
                    <?php endif; ?>
                    <?php if ( $phone = get_theme_mod( 'footer_contact_phone', '' ) ) : ?>
                        <li class="mt-1"><i class="fas fa-phone me-2"></i><a class="text-decoration-none" href="tel:<?php echo esc_attr( preg_replace('/\D+/', '', $phone) ); ?>"><?php echo esc_html( $phone ); ?></a></li>
                    <?php endif; ?>
                    <?php if ( $addr = get_theme_mod( 'footer_contact_address', '' ) ) : ?>
                        <li class="mt-1"><i class="fas fa-map-marker-alt me-2"></i><span><?php echo esc_html( $addr ); ?></span></li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="col-md-3">
                <h5><?php echo esc_html( get_theme_mod( 'footer_social_title', 'Siga-nos' ) ); ?></h5>
                <div class="footer-social">
                    <?php $socials = array('facebook'=>'fab fa-facebook-f','instagram'=>'fab fa-instagram','linkedin'=>'fab fa-linkedin-in','youtube'=>'fab fa-youtube','twitter'=>'fab fa-twitter','whatsapp'=>'fab fa-whatsapp');
                    foreach ($socials as $key=>$icon) { $url = get_theme_mod( 'footer_social_' . $key, '' ); if ($url) { echo '<a class="social-btn me-1" href="' . esc_url($url) . '" target="_blank" aria-label="' . esc_attr($key) . '"><i class="' . esc_attr($icon) . '"></i></a>'; } } ?>
                </div>
            </div>
        </div>
        <div class="footer-bottom text-center">
            © <span class="footer-brand"><?php echo esc_html( get_theme_mod( 'company_name', 'PixGo' ) ); ?></span>. Todos os direitos reservados.
            <?php if ( $url = get_theme_mod( 'company_website', '' ) ) : ?>
                <small class="d-block mt-1"><a href="<?php echo esc_url( $url ); ?>" class="footer-link text-decoration-none"><?php echo esc_html( $url ); ?></a></small>
            <?php endif; ?>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
