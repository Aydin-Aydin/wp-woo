<?php
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
?>

<li style="width: <?php echo $cols_width?>%" class="<?php echo esc_attr( $classes )?>" data-categories="<?php echo esc_attr( json_encode( $brand_category ) ) ?>" >
	<?php
	$term_link = get_term_link( $term );

	if( $show_image == 'yes' ) {
		$thumbnail_id = absint( yith_wcbr_get_term_meta( $term->term_id, 'thumbnail_id', true ) );

		if ( $thumbnail_id ) {
			$image = wp_get_attachment_image_src( $thumbnail_id, 'yith_wcbr_grid_logo_size' );

			if ( $image ) {
				echo sprintf( '<a href="%s" title="%s"><img src="%s" width="%d" height="%d" alt="%s"/></a>', esc_url( $term_link ), $term->name, $image[0], $image[1], $image[2], $term->name );
			}
		}

		elseif ( get_option( 'yith_wcbr_use_logo_default' ) == 'yes' ) {
			do_action( 'yith_wcbr_no_brand_logo', $term->term_id, $term, 'yith_wcbr_grid_logo_size', false, false );
		}

		else {
			echo sprintf( '<a href="%s">%s</a>', esc_url( $term_link ), $term->name );
		}
	}

	if( $show_name == 'yes' ) {
		$name = sprintf( '<a href="%s">%s', esc_url( $term_link ), $term->name );

		if( $show_count == 'yes' ){
			$name .= sprintf( ' (%d)', $term->count );
		}

		$name .= '</a>';

		echo $name;
	}
	?>

</li>