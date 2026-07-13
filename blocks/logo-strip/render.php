<?php
$gap        = $attributes['gap'] ?? '32px';
$visible    = $attributes['visibleItems'] ?? 5;
$autoplay   = $attributes['autoplay'] ?? false;
$monochrome = $attributes['monochrome'] ?? true;

$classes = 'aipilot-logo-strip';
if ( $monochrome ) {
	$classes .= ' aipilot-logo-strip--mono';
}
if ( $autoplay ) {
	$classes .= ' aipilot-logo-strip--autoplay';
}

$wrapper_attrs = get_block_wrapper_attributes( array(
	'class' => $classes,
	'style' => sprintf(
		'--logo-gap:%s;--logo-visible:%d;',
		esc_attr( $gap ),
		(int) $visible
	),
	'data-autoplay' => $autoplay ? 'true' : 'false',
) );
?>
<div <?php echo $wrapper_attrs; ?>>
	<div class="aipilot-logo-strip__track">
		<?php echo $content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</div>
</div>
