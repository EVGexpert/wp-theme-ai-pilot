<?php
$text    = $attributes['text'] ?? 'Бесплатная консультация';
$sub     = $attributes['subText'] ?? '';
$link    = $attributes['linkUrl'] ?? '';
$size    = $attributes['size'] ?? '160px';
$hideMob = $attributes['hideOnMobile'] ?? false;

$classes = 'aipilot-consultation-badge';
if ( $hideMob ) {
	$classes .= ' aipilot-consultation-badge--hide-mobile';
}
$wrapper_attrs = get_block_wrapper_attributes( array(
	'class' => $classes,
	'style' => sprintf( '--badge-size:%s;', esc_attr( $size ) ),
) );

$tag        = $link ? 'a' : 'div';
$link_attrs = $link ? ' href="' . esc_url( $link ) . '"' : '';
?>
<<?php echo $tag; ?><?php echo $link_attrs; ?> <?php echo $wrapper_attrs; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<span class="aipilot-consultation-badge__text"><?php echo esc_html( $text ); ?></span>
	<?php if ( $sub ) : ?><span class="aipilot-consultation-badge__sub"><?php echo esc_html( $sub ); ?></span><?php endif; ?>
</<?php echo $tag; ?>>
