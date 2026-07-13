<?php
/**
 * Hero block — server render.
 */
$desktop = $attributes['desktopImageUrl'] ?? '';
$mobile  = $attributes['mobileImageUrl'] ?? '';
$overlay = $attributes['overlayColor'] ?? 'rgba(0,0,0,0.35)';
$minH    = $attributes['minHeight'] ?? '520px';
$radius  = $attributes['borderRadius'] ?? '22px';
$pos     = $attributes['contentPosition'] ?? 'center-left';

$posClass = match ($pos) { 'center' => 'aipilot-hero--center', 'center-right' => 'aipilot-hero--right', 'top-left' => 'aipilot-hero--top-left', default => 'aipilot-hero--left' };
?>
<div <?php echo get_block_wrapper_attributes(['class' => "aipilot-hero $posClass"]); ?> style="min-height:<?php echo esc_attr($minH); ?>; border-radius:<?php echo esc_attr($radius); ?>; overflow:hidden; position:relative;">
	<?php if ($desktop): ?>
	<picture>
		<?php if ($mobile): ?><source media="(max-width:782px)" srcset="<?php echo esc_url($mobile); ?>"><?php endif; ?>
		<img src="<?php echo esc_url($desktop); ?>" alt="" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;" loading="eager" decoding="async">
	</picture>
	<?php endif; ?>
	<div style="position:absolute;inset:0;background:<?php echo esc_attr($overlay); ?>;"></div>
	<div class="aipilot-hero__content" style="position:relative;z-index:1;padding:var(--wp--preset--spacing--xl);max-width:620px;">
		<?php echo $content; ?>
	</div>
</div>
