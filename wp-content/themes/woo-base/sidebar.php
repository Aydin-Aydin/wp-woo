<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package storefront
 */

if ( ! is_active_sidebar( 'sidebar-first' ) ) {
  return;
}
?>


<div class="sidebar-left-container">
        <h2 id="site-name">LACEUP</h2>

  <aside id="left-sidebar" class="widget-area" role="complementary">

    <div class="side-nav-wrapper">
      <div class="toggle-menu">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
      </div>

      <div class="cart">
        <a class="cart-icon cart-contents" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>"><?php echo sprintf ( _n( '%d', '%d', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?></a>
      </div>
    </div>

    <div class="side-first-wrapper">
      <?php dynamic_sidebar( 'sidebar-first' ); ?>
    </div><!-- end side-left-wrapper -->

    <?php if (is_shop()): ?>
      <span class="filter-icon toggle-menu"></span>
      <div class="toggle-menu toggle-menu-filter side-left-wrapper">
      <span class="toggle-menu toggle-menu-close"></span>
       <?php dynamic_sidebar( 'woo-products' ); ?>
      </div><!-- end side-left-wrapper -->
    <?php endif ?>

  </aside><!-- left-sidebar -->
</div>
