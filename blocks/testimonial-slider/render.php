<?php
$cards   = $attributes['cardsPerView'] ?? 2;
$gap     = $attributes['gap'] ?? '24px';
$showArr = $attributes['showArrows'] ?? true;
$showDot = $attributes['showDots'] ?? false;

$slider_id = 'aipilot-testimonials-' . wp_unique_id();
?>
<div <?php echo get_block_wrapper_attributes(['class' => 'aipilot-testimonial-slider']); ?> id="<?php echo esc_attr($slider_id); ?>">
	<div class="aipilot-testimonial__viewport" style="overflow:hidden;">
		<div class="aipilot-testimonial__track" style="display:flex;gap:<?php echo esc_attr($gap); ?>;" data-cards="<?php echo (int)$cards; ?>">
			<?php echo $content; ?>
		</div>
	</div>
	<?php if ($showArr): ?>
	<button class="aipilot-testimonial__prev" aria-label="Предыдущий отзыв">←</button>
	<button class="aipilot-testimonial__next" aria-label="Следующий отзыв">→</button>
	<?php endif; ?>
</div>
