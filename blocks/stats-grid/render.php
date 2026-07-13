<?php
$colsD    = $attributes['columnsDesktop'] ?? 4;
$colsT    = $attributes['columnsTablet'] ?? 4;
$colsM    = $attributes['columnsMobile'] ?? 2;
$dividers = $attributes['showDividers'] ?? false;
$animate  = $attributes['hasAnimation'] ?? true;

$classes = 'aipilot-stats-grid';
if ( $dividers ) {
	$classes .= ' has-dividers';
}
if ( $animate ) {
	$classes .= ' has-animation';
}

$wrapper_attrs = get_block_wrapper_attributes( array(
	'class' => $classes,
	'style' => sprintf(
		'--stats-cols-desktop:%d;--stats-cols-tablet:%d;--stats-cols-mobile:%d;',
		(int) $colsD,
		(int) $colsT,
		(int) $colsM
	),
) );
?>
<div <?php echo $wrapper_attrs; ?>>
	<?php echo $content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
</div>
