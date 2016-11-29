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

<div class="woocommerce yith-wcbr-brand-thumbnail-carousel <?php echo esc_attr( $style ) ?> <?php echo esc_attr( $direction ) ?>">

	<div class="yith-wcbr-carousel-title">
		<?php if( ! empty( $title ) ): ?>
			<h3><?php echo $title ?></h3>
		<?php endif; ?>
	</div>

	<?php if( $style == 'shadow' ): ?>
		<div class="yith-wcbr-carousel-pagination-wrapper">
			<?php if( $pagination == 'yes' ): ?>
				<div class="yith-wcbr-pagination <?php echo esc_attr( $pagination_style ) ?>"></div>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<div class="yith-wcbr-thumbnail-list swiper-container" data-slidesperview="<?php echo esc_attr( $cols ) ?>" data-direction="<?php echo esc_attr( $direction ) ?>" data-autoplay="<?php echo esc_attr( $autoplay )?>">
		<?php if( ! empty( $terms ) ): ?>
			<ul class="swiper-wrapper">
			<?php
			foreach( $terms as $term ):
				?>
				<li class="swiper-slide">
					<?php
					$thumbnail_id = absint( yith_wcbr_get_term_meta( $term->term_id, 'thumbnail_id', true ) );

					if ( $thumbnail_id ) {
						$image = wp_get_attachment_image_src( $thumbnail_id, 'yith_wcbr_grid_logo_size' );

						if( $image ){
							$output = sprintf( '<a href="%s" title="%s"><img src="%s" width="%d" height="%d" alt="%s"/>', get_term_link( $term ), $term->name, $image[0], $image[1], $image[2], $term->name );

							if( $show_name == 'yes' || $show_rating == 'yes' ){

								$output .= '<div class="brand-info">';

								if( $show_name == 'yes' ){
									$output .= $term->name;
								}

								if( $show_rating == 'yes' ){
									$output .= YITH_WCBR_Premium()->get_average_term_rating_html( $term->term_id );
								}

								$output .= '</div>';
							}

							$output .= '</a>';

							echo $output;
						}
					}
					elseif( get_option( 'yith_wcbr_use_logo_default' ) == 'yes' ) {
						do_action( 'yith_wcbr_no_brand_logo', $term->term_id, $term, 'yith_wcbr_grid_logo_size', $show_name == 'yes', $show_rating == 'yes' );
					}
					else{
						?>
						<a href="<?php echo esc_url( get_term_link( $term ) ) ?>">
							<?php echo $term->name ?>

							<?php if( $show_name == 'yes' || $show_rating == 'yes' ): ?>
								<div class="brand-info">
									<?php if( $show_name == 'yes' ): ?>
										<?php echo $term->name ?>
									<?php endif; ?>

									<?php if( $show_rating == 'yes' ): ?>
										<?php echo YITH_WCBR_Premium()->get_average_term_rating_html( $term->term_id )?>
									<?php endif; ?>
								</div>
							<?php endif; ?>
						</a>
					<?php
					}
					?>
				</li>
			<?php endforeach; ?>
			</ul>
		<?php endif; ?>

	</div>

	<?php if( $style != 'shadow' ): ?>
		<div class="yith-wcbr-carousel-pagination-wrapper">
			<?php if( $prev_next == 'yes' && $style == 'background' ): ?>
				<div class="yith-wcbr-button-prev <?php echo esc_attr( $prev_next_style ) ?>"></div>
			<?php endif; ?>

			<?php if( $pagination == 'yes' ): ?>
				<div class="yith-wcbr-pagination <?php echo esc_attr( $pagination_style ) ?>"></div>
			<?php endif; ?>

			<?php if( $prev_next == 'yes' && $style == 'background' ): ?>
				<div class="yith-wcbr-button-next <?php echo esc_attr( $prev_next_style ) ?>"></div>
			<?php endif; ?>
		</div>
	<?php endif; ?>


	<?php if( $prev_next == 'yes' && $style != 'background' ): ?>
		<div class="yith-wcbr-button-wrapper">
			<div class="yith-wcbr-button-prev <?php echo esc_attr( $prev_next_style ) ?>"></div>
			<div class="yith-wcbr-button-next <?php echo esc_attr( $prev_next_style ) ?>"></div>
		</div>
	<?php endif; ?>

</div>

<?php wp_enqueue_script( 'yith-wcbr' ); ?>