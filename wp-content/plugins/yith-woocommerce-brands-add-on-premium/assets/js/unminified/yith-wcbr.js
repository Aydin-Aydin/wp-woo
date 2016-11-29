jQuery(document).ready(function ($) {
    // Filter shortcode
    $('.yith-wcbr-brand-filter .yith-wcbr-brand-filters').on('click', 'a', function (ev) {
        var t = $(this),
            filters = t.parent().find( 'a'),
            toggle = t.data( 'toggle'),
            brands_ul = t.parents('.yith-wcbr-brand-filters-wrapper').next(),
            brands = brands_ul.find( 'li'),
            brands_to_show = toggle == 'all' ? brands : brands.filter( '[data-heading="' + toggle + '"]' );

        ev.preventDefault();
        filters.removeClass( 'active' );
        t.addClass( 'active' );

        brands_ul.fadeOut( 500, function(){
            brands.hide();
            brands_to_show.show();
            brands_ul.fadeIn( 500 );
        } )
    });

    $('.yith-wcbr-brand-filter a.active').click();

    // Thumbnail carousel shortcode
    var init_thumbnail_carousel = function() {
        var window_width = $(window).outerWidth();

        $('.yith-wcbr-brand-thumbnail-carousel .swiper-container').each(function () {
            var t = $(this),
                direction = t.data('direction'),
                slidesPerView = ( window_width < 480 && direction != 'vertical' ) ? 2 : t.data('slidesperview'),
                autoplay = t.data('autoplay'),
                prev = t.parent().find('.yith-wcbr-button-prev'),
                next = t.parent().find('.yith-wcbr-button-next'),
                pagination = t.parent().find('.yith-wcbr-pagination');

            if (direction == 'vertical') {
                var wrapper = t.find('ul.swiper-wrapper'),
                    slides = wrapper.find('li'),
                    max_height = 0;

                slides.each(function () {
                    var th = $(this),
                        th_height = th.outerHeight();

                    if (th_height > max_height) {
                        max_height = th_height;
                    }
                });

                wrapper.outerHeight(max_height * slidesPerView + 15);
            }

            t.swiper({
                // Optional parameters
                slidesPerView        : slidesPerView,
                autoplay             : autoplay == 'yes' ? 1500 : 0,
                direction            : direction,
                nextButton           : next,
                prevButton           : prev,
                pagination           : pagination,
                paginationClickable  : true,
                watchSlidesVisibility: true,
                onInit               : function (swiper) {
                    swiper.slides.filter('.swiper-slide-visible').removeClass('last').last().addClass('last');
                },
                onTransitionStart    : function (swiper) {
                    swiper.slides.filter('.swiper-slide-visible').removeClass('last').last().addClass('last');
                }
            });
        });
    };

    init_thumbnail_carousel();
    $(window).on( 'resize', init_thumbnail_carousel );

    // Thumbnail carousel shortcode
    var init_product_thumbnail = function(){
        var window_width = $(window).outerWidth();

        $( '.yith-wcbr-product-carousel .swiper-container').each( function() {
            var t = $(this),
                direction = t.data('direction'),
                slidesPerView = ( window_width < 480 && direction != 'vertical' ) ? 2 : t.data('slidesperview'),
                autoplay = t.data('autoplay') == 'yes' ? 1500 : 0,
                prev = t.parent().find( '.yith-wcbr-button-prev'),
                next = t.parent().find( '.yith-wcbr-button-next'),
                pagination = t.parent().find( '.yith-wcbr-pagination' );

            if( direction == 'vertical' ){
                var wrapper = t.find( 'ul.swiper-wrapper'),
                    slides = wrapper.find( 'li'),
                    max_height = 0;

                slides.each( function(){
                    var th = $(this),
                        th_height = th.outerHeight();

                    if( th_height > max_height ){
                        max_height = th_height;
                    }
                } );

                wrapper.outerHeight( max_height * slidesPerView + 15 );
            }

            if( t.find( '.swiper-wrapper' ).parent().is('.yit-wcan-container') ){
                t.find( '.swiper-wrapper' ).unwrap();
            }

            t.swiper({
                // Optional parameters
                slidesPerView: slidesPerView,
                direction: direction,
                autoplay: autoplay,
                nextButton: next,
                prevButton: prev,
                pagination: pagination,
                paginationClickable: true,
                watchSlidesVisibility: true,
                onInit: function(swiper){
                    swiper.slides.filter( '.swiper-slide-visible' ).removeClass( 'last' ).last().addClass( 'last' );
                },
                onTransitionStart: function(swiper){
                    swiper.slides.filter( '.swiper-slide-visible' ).removeClass( 'last' ).last().addClass( 'last' );
                }
            });
        });
    };

    init_product_thumbnail();
    $(window).on( 'resize', init_product_thumbnail );
    $(document).on( 'yith-wcan-wrapped', init_product_thumbnail );

    // Brands select shortcode
    $( '.yith-wcbr-brand-select select' ).select2().on( 'change', function(e) {
        var option = $( e.currentTarget).find( 'option[value="' + e.val + '"]'),
            href = option.data( 'href' );

        if( typeof( href ) != 'undefined' ){
            window.location = href;
        }
    });

    // Brands grid shortcode
    $( '.yith-wcbr-brand-grid select.yith-wcbr-category-dropdown' ).select2().on( 'change', function(e) {
        var t = $(this),
            searched_category = e.val,
            shortcode = t.parents('.yith-wcbr-brand-grid'),
            brands_ul = shortcode.find( '.yith-wcbr-brands-list' ),
            brands = brands_ul.find( 'li');

        brands_ul.fadeOut( 500, function() {
            brands.each(function () {
                var brand = $(this),
                    related_categories = brand.data('categories'),
                    heading_container = brand.parents('.yith-wcbr-same-heading-box'),
                    found = false,
                    reset = false;

                if( searched_category == 0 ){
                    brand.removeClass('hidden').show();
                    reset = true;
                }

                if( ! reset ) {
                    if ( $.inArray( searched_category + "", related_categories) > -1 ) {
                        found = true;
                    }

                    if ( !found ) {
                        brand.addClass('hidden').hide();
                    }
                    else {
                        brand.removeClass('hidden').show();
                    }
                }

                if( heading_container.find( 'li').not('.hidden').length == 0 ){
                    heading_container.hide();
                }
                else{
                    heading_container.show();
                }
            } );

            brands_ul.fadeIn( 500 );
        } );
    });

    // Filter Brands grid
    $('.yith-wcbr-brand-grid .yith-wcbr-brand-filters').on('click', 'a', function (ev) {
        var t = $(this),
            filters = t.parent().find( 'a'),
            reset = filters.filter( '.reset' ),
            brands_ul = t.parents('.yith-wcbr-brand-grid').find( '.yith-wcbr-brands-list' ),
            brands = brands_ul.find( 'li'),
            searched_categories = [];

        ev.preventDefault();

        if( t.is( '.reset' ) ){
            filters.removeClass( 'active' );
            t.addClass( 'active' );
        }
        else if( t.is( '.active' ) ){
            if( filters.filter( '.active').length != 1 ){
                t.removeClass( 'active' );
            }
            else{
                return;
            }
        }
        else{
            reset.removeClass( 'active' );
            t.addClass( 'active' );
        }

        filters.filter( '.active' ).each( function(){
            var filter = $(this);

            searched_categories.push( filter.data( 'term_id' ) );
        } );

        brands_ul.fadeOut( 500, function() {
            brands.each(function () {
                var brand = $(this),
                    related_categories = brand.data('categories'),
                    heading_container = brand.parents('.yith-wcbr-same-heading-box'),
                    found = false,
                    reset = false;

                if( t.is( '.reset' ) ){
                    brand.removeClass('hidden').show();
                    reset = true;
                }

                if( ! reset ) {
                    for (var i in searched_categories) {
                        if ($.inArray(searched_categories[i] + "", related_categories) > -1) {
                            found = true;
                            break;
                        }
                    }

                    if (!found) {
                        brand.addClass('hidden').hide();
                    }
                    else {
                        brand.removeClass('hidden').show();
                    }
                }

                if( heading_container.find( 'li').not('.hidden').length == 0 ){
                    heading_container.hide();
                }
                else{
                    heading_container.show();
                }
            } );

            brands_ul.fadeIn( 500 );
        } );
    });

    $('.yith-wcbr-brand-grid .yith-wcbr-brand-scroll').on('click', 'a', function(ev){
        var t = $(this),
            heading = t.data('toggle'),
            shortcode = t.parents('.yith-wcbr-brand-grid');

        ev.preventDefault();

        if( shortcode.find( '.yith-wcbr-same-heading-box[data-heading="' + heading + '"]:visible').length > 0 ) {
            $('html, body').animate({scrollTop: shortcode.find('.yith-wcbr-same-heading-box[data-heading="' + heading + '"]:visible').offset().top}, 'slow');
        }
    })
});