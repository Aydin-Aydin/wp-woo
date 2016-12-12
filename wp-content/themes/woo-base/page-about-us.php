<?php get_header(); ?>
	<?php get_sidebar('sidebar-first'); ?>
<section class="primary-wrapper about-us">
  <div class="woo-main-content">
		<div id="cssanimation">
			<div id="animationbox">
		<?php if(have_posts()): while(have_posts()): the_post() ?>
			<?php the_content(); ?>
		<?php endwhile; endif; ?>
		</div>
		</div>
  </div><!-- end slider-wrapper woo-main-content -->
</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
