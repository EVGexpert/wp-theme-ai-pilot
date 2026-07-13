<?php
$pid = $attributes['propertyId'] ?? null;
if ( ! $pid ) {
	return '';
}

if ( ! function_exists( 'aipilot_render_property_card' ) ) {
	return '';
}

echo aipilot_render_property_card( $pid );
