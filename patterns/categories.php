<?php
/**
 * Title: XP Categorías destacadas
 * Slug: xp-repuestos/categories
 * Categories: xp-repuestos
 * Description: Grid 4 columnas de categorías con motion.
 * Keywords: categorias, grid, productos
 */

defined( 'ABSPATH' ) || exit;

$cats_default = array(
	array( 'slug' => 'cascos',     'name' => 'Cascos',                'desc' => 'Cascos integrales y abiertos. Marcas Vertigo y certificaciones.', 'icon' => 'helmet' ),
	array( 'slug' => 'motor',      'name' => 'Motor',                 'desc' => 'Pistones, distribución, árbol de leva, caja, carburador.', 'icon' => 'engine' ),
	array( 'slug' => 'electrico',  'name' => 'Eléctrico',             'desc' => 'Tableros, faros, lámparas, destelladores, bendix.', 'icon' => 'bolt' ),
	array( 'slug' => 'rodante',    'name' => 'Rodante y suspensión',  'desc' => 'Ejes, mazas, rayos, retenes, bujes, resortes.', 'icon' => 'wheel' ),
);

$icons = array(
	'helmet' => 'M5 14a7 7 0 1 1 14 0v3a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-3Zm0 0h14M9 19v3M15 19v3',
	'engine' => 'M5 9h2V7h4V5h2v2h4l2 2v3h2v3h-2v3l-2 2h-4v-2h-4v2H7l-2-2v-3H3v-3h2V9Z',
	'bolt'   => 'M13 2 4 14h7l-1 8 9-12h-7l1-8Z',
	'wheel'  => 'M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20Zm0 5v10M7 12h10M9 5l6 14M5 9l14 6M5 15l14-6',
);

// Si existen las categorías reales en WooCommerce, las usamos; si no, defaults.
$wc_cats = array();
if ( taxonomy_exists( 'product_cat' ) ) {
	foreach ( $cats_default as $c ) {
		$term = get_term_by( 'slug', $c['slug'], 'product_cat' );
		if ( $term ) {
			$c['count'] = $term->count;
			$c['link']  = get_term_link( $term );
		} else {
			$c['count'] = 0;
			$c['link']  = home_url( '/categoria-producto/' . $c['slug'] . '/' );
		}
		$wc_cats[] = $c;
	}
} else {
	foreach ( $cats_default as $c ) {
		$c['count'] = 0;
		$c['link']  = home_url( '/categoria-producto/' . $c['slug'] . '/' );
		$wc_cats[]  = $c;
	}
}
?>
<!-- wp:html -->
<section class="xp-section">
	<div class="xp-container">
		<div class="xp-reveal" style="display:flex; align-items:end; justify-content:space-between; gap:1rem; margin-bottom:3rem; flex-wrap:wrap;">
			<div>
				<span class="xp-eyebrow">Catálogo</span>
				<h2 style="margin-top:1rem; font-size: clamp(2.25rem, 5vw, 3.5rem); line-height:0.9;">
					Buscá lo que <span class="xp-accent-italic" style="color: var(--xp-rust);">necesitás</span>
				</h2>
			</div>
			<a href="/tienda" style="font-family: var(--xp-font-display); font-weight:700; font-size:0.875rem; text-transform:uppercase; letter-spacing:0.2em; color: var(--xp-rust); text-decoration:none;">
				Ver todos los productos →
			</a>
		</div>

		<div class="xp-reveal-stagger" style="display:grid; gap:1rem; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));">
			<?php foreach ( $wc_cats as $c ) : ?>
				<a href="<?php echo esc_url( $c['link'] ); ?>" class="xp-cat">
					<div class="xp-cat-head">
						<span class="xp-cat-icon">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
								<path d="<?php echo esc_attr( $icons[ $c['icon'] ] ?? '' ); ?>" />
							</svg>
						</span>
						<span class="xp-cat-count"><?php echo (int) $c['count']; ?> productos</span>
					</div>
					<h3 class="xp-cat-title"><?php echo esc_html( $c['name'] ); ?></h3>
					<p class="xp-cat-desc"><?php echo esc_html( $c['desc'] ); ?></p>
					<span class="xp-cat-cta">
						Ver categoría
						<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 5l7 7-7 7"/></svg>
					</span>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<!-- /wp:html -->
