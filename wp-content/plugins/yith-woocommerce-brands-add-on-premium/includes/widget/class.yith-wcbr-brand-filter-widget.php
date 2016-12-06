<?php
/**
 * Brands Filter Widget
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

if ( ! class_exists( 'YITH_WCBR_Brand_Filter_Widget' ) ) {
	/**
	 * WooCommerce Brands FIlter Widget
	 *
	 * @since 1.0.0
	 */
	class YITH_WCBR_Brand_Filter_Widget extends WP_Widget {

		/**
		 * Register widget with WordPress.
		 *
		 * @return \YITH_WCBR_Brand_Filter_Widget
		 * @since 1.0.0
		 */
		public function __construct(){
			parent::__construct(
				'yith_wcbr_brands_filter',
				__( 'YITH Brand Filter', 'yith-wcbr' ),
				array(
					'description' => __( 'Add an A-Z filter for brands', 'yith-wcbr' )
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
				'show_filter' => 'yes',         // yes - no
				'show_reset' => 'yes',          // yes - no
				'show_all_letters' => 'yes',    // yes - no
				'show_count' => 'yes',          // yes - no
				'hide_empty' => 'no',           // yes - no
				'style' => 'default',           // default - big-header - small-header - shadow - box - highlight
				'highlight_color' => '#ffd900'  // hex color code (only for highlight style)
			), $instance );

			foreach( $shortcode_atts as $key => $value ){
				$shortcode_atts_string .= $key . '="' . $value . '" ';
			}

			echo $args['before_widget'];
			echo do_shortcode( "[yith_wcbr_brand_filter  $shortcode_atts_string]" );
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
			$show_filter = isset( $instance['show_filter'] ) && $instance['show_filter'] == 'yes';
			$show_reset = isset( $instance['show_reset'] ) && $instance['show_reset'] == 'yes';
			$show_all_letters = isset( $instance['show_all_letters'] ) && $instance['show_all_letters'] == 'yes';
			$show_count = isset( $instance['show_count'] ) && $instance['show_count'] == 'yes';
			$hide_empty = isset( $instance['hide_empty'] ) && $instance['hide_empty'] == 'yes';
			$autosense_category = isset( $instance['autosense_category'] ) && $instance['autosense_category'] == 'yes';
			$category = ! empty( $instance['category'] ) ? $instance['category'] : '';
			$style = ! empty( $instance['style'] ) ? $instance['style'] : 'default';
			$highlight_color = ! empty( $instance['highlight_color'] ) ? $instance['highlight_color'] : '#ffd900';

			?>
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'yith-wcbr' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'show_filter' ); ?>">
					<input class="widefat" id="<?php echo $this->get_field_id( 'show_filter' ); ?>" name="<?php echo $this->get_field_name( 'show_filter' ); ?>" type="checkbox" value="yes" <?php checked( $show_filter ) ?>>
					<?php _e( 'Show filters', 'yith-wcbr' ); ?>
				</label><br />
				<small><?php _e( 'Show letter filter', 'yith-wcbr' ) ?></small>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'show_reset' ); ?>">
					<input class="widefat" id="<?php echo $this->get_field_id( 'show_reset' ); ?>" name="<?php echo $this->get_field_name( 'show_reset' ); ?>" type="checkbox" value="yes" <?php checked( $show_reset ) ?>>
					<?php _e( 'Show reset:', 'yith-wcbr' ); ?>
				</label><br />
				<small><?php _e( 'Display "Show all" button within letter filter', 'yith-wcbr' ) ?></small>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'show_all_letters' ); ?>">
					<input class="widefat" id="<?php echo $this->get_field_id( 'show_all_letters' ); ?>" name="<?php echo $this->get_field_name( 'show_all_letters' ); ?>" type="checkbox" value="yes" <?php checked( $show_all_letters ) ?>>
					<?php _e( 'Show all letters', 'yith-wcbr' ); ?>
				</label><br />
				<small><?php _e( 'When filters are activated, show all letters instead of showing only those of brands available', 'yith-wcbr' ) ?></small>
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
			<p>
				<label for="<?php echo $this->get_field_id( 'autosense_category' ); ?>">
					<input class="widefat" id="<?php echo $this->get_field_id( 'autosense_category' ); ?>" name="<?php echo $this->get_field_name( 'autosense_category' ); ?>" type="checkbox" value="yes" <?php checked( $autosense_category ) ?>>
					<?php _e( 'Autosense category', 'yith-wcbr' ); ?>
				</label>
				<small><?php _e( 'On product category page, ignore category option and filter brands for current category', 'yith-wcbr' ) ?></small>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Category:' ); ?></label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>" value="<?php echo esc_attr( $category ) ?>" />
				<small><?php _e( 'Comma separated list of valid product category slugs, to filter brands; leave empty if you don\'t want to filter brands by category', 'yith-wcbr' ) ?></small>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'style' ); ?>"><?php _e( 'Style:' ); ?></label>
				<select class="widefat" id="<?php echo $this->get_field_id( 'style' ); ?>" name="<?php echo $this->get_field_name( 'style' ); ?>">
					<option value="default" <?php selected( $style, 'default' ) ?> ><?php _e( 'Default', 'yith-wcbr' ) ?></option>
					<option value="big-header" <?php selected( $style, 'big-header' ) ?> ><?php _e( 'Big Header', 'yith-wcbr' ) ?></option>
					<option value="small-header" <?php selected( $style, 'small-header' ) ?> ><?php _e( 'Small Header', 'yith-wcbr' ) ?></option>
					<option value="shadow" <?php selected( $style, 'shadow' ) ?> ><?php _e( 'Shadow', 'yith-wcbr' ) ?></option>
					<option value="boxed" <?php selected( $style, 'boxed' ) ?> ><?php _e( 'Boxed', 'yith-wcbr' ) ?></option>
					<option value="highlight" <?php selected( $style, 'highlight' ) ?> ><?php _e( 'Highlight', 'yith-wcbr' ) ?></option>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'highlight_color' ); ?>"><?php _e( 'Highlight:', 'yith-wcbr' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'highlight_color' ); ?>" name="<?php echo $this->get_field_name( 'highlight_color' ); ?>" type="text" value="<?php echo esc_attr( $highlight_color ); ?>">
				<small><?php _e( 'Valid hex color code, to use as background in highlight style', 'yith-wcbr' ) ?></small>
			</p>
			<script>
				jQuery( document).ready( function( $ ){
					var show_filter = $( '#<?php echo $this->get_field_id( 'show_filter' ); ?>'),
						show_reset = $( '#<?php echo $this->get_field_id( 'show_reset' ); ?>'),
						show_all_letters = $( '#<?php echo $this->get_field_id( 'show_all_letters' ); ?>'),
						style = $( '#<?php echo $this->get_field_id( 'style' ); ?>'),
						highlight_color = $( '#<?php echo $this->get_field_id( 'highlight_color' ); ?>');

					show_filter.on( 'change', function(){
						var t = $(this);

						if( t.is( ':checked' ) ){
							show_reset.parents('p').show();
							show_all_letters.parents('p').show();
						}
						else{
							show_reset.parents('p').hide();
							show_all_letters.parents('p').hide();
						}
					}).change();

					style.on( 'change', function(){
						var t = $(this),
							val = t.val();

						if( val == 'highlight' ){
							highlight_color.parents('p').show();
						}
						else{
							highlight_color.parents('p').hide();
						}
					}).change();
				} );
			</script>
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
			$instance['show_filter'] = $new_instance['show_filter'] == 'yes' ? 'yes' : 'no';
			$instance['show_reset'] = $new_instance['show_reset'] == 'yes' ? 'yes' : 'no';
			$instance['show_all_letters'] = $new_instance['show_all_letters'] == 'yes' ? 'yes' : 'no';
			$instance['show_count'] = $new_instance['show_count'] == 'yes' ? 'yes' : 'no';
			$instance['hide_empty'] = $new_instance['hide_empty'] == 'yes' ? 'yes' : 'no';
			$instance['autosense_category'] = $new_instance['autosense_category'] == 'yes' ? 'yes' : 'no';
			$instance['category'] = ! empty( $new_instance['category'] ) ? $new_instance['category'] : '';
			$instance['style'] = ! empty( $new_instance['style'] ) && in_array( $new_instance['style'], array( 'default', 'big-header', 'small-header', 'shadow', 'boxed', 'highlight' ) ) ? $new_instance['style'] : 'default';
			$instance['highlight_color'] = ! empty( $new_instance['highlight_color'] ) ? strip_tags( $new_instance['highlight_color'] ) : '';

			return $instance;
		}
	}
}