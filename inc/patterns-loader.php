<?php
/**
 * Block patterns loader (Gutenberg).
 *
 * Registra una categoría custom y carga todos los .php de /patterns/ via auto-discovery
 * mediante el header de WP en cada archivo.
 *
 * @package XP_Repuestos
 */

defined( 'ABSPATH' ) || exit;

/**
 * Registra la categoría visible en el inserter de Gutenberg.
 */
function xp_repuestos_register_pattern_category(): void {
	if ( ! function_exists( 'register_block_pattern_category' ) ) {
		return;
	}
	register_block_pattern_category(
		'xp-repuestos',
		array(
			'label'       => __( 'XP Repuestos', 'xp-repuestos' ),
			'description' => __( 'Bloques personalizados de XP Repuestos.', 'xp-repuestos' ),
		),
	);
}
add_action( 'init', 'xp_repuestos_register_pattern_category', 9 );
