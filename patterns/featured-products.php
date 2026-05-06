<?php
/**
 * Title: XP Productos destacados
 * Slug: xp-repuestos/featured-products
 * Categories: xp-repuestos
 * Description: Sección oscura con grid de productos destacados (top ventas).
 * Keywords: featured, top, productos
 */

defined( 'ABSPATH' ) || exit;
?>
<!-- wp:html -->
<section class="xp-section xp-bg-ink" style="position:relative; overflow:hidden;">
	<div aria-hidden="true" style="position:absolute; left:-5rem; top:50%; transform:translateY(-50%); opacity:0.03; pointer-events:none;">
		<span class="xp-accent-italic" style="font-size:20rem; line-height:1; font-weight:900; color: var(--xp-paper);">TOP</span>
	</div>

	<div class="xp-container" style="position:relative;">
		<div class="xp-reveal" style="display:flex; align-items:end; justify-content:space-between; gap:1rem; margin-bottom:3rem; flex-wrap:wrap;">
			<div>
				<span class="xp-eyebrow">Top ventas</span>
				<h2 style="margin-top:1rem; font-size: clamp(2.25rem, 5vw, 3.5rem); line-height:0.9;">
					Los que más <span class="xp-accent-italic" style="color: var(--xp-rust);">salen</span>
				</h2>
			</div>
			<a href="/tienda" style="font-family: var(--xp-font-display); font-weight:700; font-size:0.875rem; text-transform:uppercase; letter-spacing:0.2em; color: var(--xp-paper); text-decoration:none;">
				Ver más →
			</a>
		</div>

		<div class="xp-reveal-stagger">
			<!-- wp:woocommerce/featured-products {"columns":4,"rows":2,"editMode":false,"contentVisibility":{"image":true,"title":true,"price":true,"rating":false,"button":false}} /-->
		</div>
	</div>
</section>
<!-- /wp:html -->
