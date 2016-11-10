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

<aside id="left-sidebar" class="widget-area" role="complementary">
  <span class="toggle-menu toggle-menu-open"></span>
  <div class="side-left-wrapper">
  <span class="toggle-menu toggle-menu-close"></span>  
	 <?php dynamic_sidebar( 'sidebar-first' ); ?>
  </div><!-- end side-left-wrapper -->
</aside><!-- left-sidebar -->