<?php
$desktop = $attributes['desktopImageUrl'] ?? '';
$mobile  = $attributes['mobileImageUrl'] ?? '';
$alt     = $attributes['alt'] ?? '';
$ratio   = $attributes['aspectRatio'] ?? '3/4';
$radius  = $attributes['radius'] ?? '22px';
$showMob = $attributes['showOnMobile'] ?? false;
?>
<div <?php echo get_block_wrapper_attributes(['class' => 'aipilot-process-media' . ($showMob ? '' : ' aipilot-process-media--hide-mobile')]); ?>>
	<?php if ($desktop): ?>
	<picture>
		<?php if ($mobile): ?><source media="(max-width:782px)" srcset="<?php echo esc_url($mobile); ?>"><?php endif; ?>
		<img src="<?php echo esc_url($desktop); ?>" alt="<?php echo esc_attr($alt); ?>" style="aspect-ratio:<?php echo esc_attr($ratio); ?>;object-fit:cover;border-radius:<?php echo esc_attr($radius); ?>;width:100%;" loading="lazy" decoding="async">
	</picture>
	<?php else: ?>
	<div style="aspect-ratio:<?php echo esc_attr($ratio); ?>;background:var(--wp--preset--color--surface-soft);border-radius:<?php echo esc_attr($radius); ?>;display:flex;align-items:center;justify-content:center;color:var(--wp--preset--color--text-secondary);">Изображение</div>
	<?php endif; ?>
</div>
<style>
@media (max-width:782px) {
	.aipilot-process-media--hide-mobile { display:none; }
}
</style>
