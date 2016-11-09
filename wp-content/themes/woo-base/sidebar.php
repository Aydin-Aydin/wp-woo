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
	<?php dynamic_sidebar( 'sidebar-first' ); ?>
</aside><!-- #secondary -->