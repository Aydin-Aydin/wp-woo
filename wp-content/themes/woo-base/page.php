<?php get_header(); ?>
	<?php get_sidebar('sidebar-first'); ?>
<?php
  $args = ['post_type' => 'slider'];
  $loop = new WP_Query( $args );

  while ( $loop->have_posts() ) : $loop->the_post(); ?>
  <div class="slider-wrapper" style="background-image: url(<?php the_field("front_slider_img"); ?>);">
    <h1><?php the_title(); ?></h1>

    <div class="entry-content">

      <?php the_content(); ?>
      <a href="<?php the_field('front_slider_link');?>">Click</a>
    </div>
  </div>



  <?php endwhile; ?>

<?php get_footer(); ?>
