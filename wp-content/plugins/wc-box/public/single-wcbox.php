<?php
 /*Template Name: New Template
 */
 
get_header(); ?>
<div id="primary">
    <div id="content" role="main">
		<div class="container" style="margin-top:100px">
			<div class="row">
				<div class="col-md-12">
				<?php
				
				while ( have_posts() ) : the_post();
				?>
				
					<?php
	// metabox

	// Tab Options
	
	$animation_effect = vp_metabox('wcbox_meta.wcbox_tav.0.wcbox_effect');
	$tab_ative_color = vp_metabox('wcbox_meta.wcbox_tav.0.wcbox_cl_2');
	$tab_bg_active = vp_metabox('wcbox_meta.wcbox_tav.0.wcbox_cl_1');
	$tab_txt_color = vp_metabox('wcbox_meta.wcbox_tav.0.wcbox_ss_1');
	
	// Product Options
	$img_hover = vp_metabox('wcbox_meta.wcbox_product_option.0.wcbox_cl_1');

	$hover_ico = vp_metabox('wcbox_meta.wcbox_product_option.0.wcbox_hover_ico');
	
	$product_title_color = vp_metabox('wcbox_meta.wcbox_product_option.0.wcbox_cl_2');
	$product_rating_color = vp_metabox('wcbox_meta.wcbox_product_option.0.wcbox_cl_3');	

	$show_title = vp_metabox('wcbox_meta.wcbox_product_option.0.wcbox_rb_1');
	$show_rating = vp_metabox('wcbox_meta.wcbox_product_option.0.wcbox_rb_2');
	$show_price = vp_metabox('wcbox_meta.wcbox_product_option.0.wcbox_rb_3');
	$show_btn = vp_metabox('wcbox_meta.wcbox_product_option.0.wcbox_rb_4');
	
	// Carousel Options
	$product_margin = vp_metabox('wcbox_meta.wcbox_carousel_option.0.wcbox_product_margin');
	$product_loop = vp_metabox('wcbox_meta.wcbox_carousel_option.0.wcbox_rb_1');
	$product_stage = vp_metabox('wcbox_meta.wcbox_carousel_option.0.wcbox_padding_satge');
	$navgiation = vp_metabox('wcbox_meta.wcbox_carousel_option.0.wcbox_nav_2');
	$pagination = vp_metabox('wcbox_meta.wcbox_carousel_option.0.wcbox_dots_2');
	$wcbox_autoplay = vp_metabox('wcbox_meta.wcbox_carousel_option.0.wcbox_autoplay');
	$wcbox_autoplayTimeout = vp_metabox('wcbox_meta.wcbox_carousel_option.0.wcbox_autoplayTimeout');
	// Responsive Layout 
	$wcbox_colum = vp_metabox('wcbox_meta.wcbox_carousel_option.0.wcbox_cl_1');
	$wcbox_colum_t = vp_metabox('wcbox_meta.wcbox_carousel_option.0.wcbox_cl_2');
	$wcbox_colum_m = vp_metabox('wcbox_meta.wcbox_carousel_option.0.wcbox_cl_3');
	
	$query_ppp = vp_metabox('wcbox_meta.wcbox_get_q.0.wcbox_ppp_cat');
	$cat_ppp = vp_metabox('wcbox_meta.wcbox_get_q.0.wcbox_categories_1');
	$tag_ppp = vp_metabox('wcbox_meta.wcbox_get_q.0.wcbox_tags_1');
	
	//Filtter
	$wcbox_q =	vp_metabox('wcbox_meta.wcbox_get_q.0.filter_type');
	
	$wcbox_sidebar_slider =	vp_metabox('wcbox_widget_id.group.0.ss_check');
	$wcbox_sidebar =	vp_metabox('wcbox_widget_id.group.0.enable_widget');
	
	
	
	// metabox
	
 ?>
    

	    <!-- - - - - - -  - - - HORIZONTAL TAB - - - - - -  - - - - - -->
	<script type="text/javascript">
	jQuery(document).ready(function(){
	jQuery('.wcbox_slider_<?php echo $id;?>').turbotabs({			

		width : "100%",
		animation :'<?php echo $animation_effect;?>',
		navAlign : 'center',
		mode: 'horizontal', // accordion ,horizontal
		headingTextColor : ''
	}); 
	jQuery(".wcbox_slider_<?php echo $id;?> .owlw").owlCarousel(
		{
			

			loop:<?php echo $product_loop;?>,
			dots: <?php echo $pagination;?>,
			nav: <?php echo $navgiation;?>,
			items:<?php if($wcbox_sidebar == 'yes'){if($wcbox_sidebar_slider == 'slider'){echo '1' ;}else{echo $wcbox_colum;}}else{echo $wcbox_colum;}?>,
			margin:<?php echo $product_margin;?>,
			
			autoplay: <?php echo $wcbox_autoplay;?>, // type false | if you don't want auto play
			autoplayTimeout: <?php echo $wcbox_autoplayTimeout;?>, // 1 sec = 1000
			navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
			responsive:{
			480:{
				items:<?php if($wcbox_sidebar == 'yes'){if($wcbox_sidebar_slider == 'slider'){echo '1' ;}else{echo $wcbox_colum;}}else{echo $wcbox_colum_m;}?>
			},
			768:{
				items:<?php if($wcbox_sidebar == 'yes'){if($wcbox_sidebar_slider == 'slider'){echo '1' ;}else{echo $wcbox_colum;}}else{echo $wcbox_colum_t;}?>
				
			},
			980:{
				items:<?php if($wcbox_sidebar == 'yes'){if($wcbox_sidebar_slider == 'slider'){echo '1' ;}else{echo $wcbox_colum;}}else{echo $wcbox_colum;}?>
			}
		},
			
	  
		}
	);	
	}); 
	</script>
	<style type="text/css">
	.wcbox_slider_<?php echo $id;?> .tt_tabs {		
		margin: 0 !important;
		padding: 0 !important;
		
		}

	.wcbox_slider_<?php echo $id;?> .cl-effect-21 .t_name 
	{color:<?php echo $tab_txt_color;?>;}

	.wcbox_slider_<?php echo $id;?> .wcbox_box_onsale , .wcbox_slider_<?php echo $id;?> .cl-effect-21 .active .t_name
	
	{		color:<?php echo $tab_ative_color; ?> !important ;}

	
	.wcbox_slider_<?php echo $id;?> .cl-effect-21 .t_name::before ,
	.wcbox_slider_<?php echo $id;?> .cl-effect-21 .t_name::after,
	.wcbox_slider_<?php echo $id;?> .wcbox_box_onsale
	{
		background:<?php echo $tab_bg_active; ?>;
	}
	.wcbox_slider_<?php echo $id;?> .cl-effect-21 .active
	{
		background:<?php echo $tab_bg_active; ?>;
	}
	.wcbox_slider_<?php echo $id;?> .wcbox-quick-view
	{
		background:<?php echo $img_hover; ?>;
	}
	.wcbox_slider_<?php echo $id;?> .wcbox-quick-view:before
	{
		color:<?php echo $hover_ico; ?>;
	}
	.wcbox_slider_<?php echo $id;?> h3{color:<?php echo $product_title_color;?>;}
	.wcbox_slider_<?php echo $id;?> .woocommerce .star-rating span:before{color:<?php echo $product_rating_color;?> !important;}
	
	</style>
	
    <div class="wcbox_slider_<?php echo $id;?>">
            <!-- - - - - - Tab navigation - - - - - - -->
	
	
            <ul class="tt_tabs cl-effect-21">
		
			<?php
			
			if($wcbox_q == 'category'){ $slides = vp_metabox('wcbox_meta.wcbox_get_q.0.filter_category');}
			elseif($wcbox_q == 'tags'){$slides = vp_metabox('wcbox_meta.wcbox_get_q.0.filter_tag');}
			elseif($wcbox_q == 'query'){$slides = vp_metabox('wcbox_meta.wcbox_get_q.0.filter_query');}
			
			if($wcbox_q == 'category' || $wcbox_q == 'tags'){
				foreach($slides as $slide) {
							?>
							<li><span class="t_name"><?php echo $slide; ?></span></li>		
							<?php
						}
			}
			
			if($wcbox_q == 'query' ){	
			foreach($slides as $slide) {			
						
			$wcbox_get_cat_name = ''.$slide.'';
			?>	
                <li><span class="t_name"><?php require( plugin_dir_path( __FILE__ ) . 'shortcode/wcbox_tab_name.php');?></span></li>
			<?php 				
			}
			}
			 
			 
				
			  
		 ?>
            </ul>
            <!-- - - - - Tab Content - - - - - -->
            <div class="tt_container">
				<?php
				 if($wcbox_q == 'category'){ $slides = vp_metabox('wcbox_meta.wcbox_get_q.0.filter_category');}
				 elseif($wcbox_q == 'tags'){$slides = vp_metabox('wcbox_meta.wcbox_get_q.0.filter_tag');}
				 elseif($wcbox_q == 'query'){$slides = vp_metabox('wcbox_meta.wcbox_get_q.0.filter_query');}
				 elseif($wcbox_q == 'specific_id'){$slides = vp_metabox('wcbox_meta.wcbox_get_q.0.filter_id');}
				 
				
				
				
				 if($wcbox_q == 'specific_id'){
					 $slides = vp_metabox('wcbox_meta.wcbox_get_q.0.filter_id');
					 
						 ?>
					<div class=" tt_tab active">
						<div class="woocommerce">
							<ul class="products <?php if($wcbox_sidebar == 'yes'){if($wcbox_sidebar_slider == 'slider'){echo 'owlw' ;}else{}}else{echo 'owlw';}?>">
					<?php
							
							$args = array(
							'post__in' => $slides, // id of a page, post, or custom type
							'post_type' => 'product',
							'ignore_sticky_post' => 1
							);
							$the_query = new WP_Query( $args );
							if($the_query->have_posts()) :							
							while($the_query->have_posts()) : $the_query->the_post();
								// Product Details
								if($wcbox_sidebar == 'yes'){
									if($wcbox_sidebar_slider == 'slider'){
											require( plugin_dir_path( __FILE__ ) . 'shortcode/product_shortcode.php');	
										}
										else{
											require( plugin_dir_path( __FILE__ ) . 'shortcode/product_widgett.php');
										}
									}
									else{
										require( plugin_dir_path( __FILE__ ) . 'shortcode/product_shortcode.php');
									}
								
													
							endwhile; 
							endif; 

							
				?>
						</ul>
					</div>
				</div>
				
			

				<?php
				}
				if($wcbox_q == 'query'){
				foreach($slides as $slide) {
				
							?>
				 <div class=" tt_tab">
					<div class="woocommerce">
					
					<ul class="products <?php if($wcbox_sidebar == 'yes'){if($wcbox_sidebar_slider == 'slider'){echo 'owlw' ;}else{}}else{echo 'owlw';}?>">
							<?php
							$wcbox_get_cat = ''.$slide.'';
							
								// Product Details
								if($wcbox_sidebar == 'yes'){
									if($wcbox_sidebar_slider == 'slider'){
											
											require( plugin_dir_path( __FILE__ ) . 'shortcode/wcbox_tab_shortcode.php');	
										}
										else{
											
											require( plugin_dir_path( __FILE__ ) . 'shortcode/wcbox_tab_widget.php');
										}
									}
									else{
										require( plugin_dir_path( __FILE__ ) . 'shortcode/wcbox_tab_shortcode.php');
									}							
							

							?>							
						</ul>
					</div>
						
				</div>		
							<?php
						}
				}
				if($wcbox_q == 'category' || $wcbox_q == 'tags'){
				foreach($slides as $slide) {
							?>
				 <div class=" tt_tab">
					<div class="woocommerce">
					
						<ul class="products <?php if($wcbox_sidebar == 'yes'){if($wcbox_sidebar_slider == 'slider'){echo 'owlw' ;}else{}}else{echo 'owlw';}?>">
						
							<?php
							
							 if($wcbox_q == 'category'){
								$args = array(
										'posts_per_page' => ''.$cat_ppp.'',										
										'post_type' => 'product',
										'product_cat' => ''.$slide.'',
										'ignore_sticky_post' => 1
										
									);	 
							 }
							 elseif($wcbox_q == 'tags'){
								 $args = array(
										'posts_per_page' => ''.$tag_ppp.'',										
										'post_type' => 'product',
										'product_tag' => ''.$slide.'',
										'ignore_sticky_post' => 1
										
									);}

									$the_query = new WP_Query( $args );
							if($the_query->have_posts()) :							
							while($the_query->have_posts()) : $the_query->the_post();
							
								// Product Details
								if($wcbox_sidebar == 'yes'){
									if($wcbox_sidebar_slider == 'slider'){
											require( plugin_dir_path( __FILE__ ) . 'shortcode/product_shortcode.php');	
										}
										else{
											require( plugin_dir_path( __FILE__ ) . 'shortcode/product_widgett.php');
										}
									}
									else{
										require( plugin_dir_path( __FILE__ ) . 'shortcode/product_shortcode.php');
									}
							endwhile; 
							endif; 
							
							
							?>							
						</ul>
					</div>
						
				</div>		
							<?php
						}
				}
				
				?>     	
            </div>	

    </div><!-- #myTab -->
    <!-- Query in Query--> 
  
 
				<?php endwhile; ?>
				</div>
			</div>
		</div>
    
    </div>
</div>
<?php wp_reset_query(); ?>
<?php get_footer(); ?>