<?php
/**
 * Title: XP Por qué elegirnos
 * Slug: xp-repuestos/why-xp
 * Categories: xp-repuestos
 * Description: Bloque sticky 4 razones por qué comprar en XP.
 * Keywords: por que, razones, beneficios
 */

defined( 'ABSPATH' ) || exit;

$wa_link = xp_repuestos_whatsapp_link();
$reasons = array(
	array( 'k' => '01', 't' => 'Compatibilidad confirmada', 'd' => 'Te decimos qué modelo de moto entra antes de la compra. Cero adivinanzas.' ),
	array( 'k' => '02', 't' => 'Stock real, no foto de catálogo', 'd' => 'Lo que ves publicado lo tenemos. Si no, te avisamos cuándo entra.' ),
	array( 'k' => '03', 't' => 'Envío a todo el país', 'd' => 'OCA, Andreani y Correo Argentino. Despachamos en 24/48 hs hábiles.' ),
	array( 'k' => '04', 't' => 'Atención personalizada', 'd' => 'Hablás con personas que arreglan motos, no con un bot.' ),
);
?>
<!-- wp:html -->
<section class="xp-section">
	<div class="xp-container">
		<div style="display:grid; gap:3rem; align-items:start;" class="xp-why-grid">
			<div class="xp-reveal" style="position:sticky; top:8rem;">
				<span class="xp-eyebrow">Por qué XP</span>
				<h2 style="margin-top:1rem; font-size: clamp(2.25rem, 5vw, 3.5rem); line-height:0.9;">
					Repuesto<br>
					<span class="xp-accent-italic" style="color: var(--xp-rust);">justo. Bien rápido.</span>
				</h2>
				<p style="margin-top:1.5rem; max-width: 28rem; color: color-mix(in srgb, var(--xp-ink-soft) 80%, transparent); line-height:1.6;">
					No vendemos lo que no usaríamos en nuestra propia moto. Si no estás seguro de qué necesitás, mandanos foto del repuesto roto por WhatsApp y te confirmamos compatibilidad antes de cobrarte un peso.
				</p>
				<div style="margin-top:2rem; display:flex; flex-wrap:wrap; gap:0.75rem;">
					<a href="<?php echo esc_url( $wa_link ); ?>" target="_blank" rel="noopener" class="xp-btn xp-btn-wa">
						<svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.149-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.247-.694.247-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
						Mandar foto por WhatsApp
					</a>
					<a href="/nuestra-historia/" class="xp-btn xp-btn-ghost">Conocernos</a>
				</div>
			</div>

			<div class="xp-reveal-stagger" style="display:grid; gap:1rem; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));">
				<?php foreach ( $reasons as $r ) : ?>
					<div class="xp-card" style="padding:1.5rem;">
						<span style="font-family: var(--xp-font-display); font-weight:900; font-size:1.875rem; color: var(--xp-rust); font-variant-numeric: tabular-nums;"><?php echo esc_html( $r['k'] ); ?></span>
						<h3 style="margin-top:0.75rem; font-size:1.25rem; line-height:1.2;"><?php echo esc_html( $r['t'] ); ?></h3>
						<p style="margin-top:0.5rem; font-size:0.875rem; color: color-mix(in srgb, var(--xp-ink-soft) 75%, transparent); line-height:1.6;"><?php echo esc_html( $r['d'] ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
<style>
@media (min-width: 1024px) {
	.xp-why-grid { grid-template-columns: 5fr 7fr !important; }
}
</style>
<!-- /wp:html -->
