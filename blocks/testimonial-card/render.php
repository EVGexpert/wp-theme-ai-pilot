<?php
$quote    = $attributes['quote'] ?? '';
$author   = $attributes['authorName'] ?? '';
$role     = $attributes['authorRole'] ?? '';
$avatar   = $attributes['avatarUrl'] ?? '';
$rating   = $attributes['rating'] ?? 5;
$showMark = $attributes['showQuoteMark'] ?? true;
?>
<div <?php echo get_block_wrapper_attributes(['class' => 'aipilot-testimonial-card']); ?> style="flex:0 0 calc((100% - var(--testimonial-gap, 24px)) / var(--testimonial-cards, 2));background:var(--wp--preset--color--surface-soft);border-radius:14px;padding:var(--wp--preset--spacing--lg);">
	<?php if ($showMark): ?>
	<div class="aipilot-testimonial-card__quote-mark" style="font-size:2.5rem;line-height:1;color:var(--wp--preset--color--primary);margin-bottom:0.5rem;">❝</div>
	<?php endif; ?>
	<blockquote class="aipilot-testimonial-card__quote" style="margin:0 0 var(--wp--preset--spacing--md);font-size:0.9375rem;line-height:1.6;color:var(--wp--preset--color--text);font-style:italic;"><?php echo esc_html($quote); ?></blockquote>
	<div class="aipilot-testimonial-card__author" style="display:flex;align-items:center;gap:var(--wp--preset--spacing--sm);">
		<?php if ($avatar): ?>
		<img src="<?php echo esc_url($avatar); ?>" alt="<?php echo esc_attr($author); ?>" style="width:40px;height:40px;border-radius:50%;object-fit:cover;" loading="lazy">
		<?php else: ?>
		<div style="width:40px;height:40px;border-radius:50%;background:var(--wp--preset--color--primary-light);display:flex;align-items:center;justify-content:center;font-weight:600;font-size:0.875rem;color:var(--wp--preset--color--primary-dark);"><?php echo esc_html(mb_substr($author, 0, 1)); ?></div>
		<?php endif; ?>
		<div>
			<cite style="font-style:normal;font-weight:600;font-size:0.875rem;display:block;"><?php echo esc_html($author); ?></cite>
			<?php if ($role): ?><span style="font-size:0.75rem;color:var(--wp--preset--color--text-secondary);"><?php echo esc_html($role); ?></span><?php endif; ?>
		</div>
	</div>
</div>
