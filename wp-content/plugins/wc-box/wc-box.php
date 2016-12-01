<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://iamniloy.com
 * @since             1.0.0
 * @package           Wc_Box
 *
 * @wordpress-plugin
 * Plugin Name:       WCBox - Product Slider/carsouel Plugin For Woocommerce
 * Plugin URI:        http://codecanyon.net/item/wcbox-woocommerce-plugin/13273548?ref=NiloySarker
 * Description:       Wcbox is a Product Slider Plugin for woocommerce.
 * Version:           1.1
 * Author:            Niloy Sarker
 * Author URI:        http://iamniloy.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wc-box
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
	 if ( ! in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) )  ){
	add_action( 'admin_notices', 'woocommerce_inactive_notice'  );
	return;
	}
	
	function woocommerce_inactive_notice() {
		if ( current_user_can( 'activate_plugins' ) ) :
			if ( !class_exists( 'WooCommerce' ) ) :
				?>
				<div id="message" class="error">
					<p>
						<?php
						printf(
							__( '%s WCBox needs WooCommerce%s %sWooCommerce%s must be active for WCBox Plugin to work. Please install & activate WooCommerce.', 'wc-box' ),
							'<strong>',
							'</strong><br>',
							'<a href="http://wordpress.org/extend/plugins/woocommerce/" target="_blank" >',
							'</a>'
						);
						?>
					</p>
				</div>		
				<?php
			endif;
		endif;
	}
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wc-box-activator.php
 */
function activate_wc_box() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wc-box-activator.php';
	Wc_Box_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wc-box-deactivator.php
 */
function deactivate_wc_box() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wc-box-deactivator.php';
	Wc_Box_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wc_box' );
register_deactivation_hook( __FILE__, 'deactivate_wc_box' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wc-box.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wc_box() {

	$plugin = new Wc_Box();
	$plugin->run();
	

}
run_wc_box();


	


	
/**
 * Woocomarce Product View Counter
 */
function wcbox_product_view($postID) {
$count_key = 'post_views_count';
$count = get_post_meta($postID, $count_key, true);
if($count==''){
$count = 0;
delete_post_meta($postID, $count_key);
add_post_meta($postID, $count_key, '0');
}else{
$count++;
update_post_meta($postID, $count_key, $count);
}

}
/**
 * Woocomarce Product View Counter echo
 */
function get_wcbox_view(){
	wcbox_product_view(get_the_ID());
};

/**
 *  Add Product View Counter in Single Product
 */

add_action( 'woocommerce_single_product_summary',  'get_wcbox_view' );


	/**
	 * Register the JS & CSS for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	// wcbox_enqueue_styles 
	function wcbox_enqueue_styles() {
		wp_enqueue_style( 'animate', plugin_dir_url( __FILE__ ) . 'assets/css/animate.min.css', array(),  'all' );
		wp_enqueue_style( 'font-awesome', plugin_dir_url( __FILE__ ) . 'assets/css/font-awesome.min.css', array(),  'all' );
		wp_enqueue_style( 'turbotabs', plugin_dir_url( __FILE__ ) . 'assets/css/turbotabs.css', array(),  'all' );
		wp_enqueue_style( 'owl-carousel', plugin_dir_url( __FILE__ ) . 'assets/css/owl.carousel.css', array(),  'all' );
		wp_enqueue_style( 'ezmodal-css', plugin_dir_url( __FILE__ ) . 'assets/css/ezmodal.min.css', array(),  'all' );
		 global $woocommerce;
		 wp_enqueue_style( 'wcbox_prettyPhoto_css', $woocommerce->plugin_url() . '/assets/css/prettyPhoto.css' );
		 wp_enqueue_style( 'public-css', plugin_dir_url( __FILE__ ) . 'assets/css/wc-box-public.css', array(),  'all' );

	}
	// wcbox_enqueue_scripts
	function wcbox_enqueue_scripts() {
		global $woocommerce;
		wp_enqueue_script('jquery');
		
		 wp_enqueue_script( 'wcbox_prettyPhoto', $woocommerce->plugin_url( __FILE__ ) . '/assets/js/prettyPhoto/jquery.prettyPhoto.js', array( 'jquery' ), $woocommerce->version, false );
		 wp_enqueue_script( 'wcbox_prettyPhoto-init', $woocommerce->plugin_url( __FILE__ ) . '/assets/js/prettyPhoto/jquery.prettyPhoto.init.js', array( 'jquery' ), $woocommerce->version, false );
		wp_enqueue_script( 'owl-carousel', plugin_dir_url( __FILE__ ) . 'assets/js/owl.carousel.min.js', array( 'jquery' ),  false );
		wp_enqueue_script( 'turbotabs', plugin_dir_url( __FILE__ ) . 'assets/js/turbotabs.js', array( 'jquery' ),  false );
		wp_enqueue_script( 'public-js', plugin_dir_url( __FILE__ ) . 'assets/js/wc-box-public.js', array( 'jquery' ),  false );
		wp_enqueue_script( 'ezmodal', plugin_dir_url( __FILE__ ) . 'assets/js/ezmodal.min.js', array( 'jquery' ),  false );
		 wp_enqueue_script( 'modernizr.custom', plugin_dir_url( __FILE__ ) . 'assets/js/modernizr.custom.js', array( 'jquery' ),  false );
		

	}
	
	// wcbox_quick_view_class_before
	function wcbox_quick_view_class_before() {
		echo '<div class="wcbox_quick_view">';
	}
	// wcbox_quick_view_class_after
	function wcbox_quick_view_class_after() {
		echo '</div>';
	}
	// Register wcbox_post_type
	function wcbox_post_type() {

		$labels = array(
			'name'                => _x( 'Sliders', 'Post Type General Name', 'wcbox' ),
			'singular_name'       => _x( 'Slider', 'Post Type Singular Name', 'wcbox' ),
			'menu_name'           => __( ' Wcbox', 'wcbox' ),
			'name_admin_bar'      => __( ' Wcbox', 'wcbox' ),
			'parent_item_colon'   => __( 'Parent Product Slider', 'wcbox' ),
			'all_items'           => __( 'All Product Sliders', 'wcbox' ),
			'add_new_item'        => __( 'Add New Product Slider', 'wcbox' ),
			'add_new'             => __( 'Add Product Slider', 'wcbox' ),
			'new_item'            => __( 'New Product Slider', 'wcbox' ),
			'edit_item'           => __( 'Edit Product Slider', 'wcbox' ),
			'update_item'         => __( 'Update Product Slider', 'wcbox' ),
			'view_item'           => __( 'View Product Slider', 'wcbox' ),
			'search_items'        => __( 'Search Product Slider', 'wcbox' ),
			'not_found'           => __( 'Not found', 'wcbox' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'wcbox' ),
		);
		$args = array(
			'label'               => __( 'Slider', 'wcbox' ),
			'labels'              => $labels,
			'supports'            => array( 'title','custom-fields', ),
			'hierarchical'        => false,
			'rewrite' => array( 'slug' => 'wcbox' ),
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 25,
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,		
			'exclude_from_search' => true,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
		);
		register_post_type( 'wcbox', $args );

	}

 // wcbox_quick_view_up
function wcbox_quick_view_up(){
	?>
        <div id="quick_view_modal" class="ezmodal ">
            <div class="ezmodal-container" >
                
					<div class="woocommerce woocommerce-page">
					<div class="ezmodal-content product"></div>
					</div>
					<div class="ezmodal-footer">
						<span data-dismiss="ezmodal" class="fa fa-close"></span>       			
					</div>
				
			</div>
        </div>
	<?php
}



// custom_enter_title
function custom_enter_title( $input ) {
    global $post_type;

    if ( 'wcbox' == $post_type )
        return __( 'Enter Slider Name', 'wcbox' );

    return $input;
}

// wcbopx_edit_form_after_title
function wcbopx_edit_form_after_title() {
	 global $post;
        if($post->post_type == 'wcbox'){
		?>			 
			<label for="wcbox_dynamic_code"><i style="margin-top:10px;display: inline-block;">WCBox Slider Shortcode</i></label><br />
			<input type="text" readonly id="wcbox_dynamic_code" onfocus="this.select();" name="wcbox_dynamic_code" value="[wcbox_slider id='<?php echo get_the_id(); ?>']" size="40" style=" background: rgba(0, 0, 0, 0.0);box-shadow: 0 0 0 0;border: 0px;padding: 3px;font-size: 13px;letter-spacing: 1px;" />
			<style type="text/css">
				div#edit-slug-box {
				display: none;
				}
			</style>
		<?php	
				}
			    
		}
//  wcbox_remove_quick_edit
function wcbox_remove_quick_edit( $actions ) {
	global $post;
    if( $post->post_type == 'wcbox' ) {
		unset($actions['inline hide-if-no-js']);
        unset( $actions['view'] );
	}
    return $actions;
}
 //  wcbox_single_template
function wcbox_single_template( $template ){

    /* 
     * Optional: Have a plug-in option to disable template handling
     * if( get_option('wpse72544_disable_template_handling') )
     *     return $template;
     */

    if(is_singular('wcbox')){
        //WordPress couldn't find an 'event' template. Use plug-in instead:
		$plugindir = dirname( __FILE__ );
        $template = $plugindir . '/public/single-wcbox.php' ;
    }

    return $template;
}

 // wcbox_Shortcode_columns_ot
function  wcbox_Shortcode_columns_ot ( $columns ) {
	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Slider Name' ),
		'wcbox_Shortcode' => __( 'Shortcode' ),
		'date' => __( 'Date' )
	);
	return $columns;
}
 // wcbox_Shortcode_columns
function wcbox_Shortcode_columns($column)
{	global $post;	
	$slider_id = $post->ID;
	switch ($column)
	{
		case "wcbox_Shortcode":
		?><input type="text" readonly id="wcbox_dynamic_code" onfocus="this.select();" name="wcbox_dynamic_code" value="[wcbox_slider id='<?php echo $slider_id; ?>']" size="40" style=" background: rgba(0, 0, 0, 0.0);box-shadow: 0 0 0 0;border: 0px;padding: 3px;font-size: 13px;letter-spacing: 1px;" />
		<?php
		break;			
	}
}



add_action( 'wp_enqueue_scripts', 'wcbox_enqueue_styles' ); // wcbox_enqueue_styles
add_action( 'wp_enqueue_scripts','wcbox_enqueue_scripts' ); // wcbox_enqueue_scripts
add_action( 'woocommerce_before_single_product_summary', 'wcbox_quick_view_class_before', 10 );  // wcbox_quick_view_class_before
add_action( 'woocommerce_after_single_product_summary', 'wcbox_quick_view_class_after', 5 ); // wcbox_quick_view_class_after
add_action( 'init', 'wcbox_post_type', 0 ); // wcbox_post_type
add_action('wp_footer','wcbox_quick_view_up'); // wcbox_quick_view_up
add_action( 'edit_form_after_title', 'wcbopx_edit_form_after_title' ); // wcbopx_edit_form_after_title
add_action("manage_posts_custom_column",  "wcbox_Shortcode_columns"); // wcbox_Shortcode_columns

add_filter( 'manage_edit-wcbox_columns', 'wcbox_Shortcode_columns_ot' ) ; // wcbox_Shortcode_columns_ot
add_filter( 'enter_title_here', 'custom_enter_title' ); // custom_enter_title
add_filter('widget_text', 'do_shortcode'); /* Allow shortcodes in widget areas */
add_filter('template_include', 'wcbox_single_template'); //  wcbox_single_template
if (is_admin()) {
	add_filter('post_row_actions','wcbox_remove_quick_edit',10,2); //  wcbox_remove_quick_edit
}


require_once plugin_dir_path( __FILE__ ) . 'public/shortcode/wcbox_shortcode.php';
require_once plugin_dir_path( __FILE__ ) . 'functions.php';






/*=========================================
         Custom Submit Box
  ==========================================*/   
      function wcbox_replace_meta_box() 
      {
         
          
          // now loop through $items array and remove, then

             remove_meta_box('submitdiv', 'wcbox' , 'core'); // $item represents post_type
             add_meta_box('submitdiv', 'Status', 'wcbox_submit_meta_box', 'wcbox', 'side', 'low'); // $value will be the output title in the box
          
      }
      add_action( 'admin_menu', 'wcbox_replace_meta_box' );
 
      /**
      * Custom edit of default wordpress publish box callback
      * loop through each custom post type and remove default
      * submit box, replacing it with custom one that has
      * only submit button with custom text on it (add/update)
      *
      * @global $action, $post
      * @see wordpress/includes/metaboxes.php
      * @since  1.0
      *
      */ 
      function wcbox_submit_meta_box() {
        global $action, $post;
       
        $post_type = $post->post_type; // get current post_type
        $post_type_object = get_post_type_object($post_type);
        $can_publish = current_user_can($post_type_object->cap->publish_posts);
        // again, use the same array. It is important
        // to put it in same order, so that it can
        // follow the right meta box
        $items = array( 
           'wcbox' => 'wcbox'
        );
        // now create var $item that will take only right
        // post_type information for currently displayed
        // post_type. Because $post_type var will store
        // only current post_type, it will correspond to
        // the appropriate 'key' from the $items array.
        // This $item will hold only the string name of 
        // the post_type which will be used further in context
        // on appropriate places.
        $item = $items[$post_type];
        ?>
        <div class="submitbox" id="submitpost">
         <div id="major-publishing-actions">
         <?php
         do_action( 'post_submitbox_start' );
         ?>

         <div id="publishing-action">
         <span class="spinner"></span>
         <?php
         if ( !in_array( $post->post_status, array('publish', 'future', 'private') ) || 0 == $post->ID ) {
              if ( $can_publish ) : ?>
                <input name="original_publish" type="hidden" id="original_publish" value="<?php esc_attr_e('Add Tab') ?>" />
                <?php submit_button( sprintf( __( 'Add %' ), $item ), 'primary button-large', 'publish', false, array( 'accesskey' => 'p' ) ); ?>
         <?php   
              endif; 
         } else { ?>
                <input name="original_publish" type="hidden" id="original_publish" value="<?php esc_attr_e('Update ') . $item; ?>" />
                <input name="save" type="submit" class="button button-primary button-large" id="publish" accesskey="p" value="<?php esc_attr_e('Update ') . $item; ?>" />
         <?php
         } //if ?>
         </div>
         <div class="clear"></div>
         </div>
         </div>
        <?php
      } // submit_meta_box()
     




// Vafpress Conditional Fileds
VP_Security::instance()->whitelist_function('vp_dep_is_query');

function vp_dep_is_query($value)
{
	if($value === 'query')
		return true;
	return false;
}


VP_Security::instance()->whitelist_function('vp_dep_is_categories');

function vp_dep_is_categories($value)
{
	if($value === 'category')
		return true;
	return false;
}


VP_Security::instance()->whitelist_function('vp_dep_is_tags');

function vp_dep_is_tags($value)
{
	if($value === 'tags')
		return true;
	return false;
}

VP_Security::instance()->whitelist_function('vp_dep_is_spacific_products');

function vp_dep_is_spacific_products($value)
{
	if($value === 'specific_id')
		return true;
	return false;
}


VP_Security::instance()->whitelist_function('vp_dep_is_widget_en');

function vp_dep_is_widget_en($value)
{
	if($value === 'yes')
		return true;
	return false;
}
