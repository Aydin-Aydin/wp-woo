<?php

/*  Register Scripts and Style */
/*  Register Scripts and Style */
function theme_register_scripts() {

  wp_enqueue_script( 'woo-base-js', esc_url( trailingslashit( get_template_directory_uri() ) . 'js/woo-base.min.js' ), array( 'jquery' ), '1.0', true );
  wp_enqueue_script( 'imgLiquid-js', esc_url( trailingslashit( get_template_directory_uri() ) . 'js/imgLiquid.min.js' ), array( 'jquery' ));
  wp_enqueue_script( 'jquery-matchHeight-js', esc_url( trailingslashit( get_template_directory_uri() ) . 'js/jquery.matchHeight.js' ), array( 'jquery' ));
  wp_enqueue_script( 'rater-js', esc_url( trailingslashit( get_template_directory_uri() ) . 'js/rater.js' ), array( 'jquery' ));
  wp_enqueue_script( 'slick-slider-js', esc_url( trailingslashit( get_template_directory_uri() ) . '/node_modules/slick-carousel/slick/slick.js'), array( 'jquery' ));
  // Stylesheets
  wp_enqueue_style( 'normalize-css', get_stylesheet_directory_uri() . '/node_modules/normalize.css/normalize.css');
  wp_enqueue_style( 'woo-base-css', get_stylesheet_directory_uri() . '/dist/css/style.css');
  wp_enqueue_style( 'slick-1-css', get_stylesheet_directory_uri() . '/node_modules/slick-carousel/slick/slick.css');
  wp_enqueue_style( 'slick-2-css', get_stylesheet_directory_uri() . '/node_modules/slick-carousel/slick/slick-theme.css');

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
  echo '<div class="woo-content primary-wrapper">';
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

            if ( has_post_thumbnail() ) {
                $output = '<div class="imgLiquidFill imgLiquid" style="background-image: url(' . wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail-size', true)[0] . ')">';
                $output .= get_the_post_thumbnail( $post->ID, $size );

            } else {

                $output .= '<img src="'. woocommerce_placeholder_img_src() .'" alt="Placeholder" width="' . $placeholder_width . '" height="' . $placeholder_height . '" />';

            }

            $output .= '</div>';

            return $output;
    }
 }

 // Remove default shop page sorting
 remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

 // Remove sale icon
 add_filter('woocommerce_sale_flash', 'woo_hide_sale_icon');
 function woo_hide_sale_icon() {
    return false;
 }

// Remove add to card link
add_filter('woocommerce_loop_add_to_cart_link', 'woo_hide_add_to_card_link');
 function woo_hide_add_to_card_link() {
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

// Rating system
add_action('woocommerce_after_shop_loop_item', 'get_star_rating' );
function get_star_rating()
{
    global $woocommerce, $product;
    $average = $product->get_average_rating();

    echo '<div class="star-rating"><span data-rating="' . floor($average * 2) / 2 . '"</span></div>';
}


// Move review tab single poroduct page.
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
function woo_remove_product_tabs( $tabs ) {
    unset( $tabs['reviews'] );  // Removes the reviews tab
    unset( $tabs['description'] );  // Removes the additional information tab
    return $tabs;
}

// Move single product reviews to under images.
add_action( 'woocommerce_after_single_product', 'comments_template', 50 );
function woocommerce_template_product_reviews() {
woocommerce_get_template( 'single-product-reviews.php' );
}

// Move single product related 
add_action( 'woocommerce_before_main_content', 'wpa_115808' );
function wpa_115808(){
   remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
   add_action( 'woocommerce_after_single_product', 'woocommerce_output_related_products' );
}
// End woocommerce hooks

// Start Advanced custom fields
if(function_exists("register_field_group"))
{
  register_field_group(array (
    'id' => 'acf_front-page',
    'title' => 'Front page',
    'fields' => array (
      array (
        'key' => 'field_5824e7aa9780f',
        'label' => 'Link',
        'name' => 'front_slider_link',
        'type' => 'page_link',
        'post_type' => array (
          0 => 'all',
        ),
        'allow_null' => 0,
        'multiple' => 0,
      ),
      array (
        'key' => 'field_58259e2ef75b6',
        'label' => 'Image',
        'name' => 'front_slider_img',
        'type' => 'image',
        'save_format' => 'url',
        'preview_size' => 'large',
        'library' => 'all',
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'slider',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'normal',
      'layout' => 'default',
      'hide_on_screen' => array (
        0 => 'custom_fields',
        1 => 'comments',
        2 => 'featured_image',
      ),
    ),
    'menu_order' => 0,
  ));
}// End advanced custom fields


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
        'name' => 'Top Rated Products',
        'id' => 'top-rated',
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


// Custom fields
if(function_exists("register_field_group"))
{
    register_field_group(array (
        'id' => 'acf_front-page',
        'title' => 'Front page',
        'fields' => array (
            array (
                'key' => 'field_5824e7aa9780f',
                'label' => 'Link',
                'name' => 'front_slider_link',
                'type' => 'page_link',
                'post_type' => array (
                    0 => 'all',
                ),
                'allow_null' => 0,
                'multiple' => 0,
            ),
            array (
                'key' => 'field_58259e2ef75b6',
                'label' => 'Image',
                'name' => 'front_slider_img',
                'type' => 'image',
                'save_format' => 'url',
                'preview_size' => 'large',
                'library' => 'all',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'slider',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'default',
            'hide_on_screen' => array (
                0 => 'custom_fields',
                1 => 'comments',
                2 => 'featured_image',
            ),
        ),
        'menu_order' => 0,
    ));
}
