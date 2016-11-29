=== YITH WooCommerce Brands Add-On ===

Contributors: yithemes
Tags: brand, brands, logo, manufacturer, yit, e-commerce, ecommerce, shop, supplier, woocommerce brand, woocommerce filter, filter, brand filter, woocommerce manufacturer, woocommerce supplier, brands for woocommerce, brands for wc, product brands, brands for products
Requires at least: 4.0
Tested up to: 4.5.2
Stable tag: 1.0.8
License: GPLv2 or later
Documentation: http://yithemes.com/docs-plugins/yith-woocommerce-brands-add-on

== Changelog ==

= 1.0.8 - Released: Jun, 13 - 2016 =

* Fixed: removed "meta_query" from get_terms when WC < 2.6

= 1.0.7 - Released: Jun, 10 - 2016 =

* Added: WordPress 4.5.2 support
* Added: WooCommerce 2.6-RC1 support
* Tweak: deprecated function that refers directly to woocommerce_termmeta
* Tweak: added meta_query in get_terms to filter brands without image
* Tweak: added yith_wcbr_get_terms to pass different params to get_terms for WP > 4.5
* Fixed: hide_no_image flag in Brand Thumbnail Carousel and Brand Thumbnail widgets
* Fixed: admin filed css issue (line height for image size)

= 1.0.6 - Released: May, 02 - 2016 =

* Added: WordPress 4.5.1 support
* Added: WooCommerce 2.5.5 support
* Added: options to set brands thumb dimensions
* Added: "Before product title" position for single product brand
* Added: flag with_front on register_taxonomy, with filter yith_wcbr_taxonomy_with_front to change default value
* Added: Rich Snippets for brand
* Added: Integration with YOAST Seo (%%product_brand%% for products)
* Added: fix for WCAN (adding .yit-wcan-container in swiper carousel)
* Added: filter yith_customize_product_carousel_loop to customize $woocommerce_loop before product carousel
* Added: filter yith_wcbr_print_brand_description to hide product brand description
* Added: filter yith_wcbr_taxonomy_label for brand label
* Added: transients yith_wcbr_brand_category_relationships and yith_wcbr_category_brand_relationships to improve performance of shortcodes callbacks
* Tweak: updated Swiper library to revision 3.3.0
* Fixed: error including assets on backend caused by wrong screen id

= 1.0.5 - Released: Oct, 23 - 2015 =

* Tweak: Performance improved with new plugin core 2.0
* Fixed: plugin-fw breaking theme-editor.php page

= 1.0.4 - Released: Sep, 21 - 2015 =

* Added: yith_wcbr_taxonomy_capabilities filter
* Added: YITH WooCommerce Multi Vendor Support
* Fixed: "All" placeholder disappearing on select2 dropdown

= 1.0.3 - Released: Aug, 13 - 2015 =

* Added: Compatibility with WC 2.4.2
* Tweak: Updated internal plugin-fw

= 1.0.2 - Released: Jul, 13 - 2015 =

* Added: WC 2.3.13 support
* Added: improved YITH WooCommerce Product Filter compatibility
* Fixed: minor bugs

= 1.0.1 - Released: Jun, 18 - 2015 =

* Initial release