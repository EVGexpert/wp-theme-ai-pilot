<?php
/**
 * Title: Property Catalog
 * Slug: aipilot-demo/catalog
 * Categories: aipilot-demo
 * Description: Секция каталога объектов с каруселью.
 */
?>
<!-- wp:group {"align":"wide","className":"section-padding","style":{"spacing":{"padding":{"top":"var:preset|spacing|4xl","bottom":"var:preset|spacing|4xl","left":"var:preset|spacing|xl","right":"var:preset|spacing|xl"}}},"backgroundColor":"surface-soft","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide section-padding has-surface-soft-background-color has-background" style="padding-top:var(--wp--preset--spacing--4xl);padding-bottom:var(--wp--preset--spacing--4xl);padding-left:var(--wp--preset--spacing--xl);padding-right:var(--wp--preset--spacing--xl)">
	<!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|2xl","left":"var:preset|spacing|2xl"}}}} -->
	<div class="wp-block-columns">
		<!-- wp:column {"width":"30%"} -->
		<div class="wp-block-column" style="flex-basis:30%">
			<!-- wp:heading {"level":2} -->
			<h2 class="wp-block-heading">Каталог объектов</h2>
			<!-- /wp:heading -->
			<!-- wp:paragraph -->
			<p>Подберите идеальное помещение для вашего бизнеса — от офисов до производственных комплексов.</p>
			<!-- /wp:paragraph -->
			<!-- wp:button -->
			<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/property">Все объекты</a></div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:column -->
		<!-- wp:column {"width":"70%"} -->
		<div class="wp-block-column" style="flex-basis:70%">
			<!-- wp:aipilot-demo-blocks/property-carousel {"postCount":6,"cardsPerView":2,"showArrows":true} /-->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
