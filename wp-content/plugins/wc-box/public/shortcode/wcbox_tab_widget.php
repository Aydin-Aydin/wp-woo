<?php	

switch ($wcbox_get_cat) {
	
    case 'most_viewed_products':
        $wcbox_qf = array(
			'post_type' => 'product',
			'posts_per_page' => ''.$query_ppp.'',
			'meta_key' => 'post_views_count',														
			'orderby'  => 'meta_value_num',
			'order'  => 'DESC'
		); 
				$wcbox_query = new WP_Query( $wcbox_qf );
		
		if ($wcbox_query->have_posts()) : 

			while ($wcbox_query->have_posts()) : 
			
				$wcbox_query->the_post();
				
				$product = get_product( $wcbox_query->post->ID );
				
					// Output product information here									
				require 'product_widgett.php' ;
				
				
			endwhile;
			
		endif;

		
	break;
	// Break
    case 'featured_products':
       $wcbox_qf = array(
			'post_type' => 'product',
			'posts_per_page' => ''.$query_ppp.'',
			'meta_key' => '_featured',														
			'meta_value' => 'yes',														
			'orderby'  => 'date',
			'order'  => 'desc'
		); 
				$wcbox_query = new WP_Query( $wcbox_qf );
			
		if ($wcbox_query->have_posts()) : 

			while ($wcbox_query->have_posts()) : 
			
				$wcbox_query->the_post();
				
				$product = get_product( $wcbox_query->post->ID );
				
					// Output product information here									
				require 'product_widgett.php' ;
				
				
			endwhile;
			
		endif;
		
    break;
	// Break
    case 'top_rated_products':
			add_filter( 'posts_clauses',  array( WC()->query, 'order_by_rating_post_clauses' ) );
		$query_args = array( 'posts_per_page' => $query_ppp, 'no_found_rows' => 1, 'post_status' => 'publish', 'post_type' => 'product' );
		$query_args['meta_query'] = WC()->query->get_meta_query();
		$r = new WP_Query( $query_args );
		if ( $r->have_posts() ) {
			
			
			while ( $r->have_posts() ) {
				$r->the_post();
				// Output product information here									
				require  'product_widgett.php' ;
			}
			
			
		}
		remove_filter( 'posts_clauses', array( WC()->query, 'order_by_rating_post_clauses' ) );
		wp_reset_postdata();
    break;
	//break

    case 'best_selling_products':
       $wcbox_qf = array(
			'post_type' => 'product',
			'posts_per_page' => ''.$query_ppp.'',
			'meta_key' => 'total_sales',																											
			'orderby'  => 'meta_value_num',			
		); 
				$wcbox_query = new WP_Query( $wcbox_qf );
			
		if ($wcbox_query->have_posts()) : 

			while ($wcbox_query->have_posts()) : 
			
				$wcbox_query->the_post();
				
				$product = get_product( $wcbox_query->post->ID );
				
				// Output product information here									
				require 'product_widgett.php' ;
				
				
			endwhile;
			
		endif;
		
    break;
	//break
    case 'sale_products':
       $wcbox_qf = array(
		'posts_per_page'    => $query_ppp,
		'post_status'       => 'publish',
		'post_type'         => 'product',
		'meta_query'        => WC()->query->get_meta_query(),
		'post__in'          => array_merge( array( 0 ), wc_get_product_ids_on_sale() )
		);
		$wcbox_query = new WP_Query( $wcbox_qf );
			
		if ($wcbox_query->have_posts()) : 

			while ($wcbox_query->have_posts()) : 
			
				$wcbox_query->the_post();
				
				$product = get_product( $wcbox_query->post->ID );
				
				// Output product information here					
				require  'product_widgett.php' ;
				
			endwhile;
			
		endif;
		
    break;
	//break

    case 'recent_products':
       $wcbox_qf = array(
			'post_type' => 'product',
			'posts_per_page' => $query_ppp,
			'meta_query'  => WC()->query->get_meta_query(),	
			'order' 	=> 'desc',
			'orderby' 	=> 'date'		
		); 
		$wcbox_query = new WP_Query( $wcbox_qf );
			
		if ($wcbox_query->have_posts()) : 

			while ($wcbox_query->have_posts()) : 
			
				$wcbox_query->the_post();
				
				$product = get_product( $wcbox_query->post->ID );
				
				// Output product information here					
				require 'product_widgett.php' ;
				
			
				
			endwhile;
			
		endif;
		
    break;
	//break
}
