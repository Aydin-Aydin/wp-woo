<?php get_header(); ?>
  <?php get_sidebar('sidebar-first'); ?>
	<section class="primary-wrapper">
		<div class="slider-wrapper woo-content"> 
		<?php if (have_posts()): ?>
		  <?php while (have_posts()): the_post(); ?>
		    <?php the_content(); ?>
		    <?php endwhile; ?>
		<?php endif ?>
		</div><!-- end slider-wrapper woo-content -->
	</section>
<?php get_footer(); ?>
