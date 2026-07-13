<?php
/**
 * Title: Hero Section
 * Slug: aipilot-demo/hero
 * Categories: aipilot-demo
 * Description: Первый экран с фоновым изображением и призывом к действию.
 */
?>
<!-- wp:group {"align":"full","className":"section-padding","style":{"spacing":{"padding":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull section-padding" style="padding-top:0;padding-bottom:0">
	<!-- wp:aipilot-demo-blocks/hero {"minHeight":"520px","overlayColor":"rgba(0,0,0,0.4)","desktopImageUrl":"https://placehold.co/1920x720/333/fff?text=Building","mobileImageUrl":"https://placehold.co/800x600/333/fff?text=Building+Mobile","borderRadius":"22px"} -->
	<div class="wp-block-aipilot-demo-blocks-hero">
		<!-- wp:heading {"level":1,"style":{"typography":{"fontSize":"clamp(2.375rem,5vw,3.5rem)"},"color":{"text":"#ffffff"}}} -->
		<h1 class="wp-block-heading" style="color:#ffffff;font-size:clamp(2.375rem,5vw,3.5rem)">Найдём идеальную<br>коммерческую недвижимость</h1>
		<!-- /wp:heading -->
		<!-- wp:paragraph {"style":{"color":{"text":"#e0e0e0"},"typography":{"fontSize":"1.125rem"}}} -->
		<p style="color:#e0e0e0;font-size:1.125rem">Более 10 лет помогаем бизнесу находить, оценивать и приобретать коммерческие объекты в Калининграде и области.</p>
		<!-- /wp:paragraph -->
		<!-- wp:buttons -->
		<div class="wp-block-buttons">
			<!-- wp:button {"backgroundColor":"surface","textColor":"text","style":{"border":{"radius":"999px"}}} -->
			<div class="wp-block-button"><a class="wp-block-button__link has-text-color has-surface-background-color has-text-color has-background wp-element-button" style="border-radius:999px">Подобрать объект</a></div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->
	</div>
	<!-- /wp:aipilot-demo-blocks/hero -->
</div>
<!-- /wp:group -->
