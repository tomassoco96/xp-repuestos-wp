<?php
/**
 * WooCommerce overrides + Customizer settings de XP Repuestos.
 *
 * @package XP_Repuestos
 */

defined( 'ABSPATH' ) || exit;

/**
 * Customizer: campos para datos del comercio (WhatsApp, email, dirección, redes).
 */
function xp_repuestos_customize_register( WP_Customize_Manager $wp_customize ): void {
	$wp_customize->add_section( 'xp_repuestos', array(
		'title'    => __( 'XP Repuestos · Datos del comercio', 'xp-repuestos' ),
		'priority' => 30,
	) );

	$fields = array(
		'xp_whatsapp'         => array( 'WhatsApp (solo dígitos, formato internacional)', '5491123929823' ),
		'xp_whatsapp_display' => array( 'WhatsApp (visible)', '+54 9 11 2392-9823' ),
		'xp_email'            => array( 'Email', 'hola@xprepuestos.com.ar' ),
		'xp_address'          => array( 'Dirección', 'Montenegro 1627, CABA' ),
		'xp_instagram_url'    => array( 'Instagram URL', 'https://instagram.com/xp.repuestos' ),
		'xp_instagram_handle' => array( 'Instagram handle', '@xp.repuestos' ),
		'xp_shipping_msg'     => array( 'Mensaje envío gratis (header)', 'Envío gratis en compras superiores a $80.000' ),
	);

	foreach ( $fields as $id => [ $label, $default ] ) {
		$wp_customize->add_setting( $id, array(
			'default'           => $default,
			'transport'         => 'refresh',
			'sanitize_callback' => 'wp_kses_post',
		) );
		$wp_customize->add_control( $id, array(
			'label'   => $label,
			'section' => 'xp_repuestos',
			'type'    => 'text',
		) );
	}
}
add_action( 'customize_register', 'xp_repuestos_customize_register' );

/**
 * WooCommerce: layout del shop.
 */
function xp_repuestos_loop_columns(): int {
	return 4;
}
add_filter( 'loop_shop_columns', 'xp_repuestos_loop_columns' );

function xp_repuestos_products_per_page(): int {
	return 24;
}
add_filter( 'loop_shop_per_page', 'xp_repuestos_products_per_page', 20 );

/**
 * Reemplaza "Add to cart" por consulta WhatsApp en archive.
 *
 * Esto NO desactiva el botón clásico — agrega un botón de WhatsApp al lado.
 */
function xp_repuestos_add_wa_button(): void {
	global $product;
	if ( ! $product ) {
		return;
	}

	$message = sprintf(
		'Hola! Vengo de la web. Quería consultar por: %s',
		wp_strip_all_tags( $product->get_name() ),
	);
	$link    = xp_repuestos_whatsapp_link( $message );

	printf(
		'<a class="xp-wa-mini" href="%1$s" target="_blank" rel="noopener" aria-label="%2$s">'
		. '<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.149-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.247-.694.247-1.289.173-1.413-.074-.124-.272-.198-.57-.347" /></svg>'
		. '</a>',
		esc_url( $link ),
		esc_attr( sprintf( 'Consultar por WhatsApp: %s', $product->get_name() ) ),
	);
}
add_action( 'woocommerce_after_shop_loop_item', 'xp_repuestos_add_wa_button', 11 );

/**
 * Single product: agrega botón WhatsApp después del addtocart.
 */
function xp_repuestos_single_wa_button(): void {
	global $product;
	if ( ! $product ) {
		return;
	}

	$message = sprintf(
		'Hola! Vengo de la web. Quería consultar por: %s',
		wp_strip_all_tags( $product->get_name() ),
	);
	$link    = xp_repuestos_whatsapp_link( $message );

	printf(
		'<a class="xp-btn xp-btn-wa xp-single-wa" href="%1$s" target="_blank" rel="noopener">'
		. '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.149-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.247-.694.247-1.289.173-1.413-.074-.124-.272-.198-.57-.347" /></svg>'
		. '<span>Consultar por WhatsApp</span></a>',
		esc_url( $link ),
	);
}
add_action( 'woocommerce_after_add_to_cart_button', 'xp_repuestos_single_wa_button' );

/**
 * WhatsApp FAB (botón flotante) en todo el sitio.
 */
function xp_repuestos_render_whatsapp_fab(): void {
	$link = xp_repuestos_whatsapp_link();
	?>
	<a
		class="xp-fab"
		href="<?php echo esc_url( $link ); ?>"
		target="_blank"
		rel="noopener"
		aria-label="<?php esc_attr_e( 'Abrir chat de WhatsApp con XP Repuestos', 'xp-repuestos' ); ?>"
	>
		<svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
			<path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.149-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.247-.694.247-1.289.173-1.413-.074-.124-.272-.198-.57-.347" />
		</svg>
		<span class="xp-fab-label"><?php esc_html_e( 'Consultar por WhatsApp', 'xp-repuestos' ); ?></span>
	</a>
	<?php
}
add_action( 'wp_footer', 'xp_repuestos_render_whatsapp_fab', 50 );

/**
 * Schema.org Organization en el head.
 */
function xp_repuestos_organization_schema(): void {
	if ( ! is_front_page() ) {
		return;
	}

	$data = xp_repuestos_get_site_data();

	xp_repuestos_json_ld( array(
		'@context'    => 'https://schema.org',
		'@type'       => 'LocalBusiness',
		'@id'         => home_url( '/#org' ),
		'name'        => 'XP Repuestos',
		'description' => 'Repuestos y accesorios para motos en Argentina.',
		'image'       => XP_REPUESTOS_URI . '/assets/images/logo-xp-stack.svg',
		'address'     => array(
			'@type'           => 'PostalAddress',
			'streetAddress'   => 'Montenegro 1627',
			'addressLocality' => 'CABA',
			'addressCountry'  => 'AR',
		),
		'telephone'   => $data['whatsapp_display'],
		'email'       => $data['email'],
		'priceRange'  => '$$',
		'sameAs'      => array( $data['instagram_url'] ),
	) );
}
add_action( 'wp_head', 'xp_repuestos_organization_schema', 99 );
