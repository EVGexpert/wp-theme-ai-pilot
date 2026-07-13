<?php
$dividers = $attributes['showDividers'] ?? true;
$numbers  = $attributes['showNumbers'] ?? true;
$gap      = $attributes['gap'] ?? '32px';

$classes = 'aipilot-process-list';
if ( $dividers ) {
	$classes .= ' has-dividers';
}
if ( ! $numbers ) {
	$classes .= ' hide-numbers';
}

$wrapper_attrs = get_block_wrapper_attributes( array(
	'class' => $classes,
	'style' => sprintf( '--process-gap:%s;', esc_attr( $gap ) ),
) );
?>
<div <?php echo $wrapper_attrs; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<?php echo $content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
</div>
