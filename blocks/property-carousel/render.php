<?php
$mode        = $attributes['sourceMode'] ?? 'dynamic';
$count       = $attributes['postCount'] ?? 6;
$cards       = $attributes['cardsPerView'] ?? 3;
$tablet      = $attributes['tabletCardsPerView'] ?? 2;
$mobile      = $attributes['mobileCardsPerView'] ?? 1;
$gap         = $attributes['gap'] ?? '24px';
$tax         = $attributes['taxonomyFilter'] ?? '';
$term        = $attributes['termId'] ?? 0;
$show_arrows = $attributes['showArrows'] ?? true;
$show_dots   = $attributes['showDots'] ?? true;
$autoplay    = $attributes['autoplay'] ?? false;
$loop        = $attributes['loop'] ?? true;

$posts = array();
if ( $mode === 'dynamic' ) {
	if ( function_exists( 'aipilot_render_property_card' ) ) {
		$args = array(
			'post_type'      => 'property',
			'posts_per_page' => $count,
			'post_status'    => 'publish',
			'orderby'        => 'date',
			'order'          => 'DESC',
		);
		if ( $tax && $term ) {
			$args['tax_query'] = array( array( 'taxonomy' => $tax, 'field' => 'term_id', 'terms' => $term ) );
		}
		$posts = get_posts( $args );
	}
}

$carousel_id = 'aipilot-carousel-' . wp_unique_id();

$wrapper_attrs = get_block_wrapper_attributes( array(
	'class' => 'aipilot-carousel' . ( $loop ? ' is-loop' : '' ),
	'style' => sprintf( '--carousel-gap:%s;--carousel-cards:%d;--carousel-cards-tablet:%d;--carousel-cards-mobile:%d;', esc_attr( $gap ), (int) $cards, (int) $tablet, (int) $mobile ),
	'data-autoplay'     => $autoplay ? 'true' : 'false',
	'data-loop'         => $loop ? 'true' : 'false',
	'data-cards'        => (int) $cards,
	'data-cards-tablet' => (int) $tablet,
	'data-cards-mobile' => (int) $mobile,
) );
?>
<div <?php echo $wrapper_attrs; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> id="<?php echo esc_attr( $carousel_id ); ?>">
	<div class="aipilot-carousel__viewport">
		<div class="aipilot-carousel__track">
			<?php if ( $mode === 'dynamic' ) : ?>
				<?php foreach ( $posts as $p ) : ?>
					<div class="aipilot-carousel__slide">
						<?php echo aipilot_render_property_card( $p->ID ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>
				<?php endforeach; ?>
			<?php else : ?>
				<?php echo $content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<?php endif; ?>
		</div>
	</div>
	<?php if ( $show_arrows ) : ?>
	<button class="aipilot-carousel__prev" aria-label="Предыдущие слайды">&larr;</button>
	<button class="aipilot-carousel__next" aria-label="Следующие слайды">&rarr;</button>
	<?php endif; ?>
	<?php if ( $show_dots ) : ?>
	<div class="aipilot-carousel__dots" role="tablist" aria-label="Слайды каталога"></div>
	<?php endif; ?>
</div>
