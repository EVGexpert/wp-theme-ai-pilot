<?php
$prefix = $attributes['prefix'] ?? '';
$value  = $attributes['value'] ?? '100';
$suffix = $attributes['suffix'] ?? '+';
$label  = $attributes['label'] ?? '';
?>
<div <?php echo get_block_wrapper_attributes(['class' => 'aipilot-stat-item']); ?> style="text-align:center;">
	<div class="aipilot-stat-item__value" style="font-size:clamp(1.875rem,4vw,2.75rem);font-weight:700;line-height:1.15;color:var(--wp--preset--color--text);">
		<?php if ($prefix): ?><span class="aipilot-stat-item__prefix"><?php echo esc_html($prefix); ?></span><?php endif; ?>
		<span class="aipilot-stat-item__number"><?php echo esc_html($value); ?></span>
		<?php if ($suffix): ?><span class="aipilot-stat-item__suffix"><?php echo esc_html($suffix); ?></span><?php endif; ?>
	</div>
	<?php if ($label): ?>
	<p class="aipilot-stat-item__label" style="margin-top:0.25rem;font-size:0.875rem;color:var(--wp--preset--color--text-secondary);"><?php echo esc_html($label); ?></p>
	<?php endif; ?>
</div>
