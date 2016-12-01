

(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note that this assume you're going to use jQuery, so it prepares
	 * the $ function reference to be used within the scope of this
	 * function.
	 *
	 * From here, you're able to define handlers for when the DOM is
	 * ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * Or when the window is loaded:
	 *

	 *
	 * ...and so on.
	 *
	 * Remember that ideally, we should not attach any more than a single DOM-ready or window-load handler
	 * for any particular page. Though other scripts in WordPress core, other plugins, and other themes may
	 * be doing this, we should try to minimize doing that in our own work.
	 */

	$(document).ready(function(){
		$("ul.tt_tabs li:nth-child(1)").addClass('active');	
		$(".tt_container  .tt_tab:nth-child(1)").addClass('active');	
		/**
		 * Product quick view popup
		 */
		var $modal = $( '#quick_view_modal' ),
			$modalBody = $modal.find( '.ezmodal-content' );

		// Open product single modal
		$( '.product' ).on( 'click', '.wcbox-quick-view', function( e ) {
			e.preventDefault();

			$modal.fadeIn(500).addClass( 'in' );
			$modalBody.html( '<div class="ajax-loading" style="position:relative;z-index:9"><i class="fa fa-spin fa-spinner"></i></div>' );
			$.get( $( this ).attr( 'data-href' ), function( response ) {
				if ( ! response ) {
					return;
				}

				var $content = $( response ).find( '.wcbox_quick_view' );

				$modalBody.html( $content );

				singleThumbCarousel();



			} );
		} );


				/**
		 * Init product single thumb carousel
		 */

		function singleThumbCarousel() {

			$( '.woocommerce .thumbnails' ).owlCarousel({
				loop:false,
				dots: false,
				nav: true,
				navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
				items:4,
				margin:10,
				autoplay: true, // type false | if you don't want auto play
			});
			
			


			$( '.woocommerce .thumbnails' ).find( 'a' ).on( 'click', function( e ) {
				e.preventDefault();
				$( '.woocommerce .images' ).find( '.woocommerce-main-image img').attr( 'src', $( this ).attr( 'href' ) );
				
			
			} );
			$( '.woocommerce-main-image').on( 'click', function(e) {
				e.preventDefault();
				var api_images = [],
					api_titles = [],
					i = 0;

				if( $( '.woocommerce .thumbnails' ).length > 0 ) {
					$( '.woocommerce .thumbnails' ).find( 'a' ).each( function(  ) {
						api_images[i] = $( this ).attr( 'href' );
						api_titles[i] = $( this ).find( 'img' ).attr( 'alt' );
						i++;
					} );
				} else {
					api_images[i] = $( this ).attr( 'href' );
					api_titles[i] = $( this ).find( 'img' ).attr( 'alt' );
				}

				$.fn.prettyPhoto({'theme': 'pp_woocommerce'});
				$.prettyPhoto.open( api_images, api_titles, '' );
			} );

		

			
	
		}
		
		


	//
	

	// Lightbox
	$(".wcbox_quick_view a.zoom").prettyPhoto({
		hook: 'data-rel',
		social_tools: false,
		theme: 'pp_woocommerce',
		horizontal_padding: 20,
		opacity: 0.8,
		deeplinking: false
	});
	$(".wcbox_quick_view a[data-rel^='prettyPhoto']").prettyPhoto({
		hook: 'data-rel',
		social_tools: false,
		theme: 'pp_woocommerce',
		horizontal_padding: 20,
		opacity: 0.8,
		deeplinking: false
	});



	 
	// Equal Product slide
	


	}); 

})( jQuery );
