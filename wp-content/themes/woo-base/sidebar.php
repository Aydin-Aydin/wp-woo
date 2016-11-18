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

<<<<<<< HEAD
<div class="sidebar-left-container">	
=======
<div class="sidebar-left-container">
>>>>>>> PontusDev
	<aside id="left-sidebar" class="widget-area" role="complementary">

	  <div class="side-nav-wrapper">
		  <div class="toggle-menu">
			  <span></span>
			  <span></span>
			  <span></span>
			  <span></span>
			</div>
	  </div>

	  <div class="side-first-wrapper">
	  	<?php dynamic_sidebar( 'sidebar-first' ); ?>
	  </div><!-- end side-left-wrapper -->

<<<<<<< HEAD
		<?php if (is_shop()): ?>		
			<span class="filter-icon toggle-menu"></span>
		  <div class="toggle-menu toggle-menu-filter side-left-wrapper">
		  <span class="toggle-menu toggle-menu-close"></span>  
			 <?php dynamic_sidebar( 'woo-products' ); ?>
		  </div><!-- end side-left-wrapper -->	  
		<?php endif ?>
		
=======
		<?php if (is_shop()): ?>
			<span class="filter-icon toggle-menu"></span>
		  <div class="toggle-menu toggle-menu-filter side-left-wrapper">
		  <span class="toggle-menu toggle-menu-close"></span>
			 <?php dynamic_sidebar( 'woo-products' ); ?>
		  </div><!-- end side-left-wrapper -->
		<?php endif ?>

>>>>>>> PontusDev
	</aside><!-- left-sidebar -->
</div>
