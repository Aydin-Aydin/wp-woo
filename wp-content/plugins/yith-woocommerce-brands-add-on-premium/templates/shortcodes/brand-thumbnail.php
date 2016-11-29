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

$count = 0;
$current_row = 1;
$total = count( $terms );
$rows = ceil( $total / $cols );
?>

<div class="yith-wcbr-brand-thumbnail <?php echo $style ?>">

	<?php if( ! empty( $title ) ): ?>
		<h3><?php echo $title ?></h3>
	<?php endif; ?>

	<div class="yith-wcbr-thumbnail-list">
		<?php if( ! empty( $terms ) ): ?>
			<ul>
				<?php
				foreach( $terms as $term ):
					$classes = '';
					$classes .= ( $count % $cols == 0 ) ? 'first' : '';
					$classes .= ( $current_row == $rows ) ? ' last-row' : '';
					$count++;

					if( $count % $cols == 0 ){
						$current_row++;
					}
					?>
					<li style="width: <?php echo $cols_width?>%" class="<?php echo esc_attr( $classes )?>" >
						<?php
						$thumbnail_id = absint( yith_wcbr_get_term_meta( $term->term_id, 'thumbnail_id', true ) );

						if ( $thumbnail_id ) {
							$image = wp_get_attachment_image_src( $thumbnail_id, 'yith_wcbr_grid_logo_size' );

							if( $image ){
								echo sprintf( '<a href="%s" title="%s"><img src="%s" width="%d" height="%d" alt="%s"/></a>', get_term_link( $term ), $term->name, $image[0], $image[1], $image[2], $term->name );
							}
						}
						elseif( get_option( 'yith_wcbr_use_logo_default' ) == 'yes' ) {
							do_action( 'yith_wcbr_no_brand_logo', $term->term_id, $term, 'yith_wcbr_grid_logo_size', false, false );
						}
						else{
						?>
							<a href="<?php echo esc_url( get_term_link( $term ) ) ?>">
								<?php echo $term->name ?>
							</a>
						<?php
						}
						?>
					</li>
				<?php endforeach;?>
			</ul>
		<?php endif; ?>
	</div>

	<div class="yith-wcbr-brands-pagination">
		<?php
		if( isset( $page_links ) ){
			echo $page_links;
		}
		?>
	</div>

</div>