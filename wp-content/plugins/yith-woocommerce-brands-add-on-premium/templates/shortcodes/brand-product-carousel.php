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

global $wpdb, $woocommerce, $woocommerce_loop;
add_filter( 'post_class', 'yith_wcbr_add_slider_post_class' );
?>

	<div class="woocommerce yith-wcbr-product-carousel <?php echo $style ?>">

		<div class="yith-wcbr-carousel-title">
			<?php if ( ! empty( $title ) ): ?>
				<h2><?php echo $title ?></h2>
			<?php endif; ?>
		</div>

		<?php if( $show_brand_box == 'yes' && isset( $brand ) && $brand != 'all' ): ?>
			<div class="yith-wcbr-carousel-brand-box">
				<h3><?php echo esc_attr( apply_filters( 'yith_wcbr_brands_box_title', __( 'Products in Brands', 'yith-wcbr' ) ) ) ?></h3>
				<p>
					<?php
					$brand_array = explode( ',', $brand );
					$brand_links = array();

					if( ! empty( $brand_array ) ){
						foreach( $brand_array as $elem ){
							$term = get_term_by( 'slug', $elem, YITH_WCBR::$brands_taxonomy );

							$brand_links[] = sprintf( '<a href="%s">%s</a>', get_term_link( $term, YITH_WCBR::$brands_taxonomy ), $term->name );
						}
					}

					echo implode( ', ', $brand_links );
					?>
				</p>
			</div>
		<?php endif; ?>

		<div class="yith-wcbr-product-list swiper-container row" data-slidesperview="<?php echo esc_attr( $cols ) ?>" data-direction="<?php echo esc_attr( $direction ) ?>" data-autoplay="<?php echo esc_attr( $autoplay )?>">
			<?php if ( $products->have_posts() ) : ?>
				<ul class="products swiper-wrapper">
					<?php
					while ( $products->have_posts() ) :
						$products->the_post();

						wc_get_template( 'content-product.php', array( 'product_in_a_row' => $cols ) );
						$cols = ( isset( $woocommerce_loop['columns'] ) ) ? $woocommerce_loop['columns'] : 6; //fix $woocommerce_loop['columns'] empty
					endwhile; // end of the loop.
					?>
				</ul>
			<?php endif; ?>
		</div>

		<?php if( $pagination == 'yes' ): ?>
			<div class="yith-wcbr-carousel-pagination-wrapper">
				<div class="yith-wcbr-pagination <?php echo esc_attr( $pagination_style ) ?>"></div>
			</div>
		<?php endif; ?>

		<?php if( $prev_next == 'yes' ): ?>
			<div class="yith-wcbr-button-wrapper">
				<div class="yith-wcbr-button-prev <?php echo esc_attr( $prev_next_style ) ?>"></div>
				<div class="yith-wcbr-button-next <?php echo esc_attr( $prev_next_style ) ?>"></div>
			</div>
		<?php endif; ?>
	</div>

<?php
remove_filter( 'post_class', 'yith_wcbr_add_slider_post_class' );
wp_reset_query();
wp_enqueue_script( 'yith-wcbr' );
?>