<?php
$prefix = $attributes['prefix'] ?? '';
$value  = $attributes['value'] ?? '100';
$suffix = $attributes['suffix'] ?? '+';
$label  = $attributes['label'] ?? '';
$animate = $attributes['showCounter'] ?? false;
?>
<div <?php echo get_block_wrapper_attributes( array( 'class' => 'aipilot-stat-item' ) ); ?>>
	<div class="aipilot-stat-item__value">
		<?php if ( $prefix ) : ?><span class="aipilot-stat-item__prefix"><?php echo esc_html( $prefix ); ?></span><?php endif; ?>
		<span class="aipilot-stat-item__number"<?php echo $animate ? ' data-count-target="' . esc_attr( $value ) . '"' : ''; ?>><?php echo esc_html( $value ); ?></span>
		<?php if ( $suffix ) : ?><span class="aipilot-stat-item__suffix"><?php echo esc_html( $suffix ); ?></span><?php endif; ?>
	</div>
	<?php if ( $label ) : ?>
	<p class="aipilot-stat-item__label"><?php echo esc_html( $label ); ?></p>
	<?php endif; ?>
</div>
