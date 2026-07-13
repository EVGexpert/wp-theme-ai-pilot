<?php
$gap       = $attributes['gap'] ?? '32px';
$visible   = $attributes['visibleItems'] ?? 5;
$autoplay  = $attributes['autoplay'] ?? false;
$monochrome = $attributes['monochrome'] ?? true;
?>
<div <?php echo get_block_wrapper_attributes(['class' => 'aipilot-logo-strip' . ($monochrome ? ' aipilot-logo-strip--mono' : '')]); ?>>
	<div class="aipilot-logo-strip__track" style="display:flex;align-items:center;gap:<?php echo esc_attr($gap); ?>;overflow-x:auto;scroll-snap-type:x mandatory;-webkit-overflow-scrolling:touch;padding:0.5rem 0;">
		<?php echo $content; ?>
	</div>
</div>
