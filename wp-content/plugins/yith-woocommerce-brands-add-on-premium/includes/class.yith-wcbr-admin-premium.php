<?php
/**
 * Admin Premium class
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Brands Add-on
 * @version 1.0.0
 */

/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'YITH_WCBR' ) ) {
	exit;
} // Exit if accessed directly

if ( ! class_exists( 'YITH_WCBR_Admin_Premium' ) ) {
	/**
	 * WooCommerce Brands Admin
	 *
	 * @since 1.0.0
	 */
	class YITH_WCBR_Admin_Premium extends YITH_WCBR_Admin {
		/**
		 * Single instance of the class
		 *
		 * @var \YITH_WCBR_Admin_Premium
		 * @since 1.0.0
		 */
		protected static $instance;

		/**
		 * Constructor method
		 *
		 * @return \YITH_WCBR_Admin_Premium
		 * @since 1.0.0
		 */
		public function __construct() {
			parent::__construct();

			// remove premium tab
			unset( $this->available_tabs['premium'] );

			// register premium settings
			add_filter( 'yith_wcbr_general_settings', array( $this, 'filter_setting_options' ) );
			add_action( 'woocommerce_admin_field_yith_wcbr_upload_image', array( $this, 'print_image_upload_field' ), 10, 1 );
			add_action( 'woocommerce_admin_field_yith_wcbr_image_size', array( $this, 'print_image_size_field' ), 10, 1 );

			// import/export handling
			add_action( 'add_tag_form', array( $this, 'add_import_link' ) );
			add_action( 'admin_footer', array( $this, 'add_export_action' ) );
			add_action( 'admin_init', array( $this, 'export_csv' ) );
			add_action( 'admin_init', array( $this, 'register_csv_importer' ) );

			// register plugin to licence/update system
			add_action( 'wp_loaded', array( $this, 'register_plugin_for_activation' ), 99 );
			add_action( 'admin_init', array( $this, 'register_plugin_for_updates' ) );
		}

		/**
		 * Enqueue plugin admin styles when required
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function enqueue() {
			$screen = get_current_screen();

			parent::enqueue();

			if( $screen->id == 'edit-' . YITH_WCBR::$brands_taxonomy ){
				wp_enqueue_style( 'yith-wcbr-admin', YITH_WCBR_URL . 'assets/css/admin/yith-wcbr.css' );
			}
		}

		/* === PLUGIN PANEL METHODS === */

		/**
		 * Adds premium option to plugin panel
		 *
		 * @param $options mixed Original options array
		 *
		 * @return mixed FIltered option array
		 * @since 1.0.0
		 */
		public function filter_setting_options( $options ) {
			$section_start = array_splice( $options['settings'], 0, 1 );
			$section_end = array_splice( $options['settings'], -1, 1 );

			$product_taxonomies = array();
			$product_taxonomies_raw = get_object_taxonomies( 'product', 'objects' );
			$excluded_product_taxonomies = array(
				'product_type',
				'product_shipping_class',
				'yith_product_brand'
			);

			if( ! empty( $product_taxonomies_raw ) ){
				foreach( $product_taxonomies_raw as $taxonomy_slug => $taxonomy ){
					if( in_array( $taxonomy_slug, $excluded_product_taxonomies ) ){
						continue;
					}

					$product_taxonomies[ $taxonomy_slug ] = $taxonomy->label;
				}
			}

			$premium_options_chunck_1 = array(
				'general-brand-taxonomy' => array(
					'id'        => 'yith_wcbr_brands_taxonomy',
					'name'      => __( 'Product brand taxonomy', 'yith-wcbr' ),
					'type'      => 'select',
					'options'   => array_merge(
						array(
							'yith_product_brand' => __( 'Default brand taxonomy', 'yith-wcbr' )
						),
						$product_taxonomies
					),
					'desc'      => __( 'Select the taxonomy whose terms will be used as brands; not all taxonomies support all plugin features, so if you change this option it is at your own risk', 'yith-wcbr' ),
					'class'     => 'wc-enhanced-select',
					'default'   => 'yith_product_brand',
					'css'       => 'max-width:300px;'
				)
			);

			$premium_options_chunck_2 = array(
				'general-brand-single-product-position' => array(
					'id'        => 'yith_wcbr_single_product_brands_position',
					'name'      => __( 'Single product brand position', 'yith-wcbr' ),
					'type'      => 'select',
					'options'   => array(
						'none' => __( 'Hide on single product page', 'yith-wcbr' ),
						'woocommerce_template_before_single_title' => __( 'Before product title', 'yith-wcbr' ),
						'woocommerce_template_single_title' => __( 'After product title', 'yith-wcbr' ),
						'woocommerce_template_single_price' => __( 'After product price', 'yith-wcbr' ),
						'woocommerce_template_single_excerpt' => __( 'After product excerpt', 'yith-wcbr' ),
						'woocommerce_template_single_add_to_cart' => __( 'After single Add to Cart', 'yith-wcbr' ),
						'woocommerce_product_meta_end' => __( 'After product meta', 'yith-wcbr' ),
						'woocommerce_template_single_sharing' => __( 'After product share', 'yith-wcbr' )
					),
					'desc'      => __( 'Position for brand list', 'yith-wcbr' ),
					'default'   => 'woocommerce_template_single_meta',
					'css'       => 'min-width:300px;'
				),
				'general-brand-single-product-content' => array(
					'id'        => 'yith_wcbr_single_product_brands_content',
					'name'      => __( 'Single product brand content', 'yith-wcbr' ),
					'type'      => 'select',
					'options'   => array(
						'both' => __( 'Both name and logo', 'yith-wcbr' ),
						'logo' => __( 'Only logo', 'yith-wcbr' ),
						'name' => __( 'Only name', 'yith-wcbr' )
					),
					'desc'      => __( 'Content to show for brands in single product page', 'yith-wcbr' ),
					'default'   => 'both',
					'css'       => 'min-width:300px;'
				),
				'general-brand-single-product-size' => array(
					'id'        => 'yith_wcbr_single_product_brands_size',
					'name'      => __( 'Standard size of brand images in product page', 'yith-wcbr' ),
					'type'      => 'yith_wcbr_image_size',
					'desc'      => __( 'This is the size of images that will be used as brand thumbnails in single product page', 'yith-wcbr' ),
					'default'   => array(
						'width'  => apply_filters( 'yith_wcbr_single_thumb_width', 0 ),
						'height' => apply_filters( 'yith_wcbr_single_thumb_width', 30 ),
						'crop'   => apply_filters( 'yith_wcbr_single_thumb_width', true )
					)
				),
				'general-brand-loop-product-position' => array(
					'id'        => 'yith_wcbr_loop_product_brands_position',
					'name'      => __( 'Product brand position in loop page', 'yith-wcbr' ),
					'type'      => 'select',
					'options'   => array(
						'none' => __( 'Hide on loop', 'yith-wcbr' ),
						'woocommerce_template_loop_price' => __( 'After product price', 'yith-wcbr' ),
						'woocommerce_template_loop_add_to_cart' => __( 'After "Add to Cart" in loop', 'yith-wcbr' )
					),
					'desc'      => __( 'Position of brand list', 'yith-wcbr' ),
					'default'   => 'woocommerce_template_loop_price',
					'css'       => 'min-width:300px;'
				),
				'general-brand-loop-product-size' => array(
					'id'        => 'yith_wcbr_loop_product_brands_size',
					'name'      => __( 'Standard size of brand images in shop page', 'yith-wcbr' ),
					'type'      => 'yith_wcbr_image_size',
					'desc'      => __( 'This is the size of images that will be used as brand thumbnails in shop page', 'yith-wcbr' ),
					'default'   => array(
						'width'  => apply_filters( 'yith_wcbr_grid_thumb_width', 0 ),
						'height' => apply_filters( 'yith_wcbr_grid_thumb_height', 60 ),
						'crop'   => apply_filters( 'yith_wcbr_grid_thumb_crop', true )
					)
				),
				'general-brand-loop-product-content' => array(
					'id'        => 'yith_wcbr_loop_product_brands_content',
					'name'      => __( 'Loop product brand content', 'yith-wcbr' ),
					'type'      => 'select',
					'options'   => array(
						'both' => __( 'Both name and logo', 'yith-wcbr' ),
						'logo' => __( 'Only logo', 'yith-wcbr' ),
						'name' => __( 'Only name', 'yith-wcbr' )
					),
					'desc'      => __( 'Content to show for brands in loop page', 'yith-wcbr' ),
					'default'   => 'name',
					'css'       => 'min-width:300px;'
				),
				'general-brand-use-logo-default' => array(
					'id'        => 'yith_wcbr_use_logo_default',
					'name'      => __( 'Use brand default logo', 'yith-wcbr' ),
					'type'      => 'checkbox',
					'desc'      => __( 'Use default image when no logo is selected or not', 'yith-wcbr' ),
					'default'   => 'no',
					'css'       => 'min-width:300px;'
				),
				'general-brand-logo-default' => array(
					'id'        => 'yith_wcbr_logo_default',
					'name'      => __( 'Default logo', 'yith-wcbr' ),
					'type'      => 'yith_wcbr_upload_image',
				)
			);

			$options['settings'] = array_merge( $section_start, $premium_options_chunck_1, $options['settings'], $premium_options_chunck_2, $section_end );

			return $options;
		}

		/**
		 * Print custom upload filed on plugin panel
		 *
		 * @param $value mixed Array of filed options
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function print_image_upload_field( $value ) {
			// define templates for the field
			extract( $value );

			$image_id = get_option( 'yith_wcbr_logo_default' );
			$image = $image_id ? wp_get_attachment_thumb_url( $image_id ) : wc_placeholder_img_src();

			// include field template
			include( YITH_WCBR_DIR . 'templates/admin/fields/upload-image.php' );
		}

		/**
		 * Print custom image size filed on plugin panel
		 *
		 * @param $value mixed Array of filed options
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function print_image_size_field( $value ) {
			// define templates for the field
			extract( $value );
			
			if( ! isset( $default ) ){
				$default = array(
					'width' => 0,
					'height' => 30,
					'crop' => false
				);
			}

			$image_size = get_option( $id, $default );

			// include field template
			include( YITH_WCBR_DIR . 'templates/admin/fields/image-size.php' );
		}

		/* === PLUGIN TAXONOMY METHODS === */

		/**
		 * Prints custom term fields on "Add Brand" page
		 *
		 * @param $term string Current taxonomy id
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function add_brand_taxonomy_fields( $term ) {
			// include basic options
			parent::add_brand_taxonomy_fields( $term );

			// include premium options
			include( YITH_WCBR_DIR . 'templates/admin/add-brand-taxonomy-form-premium.php' );
		}

		/**
		 * Prints custom term fields on "Edit Brand" page
		 *
		 * @param $term string Current taxonomy id
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function edit_brand_taxonomy_fields( $term ) {
			// include basic options
			parent::edit_brand_taxonomy_fields( $term );

			$banner_id = absint( yith_wcbr_get_term_meta( $term->term_id, 'banner_id', true ) );
			$banner = $banner_id ? wp_get_attachment_thumb_url( $banner_id ) : wc_placeholder_img_src();
			$custom_url = yith_wcbr_get_term_meta( $term->term_id, 'custom_url', true );

			// include premium options
			include( YITH_WCBR_DIR . 'templates/admin/edit-brand-taxonomy-form-premium.php' );
		}

		/**
		 * Save custom term fields
		 *
		 * @param $term_id int Currently saved term id
		 * @param $tt_id int Term Taxonomy id
		 * @param $taxonomy string Current taxonomy slug
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function save_brand_taxonomy_fields( $term_id, $tt_id = '', $taxonomy = '' ) {
			parent::save_brand_taxonomy_fields( $term_id, $tt_id, $taxonomy );

			if ( isset( $_POST['product_brand_banner_id'] ) && YITH_WCBR::$brands_taxonomy === $taxonomy ) {
				yith_wcbr_update_term_meta( $term_id, 'banner_id', absint( $_POST['product_brand_banner_id'] ) );
			}

			if ( isset( $_POST['product_brand_custom_url'] ) && YITH_WCBR::$brands_taxonomy === $taxonomy ) {
				yith_wcbr_update_term_meta( $term_id, 'custom_url', esc_url( $_POST['product_brand_custom_url'] ) );
			}
		}

		/* === IMPORT EXPORT METHODS === */

		/**
		 * Print "Import CSV" button in brand taxonomy
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function add_import_link() {
			$screen = get_current_screen();

			if( $screen->id == 'edit-' . YITH_WCBR::$brands_taxonomy ) {
				$action = sprintf( '<p class="import-csv"></p><a href="%s" class="button button-secondary">%s</a></p>', admin_url( 'admin.php?import=yith_wcbr_brand_csv' ), __( 'Import from CSV', 'yith-wcbr' ) );

				echo $action;
			}
		}

		/**
		 * Register wordpress importer
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function register_csv_importer() {
			register_importer( 'yith_wcbr_brand_csv', __( 'YITH Brands (CSV)', 'yith-wcbr' ), __( 'Import <strong>brands</strong> to your store via csv file.', 'yith-wcbr'), array( $this, 'import_csv' ) );
		}

		/**
		 * Print js code used to add bulk action "Export CSV" in add tag screen
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function add_export_action() {
			$screen = get_current_screen();

			if( $screen->id == 'edit-' . YITH_WCBR::$brands_taxonomy ):
				?>

				<script type="text/javascript">
					jQuery(function() {
						jQuery('<option>').val('export_csv').text('<?php _e( 'Export CSV', 'yith-wcbr' )?>').appendTo("select[name='action']");
						jQuery('<option>').val('export_csv').text('<?php _e( 'Export CSV', 'yith-wcbr' )?>').appendTo("select[name='action2']");
					});
				</script>

			<?php
			endif;
		}

		/**
		 * Generate file csv to export brands
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function export_csv() {
			global $pagenow;

			if (
				$pagenow == 'edit-tags.php' &&
				! empty( $_REQUEST['delete_tags'] ) &&
				(
					( isset( $_REQUEST['action'] ) && $_REQUEST['action'] == 'export_csv' ) ||
					( isset( $_REQUEST['action2'] ) && $_REQUEST['action2'] == 'export_csv' )
				)
			) {
				$terms = $_REQUEST['delete_tags'];

				$sitename = sanitize_key( get_bloginfo( 'name' ) );
				$sitename .= ( ! empty( $sitename ) ) ? '.' : '';
				$filename = $sitename . 'wordpress.' . date( 'Y-m-d' ) . '.csv';
				$base_url = is_multisite() ? network_home_url() : get_bloginfo_rss( 'url' );

				// create csv file content
				$formatted_terms = array();
				$formatted_terms[] = array( 'id', 'name', 'slug', 'description', 'parent', 'base_siste_url', 'thumbnail', 'banner', 'custom_url');

				foreach( $terms as $term_id ){
					// retrieve term
					$term = get_term( $term_id, YITH_WCBR::$brands_taxonomy );

					// retrieve thumbnail
					$term_thumbnail_id = absint( yith_wcbr_get_term_meta( $term_id, 'thumbnail_id', true ) );
					$term_image = $term_thumbnail_id ? wp_get_attachment_url( $term_thumbnail_id ) : '';

					// retrieve banner
					$term_banner_id = absint( yith_wcbr_get_term_meta( $term_id, 'banner_id', true ) );
					$term_banner = $term_banner_id ? wp_get_attachment_url( $term_banner_id ) : '';

					// retrieve custom url
					$term_custom_url = yith_wcbr_get_term_meta( $term_id, 'custom_url', true );

					// retrieve term parent
					$term_parent_slug = '';
					if( $term->parent ){
						$term_parent_obj = get_term( $term->parent, YITH_WCBR::$brands_taxonomy );
						$term_parent_slug = ( $term_parent_obj && ! is_wp_error( $term_parent_obj ) ) ? $term_parent_obj->slug : '';
					}

					$formatted_terms[] = array(
						$term_id,
						$term->name,
						$term->slug,
						$term->description,
						$term_parent_slug,
						$base_url,
						$term_image,
						$term_banner,
						$term_custom_url
					);
				}

				header( 'Content-Description: File Transfer' );
				header( 'Content-Disposition: attachment; filename=' . $filename );
				header( 'Content-Type: text/xml; charset=' . get_option( 'blog_charset' ), true );

				$df = fopen( 'php://output', 'w' );

				foreach( $formatted_terms as $row ){
					fputcsv( $df, $row );
				}

				fclose($df);

				die();
			}
		}

		/**
		 * Import brands from csv
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function import_csv() {
			if ( ! class_exists( 'WP_Importer' ) ) {
				$class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';

				if ( file_exists( $class_wp_importer ) ) {
					require $class_wp_importer;
				}
			}

			// includes
			require YITH_WCBR_DIR . 'includes/importer/class.yith-wcbr-csv-importer.php';

			// Dispatch
			YITH_WCBR_CSV_Importer()->dispatch();
		}

		/* === LICENCE HANDLING METHODS === */

		/**
		 * Register plugins for activation tab
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function register_plugin_for_activation() {
			if( ! class_exists( 'YIT_Plugin_Licence' ) ){
				require_once YITH_WCBR_DIR . 'plugin-fw/licence/lib/yit-licence.php';
				require_once YITH_WCBR_DIR . 'plugin-fw/licence/lib/yit-plugin-licence.php';
			}

			YIT_Plugin_Licence()->register( YITH_WCBR_INIT, YITH_WCBR_SECRET_KEY, YITH_WCBR_SLUG );
		}

		/**
		 * Register plugins for update tab
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function register_plugin_for_updates() {
			if( ! class_exists( 'YIT_Plugin_Licence' ) ){
				require_once( YITH_WCBR_DIR . 'plugin-fw/lib/yit-upgrade.php' );
			}

			YIT_Upgrade()->register( YITH_WCBR_SLUG, YITH_WCBR_INIT );
		}

		/**
		 * Returns single instance of the class
		 *
		 * @return \YITH_WCBR_Admin_Premium
		 * @since 1.0.0
		 */
		public static function get_instance(){
			if( is_null( self::$instance ) ){
				self::$instance = new self;
			}

			return self::$instance;
		}
	}
}

/**
 * Unique access to instance of YITH_WCBR_Admin_Premium class
 *
 * @return \YITH_WCBR_Admin_Premium
 * @since 1.0.0
 */
function YITH_WCBR_Admin_Premium(){
	return YITH_WCBR_Admin_Premium::get_instance();
}