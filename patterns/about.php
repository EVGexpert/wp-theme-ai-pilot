<?php
/**
 * Title: About Section
 * Slug: aipilot-demo/about
 * Categories: aipilot-demo
 * Description: Секция «О нас» с текстом и статистикой.
 */
?>
<!-- wp:group {"align":"wide","className":"section-padding","style":{"spacing":{"padding":{"top":"var:preset|spacing|4xl","bottom":"var:preset|spacing|4xl","left":"var:preset|spacing|xl","right":"var:preset|spacing|xl"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide section-padding" style="padding-top:var(--wp--preset--spacing--4xl);padding-bottom:var(--wp--preset--spacing--4xl);padding-left:var(--wp--preset--spacing--xl);padding-right:var(--wp--preset--spacing--xl)">
	<!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|2xl","left":"var:preset|spacing|3xl"}}}} -->
	<div class="wp-block-columns">
		<!-- wp:column {"width":"40%"} -->
		<div class="wp-block-column" style="flex-basis:40%">
			<!-- wp:heading {"level":2} -->
			<h2 class="wp-block-heading">О компании</h2>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"style":{"color":{"text":"var:preset|color|text-secondary"}}} -->
			<p style="color:var(--wp--preset--color--text-secondary)">AIPilot — агентство коммерческой недвижимости с многолетним опытом. Мы сопровождаем сделки любой сложности: от аренды небольшого офиса до приобретения производственных комплексов.</p>
			<!-- /wp:paragraph -->
			<!-- wp:button -->
			<div class="wp-block-button"><a class="wp-block-button__link wp-element-button">Подробнее о нас</a></div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:column -->
		<!-- wp:column {"width":"60%"} -->
		<div class="wp-block-column" style="flex-basis:60%">
			<!-- wp:aipilot-demo-blocks/stats-grid {"columnsDesktop":4,"columnsMobile":2} -->
			<!-- wp:aipilot-demo-blocks/stat-item {"value":"500","suffix":"+","label":"Завершённых сделок"} /-->
			<!-- wp:aipilot-demo-blocks/stat-item {"value":"12","suffix":" лет","label":"На рынке недвижимости"} /-->
			<!-- wp:aipilot-demo-blocks/stat-item {"value":"95","suffix":"%","label":"Довольных клиентов"} /-->
			<!-- wp:aipilot-demo-blocks/stat-item {"value":"24","suffix":"/7","label":"Поддержка клиентов"} /-->
			<!-- /wp:aipilot-demo-blocks/stats-grid -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
