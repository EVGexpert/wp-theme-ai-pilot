<?php
/**
 * Title: Hero Section
 * Slug: aipilot-demo/hero
 * Categories: aipilot-demo
 * Description: Первый экран с фоновым изображением и призывом к действию.
 */
$hero_desktop = get_template_directory_uri() . '/assets/images/hero-desktop.svg';
$hero_mobile  = get_template_directory_uri() . '/assets/images/hero-mobile.svg';
?>
<!-- wp:group {"align":"full","className":"site-section aipilot-hero-section","anchor":"top","style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"var:preset|spacing|lg","right":"var:preset|spacing|lg"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull site-section aipilot-hero-section" id="top" style="padding-top:0;padding-bottom:0;padding-left:var(--wp--preset--spacing--lg);padding-right:var(--wp--preset--spacing--lg)">
	<!-- wp:aipilot-demo-blocks/hero {"desktopImageUrl":"<?php echo esc_url( $hero_desktop ); ?>","mobileImageUrl":"<?php echo esc_url( $hero_mobile ); ?>","overlayColor":"linear-gradient(90deg, rgba(37,37,37,0.72) 0%, rgba(60,90,110,0.45) 60%, rgba(96,140,170,0.2) 100%)","minHeight":"520px","borderRadius":"22px","contentPosition":"center-left"} -->
	<div class="wp-block-aipilot-demo-blocks-hero">
		<!-- wp:heading {"level":1,"style":{"color":{"text":"#ffffff"},"typography":{"fontSize":"clamp(2.25rem,5vw,3.5rem)","fontWeight":"700","lineHeight":"1.1"}}} -->
		<h1 class="wp-block-heading" style="color:#ffffff;font-size:clamp(2.25rem,5vw,3.5rem);font-weight:700;line-height:1.1">Недвижимость<br>для бизнеса</h1>
		<!-- /wp:heading -->
		<!-- wp:paragraph {"style":{"color":{"text":"#e8eef2"},"typography":{"fontSize":"1.125rem","lineHeight":"1.5"}}} -->
		<p style="color:#e8eef2;font-size:1.125rem;line-height:1.5">Аренда, продажа и подбор объектов — от офисов до складов</p>
		<!-- /wp:paragraph -->
		<!-- wp:buttons -->
		<div class="wp-block-buttons">
			<!-- wp:button {"backgroundColor":"surface","textColor":"text","style":{"border":{"radius":"999px"},"spacing":{"padding":{"top":"0.875rem","bottom":"0.875rem","left":"2rem","right":"2rem"}}}} -->
			<div class="wp-block-button"><a class="wp-block-button__link has-text-color has-surface-background-color has-text-color has-background wp-element-button" href="#contacts" style="border-radius:999px;padding-top:0.875rem;padding-bottom:0.875rem;padding-left:2rem;padding-right:2rem">Начать сотрудничество</a></div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->
	</div>
	<!-- /wp:aipilot-demo-blocks/hero -->
</div>
<!-- /wp:group -->
