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
                    <?php if ( $email = get_theme_mod( 'footer_contact_email', '' ) ) : 
                        $display_email = $email;
                        if ( strlen($email) > 25 ) {
                            $display_email = substr($email, 0, 25) . '...';
                        }
                    ?>
                        <li><i class="fas fa-envelope me-2"></i><a class="text-decoration-none" href="mailto:<?php echo esc_attr( $email ); ?>" title="<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $display_email ); ?></a></li>
                    <?php endif; ?>
                    <?php if ( $phone = get_theme_mod( 'footer_contact_phone', '' ) ) : 
                        $phone_data = pixgo_get_contact_link_data( $phone );
                    ?>
                        <li class="mt-1"><i class="<?php echo esc_attr($phone_data['icon_class']); ?> me-2"></i><a class="text-decoration-none" href="<?php echo esc_url( $phone_data['url'] ); ?>" <?php echo $phone_data['is_mobile'] ? 'target="_blank"' : ''; ?>><?php echo esc_html( $phone ); ?></a></li>
                    <?php endif; ?>
                    <?php if ( $addr = get_theme_mod( 'footer_contact_address', '' ) ) : ?>
                        <li class="mt-1"><i class="fas fa-map-marker-alt me-2"></i><span><?php echo esc_html( $addr ); ?></span></li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="col-md-3">
                <h5><?php echo esc_html( get_theme_mod( 'footer_social_title', 'Siga-nos' ) ); ?></h5>
                <div class="footer-social">
                    <?php 
                    $socials = array('facebook'=>'fab fa-facebook-f','instagram'=>'fab fa-instagram','linkedin'=>'fab fa-linkedin-in','youtube'=>'fab fa-youtube','twitter'=>'fab fa-twitter','whatsapp'=>'fab fa-whatsapp');
                    foreach ($socials as $key=>$icon) { 
                        $url = get_theme_mod( 'footer_social_' . $key, '' ); 
                        if ($url) { 
                            // Tratamento especial para WhatsApp se for inserido apenas número
                            if ( $key === 'whatsapp' ) {
                                // Remove protocolo se houver para verificar se é apenas número
                                $clean_val = preg_replace( '#^https?://#', '', $url );
                                $only_digits = preg_replace( '/\D+/', '', $clean_val );
                                
                                // Se não tem wa.me/whatsapp.com e parece um número válido
                                if ( strpos($url, 'wa.me') === false && strpos($url, 'whatsapp.com') === false && !empty($only_digits) && strlen($only_digits) >= 10 ) {
                                    $phone_data = pixgo_get_contact_link_data( $only_digits );
                                    if ( $phone_data['is_mobile'] ) {
                                        $url = $phone_data['url'];
                                    } else {
                                        // Fallback: Se não foi detectado como móvel (ex: fixo business), força link wa.me
                                        // Adiciona 55 se for número brasileiro típico (10 ou 11 dígitos) e não começar com 55
                                        $wa_num = $only_digits;
                                        if ( (strlen($wa_num) === 10 || strlen($wa_num) === 11) && substr($wa_num, 0, 2) !== '55' ) {
                                            $wa_num = '55' . $wa_num;
                                        }
                                        $url = "https://wa.me/{$wa_num}";
                                    }
                                }
                            }
                            echo '<a class="social-btn me-1" href="' . esc_url($url) . '" target="_blank" aria-label="' . esc_attr($key) . '"><i class="' . esc_attr($icon) . '"></i></a>'; 
                        } 
                    } 
                    ?>
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
