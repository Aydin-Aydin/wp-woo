<?php get_header(); ?>
	<?php get_sidebar('sidebar-first'); ?>
<section class="primary-wrapper">

  <?php if (is_front_page()): ?>
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

<<<<<<< HEAD
<<<<<<< HEAD
          <a id="takeMeDown" href="#frontWidgetBrands" title="Take Me Down"></a>
=======
          <a class="take-me-down" href="#content-top"></a>

>>>>>>> 71511c4e17f3df54582e3799817cd4a391d3b427
=======
          <a id="takeMeDown" href="#scroll2" title="Take Me Down"></a>
>>>>>>> sergio
        </div>

      <?php endwhile; ?>
    </div><!-- end slider-wrapper woo-main-content -->


<<<<<<< HEAD
<<<<<<< HEAD
    <div class="front-widget brand-widget" id="frontWidgetBrands">
=======
    <div id="content-top" class="front-widget brand-widget">
>>>>>>> 71511c4e17f3df54582e3799817cd4a391d3b427
=======
    <div class="front-widget brand-widget">
>>>>>>> sergio
      <?php dynamic_sidebar( 'top-brands' ); ?>
    </div>

    <div class="front-widget rated-widget" id="scroll2">
      <?php dynamic_sidebar( 'top-rated' ); ?>
    </div>

    <div class="latest-products">
      <?php dynamic_sidebar( 'latest-products' ); ?>
    </div>

  <?php endif; ?>

</section>
<?php get_footer(); ?>
