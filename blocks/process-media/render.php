<?php
$desktop_id = $attributes['desktopImageId'] ?? 0;
$desktop    = $attributes['desktopImageUrl'] ?? '';
$mobile_id  = $attributes['mobileImageId'] ?? 0;
$mobile     = $attributes['mobileImageUrl'] ?? '';
$alt        = $attributes['alt'] ?? '';
$ratio      = $attributes['aspectRatio'] ?? '3/4';
$radius     = $attributes['radius'] ?? '22px';
$show_mob   = $attributes['showOnMobile'] ?? false;

$classes = 'aipilot-process-media';
if ( ! $show_mob ) {
	$classes .= ' aipilot-process-media--hide-mobile';
}
$wrapper_attrs = get_block_wrapper_attributes( array(
	'class' => $classes,
	'style' => sprintf( '--media-ratio:%s;--media-radius:%s;', esc_attr( $ratio ), esc_attr( $radius ) ),
) );

$desktop_img = '';
if ( $desktop_id ) {
	$desktop_img = wp_get_attachment_image( $desktop_id, 'large', false, array(
		'loading'  => 'lazy',
		'decoding' => 'async',
	) );
} elseif ( $desktop ) {
	$desktop_img = '<img src="' . esc_url( $desktop ) . '" alt="' . esc_attr( $alt ) . '" loading="lazy" decoding="async">';
}

$mobile_src = '';
if ( $mobile_id ) {
	$m = wp_get_attachment_image_src( $mobile_id, 'large' );
	$mobile_src = $m ? $m[0] : '';
} elseif ( $mobile ) {
	$mobile_src = $mobile;
}
?>
<div <?php echo $wrapper_attrs; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<?php if ( $desktop_img ) : ?>
	<picture>
		<?php if ( $mobile_src ) : ?>
			<source media="(max-width: 782px)" srcset="<?php echo esc_url( $mobile_src ); ?>">
		<?php endif; ?>
		<?php echo $desktop_img; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped — escaped above ?>
	</picture>
	<?php else : ?>
	<div class="aipilot-process-media__placeholder">Изображение</div>
	<?php endif; ?>
</div>
