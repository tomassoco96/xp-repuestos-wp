<?php
/**
 * Title: XP Hero
 * Slug: xp-repuestos/hero
 * Categories: xp-repuestos
 * Description: Hero cinemático con logo XP rotando, título kinético y CTAs.
 * Keywords: hero, portada, banner
 */

defined( 'ABSPATH' ) || exit;

$wa_link = xp_repuestos_whatsapp_link();
?>
<!-- wp:html -->
<section class="xp-hero">
	<div class="xp-hero-backdrop" aria-hidden="true"><?php xp_repuestos_logo( 'dark' ); ?></div>
	<div class="xp-hero-noise" aria-hidden="true"></div>

	<div class="xp-container xp-hero-grid">
		<div class="xp-reveal-stagger">
			<span class="xp-eyebrow" style="color: var(--xp-rust); --xp-rust: #E20613;">
				<span class="xp-pulse" aria-hidden="true"></span>
				Repuestos para motos · CABA
			</span>

			<h1 class="xp-hero-title">
				<span style="display:block;">Tu moto</span>
				<span style="display:block;">
					<span class="xp-hero-title-italic">no para</span><span style="color: var(--xp-rust);">.</span>
				</span>
			</h1>

			<p class="xp-hero-sub">
				Más de 1.000 repuestos originales y alternativos para Honda, Yamaha, Gilera, Zanella y todas las marcas que rodean en la calle. Llegamos a todo el país.
			</p>

			<div class="xp-hero-cta">
				<a href="/tienda" class="xp-btn xp-btn-primary">
					Ver catálogo
					<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 5l7 7-7 7"/></svg>
				</a>
				<a href="<?php echo esc_url( $wa_link ); ?>" target="_blank" rel="noopener" class="xp-btn xp-btn-ghost xp-btn-ghost-light">
					<svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.149-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.247-.694.247-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
					Consultar por WhatsApp
				</a>
			</div>
		</div>
	</div>

	<div class="xp-trust">
		<div class="xp-container">
			<div class="xp-trust-grid">
				<div class="xp-trust-item">
					<p class="xp-trust-num">+1.000</p>
					<p class="xp-trust-label">repuestos en stock</p>
				</div>
				<div class="xp-trust-item">
					<p class="xp-trust-num">20+</p>
					<p class="xp-trust-label">marcas que cubrimos</p>
				</div>
				<div class="xp-trust-item">
					<p class="xp-trust-num">24h</p>
					<p class="xp-trust-label">respuesta promedio</p>
				</div>
				<div class="xp-trust-item">
					<p class="xp-trust-num">CABA</p>
					<p class="xp-trust-label">atención personalizada</p>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- /wp:html -->
