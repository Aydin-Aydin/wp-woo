<?php get_header(); ?>
<<<<<<< HEAD
	<?php get_sidebar('sidebar-first'); ?>
<section class="primary-wrapper">
  <div class="slider-wrapper woo-main-content">
    <?php
      $args = ['post_type' => 'slider'];
      $loop = new WP_Query( $args );

      while ( $loop->have_posts() ) : $loop->the_post();
    ?>
      <div class="slider-content" style="background-image: url(<?php the_field("front_slider_img"); ?>);">
        <div class="overlay-filter">
          <div class="entry-content">
            <div class="overlay">

              <h1><?php the_title(); ?></h1>
              <?php the_content(); ?>
              <a href="<?php the_field('front_slider_link');?>">Click</a>

            </div>
          </div>
        </div>
      </div>



    <?php endwhile; ?>
  </div>

  <div class="front-widget">
    <?php dynamic_sidebar( 'top-rated' ); ?>
  </div>
</section>
=======
  <?php get_sidebar('sidebar-first'); ?>

<div class="slider-wrapper woo-content"> 
  <?php if (is_front_page()): ?>
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
  <?php endif ?>
<?php if (have_posts): ?>
  <?php while (have_posts()): the_post(); ?>
    <?php the_content(); ?>
    <?php endwhile; ?>
<?php endif ?>
</div><!-- end slider-wrapper woo-content -->
>>>>>>> mohamad
<?php get_footer(); ?>
