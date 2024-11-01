<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce-for-elementor/content-product.php.
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<li <?php echo $li_class; ?>>
	<div class="wfe-product-item">
		<header class="wfe-product-item__entry-header">
			<a class="wfe-product-item__thumbnail" href="<?php the_permalink(); ?>">
				<?php if ( $product->is_on_sale() ) : ?>
				<span class="onsale">
				<?php
					$percentage = round( ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100 );
					echo '-' . $percentage . '%';
					?>
				</span>
				<?php endif; ?>
				<?php woocommerce_template_loop_product_thumbnail(); ?>
			</a>
		</header>

		<footer class="wfe-product-item__entry-footer">
			<?php the_title( '<h2 class="wfe-product-item__title"><a href="' . get_the_permalink() . '">', '</a></h2>' ); ?>
			<div class="wfe-product-item__rating"><?php woocommerce_template_loop_rating(); ?></div>
			<div class="wfe-product-item__price"><?php woocommerce_template_loop_price(); ?></div>
			<div class="wfe-product-item__add-to-cart">
				<?php woocommerce_template_loop_add_to_cart(); ?>
			</div>
		</footer>
	</div>
</li>
