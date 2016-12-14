<?php get_header(); ?>
	<?php get_sidebar('sidebar-first'); ?>
<section class="primary-wrapper">

    <?php if (is_front_page()):

      $page = get_posts(
        array(
          'name'      => 'home',
          'post_type' => 'page'
        )
      );

      if ( $page )
        {?>

            <div class="home-post" style="background-image: url(<?php the_field("front_post_img"); ?>);">
              <div class="post-content">

                <h1><?php bloginfo('name'); ?></h1>

                <?php echo $page[0]->post_content ?>

              </div>
            </div>

        <?php }
    ?>
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

          <a class="take-me-down" href="#content-top"></a>

        </div>

      <?php endwhile; ?>
    </div><!-- end slider-wrapper woo-main-content -->

    <div id="content-top" class="front-widget brand-widget">
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
