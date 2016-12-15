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
	<div class="container">
    <div id="mobilNavWrap">
      <nav class="mobil-nav">
        <?php dynamic_sidebar( 'sidebar-first' ); ?>
      </nav>

      <div class="mobil-nav-header">
        <div class="toggle-mobil-nav">
          <span></span>
          <span></span>
          <span></span>
          <span></span>
        </div>

        <div class="cart">
          <a class="cart-icon cart-contents" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>"><?php echo sprintf ( _n( '%d', '%d', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?></a>
        </div>
      </div>
  </div>







