<?php
/**
 * Brands Select Widget
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

if ( ! class_exists( 'YITH_WCBR_Brand_Select_Widget' ) ) {
	/**
	 * WooCommerce Brands Select Widget
	 *
	 * @since 1.0.0
	 */
	class YITH_WCBR_Brand_Select_Widget extends WP_Widget {

		/**
		 * Register widget with WordPress.
		 *
		 * @return \YITH_WCBR_Brand_Select_Widget
		 * @since 1.0.0
		 */
		public function __construct(){
			parent::__construct(
				'yith_wcbr_brands_select',
				__( 'YITH Brand Select', 'yith-wcbr' ),
				array(
					'description' => __( 'Add a select with all brands', 'yith-wcbr' )
				)
			);
		}

		/**
		 * Front-end display of widget.
		 *
		 * @see WP_Widget::widget()
		 *
		 * @param array $args     Widget arguments.
		 * @param array $instance Saved values from database.
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function widget( $args, $instance ) {
			// translate widget title
			if( isset( $instance['title'] ) ){
				$instance['title'] = apply_filters( 'widget_title', $instance['title'] );
			}

			// parse args
			$shortcode_atts_string = '';
			$shortcode_atts = shortcode_atts( array(
				'title' => '',
				'autosense_category' => 'no',   // yes - no (if yes, on product category page, ignores "category" options, and shows only brands for current category)
				'category' => 'all',            // all - a list of comma separated valid category slug
				'show_count' => 'yes',          // yes - no
				'hide_empty' => 'no'            // yes - no
			), $instance );

			foreach( $shortcode_atts as $key => $value ){
				$shortcode_atts_string .= $key . '="' . $value . '" ';
			}

			echo $args['before_widget'];
			echo do_shortcode( "[yith_wcbr_brand_select $shortcode_atts_string]" );
			echo $args['after_widget'];
		}

		/**
		 * Back-end widget form.
		 *
		 * @see WP_Widget::form()
		 *
		 * @param array $instance Previously saved values from database.
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function form( $instance ) {
			$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
			$autosense_category = isset( $instance['autosense_category'] ) && $instance['autosense_category'] == 'yes';
			$category = ! empty( $instance['category'] ) ? $instance['category'] : '';
			$show_count = isset( $instance['show_count'] ) && $instance['show_count'] == 'yes';
			$hide_empty = isset( $instance['hide_empty'] ) && $instance['hide_empty'] == 'yes';

			?>
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'yith-wcbr' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'autosense_category' ); ?>">
					<input class="widefat" id="<?php echo $this->get_field_id( 'autosense_category' ); ?>" name="<?php echo $this->get_field_name( 'autosense_category' ); ?>" type="checkbox" value="yes" <?php checked( $autosense_category ) ?>>
					<?php _e( 'Autosense category', 'yith-wcbr' ); ?>
				</label><br />
				<small><?php _e( 'On product category page, ignore category option and filter brands for current category', 'yith-wcbr' ) ?></small>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Category:' ); ?></label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>" value="<?php echo esc_attr( $category ) ?>" />
				<small><?php _e( 'Comma separated list of valid product category slugs, to filter brands; leave it empty if you don\'t want to filter brands by category', 'yith-wcbr' ) ?></small>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'show_count' ); ?>">
					<input class="widefat" id="<?php echo $this->get_field_id( 'show_count' ); ?>" name="<?php echo $this->get_field_name( 'show_count' ); ?>" type="checkbox" value="yes" <?php checked( $show_count ) ?>>
					<?php _e( 'Show count', 'yith-wcbr' ); ?>
				</label><br />
				<small><?php _e( 'Show number of products for each brand', 'yith-wcbr' ) ?></small>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'hide_empty' ); ?>">
					<input class="widefat" id="<?php echo $this->get_field_id( 'hide_empty' ); ?>" name="<?php echo $this->get_field_name( 'hide_empty' ); ?>" type="checkbox" value="yes" <?php checked( $hide_empty ) ?>>
					<?php _e( 'Hide empty', 'yith-wcbr' ); ?>
				</label><br />
				<small><?php _e( 'Hide brands without products associated', 'yith-wcbr' ) ?></small>
			</p>
		<?php
		}

		/**
		 * Sanitize widget form values as they are saved.
		 *
		 * @see WP_Widget::update()
		 *
		 * @param array $new_instance Values just sent to be saved.
		 * @param array $old_instance Previously saved values from database.
		 *
		 * @return array Updated safe values to be saved.
		 * @since 1.0.0
		 */
		public function update( $new_instance, $old_instance ){
			$instance = array();
			$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
			$instance['autosense_category'] = $new_instance['autosense_category'] == 'yes' ? 'yes' : 'no';
			$instance['category'] = ! empty( $new_instance['category'] ) ? $new_instance['category'] : '';
			$instance['show_count'] = $new_instance['show_count'] == 'yes' ? 'yes' : 'no';
			$instance['hide_empty'] = $new_instance['hide_empty'] == 'yes' ? 'yes' : 'no';

			return $instance;
		}
	}
}