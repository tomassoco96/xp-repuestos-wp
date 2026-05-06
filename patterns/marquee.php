<?php
/**
 * Title: XP Marquee de marcas
 * Slug: xp-repuestos/marquee
 * Categories: xp-repuestos
 * Description: Marquee continuo con marcas y modelos.
 * Keywords: marquee, ticker, marcas
 */

defined( 'ABSPATH' ) || exit;

$brands = array(
	'Honda', 'Yamaha', 'Gilera', 'Zanella', 'Motomel', 'Keller', 'Mondial',
	'Suzuki', 'Beta', 'Guerrero', 'Vertigo', 'Bajaj', 'Skua',
);
$brands = array_merge( $brands, $brands, $brands );
?>
<!-- wp:html -->
<section class="xp-marquee" aria-label="Marcas que trabajamos">
	<div class="xp-marquee-track">
		<?php foreach ( $brands as $b ) : ?>
			<span>
				<span class="xp-marquee-dot" aria-hidden="true">●</span>
				<span><?php echo esc_html( $b ); ?></span>
			</span>
		<?php endforeach; ?>
	</div>
</section>
<!-- /wp:html -->
