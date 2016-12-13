<?php
/**
 * The template for displaying product widget entries
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-widget-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product; ?>
<li class="grid-item">
	<a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
    <div class="imgLiquidFill imgLiquid" style="background-image: url('<?php echo wp_get_attachment_image_src( get_post_thumbnail_id($product->id), 'thumbnail-size', true)[0] ?>');">
      	<?php echo $product->get_image(); ?>
    </div>
    <div class="text-wrapper">

      <span class="text-item product-title">
        <?php echo $product->get_title(); ?>
      </span>

      <?php if ( ! empty( $show_rating ) ) : ?>
        <span class="text-item product-rating">
            <?php echo $product->get_rating_html(); ?>
        </span>
      <?php endif; ?>

      <span class="text-item product-price">
        <?php echo $product->get_price_html(); ?>
      </span>

    </div>
  </a>
</li>
