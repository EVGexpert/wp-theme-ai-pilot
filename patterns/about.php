<?php
/**
 * Title: About Section
 * Slug: aipilot-demo/about
 * Categories: aipilot-demo
 * Description: Секция «О нас» с текстом и статистикой.
 */
?>
<!-- wp:group {"align":"wide","className":"site-section","anchor":"about","style":{"spacing":{"padding":{"top":"var:preset|spacing|4xl","bottom":"var:preset|spacing|4xl","left":"var:preset|spacing|lg","right":"var:preset|spacing|lg"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide site-section" id="about" style="padding-top:var(--wp--preset--spacing--4xl);padding-bottom:var(--wp--preset--spacing--4xl);padding-left:var(--wp--preset--spacing--lg);padding-right:var(--wp--preset--spacing--lg)">
	<!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|2xl","left":"var:preset|spacing|3xl"}}}} -->
	<div class="wp-block-columns are-vertically-aligned-center">
		<!-- wp:column {"width":"48%","verticalAlignment":"center"} -->
		<div class="wp-block-column" style="flex-basis:48%">
			<!-- wp:heading {"level":2,"style":{"typography":{"fontWeight":"600"}}} -->
			<h2 class="wp-block-heading" style="font-weight:600">О компании</h2>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"style":{"color":{"text":"var:preset|color|text-secondary"},"typography":{"fontSize":"1.0625rem","lineHeight":"1.6"}}} -->
			<p style="color:var(--wp--preset--color--text-secondary);font-size:1.0625rem;line-height:1.6">«Пространство» — агентство коммерческой недвижимости с многолетним опытом. Мы сопровождаем сделки любой сложности: от аренды небольшого офиса до приобретения производственных комплексов.</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->
		<!-- wp:column {"width":"52%","verticalAlignment":"center"} -->
		<div class="wp-block-column" style="flex-basis:52%">
			<!-- wp:aipilot-demo-blocks/stats-grid {"columnsDesktop":2,"columnsTablet":2,"columnsMobile":2,"showDividers":true,"hasAnimation":true} -->
			<!-- wp:aipilot-demo-blocks/stat-item {"value":"10","suffix":"+","label":"лет на рынке","showCounter":true} /-->
			<!-- wp:aipilot-demo-blocks/stat-item {"value":"1000","suffix":"+","label":"успешных сделок","showCounter":true} /-->
			<!-- wp:aipilot-demo-blocks/stat-item {"value":"4000","suffix":"+","label":"объектов в нашей базе","showCounter":true} /-->
			<!-- wp:aipilot-demo-blocks/stat-item {"value":"95","suffix":"%","label":"довольных клиентов","showCounter":true} /-->
			<!-- /wp:aipilot-demo-blocks/stats-grid -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
