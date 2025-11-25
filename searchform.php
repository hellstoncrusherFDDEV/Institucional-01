<form role="search" method="get" class="search-form d-flex" action="<?php echo esc_url( home_url( '/' ) ); ?>">
  <label class="visually-hidden" for="search-field"><?php esc_html_e( 'Search for:', 'institucional-01' ); ?></label>
  <input type="search" id="search-field" class="form-control me-2" placeholder="<?php esc_attr_e( 'Pesquisar...', 'institucional-01' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
  <button type="submit" class="btn btn-primary">
    <span class="visually-hidden"><?php esc_html_e( 'Search', 'institucional-01' ); ?></span>
    <i class="fas fa-search"></i>
  </button>
</form>