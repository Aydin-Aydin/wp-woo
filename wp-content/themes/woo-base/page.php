<?php get_header(); ?>
	<?php get_sidebar('sidebar-first'); ?>
<div class="slider-wrapper woo-content ">
  <?php
    $args = ['post_type' => 'slider'];
    $loop = new WP_Query( $args );

    while ( $loop->have_posts() ) : $loop->the_post();
  ?>
    <div class="slider-content" style="background-image: url(<?php the_field("front_slider_img"); ?>);">
      <div class="entry-content">
        <div class="overlay">

          <h1><?php the_title(); ?></h1>
          <?php the_content(); ?>
          <a href="<?php the_field('front_slider_link');?>">Click</a>

        </div>
      </div>
    </div>



  <?php endwhile; ?>
</div>

<?php get_footer(); ?>
