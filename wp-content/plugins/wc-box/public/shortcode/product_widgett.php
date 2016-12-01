<?php global $product;
?>
<div class=" wcbox_product product woocommerce wcbox_carousel_product ">
	<div class="wcbox_product_img" >
			<?php
			// Product Image
				if ( has_post_thumbnail() ) {
					$wc_image_url=	 wp_get_attachment_image_src( get_post_thumbnail_id(),'shop_catalog');
				echo '<img src="'.$wc_image_url[0].'" alt="'.get_the_title().'"/>';
				} 
				else{ echo '<img src="'.wc_placeholder_img_src('woocommerce_get_image_size_shop_thumbnail').'" alt="" />'; }
				
			
			 //Quick View
			 echo '<span ezmodal-target="#quick_view_modal" data-href="' . $product->get_permalink() . '" data-original-title="' . esc_attr__( 'Quick View', 'wcbox' ) . '" class="wcbox-quick-view"></span>';
			 ?>
		</div>
		<div class="wcbox_product_details">
		<?php if ( $product->is_on_sale() ){
			echo apply_filters( 'woocommerce_sale_flash', '<a href="'.get_the_permalink().'" class="wcbox_box_onsale">' . __( 'Sale!', 'wc-box' ) . '</a>',  $product );
		 }
		 ?>
		<a href="<?php the_permalink(); ?>" class="wcbox_product_title">
			<?php if($show_title == 'true'){the_title();}
			
			if($show_rating == 'true'){
				 if($product->get_rating_html()){
					?>
					<span class="wcbox_product_rating"><?php echo $product->get_rating_html(); ?></span>
					<?php
				}
			}
			?>	
		</a>
			<span class="wcbox_product_title"><?php if($show_price == 'true'){echo $product->get_price_html();} ?></span>
		
		
	</div>

</div>	