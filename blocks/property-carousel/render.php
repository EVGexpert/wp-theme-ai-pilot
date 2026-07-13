<?php
$mode       = $attributes['sourceMode'] ?? 'dynamic';
$count      = $attributes['postCount'] ?? 6;
$cards      = $attributes['cardsPerView'] ?? 3;
$gap        = $attributes['gap'] ?? '24px';
$tax        = $attributes['taxonomyFilter'] ?? '';
$term       = $attributes['termId'] ?? 0;
$showArrows = $attributes['showArrows'] ?? true;
$autoplay   = $attributes['autoplay'] ?? true;
$loop       = $attributes['loop'] ?? true;

$posts = [];
if ( $mode === 'dynamic' ) {
	if ( function_exists( 'aipilot_render_property_card' ) ) {
		$args = ['post_type' => 'property', 'posts_per_page' => $count, 'post_status' => 'publish'];
		if ( $tax && $term ) {
			$args['tax_query'] = [[ 'taxonomy' => $tax, 'field' => 'term_id', 'terms' => $term ]];
		}
		$posts = get_posts( $args );
	}
}

$carousel_id = 'aipilot-carousel-' . wp_unique_id();
?>
<div <?php echo get_block_wrapper_attributes(['class' => 'aipilot-carousel']); ?> id="<?php echo esc_attr($carousel_id); ?>">
	<div class="aipilot-carousel__viewport" style="overflow:hidden;position:relative;">
		<div class="aipilot-carousel__track" style="display:flex;gap:<?php echo esc_attr($gap); ?>;transition:transform 0.4s ease;" data-cards="<?php echo (int)$cards; ?>">
			<?php if ($mode === 'dynamic'): ?>
				<?php foreach ($posts as $p): ?>
					<div class="aipilot-carousel__slide" style="flex:0 0 calc((100% - <?php echo esc_attr($gap); ?> * <?php echo (int)($cards-1); ?>) / <?php echo (int)$cards; ?>);">
						<?php echo aipilot_render_property_card($p->ID); ?>
					</div>
				<?php endforeach; ?>
			<?php else: ?>
				<?php echo $content; ?>
			<?php endif; ?>
		</div>
	</div>
	<?php if ($showArrows): ?>
	<button class="aipilot-carousel__prev" aria-label="Предыдущие" style="position:absolute;top:50%;left:0;transform:translateY(-50%);background:var(--wp--preset--color--surface);border:1px solid var(--wp--preset--color--border);border-radius:50%;width:44px;height:44px;cursor:pointer;z-index:2;display:flex;align-items:center;justify-content:center;">←</button>
	<button class="aipilot-carousel__next" aria-label="Следующие" style="position:absolute;top:50%;right:0;transform:translateY(-50%);background:var(--wp--preset--color--surface);border:1px solid var(--wp--preset--color--border);border-radius:50%;width:44px;height:44px;cursor:pointer;z-index:2;display:flex;align-items:center;justify-content:center;">→</button>
	<?php endif; ?>
</div>
