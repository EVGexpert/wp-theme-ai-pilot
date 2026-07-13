<?php
$logo_id  = $attributes['logoImageId'] ?? 0;
$logo_url = $attributes['logoImageUrl'] ?? '';
$alt      = $attributes['alt'] ?? '';
$name     = $attributes['companyName'] ?? '';
$link     = $attributes['linkUrl'] ?? '';

$img = '';
if ( $logo_id ) {
	$img = wp_get_attachment_image( $logo_id, 'medium', false, array(
		'class'    => 'aipilot-logo-item__img',
		'loading'  => 'lazy',
		'decoding' => 'async',
	) );
} elseif ( $logo_url ) {
	$img = '<img src="' . esc_url( $logo_url ) . '" alt="' . esc_attr( $alt ?: $name ) . '" class="aipilot-logo-item__img" loading="lazy" decoding="async">';
}

$tag        = $link ? 'a' : 'span';
$link_attrs = $link ? ' href="' . esc_url( $link ) . '" target="_blank" rel="noopener noreferrer"' : '';
?>
<<?php echo $tag; ?><?php echo $link_attrs; ?> <?php echo get_block_wrapper_attributes( array( 'class' => 'aipilot-logo-item' ) ); ?>>
	<?php if ( $img ) : ?>
		<?php echo $img; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	<?php else : ?>
		<span class="aipilot-logo-item__fallback"><?php echo esc_html( $name ?: 'Логотип' ); ?></span>
	<?php endif; ?>
</<?php echo $tag; ?>>
