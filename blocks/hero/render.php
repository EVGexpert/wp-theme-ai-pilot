<?php
/**
 * Hero block — server render.
 */
$desktop_id = $attributes['desktopImageId'] ?? 0;
$desktop    = $attributes['desktopImageUrl'] ?? '';
$mobile_id  = $attributes['mobileImageId'] ?? 0;
$mobile     = $attributes['mobileImageUrl'] ?? '';
$overlay    = $attributes['overlayColor'] ?? 'rgba(0,0,0,0.35)';
$minH       = $attributes['minHeight'] ?? '520px';
$radius     = $attributes['borderRadius'] ?? '22px';
$pos        = $attributes['contentPosition'] ?? 'center-left';

$posClass = match ( $pos ) {
	'center'       => 'aipilot-hero--center',
	'center-right' => 'aipilot-hero--right',
	'top-left'     => 'aipilot-hero--top-left',
	default        => 'aipilot-hero--left',
};

// Build desktop image markup (prefer attachment ID for srcset + dimensions).
$desktop_img = '';
if ( $desktop_id ) {
	$desktop_img = wp_get_attachment_image( $desktop_id, 'full', false, array(
		'class'         => 'aipilot-hero__img',
		'loading'       => 'eager',
		'decoding'      => 'async',
		'fetchpriority' => 'high',
	) );
} elseif ( $desktop ) {
	$desktop_img = '<img class="aipilot-hero__img" src="' . esc_url( $desktop ) . '" alt="" loading="eager" decoding="async" fetchpriority="high" width="1600" height="720">';
}

// Mobile source (picture <source>).
$mobile_src = '';
if ( $mobile_id ) {
	$mobile_src = wp_get_attachment_image_src( $mobile_id, 'full' );
	$mobile_src = $mobile_src ? $mobile_src[0] : '';
} elseif ( $mobile ) {
	$mobile_src = $mobile;
}
?>
<figure <?php echo get_block_wrapper_attributes( array( 'class' => "aipilot-hero $posClass" ) ); ?> style="--hero-min-height:<?php echo esc_attr( $minH ); ?>;--hero-radius:<?php echo esc_attr( $radius ); ?>;--hero-overlay:<?php echo esc_attr( $overlay ); ?>;">
	<?php if ( $desktop_img ) : ?>
	<picture class="aipilot-hero__media">
		<?php if ( $mobile_src ) : ?>
			<source media="(max-width: 782px)" srcset="<?php echo esc_url( $mobile_src ); ?>">
		<?php endif; ?>
		<?php echo $desktop_img; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped — built above with escaping ?>
	</picture>
	<?php endif; ?>
	<div class="aipilot-hero__overlay" aria-hidden="true"></div>
	<div class="aipilot-hero__content">
		<?php echo $content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</div>
</figure>
