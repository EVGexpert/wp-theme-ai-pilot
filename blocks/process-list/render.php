<?php
$dividers = $attributes['showDividers'] ?? true;
$numbers  = $attributes['showNumbers'] ?? true;
$gap      = $attributes['gap'] ?? '32px';
?>
<div <?php echo get_block_wrapper_attributes(['class' => 'aipilot-process-list']); ?> style="display:flex;flex-direction:column;gap:<?php echo esc_attr($gap); ?>;">
	<?php echo $content; ?>
</div>
