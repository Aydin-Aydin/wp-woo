<?php
/**
 * Main class Premium
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Brands
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

if ( ! class_exists( 'YITH_WCBR_Premium' ) ) {
	/**
	 * WooCommerce Brands
	 *
	 * @since 1.0.0
	 */
	class YITH_WCBR_Premium extends YITH_WCBR {
		/**
		 * Single instance of the class
		 *
		 * @var \YITH_WCBR_Premium
		 * @since 1.0.0
		 */
		protected static $instance;

		/**
		 * Constructor method
		 *
		 * @return \YITH_WCBR_Premium
		 * @since 1.0.0
		 */
		public function __construct() {

			// sets correct brand taxonomy and execute parent constructor
			self::$brands_taxonomy = get_option( 'yith_wcbr_brands_taxonomy', self::$brands_taxonomy );
			parent::__construct();

			// register shortcodes
			add_action( 'init', array( 'YITH_WCBR_Shortcode', 'init' ), 5 );

			// register widget
			add_action( 'widgets_init', array( $this, 'register_widget' ) );

			// adds archive page banner
			add_action( 'woocommerce_archive_description', array( $this, 'add_loop_brand_header' ), 5 );

			// adds action for frontend templates
			remove_action( 'woocommerce_product_meta_end', array( $this, 'add_single_product_brand_template' ) );
			add_action( 'init', array( $this, 'add_single_product_brand_action' ) );
			add_action( 'init', array( $this, 'add_loop_product_brand_action' ) );

			// adds action to print default logo
			add_action( 'yith_wcbr_no_brand_logo', array( $this, 'add_default_logo_image' ), 10, 5 );

			// add filter to customize term link
			add_filter( 'term_link', array( $this, 'add_custom_term_link' ), 10, 3 );

			// flush transients for brands-category and category-brand relationships whenever a new term relationship is added
			add_action( 'set_object_terms', array( $this, 'flush_relationships_transients' ), 10, 6 );

			// Yoast SEO integration
			if( defined( 'WPSEO_VERSION' ) ){
				add_action( 'init', array( $this, 'add_yoast_seo_replacement' ) );
			}
		}

		/**
		 * Enqueue frontend scripts
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function enqueue() {
			parent::enqueue();

			$path = ( defined( 'WP_DEBUG' ) && WP_DEBUG ) ? 'unminified/' : '';
			$wc_path  = str_replace( array( 'http:', 'https:' ), '', WC()->plugin_url() ) . '/assets/';
			$suffix = ( defined( 'WP_DEBUG' ) && WP_DEBUG ) ? '' : '.min';

			// include js required
			$template_name = 'brands.js';
			$locations = array(
				trailingslashit( WC()->template_path() ) . 'yith-wcbr/' . $template_name,
				trailingslashit( WC()->template_path() ) . $template_name,
				'yith-wcbr/' . $template_name,
				$template_name
			);

			$template_js = locate_template( $locations );

			if( ! $template_js ){
				$template_js = YITH_WCBR_URL . 'assets/js/' . $path . 'yith-wcbr' . $suffix . '.js';
			}
			else{
				$search     = array( get_stylesheet_directory(), get_template_directory() );
				$replace    = array( get_stylesheet_directory_uri(), get_template_directory_uri() );
				$template_js = str_replace( $search, $replace, $template_js );
			}

			// include shortcode css
			$template_name = 'brands-shortcode.css';
			$locations = array(
				trailingslashit( WC()->template_path() ) . 'yith-wcbr/' . $template_name,
				trailingslashit( WC()->template_path() ) . $template_name,
				'yith-wcbr/' . $template_name,
				$template_name
			);

			$template_css = locate_template( $locations );

			if( ! $template_css ){
				$template_css = YITH_WCBR_URL . 'assets/css/yith-wcbr-shortcode.css';
			}
			else{
				$search     = array( get_stylesheet_directory(), get_template_directory() );
				$replace    = array( get_stylesheet_directory_uri(), get_template_directory_uri() );
				$template_css = str_replace( $search, $replace, $template_css );
			}

			wp_register_script( 'jquery-swiper', YITH_WCBR_URL . 'assets/js/' . $path . 'swiper.jquery' . $suffix . '.js', array( 'jquery' ), false, true );
			wp_register_script( 'yith-wcbr', $template_js, array( 'jquery', 'jquery-swiper', 'select2' ), false, true );
			wp_localize_script( 'yith-wcbr', 'yith_wcbr', array(
				'labels' => array(
					'brands_select_default' => apply_filters( 'yith_wcbr_brands_select_default', __( 'Any Brand', 'yith-wcbr' ) )
				)
			) );

			wp_register_style( 'yith-wcbr-shortcode', $template_css, array( 'yith-wcbr' ) );
			wp_register_style( 'jquery-swiper', YITH_WCBR_URL . 'assets/css/swiper.css' );

			do_action( 'yith_wcbr_enqueue_frontend_script' );
			do_action( 'yith_wcbr_enqueue_frontend_style' );

			wp_enqueue_style( 'jquery-swiper' );
			wp_enqueue_style( 'select2', $wc_path . 'css/select2.css' );
			wp_enqueue_style( 'yith-wcbr' );
			wp_enqueue_style( 'yith-wcbr-shortcode' );
		}

		/**
		 * Register taxonomy for brands
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function register_taxonomy(){
			if( ! taxonomy_exists( self::$brands_taxonomy ) ){
				// register default taxonomy
				parent::register_taxonomy();
			}
		}

		/**
		 * Register thumb size for brand logo on single product page
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function register_image_size() {
			parent::register_image_size();

			$default_values = array(
				'width' => 0,
				'height' => 30,
				'crop' => true
			);
			$stored_values = get_option( 'yith_wcbr_loop_product_brands_size', $default_values );

			$grid_thumb_width = apply_filters( 'yith_wcbr_grid_thumb_width', $stored_values['width'] );
			$grid_thumb_height = apply_filters( 'yith_wcbr_grid_thumb_height', $stored_values['height'] );
			$grid_thumb_crop = apply_filters( 'yith_wcbr_grid_thumb_crop', $stored_values['crop'] );

			add_image_size( 'yith_wcbr_grid_logo_size', $grid_thumb_width, $grid_thumb_height, $grid_thumb_crop );
		}

		/**
		 * Register available widgets
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function register_widget() {
			require_once( YITH_WCBR_INC . 'widget/class.yith-wcbr-brand-filter-widget.php' );
			require_once( YITH_WCBR_INC . 'widget/class.yith-wcbr-brand-thumbnail-widget.php' );
			require_once( YITH_WCBR_INC . 'widget/class.yith-wcbr-brand-thumbnail-carousel-widget.php' );
			require_once( YITH_WCBR_INC . 'widget/class.yith-wcbr-brand-select-widget.php' );
			require_once( YITH_WCBR_INC . 'widget/class.yith-wcbr-brand-list-widget.php' );

			register_widget( 'YITH_WCBR_Brand_Filter_Widget' );
			register_widget( 'YITH_WCBR_Brand_Thumbnail_Widget' );
			register_widget( 'YITH_WCBR_Brand_Thumbnail_Carousel_Widget' );
			register_widget( 'YITH_WCBR_Brand_Select_Widget' );
			register_widget( 'YITH_WCBR_Brand_List_Widget' );
		}

		/**
		 * Adds single product brand template to correct action
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function add_single_product_brand_action() {
			$position = get_option( 'yith_wcbr_single_product_brands_position', 'woocommerce_template_single_meta' );
			$action = 'woocommerce_product_meta_end';
			$priority = 10;

			switch( $position ){
				case 'none':
					return;
				case 'woocommerce_template_single_title':
					$action = 'woocommerce_single_product_summary';
					$priority = 7;
					break;
				case 'woocommerce_template_before_single_title':
					$action = 'woocommerce_single_product_summary';
					$priority = 3;
					break;
				case 'woocommerce_template_single_price':
					$action = 'woocommerce_single_product_summary';
					$priority = 15;
					break;
				case 'woocommerce_template_single_excerpt':
					$action = 'woocommerce_single_product_summary';
					$priority = 25;
					break;
				case 'woocommerce_template_single_add_to_cart':
					$action = 'woocommerce_single_product_summary';
					$priority = 35;
					break;
				case 'woocommerce_template_single_sharing':
					$action = 'woocommerce_single_product_summary';
					$priority = 55;
					break;
				case 'woocommerce_product_meta_end':
				default:
					break;
			}

			add_action( $action, array( $this, 'add_single_product_brand_template' ), $priority );
		}

		/**
		 * Adds loop brand template to correct action
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function add_loop_product_brand_action(){
			$position = get_option( 'yith_wcbr_loop_product_brands_position', 'woocommerce_template_loop_price' );
			$action = 'woocommerce_after_shop_loop_item';
			$priority = 15;

			switch( $position ){
				case 'none':
					return;
				case 'woocommerce_template_loop_price':
					$action = 'woocommerce_after_shop_loop_item';
					$priority = 5;
					break;
				case 'woocommerce_template_loop_add_to_cart':
				default:
					break;
			}

			add_action( $action, array( $this, 'add_loop_brand_template' ), $priority );
		}

		/**
		 * Include template for brands on archive product page
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function add_loop_brand_header() {
			if( is_tax( self::$brands_taxonomy ) && get_query_var( 'paged' ) == 0 ){

				// retrieve data to use in template
				$qo = get_queried_object();
				$term_id = $qo->term_id;
				$term = get_term( $term_id, self::$brands_taxonomy );
				$banner_id = yith_wcbr_get_term_meta( $term_id, 'banner_id', true );

				$args = array(
					'term_id' => $term_id,
					'term' => $term,
					'banner_id' => $banner_id
				);

				if ( $banner_id ) {
					$args['banner'] = wp_get_attachment_image( $banner_id, 'big', false, array(' class' => 'brand-banner' ) );
				}

				// include payment form template
				$template_name = 'archive-product-brands-header.php';

				yith_wcbr_get_template( $template_name, $args );
			}
		}

		/**
		 * Include template for brands on single product page
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function add_single_product_brand_template() {
			global $product;

			// retrieve data to use in template
			$brands_taxonomy = self::$brands_taxonomy;
			$before_term_list = apply_filters( 'yith_wcbr_single_product_before_term_list', '' );
			$after_term_list = apply_filters( 'yith_wcbr_single_product_after_term_list', '' );
			$term_list_sep = apply_filters( 'yith_wcbr_single_product_term_list_sep', ', ' );
			$brands_label = get_option( 'yith_wcbr_brands_label' );
			$product_brands = get_the_terms( $product->id, self::$brands_taxonomy );
			$product_has_brands = ! is_wp_error( $product_brands ) && $product_brands;
			$content_to_show = get_option( 'yith_wcbr_single_product_brands_content' );

			$args = array(
				'brands_taxonomy' => $brands_taxonomy,
				'before_term_list' => $before_term_list,
				'after_term_list' => $after_term_list,
				'term_list_sep' => $term_list_sep,
				'brands_label' => $brands_label,
				'product_brands' => $product_brands,
				'product_has_brands' => $product_has_brands,
				'content_to_show' => $content_to_show
			);

			// include payment form template
			$template_name = 'single-product-brands.php';

			yith_wcbr_get_template( $template_name, $args );
		}

		/**
		 * Print loop brand template
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function add_loop_brand_template() {
			global $product;

			// retrieve data to use in template
			$brands_taxonomy = self::$brands_taxonomy;
			$before_term_list = apply_filters( 'yith_wcbr_single_product_before_term_list', '' );
			$after_term_list = apply_filters( 'yith_wcbr_single_product_after_term_list', '' );
			$term_list_sep = apply_filters( 'yith_wcbr_single_product_term_list_sep', ', ' );
			$brands_label = get_option( 'yith_wcbr_brands_label' );
			$product_brands = get_the_terms( $product->id, self::$brands_taxonomy );
			$product_has_brands = ! is_wp_error( $product_brands ) && $product_brands;
			$content_to_show = get_option( 'yith_wcbr_loop_product_brands_content' );

			$args = array(
				'brands_taxonomy' => $brands_taxonomy,
				'before_term_list' => $before_term_list,
				'after_term_list' => $after_term_list,
				'term_list_sep' => $term_list_sep,
				'brands_label' => $brands_label,
				'product_brands' => $product_brands,
				'product_has_brands' => $product_has_brands,
				'content_to_show' => $content_to_show
			);

			// include payment form template
			$template_name = 'loop-brands.php';

			yith_wcbr_get_template( $template_name, $args );
		}

		/**
		 * Print default logo image, if enabled
		 *
		 * @param $term_id int Term id
		 * @param $term \stdClass Term object
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function add_default_logo_image( $term_id, $term, $size = 'yith_wcbr_logo_size', $show_term_name = false, $show_avg_rating = false ) {
			$default_logo_enabled = get_option( 'yith_wcbr_use_logo_default' );

			if( $default_logo_enabled == 'yes' ){
				$default_logo_id = get_option( 'yith_wcbr_logo_default' );

				if( $default_logo_id ){
					$default_logo =  wp_get_attachment_image_src( $default_logo_id, $size );

					if( $default_logo ){
						$output = sprintf( '<a href="%s"><img src="%s" width="%d" height="%d" alt="%s"/>', get_term_link( $term ), $default_logo[0], $default_logo[1], $default_logo[2], $term->name );

						if( $show_term_name || $show_avg_rating ){
							$output .= '<div class="brand-info">';

							if( $show_term_name ){
								$output .= $term->name;
							}

							if( $show_avg_rating ){
								$output .= $this->get_average_term_rating_html( $term_id );
							}

							$output .= '</div>';
						}

						$output .= '</a>';

						echo $output;
					}
				}
			}
		}

		/**
		 * Filters term link, to add custom url when set for brands
		 *
		 * @param $term_link string Term original url
		 * @param $term \stdClass Term object
		 * @param $taxonomy string Taxonomy slug
		 *
		 * @return string Term link
		 * @since 1.0.0
		 */
		public function add_custom_term_link( $term_link, $term, $taxonomy ) {
			if( $taxonomy === self::$brands_taxonomy ){
				$custom_url = yith_wcbr_get_term_meta( $term->term_id, 'custom_url', true );

				if( yith_wcbr_is_valid_url( $custom_url ) ){
					$term_link = $custom_url;
				}
			}

			return $term_link;
		}

		/**
		 * Filter term query clauses, to remove terms without thumbnail
		 *
		 * @deprecated Since version 2.6 of WooCommerce (woocommerce_termmeta has been replaced by termmeta)
		 * 
		 * @param $clauses mixed Array of query clauses to filter
		 * @param $taxonomy mixed Array of taxonomy for current query
		 * @param $args mixed array of args passe to get_terms()
		 *
		 * @return mixed Filtered array of query clauses
		 * @since 1.0.0
		 */
		public function filter_term_without_image( $clauses, $taxonomy, $args ){
			global $wpdb;

			if( in_array( self::$brands_taxonomy, $taxonomy ) ) {
				if( version_compare( WC()->version, '2.6', '<' ) ) {
					$clauses['fields'] .= ", tm.*";
					$clauses['join'] .= " INNER JOIN {$wpdb->prefix}woocommerce_termmeta AS tm ON t.term_id = tm.woocommerce_term_id";
					$clauses['where'] .= " AND tm.meta_key = 'thumbnail_id' AND tm.meta_value <> '0'";
				}
			}

			return $clauses;
		}

		/**
		 * Returns AVG brands product rating
		 *
		 * @param $term_id int Brand id
		 *
		 * @return string|int Avg rating
		 * @since 1.0.0
		 */
		public function get_average_brand_rating( $term_id ) {
			global $wpdb;

			$avg_brand_rating = $wpdb->get_var( $wpdb->prepare("
					SELECT AVG( cm.meta_value )
					FROM $wpdb->commentmeta AS cm
					LEFT JOIN $wpdb->comments AS c ON cm.comment_id = c.comment_ID
					WHERE meta_key = 'rating'
					AND comment_post_ID IN(
						SELECT p.ID
						FROM $wpdb->posts AS p
						INNER JOIN $wpdb->term_relationships AS tr ON ( p.ID = tr.object_id )
						WHERE tr.term_taxonomy_id = %d
						AND p.post_type = %s
						AND p.post_status = %s
					)
					AND c.comment_approved = '1'
					AND cm.meta_value > 0
				", $term_id, 'product', 'publish' ) );

			return is_null( $avg_brand_rating ) ? 0 : $avg_brand_rating;
		}

		/**
		 * Returns html for rating
		 *
		 * @param $term_id int Brand id
		 *
		 * @return string HTML code for rating stars
		 * @since 1.0.0
		 */
		public function get_average_term_rating_html( $term_id ) {
			$rating = $this->get_average_brand_rating( $term_id );

			$rating_html = '<div class="star-rating" title="' . sprintf( __( 'Rated %s out of 5', 'yith-wcbr' ), $rating ) . '">';
			$rating_html .= '<span style="width:' . ( ( $rating / 5 ) * 100 ) . '%"><strong class="rating">' . $rating . '</strong> ' . __( 'out of 5', 'yith-wcbr' ) . '</span>';
			$rating_html .= '</div>';

			$rating_html =  apply_filters( 'woocommerce_product_get_rating_html', $rating_html, $rating );

			$output = '<div class="woocommerce-product-rating">';
			$output .= $rating_html;
			$output .= '</div>';

			return $output;
		}

		/**
		 * Returns an array indexed by brands ids; every element is an array of ids of brand-related categories
		 *
		 * @return mixed
		 * @since 1.0.0
		 */
		public function get_brand_category_relationships(){
			global $wpdb;

			$brand_category_relationship_stored = get_transient( 'yith_wcbr_brand_category_relationships' );

			if( false === $brand_category_relationship_stored ) {
				$query = $wpdb->prepare(
					"SELECT DISTINCT tt1.term_id AS product_cat, tt2.term_id AS brand
					 FROM {$wpdb->term_taxonomy} AS tt1
					 LEFT JOIN {$wpdb->term_relationships} AS tr1 ON tr1.term_taxonomy_id = tt1.term_taxonomy_id
					 LEFT JOIN {$wpdb->term_relationships} AS tr2 ON tr2.object_id = tr1.object_id
					 LEFT JOIN {$wpdb->term_taxonomy} AS tt2 ON tt2.term_taxonomy_id = tr2.term_taxonomy_id
					 WHERE tt1.taxonomy =  %s
					 AND tt2.taxonomy =  %s",
					'product_cat',
					YITH_WCBR::$brands_taxonomy
				);

				$brand_category_relationship     = array();
				$brand_category_relationship_raw = $wpdb->get_results( $query, ARRAY_N );

				foreach ( $brand_category_relationship_raw as $row ) {
					if ( isset( $brand_category_relationship[ $row[1] ] ) ) {
						$brand_category_relationship[ $row[1] ][] = $row[0];
					} else {
						$brand_category_relationship[ $row[1] ] = (array) $row[0];
					}
				}

				set_transient( 'yith_wcbr_brand_category_relationships', $brand_category_relationship, WEEK_IN_SECONDS );
			}
			else{
				$brand_category_relationship = $brand_category_relationship_stored;
			}

			return $brand_category_relationship;
		}

		/**
		 * Returns an array indexed by product_cat ids; every element is an array of ids of category-related brands
		 *
		 * @return mixed
		 * @since 1.0.0
		 */
		public function get_category_brand_relationships(){
			global $wpdb;

			$brand_category_relationship_stored = get_transient( 'yith_wcbr_category_brand_relationships' );

			if( false === $brand_category_relationship_stored ) {
				$query = $wpdb->prepare(
					"SELECT DISTINCT tt2.term_id AS brand, tt1.term_id AS product_cat
					 FROM {$wpdb->term_taxonomy} AS tt1
					 LEFT JOIN {$wpdb->term_relationships} AS tr1 ON tr1.term_taxonomy_id = tt1.term_taxonomy_id
					 LEFT JOIN {$wpdb->term_relationships} AS tr2 ON tr2.object_id = tr1.object_id
					 LEFT JOIN {$wpdb->term_taxonomy} AS tt2 ON tt2.term_taxonomy_id = tr2.term_taxonomy_id
					 WHERE tt1.taxonomy =  %s
					 AND tt2.taxonomy =  %s",
					'product_cat',
					YITH_WCBR::$brands_taxonomy
				);

				$brand_category_relationship     = array();
				$brand_category_relationship_raw = $wpdb->get_results( $query, ARRAY_N );

				foreach ( $brand_category_relationship_raw as $row ) {
					if ( isset( $brand_category_relationship[ $row[1] ] ) ) {
						$brand_category_relationship[ $row[1] ][] = $row[0];
					} else {
						$brand_category_relationship[ $row[1] ] = (array) $row[0];
					}
				}

				set_transient( 'yith_wcbr_category_brand_relationships', $brand_category_relationship, WEEK_IN_SECONDS );
			}
			else{
				$brand_category_relationship = $brand_category_relationship_stored;
			}

			return $brand_category_relationship;
		}

		/**
		 * Flush brands-categories relationships when new new terms of this taxonomies are added to a product
		 *
		 * @param $object_id int Post id
		 * @param $terms mixed Terms id array
		 * @param $tt_ids mixed Term-taxonomy relationships ids array
		 * @param $taxonomy string Taxonomy name
		 * @param $append bool Whether to append new terms to the old terms.
		 * @param $old_tt_ids mixed Old term-taxonomy relationships ids array
		 */
		public function flush_relationships_transients( $object_id, $terms, $tt_ids, $taxonomy, $append, $old_tt_ids ) {
			if( 'product' != get_post_type( $object_id ) ){
				return;
			}

			if( empty( $terms ) ){
				return;
			}

			if( count( $tt_ids ) == count( $old_tt_ids ) && count( array_intersect( $tt_ids, $old_tt_ids ) ) == count( $tt_ids ) ){
				return;
			}

			if( ! in_array( $taxonomy, array( 'product_cat', self::$brands_taxonomy ) ) ){
				return;
			}

			delete_transient( 'yith_wcbr_brand_category_relationships' );
			delete_transient( 'yith_wcbr_category_brand_relationships' );
		}

		/* === YOAST SEO INTEGRATION === */

		/**
		 * Register replacement for YOAST SEo (you can use %%product_brand%% in products)
		 *
		 * @return void
		 * @since 1.0.6
		 */
		public function add_yoast_seo_replacement() {
			if( ! class_exists( 'WPSEO_Replace_Vars' ) ){
				return;
			}

			WPSEO_Replace_Vars::register_replacement( '%%product_brand%%', array( $this, 'retrieve_yoast_seo_replacement_value' ) );
		}

		/**
		 * Return replacement value for %%product_brand%% shortcut
		 *
		 * @param $var string String to replace
		 * @param $post mixed Args sent to replace function (in this case a post object)
		 *
		 * @return string Replacement values
		 * @since 1.0.6
		 */
		public function retrieve_yoast_seo_replacement_value( $var, $post ) {
			if( ! isset( $post->ID ) ){
				return $var;
			}

			$brands = wp_get_post_terms( $post->ID, YITH_WCBR::$brands_taxonomy );

			if( empty( $brands ) ){
				return $var;
			}

			$brand = $brands[0];
			return $brand->name;
		}

		/**
		 * Returns single instance of the class
		 *
		 * @return \YITH_WCBR_Premium
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
 * Unique access to instance of YITH_WCBR_Premium class
 *
 * @return \YITH_WCBR_Premium
 * @since 1.0.0
 */
function YITH_WCBR_Premium(){
	return YITH_WCBR_Premium::get_instance();
}