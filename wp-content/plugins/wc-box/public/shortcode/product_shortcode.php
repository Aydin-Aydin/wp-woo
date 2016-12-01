<?php global $product;
?>
<li class="product woocommerce wcbox_carousel_product">
	<div class="col-xs-12">																
		<div class="wcbox_image">
			<?php
			// Product Image
				if ( has_post_thumbnail() ) {
					$wc_image_url=	 wp_get_attachment_image_src( get_post_thumbnail_id(),'shop_catalog');
				echo '<img src="'.$wc_image_url[0].'" alt="'.get_the_title().'"/>';
				} 
				else{ echo '<img src="'.wc_placeholder_img_src('woocommerce_get_image_size_shop_thumbnail').'" alt="" />'; }
				
			// Product On SALE
			if ( $product->is_on_sale() ){
				echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale" style="z-index:1">' . __( 'Sale!', 'wc-box' ) . '</span>',  $product );
			 }
			 //Quick View
			 echo '<span ezmodal-target="#quick_view_modal" data-href="' . $product->get_permalink() . '" data-original-title="' . esc_attr__( 'Quick View', 'wcbox' ) . '" class="wcbox-quick-view"></span>';
			 ?>
		</div>
		<a href="<?php the_permalink(); ?>">
			<?php if($show_title == 'true'){
				?>
				<h3><?php the_title(); ?></h3>
				<?php
			}
			
			if($show_rating == 'true'){
				 if($product->get_rating_html()){
					?>
					<span class="wcbox_product_rating"><?php echo $product->get_rating_html(); ?></span>
					<?php
				}
			}
			if($show_price == 'true'){
				echo $product->get_price_html();
			}
			
			?>	
		</a>	
		
		
	</div>
	<div class="col-xs-12">
		<?php if($show_btn == 'true'){
			woocommerce_template_loop_add_to_cart();
			}
			 ?>
	</div>	
</li>	