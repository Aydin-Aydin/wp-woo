<?php
/*
Template Name: Page Template
*/
?>

<?php get_header(); ?>
  <?php get_sidebar('sidebar-first'); ?>

  <section class="primary-wrapper">
    <div class="page-wrapper">

      <?php if(have_posts()): while(have_posts()): the_post() ?>

          <h1><?php the_title(); ?></h1>

          <?php the_content(); ?>

      <?php endwhile; endif; ?>

    </div>
  </section>

  <?php get_sidebar(); ?>
<?php get_footer(); ?>
