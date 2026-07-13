<?php
$colsD = $attributes['columnsDesktop'] ?? 4;
$colsM = $attributes['columnsMobile'] ?? 2;
$gap   = $attributes['style']['spacing']['blockGap'] ?? 'var(--wp--preset--spacing--lg)';
?>
<div <?php echo get_block_wrapper_attributes(['class' => 'aipilot-stats-grid']); ?> style="display:grid;grid-template-columns:repeat(<?php echo (int)$colsD; ?>,1fr);gap:<?php echo esc_attr($gap); ?>;">
	<?php echo $content; ?>
</div>
<style>
@media (max-width:782px) {
	.aipilot-stats-grid { grid-template-columns:repeat(<?php echo (int)$colsM; ?>,1fr) !important; }
}
</style>
