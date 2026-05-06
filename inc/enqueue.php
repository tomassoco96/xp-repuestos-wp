<?php
/**
 * Asset enqueue: fonts, CSS y JS del child theme.
 *
 * @package XP_Repuestos
 */

defined( 'ABSPATH' ) || exit;

/**
 * Enqueue assets del frontend.
 */
function xp_repuestos_enqueue_assets(): void {
	$ver = XP_REPUESTOS_VERSION;

	// Google Fonts (Montserrat + Saira variantes) en una sola request.
	wp_enqueue_style(
		'xp-google-fonts',
		'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,700;1,900&family=Saira+Condensed:ital,wght@0,700;0,800;0,900;1,800;1,900&family=Saira+Stencil+One&display=swap',
		array(),
		null,
	);

	// Theme parent (Blocksy).
	wp_enqueue_style(
		'blocksy-parent',
		get_template_directory_uri() . '/style.css',
		array(),
		null,
	);

	// Theme child styles.
	wp_enqueue_style(
		'xp-repuestos-theme',
		XP_REPUESTOS_URI . '/assets/css/theme.css',
		array( 'blocksy-parent' ),
		$ver,
	);

	// Motion JS (deferred).
	wp_enqueue_script(
		'xp-repuestos-motion',
		XP_REPUESTOS_URI . '/assets/js/motion.js',
		array(),
		$ver,
		array(
			'in_footer' => true,
			'strategy'  => 'defer',
		),
	);
}
add_action( 'wp_enqueue_scripts', 'xp_repuestos_enqueue_assets' );

/**
 * Preconnects para Google Fonts.
 */
function xp_repuestos_resource_hints( array $urls, string $relation ): array {
	if ( 'preconnect' === $relation ) {
		$urls[] = array(
			'href'        => 'https://fonts.googleapis.com',
			'crossorigin' => '',
		);
		$urls[] = array(
			'href'        => 'https://fonts.gstatic.com',
			'crossorigin' => 'anonymous',
		);
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'xp_repuestos_resource_hints', 10, 2 );

/**
 * Favicon SVG.
 */
function xp_repuestos_favicon(): void {
	echo '<link rel="icon" type="image/svg+xml" href="' . esc_url( XP_REPUESTOS_URI . '/assets/images/favicon.svg' ) . '" />' . "\n";
	echo '<meta name="theme-color" content="#1D1D1B" />' . "\n";
}
add_action( 'wp_head', 'xp_repuestos_favicon', 1 );

/**
 * Quitar emojis (perf).
 */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

/**
 * Editor styles para Gutenberg.
 */
function xp_repuestos_editor_assets(): void {
	wp_enqueue_style(
		'xp-google-fonts-editor',
		'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,700;1,900&family=Saira+Condensed:ital,wght@0,800;0,900;1,800;1,900&family=Saira+Stencil+One&display=swap',
		array(),
		null,
	);
}
add_action( 'enqueue_block_editor_assets', 'xp_repuestos_editor_assets' );
