<?php
/**
 * XP Repuestos — Child theme
 *
 * Bootstrap del theme. Carga assets, hooks de WooCommerce y patterns de Gutenberg.
 *
 * @package XP_Repuestos
 */

defined( 'ABSPATH' ) || exit;

define( 'XP_REPUESTOS_VERSION', '1.0.0' );
define( 'XP_REPUESTOS_DIR', get_stylesheet_directory() );
define( 'XP_REPUESTOS_URI', get_stylesheet_directory_uri() );

// Asset enqueue (CSS, JS, fonts).
require_once XP_REPUESTOS_DIR . '/inc/enqueue.php';

// WooCommerce overrides y soporte.
require_once XP_REPUESTOS_DIR . '/inc/woocommerce.php';

// Block patterns custom de Gutenberg.
require_once XP_REPUESTOS_DIR . '/inc/patterns-loader.php';

/**
 * Soporte de features de WordPress.
 */
function xp_repuestos_setup(): void {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'custom-logo', array(
		'height'      => 80,
		'width'       => 80,
		'flex-height' => true,
		'flex-width'  => true,
	) );

	// WooCommerce.
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	// Editor styles.
	add_editor_style( 'assets/css/theme.css' );

	// Menus.
	register_nav_menus( array(
		'primary' => __( 'Menú principal', 'xp-repuestos' ),
		'footer'  => __( 'Menú pie de página', 'xp-repuestos' ),
	) );
}
add_action( 'after_setup_theme', 'xp_repuestos_setup' );

/**
 * Datos del comercio expuestos a templates y JS.
 *
 * Editables desde Apariencia → Personalizar → XP Repuestos (registrado en
 * inc/woocommerce.php). Si no se editan ahí, usa los defaults definidos abajo.
 */
function xp_repuestos_get_site_data(): array {
	return array(
		'whatsapp'         => get_theme_mod( 'xp_whatsapp', '5491123929823' ),
		'whatsapp_display' => get_theme_mod( 'xp_whatsapp_display', '+54 9 11 2392-9823' ),
		'whatsapp_default' => 'Hola! Vengo de la web. Quería consultar por un repuesto.',
		'email'            => get_theme_mod( 'xp_email', 'hola@xprepuestos.com.ar' ),
		'address'          => get_theme_mod( 'xp_address', 'Montenegro 1627, CABA' ),
		'instagram_url'    => get_theme_mod( 'xp_instagram_url', 'https://instagram.com/xp.repuestos' ),
		'instagram_handle' => get_theme_mod( 'xp_instagram_handle', '@xp.repuestos' ),
		'hours'            => array(
			'Lunes a Viernes: 9:00 a 16:30',
			'Sábados y domingos: cerrado',
		),
		'shipping_message' => get_theme_mod( 'xp_shipping_msg', 'Envío gratis en compras superiores a $80.000' ),
	);
}

/**
 * Helper: link de WhatsApp con mensaje pre-cargado.
 *
 * @param string $message Mensaje a precargar (en texto plano).
 */
function xp_repuestos_whatsapp_link( string $message = '' ): string {
	$data    = xp_repuestos_get_site_data();
	$message = $message !== '' ? $message : $data['whatsapp_default'];

	return sprintf(
		'https://wa.me/%s?text=%s',
		preg_replace( '/\D/', '', $data['whatsapp'] ),
		rawurlencode( $message ),
	);
}

/**
 * Helper: formato de precio en pesos argentinos sin decimales.
 *
 * @param float|int|string $value Valor numérico.
 */
function xp_repuestos_format_price( $value ): string {
	$num = (float) $value;
	return '$' . number_format( $num, 0, ',', '.' );
}

/**
 * Render del logo SVG inline (mejor perf y heredable de currentColor).
 *
 * @param string $variant 'color' (default) | 'dark' | 'stack'.
 */
function xp_repuestos_logo( string $variant = 'color' ): void {
	$map = array(
		'color' => '/assets/images/logo-xp.svg',
		'dark'  => '/assets/images/logo-xp-dark.svg',
		'stack' => '/assets/images/logo-xp-stack.svg',
	);

	$path = XP_REPUESTOS_DIR . ( $map[ $variant ] ?? $map['color'] );

	if ( file_exists( $path ) ) {
		// SVG estático del propio theme — safe.
		echo file_get_contents( $path ); // phpcs:ignore WordPress.Security.EscapeOutput
	}
}

/**
 * Helper para escapar atributos JSON (schema markup).
 */
function xp_repuestos_json_ld( array $data ): void {
	echo '<script type="application/ld+json">';
	echo wp_json_encode( $data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES );
	echo '</script>';
}
