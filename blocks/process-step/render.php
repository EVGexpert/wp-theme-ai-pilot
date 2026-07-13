<?php
$num   = $attributes['stepNumber'] ?? 1;
$title = $attributes['title'] ?? 'Шаг';
$desc  = $attributes['description'] ?? '';
$icon  = $attributes['iconSvg'] ?? 'search';
$hideN = $attributes['hideNumber'] ?? false;

// Whitelist of safe SVG icons.
$icons = array(
	'search'    => '<svg width="20" height="20" viewBox="0 0 20 20" fill="none"><circle cx="8.5" cy="8.5" r="6" stroke="white" stroke-width="2"/><path d="M13 13L18 18" stroke="white" stroke-width="2" stroke-linecap="round"/></svg>',
	'check'     => '<svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M4 10l4 4 8-8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
	'doc'       => '<svg width="20" height="20" viewBox="0 0 20 20" fill="none"><rect x="3" y="1" width="14" height="18" rx="2" stroke="white" stroke-width="2"/><path d="M6 6h8M6 10h8M6 14h5" stroke="white" stroke-width="2" stroke-linecap="round"/></svg>',
	'building'  => '<svg width="20" height="20" viewBox="0 0 20 20" fill="none"><rect x="2" y="2" width="16" height="16" rx="1" stroke="white" stroke-width="2"/><path d="M2 8h16M5 5h2M5 12h2M10 5h2M10 12h2M5 16h10" stroke="white" stroke-width="2"/></svg>',
	'handshake' => '<svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M3 7l3-3 3 2 3-3 3 3v2l-6 6-6-6V7z" stroke="white" stroke-width="2" stroke-linejoin="round"/></svg>',
);
$svg = $icons[ $icon ] ?? $icons['check'];
?>
<div <?php echo get_block_wrapper_attributes( array( 'class' => 'aipilot-process-step' ) ); ?>>
	<div class="aipilot-process-step__icon">
		<?php if ( ! $hideN ) : ?>
			<span class="aipilot-process-step__number"><?php echo (int) $num; ?></span>
		<?php else : ?>
			<?php echo $svg; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped — whitelisted above ?>
		<?php endif; ?>
	</div>
	<div class="aipilot-process-step__content">
		<h4 class="aipilot-process-step__title"><?php echo esc_html( $title ); ?></h4>
		<?php if ( $desc ) : ?><p class="aipilot-process-step__desc"><?php echo esc_html( $desc ); ?></p><?php endif; ?>
	</div>
</div>
