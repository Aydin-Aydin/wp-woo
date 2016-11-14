<?php

/*  Register Scripts and Style */
/*  Register Scripts and Style */
function theme_register_scripts() {
    wp_enqueue_script( 'woo-base-js', esc_url( trailingslashit( get_template_directory_uri() ) . 'js/woo-base.min.js' ), array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'imgLiquid-js', esc_url( trailingslashit( get_template_directory_uri() ) . 'js/imgLiquid.min.js' ), array( 'jquery' ));
    wp_enqueue_script( 'jquery-matchHeight-js', esc_url( trailingslashit( get_template_directory_uri() ) . 'js/jquery.matchHeight.js' ), array( 'jquery' ));
    wp_enqueue_style( 'normalize-css', get_stylesheet_directory_uri() . '/node_modules/normalize.css/normalize.css');
    wp_enqueue_style( 'woo-base-css', get_stylesheet_directory_uri() . '/dist/css/style.css');

    //wp_enqueue_script( 'main-js', esc_url( trailingslashit( get_template_directory_uri() ) . 'lib/main.js' ));

}
add_action( 'wp_enqueue_scripts', 'theme_register_scripts', 1 );

// Start woocommerce hooks
// Remove woocommerce original content wrapper
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);


// Add costum content wrapper
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

remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
/**
 * WooCommerce Loop Product Thumbs
 **/
 if ( ! function_exists( 'woocommerce_template_loop_product_thumbnail' ) ) {
    function woocommerce_template_loop_product_thumbnail() {
        echo woocommerce_get_product_thumbnail();
    } 
 }

/**
 * WooCommerce Product Thumbnail
 **/
 if ( ! function_exists( 'woocommerce_get_product_thumbnail' ) ) {
    
    function woocommerce_get_product_thumbnail( $size = 'shop_catalog', $placeholder_width = 0, $placeholder_height = 0  ) {
        global $post, $woocommerce;
        // if ( ! $placeholder_width )
        //     $placeholder_width = $woocommerce->get_image_size( 'shop_catalog_image_width' );
        // if ( ! $placeholder_height )
        //     $placeholder_height = $woocommerce->get_image_size( 'shop_catalog_image_height' );
            
            $output = '<div class="imgLiquidFill imgLiquid">';
            if ( has_post_thumbnail() ) {
                
                $output .= get_the_post_thumbnail( $post->ID, $size ); 
                
            } else {
            
                $output .= '<img src="'. woocommerce_placeholder_img_src() .'" alt="Placeholder" width="' . $placeholder_width . '" height="' . $placeholder_height . '" />';
            
            }
            
            $output .= '</div>';
            
            return $output;
    }
 }

 // Remove sale icon

 add_filter('woocommerce_sale_flash', 'woo_hide_sale_icon');
 function woo_hide_sale_icon() {
    return false;
 }

// Wrap product details that located in shop page in a div
 add_action('woocommerce_before_shop_loop_item_title', 'product_teaser_text_wrapper_start', 10);
 add_action('woocommerce_after_shop_loop_item','product_teaser_text_wrapper_end', 10);
function product_teaser_text_wrapper_start() {
    echo '<div class="text-wrapper">';
}

function product_teaser_text_wrapper_end() {
    echo '</div>';
}
// End woocommerce hooks


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

if ( function_exists('register_sidebar') )
    register_sidebar(array(
        'name' => 'woo-products',
        'id' => 'woo-products',
        'before_widget' => '<section id="%1$s" class="wdg-product %2$s">',
        'after_widget' => '</section>',
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

// Custom Post Type (Front Page)

function slider_post_type() {
    $labels = [
        'name' => 'Slider',
        'singular_name' => 'Slider',
        'add_new' => 'Add Item',
        'all_item' => 'All Item',
        'edit_item' => 'Edit Item',
        'new_item' => 'New Item',
        'view_item' => 'View Item',
        'search_item' => 'Search Referens',
        'not_found' => 'No item found',
        'not_found_in_trash' => 'No item found in trash',
        'parent_item_colon' => 'Parent Item'
    ];
    $args = [
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'publicly_queryable' => true,
        'query-var' => true,
        'rewrite' => true,
        'hierarchical' => true,
        'supports' => [
            'title',
            'editor',
            'thumbnail',
            'revisions',
        ],
        'taxonomies' => ['category', 'post_tag'],
        'menu_position' => 4,
        'execlude_from_search' => false
    ];
    register_post_type('slider',$args);
}
add_action('init','slider_post_type');



