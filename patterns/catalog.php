<?php
/**
 * Title: Property Catalog
 * Slug: aipilot-demo/catalog
 * Categories: aipilot-demo
 * Description: Секция каталога объектов с каруселью.
 */
?>
<!-- wp:group {"align":"wide","className":"site-section","anchor":"catalog","style":{"spacing":{"padding":{"top":"var:preset|spacing|4xl","bottom":"var:preset|spacing|4xl","left":"var:preset|spacing|lg","right":"var:preset|spacing|lg"}}},"backgroundColor":"surface-soft","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide site-section has-surface-soft-background-color has-background" id="catalog" style="padding-top:var(--wp--preset--spacing--4xl);padding-bottom:var(--wp--preset--spacing--4xl);padding-left:var(--wp--preset--spacing--lg);padding-right:var(--wp--preset--spacing--lg)">
	<!-- wp:group {"className":"site-section__header","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|2xl"}}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"bottom"}} -->
	<div class="wp-block-group site-section__header" style="margin-bottom:var(--wp--preset--spacing--2xl)">
		<!-- wp:group -->
		<div class="wp-block-group">
			<!-- wp:heading {"level":2} -->
			<h2 class="wp-block-heading">Каталог объектов</h2>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"textColor":"text-secondary"} -->
			<p class="has-text-secondary-color has-text-color">Подберите помещение для вашего бизнеса — от офисов до производственных комплексов.</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
		<!-- wp:button -->
		<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/property">Все объекты</a></div>
		<!-- /wp:button -->
	</div>
	<!-- /wp:group -->
	<!-- wp:aipilot-demo-blocks/property-carousel {"postCount":6,"cardsPerView":3,"tabletCardsPerView":2,"mobileCardsPerView":1,"showArrows":true,"showPagination":true,"autoplay":false,"loop":true} /-->
</div>
<!-- /wp:group -->
