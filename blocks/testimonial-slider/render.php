<?php
$cards    = $attributes['cardsPerView'] ?? 2;
$gap      = $attributes['gap'] ?? '24px';
$show_arr = $attributes['showArrows'] ?? true;
$show_dot = $attributes['showDots'] ?? false;
$autoplay = $attributes['autoplay'] ?? false;
$loop     = $attributes['loop'] ?? true;

$slider_id = 'aipilot-testimonials-' . wp_unique_id();

$wrapper_attrs = get_block_wrapper_attributes( array(
	'class' => 'aipilot-testimonial-slider' . ( $loop ? ' is-loop' : '' ),
	'style' => sprintf( '--testimonial-gap:%s;--testimonial-cards:%d;', esc_attr( $gap ), (int) $cards ),
	'data-autoplay' => $autoplay ? 'true' : 'false',
	'data-loop'     => $loop ? 'true' : 'false',
	'data-cards'    => (int) $cards,
) );
?>
<div <?php echo $wrapper_attrs; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> id="<?php echo esc_attr( $slider_id ); ?>">
	<div class="aipilot-testimonial__viewport">
		<div class="aipilot-testimonial__track">
			<?php echo $content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</div>
	</div>
	<?php if ( $show_arr ) : ?>
	<button class="aipilot-testimonial__prev" aria-label="Предыдущий отзыв">&larr;</button>
	<button class="aipilot-testimonial__next" aria-label="Следующий отзыв">&rarr;</button>
	<?php endif; ?>
	<?php if ( $show_dot ) : ?>
	<div class="aipilot-testimonial__dots" role="tablist" aria-label="Отзывы"></div>
	<?php endif; ?>
</div>
