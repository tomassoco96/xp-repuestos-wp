<?php
/**
 * Title: XP CTA Mayorista
 * Slug: xp-repuestos/wholesale-cta
 * Categories: xp-repuestos
 * Description: Banner navy con CTA al programa mayorista.
 * Keywords: mayorista, b2b, talleres
 */

defined( 'ABSPATH' ) || exit;

$wa_link = xp_repuestos_whatsapp_link( 'Hola! Vengo de la web. Quería sumarme al programa mayorista, soy un (taller / local de repuestos / ferretería) ubicado en (ciudad).' );
?>
<!-- wp:html -->
<section class="xp-section xp-bg-navy" style="position:relative; overflow:hidden;">
	<div aria-hidden="true" style="position:absolute; right:-8rem; top:50%; transform:translateY(-50%); opacity:0.06; pointer-events:none;">
		<?php xp_repuestos_logo( 'dark' ); ?>
	</div>

	<div class="xp-container" style="position:relative; display:grid; gap:2rem; align-items:center;" class="xp-wh-grid">
		<div class="xp-reveal">
			<span class="xp-eyebrow">Mayorista</span>
			<h2 style="margin-top:1rem; font-size: clamp(2.25rem, 5vw, 3.5rem); line-height:0.9;">
				¿Tenés un<br>
				<span class="xp-accent-italic" style="color: var(--xp-rust);">taller o local?</span>
			</h2>
			<p style="margin-top:1.5rem; max-width:36rem; color: color-mix(in srgb, var(--xp-paper) 80%, transparent); line-height:1.6;">
				Sumate al programa mayorista: precios escalonados por volumen, plazos de pago a 30 días para clientes con historial, y prioridad en stock nuevo.
			</p>
		</div>

		<div class="xp-reveal" style="display:flex; flex-direction:column; gap:0.75rem;">
			<a href="/mayorista" class="xp-btn xp-btn-primary">Conocer condiciones</a>
			<a href="<?php echo esc_url( $wa_link ); ?>" target="_blank" rel="noopener" class="xp-btn xp-btn-ghost xp-btn-ghost-light">Hablar con un asesor</a>
		</div>
	</div>
</section>
<style>
@media (min-width: 1024px) {
	.xp-wh-grid { grid-template-columns: 7fr 5fr !important; }
}
</style>
<!-- /wp:html -->
