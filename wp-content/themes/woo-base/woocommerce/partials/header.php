<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title><?php if(is_home()) bloginfo('name'); else wp_title(''); ?></title>
  <?php wp_head(); ?>
  <meta name="viewport" content="width=device-width">
</head>
<body <?php body_class(); ?>>

<header>
<!-- Define Bootstrap navwalker -->
<?php
  wp_nav_menu( array(
      'menu'              => 'primary',
      'theme_location'    => 'primary',
      'depth'             => 2,
      'container'         => 'nav',
      'container_class'   => 'main-menu',
      'container_id'      => 'main-menu',
      // 'menu_class'        => 'nav navbar-nav',
      'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
      'walker'            => new wp_bootstrap_navwalker())
  );
?>
</header>
        
        

        
     	
       
