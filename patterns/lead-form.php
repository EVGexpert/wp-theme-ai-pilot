<?php
/**
 * Title: Lead Form Section
 * Slug: aipilot-demo/lead-form
 * Categories: aipilot-demo
 * Description: Тёмная секция с формой обратной связи.
 */
?>
<!-- wp:group {"align":"full","className":"site-section","anchor":"contacts","style":{"spacing":{"padding":{"top":"var:preset|spacing|4xl","bottom":"var:preset|spacing|4xl","left":"var:preset|spacing|lg","right":"var:preset|spacing|lg"}},"color":{"background":"#252525","text":"#f0f0f0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull site-section has-text-color has-background" id="contacts" style="background-color:#252525;color:#f0f0f0;padding-top:var(--wp--preset--spacing--4xl);padding-bottom:var(--wp--preset--spacing--4xl);padding-left:var(--wp--preset--spacing--lg);padding-right:var(--wp--preset--spacing--lg)">
	<!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|2xl","left":"var:preset|spacing|3xl"}}}} -->
	<div class="wp-block-columns are-vertically-aligned-center">
		<!-- wp:column {"width":"45%","verticalAlignment":"center"} -->
		<div class="wp-block-column" style="flex-basis:45%">
			<!-- wp:heading {"level":2,"style":{"color":{"text":"#ffffff"}}} -->
			<h2 class="wp-block-heading" style="color:#ffffff">Давайте обсудим сотрудничество</h2>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"style":{"color":{"text":"#b0b0b0"},"typography":{"fontSize":"1.0625rem","lineHeight":"1.6"}}} -->
			<p style="color:#b0b0b0;font-size:1.0625rem;line-height:1.6">Оставьте заявку, и мы подберём для вас лучшие варианты коммерческой недвижимости. Перезвоним в течение рабочего дня.</p>
			<!-- /wp:paragraph -->
			<!-- wp:paragraph {"style":{"color":{"text":"#b0b0b0"},"typography":{"fontSize":"0.9375rem"}}} -->
			<p style="color:#b0b0b0;font-size:0.9375rem">Или позвоните нам: <a href="tel:+74012321000" style="color:#fff;text-decoration:underline;">+7 (4012) 32-10-00</a></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->
		<!-- wp:column {"width":"55%","verticalAlignment":"center"} -->
		<div class="wp-block-column" style="flex-basis:55%">
			<!-- wp:aipilot-demo-blocks/lead-form {"submitText":"Отправить заявку","successMessage":"Спасибо! Заявка отправлена. Мы свяжемся с вами в ближайшее время.","showPhone":true,"phoneRequired":true,"showEmail":true,"showMessage":true} /-->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
