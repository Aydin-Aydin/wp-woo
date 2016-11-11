<?php

/*  Register Scripts and Style */
/*  Register Scripts and Style */
function theme_register_scripts() {
    wp_enqueue_style( 'woo-base-css', get_stylesheet_directory_uri() . '/css/style.css');
    wp_enqueue_script( 'woo-base-js', esc_url( trailingslashit( get_template_directory_uri() ) . 'js/woo-base.min.js' ), array( 'jquery' ), '1.0', true );

    wp_enqueue_script( 'main-js', esc_url( trailingslashit( get_template_directory_uri() ) . 'lib/main.js' ));

}
add_action( 'wp_enqueue_scripts', 'theme_register_scripts', 1 );

//Add woocommerce theme support
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);


// Start of wowcommerce
add_action('woocommerce_before_main_content', 'wp_woo_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'wp_woo_wrapper_end', 10);

function wp_woo_wrapper_start() {
  echo '<div class="woo-content">';
}

function wp_woo_wrapper_end() {
  echo '</div>';
}

add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}


// Remove each style one by one
add_filter( 'woocommerce_enqueue_styles', 'jk_dequeue_styles' );
function jk_dequeue_styles( $enqueue_styles ) {
    unset( $enqueue_styles['woocommerce-general'] );    // Remove the gloss
    unset( $enqueue_styles['woocommerce-layout'] );     // Remove the layout
    unset( $enqueue_styles['woocommerce-smallscreen'] );    // Remove the smallscreen optimisation
    return $enqueue_styles;
}

// Or just remove them all in one line
add_filter( 'woocommerce_enqueue_styles', '__return_false' );
// End of wowcommerce


/* Add menu support */
if (function_exists('add_theme_support')) {
    add_theme_support('menus');
}

/* Add menu support */
if (function_exists('add_theme_support')) {
    add_theme_support('menus');
    register_nav_menus([
      'primary' => __('Primary Menu'),
      'footer' => __('Footer Menu'),
    ]);
}

/* Add post image support */
add_theme_support( 'post-thumbnails' );


/* Add custom thumbnail sizes */
if ( function_exists( 'add_image_size' ) ) {
    //add_image_size( 'custom-image-size', 500, 500, true );
}

/* Add widget support */
if ( function_exists('register_sidebar') )
    register_sidebar(array(
        'name' => 'sidebar-first',
        'id' => 'sidebar-first',
	    'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widgettitle">',
        'after_title' => '</h4>',
    ));
    
if ( function_exists('register_sidebar') )
    register_sidebar(array(
        'name' => 'sidebar-second',
        'id' => 'sidebar-second',
        'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widgettitle">',
        'after_title' => '</h4>',
    ));



/*  EXCERPT 
    Usage:
    
    <?php echo excerpt(100); ?>
*/

function excerpt($limit) {
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
    } else {
    $excerpt = implode(" ",$excerpt);
    } 
    $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
    return $excerpt;
}
