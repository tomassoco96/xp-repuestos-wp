<?php
/**
 * Override del card de producto en archive (shop / categoría / search).
 *
 * Reemplaza wc-template-functions.php / templates/content-product.php
 * con el diseño .xp-card de XP Repuestos.
 *
 * @package XP_Repuestos
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

$message = sprintf(
	'Hola! Vengo de la web. Quería consultar por: %s',
	wp_strip_all_tags( $product->get_name() ),
);
$wa_link  = xp_repuestos_whatsapp_link( $message );
$brand    = '';

// Marca: probamos atributo de producto "Marca" o taxonomía product_brand.
if ( $product->get_attribute( 'pa_marca' ) ) {
	$brand = $product->get_attribute( 'pa_marca' );
} elseif ( taxonomy_exists( 'product_brand' ) ) {
	$terms = wp_get_post_terms( $product->get_id(), 'product_brand', array( 'fields' => 'names' ) );
	if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) {
		$brand = $terms[0];
	}
}
?>

<li <?php wc_product_class( 'xp-card', $product ); ?>>
	<span class="xp-card-corner" aria-hidden="true"></span>

	<a class="xp-card-media" href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr( $product->get_name() ); ?>">
		<?php echo $product->get_image( 'woocommerce_thumbnail' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
	</a>

	<div class="xp-card-body">
		<div class="xp-card-meta">
			<?php if ( $brand ) : ?>
				<span class="xp-card-brand"><?php echo esc_html( $brand ); ?></span>
			<?php else : ?>
				<span class="xp-card-brand"><?php esc_html_e( 'Multimarca', 'xp-repuestos' ); ?></span>
			<?php endif; ?>

			<?php if ( $product->is_in_stock() ) : ?>
				<span class="xp-card-stock"><?php esc_html_e( 'En stock', 'xp-repuestos' ); ?></span>
			<?php else : ?>
				<span class="xp-card-stock" style="color: var(--xp-steel);">
					<?php esc_html_e( 'Consultar', 'xp-repuestos' ); ?>
				</span>
			<?php endif; ?>
		</div>

		<a class="xp-card-title" href="<?php the_permalink(); ?>">
			<?php echo esc_html( $product->get_name() ); ?>
		</a>

		<p class="xp-card-price">
			<?php echo $product->get_price_html(); // phpcs:ignore WordPress.Security.EscapeOutput ?>
		</p>

		<div class="xp-card-actions">
			<a href="<?php the_permalink(); ?>" class="xp-btn xp-btn-ghost">
				<?php esc_html_e( 'Ver ficha', 'xp-repuestos' ); ?>
			</a>
			<a
				href="<?php echo esc_url( $wa_link ); ?>"
				target="_blank"
				rel="noopener"
				class="xp-btn xp-btn-wa"
				aria-label="<?php echo esc_attr( sprintf( 'Consultar por WhatsApp: %s', $product->get_name() ) ); ?>"
			>
				<svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
					<path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.149-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.247-.694.247-1.289.173-1.413-.074-.124-.272-.198-.57-.347" />
				</svg>
			</a>
		</div>
	</div>
</li>
