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

	<div class="yith-wcbr-brand-filter <?php echo $style ?>">

		<?php if ( ! empty( $title ) ): ?>
			<h3><?php echo $title ?></h3>
		<?php endif; ?>

		<?php if ( $show_filter == 'yes' && ! empty( $available_filters ) ): ?>
			<div class="yith-wcbr-brand-filters-wrapper">
				<div class="yith-wcbr-brand-filters" <?php echo ( $style == 'highlight' && ! empty( $highlight_color ) ) ? "style='background-color: $highlight_color'" : "" ?> >
					<?php if ( $show_reset == 'yes' ): ?>
						<a href="#" data-toggle="all" class="active reset"><?php echo apply_filters( 'yith_wcbr_filter_reset_label', __( 'All', 'yith-wcbr' ) ) ?></a>
						<span class="reset-separator"></span>
					<?php endif; ?>
					<?php
					$first = true;
					foreach ( $stack as $letter ):
						$class = ( $first && $show_reset != 'yes' ) ? 'active' : '';
						?>
						<a href="#" data-toggle="<?php echo esc_attr( $letter ) ?>" class="<?php echo $class?>"><?php echo esc_attr( $letter )?></a>
						<?php
						$first = false;
					endforeach;
					?>
				</div>
			</div>
		<?php endif; ?>

		<div class="yith-wcbr-brands-list">
			<?php if ( ! empty( $terms ) ): ?>
				<ul>
					<?php foreach ( $terms as $term ): ?>
						<li data-heading="<?php echo isset( $term->heading ) ? $term->heading : '' ?>">
							<a href="<?php echo esc_url( get_term_link( $term ) ) ?>">
								<?php echo $term->name ?>
								<?php if ( $show_count == 'yes' ): ?>
									<span class="brand-count" <?php echo ( $style == 'highlight' && ! empty( $highlight_color ) ) ? "style='background-color: $highlight_color'" : "" ?> ><?php echo $term->count ?></span>
								<?php endif; ?>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>

		<?php if ( isset( $page_links ) ): ?>
			<nav class="yith-wcbr-brands-pagination woocommerce-pagination">
				echo $page_links;
			</nav>
		<?php endif; ?>

	</div>

<?php wp_enqueue_script( 'yith-wcbr' ); ?>