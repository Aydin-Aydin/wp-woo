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

<div class="yith-wcbr-brand-grid <?php echo esc_attr( $category_filter_style )?>">

	<?php if ( ! empty( $title ) ): ?>
		<h3><?php echo $title ?></h3>
	<?php endif; ?>

	<?php if( $show_filtered_by == 'name' && $show_category_filter && ! empty( $categories ) ): ?>
		<div class="yith-wcbr-brand-filters-wrapper">
			<div class="yith-wcbr-brand-filters <?php echo esc_attr( $category_filter_type )?>">
				<?php
				if( $category_filter_type == 'multiselect' ):
					foreach( $categories as $category ):
					?><a href="#" <?php echo $category->term_id == 0 ? 'class="reset active"' : '' ?> data-term_id="<?php echo esc_attr( $category->term_id ) ?>" >
						<?php echo esc_attr( $category-> name ) ?>
					</a><?php
					endforeach;
				elseif( $category_filter_type == 'dropdown' ): ?>
					<select class="yith-wcbr-category-dropdown" style="max-width: 300px">
						<?php
						foreach( $categories as $category ):
							?>
							<option value="<?php echo esc_attr( $category->term_id ) ?>"><?php echo esc_attr( $category-> name ) ?></option>
						<?php
						endforeach;
						?>
					</select>
				<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>

	<?php if ( $show_filtered_by == 'name' && $show_name_filter == 'yes' && ! empty( $available_filters ) ): ?>
		<div class="yith-wcbr-brand-scroll-wrapper">
			<div class="yith-wcbr-brand-scroll" >
				<?php
				$first = true;
				foreach ( $stack as $letter ):
					?><a href="#" data-toggle="<?php echo esc_attr( $letter ) ?>"><?php echo esc_attr( $letter )?></a><?php
				endforeach;
				?>
			</div>
		</div>
	<?php endif; ?>

	<?php if( ! empty( $terms ) ): ?>
		<div class="yith-wcbr-brands-list">
			<?php if( $show_filtered_by != 'none' ): ?>
				<?php foreach( $filtered_terms as $filter => $single_filter_terms ): ?>
					<?php if( ! empty( $single_filter_terms ) ): ?>
						<div class="yith-wcbr-same-heading-box" data-heading="<?php echo esc_attr( $filter ) ?>">
							<h4>
								<?php
								if( $show_filtered_by == 'name' ){
									$name = esc_attr( $filter );
								}
								else{
									$category = get_term( $filter, 'product_cat' );
									$name = esc_attr( $category->name );
								}

								echo $name;
								?>
							</h4>
							<ul>
								<?php
								$count = 0;
								$current_row = 1;
								$total = count( $single_filter_terms );
								$rows = ceil( $total / $cols );

								foreach( $single_filter_terms as $term ) {
									$classes = '';
									$classes .= ( $count % $cols == 0 ) ? 'first' : '';
									$classes .= ( $current_row == $rows ) ? ' last-row' : '';
									$count ++;

									if ( $count % $cols == 0 ) {
										$current_row ++;
									}

									yith_wcbr_get_template(
										'brand-grid-loop',
										array(
											'term'        => $term,
											'show_image'  => $show_image,
											'show_name'   => $show_name,
											'show_count'  => $show_count,
											'classes'     => $classes,
											'cols_width'  => $cols_width,
											'brand_category' => isset( $brand_category_relationship[ $term->term_id ] ) ? $brand_category_relationship[ $term->term_id ] : array()
										),
										'shortcodes'
									);
								}
								?>
							</ul>
						</div>
					<?php endif;?>
				<?php endforeach; ?>
			<?php else: ?>
				<ul>
					<?php
						$count = 0;
						$current_row = 1;
						$total = count( $terms );
						$rows = ceil( $total / $cols );

						foreach( $terms as $term ){
							$classes = '';
							$classes .= ( $count % $cols == 0 ) ? 'first' : '';
							$classes .= ( $current_row == $rows ) ? ' last-row' : '';
							$count ++;

							if ( $count % $cols == 0 ) {
								$current_row ++;
							}

							yith_wcbr_get_template(
								'brand-grid-loop',
								array(
									'term' => $term,
									'show_image' => $show_image,
									'show_name' => $show_name,
									'show_count' => $show_count,
									'classes'     => $classes,
									'cols_width'  => $cols_width
								),
								'shortcodes'
							);
						}
					?>
				</ul>
			<?php endif; ?>
		</div>
	<?php endif; ?>

</div>

<?php wp_enqueue_script( 'yith-wcbr' ) ?>