<?php
$logo_id   = $attributes['logoImageId'] ?? 0;
$logo_url  = $attributes['logoImageUrl'] ?? '';
$alt       = $attributes['alt'] ?? '';
$name      = $attributes['companyName'] ?? '';
$link      = $attributes['linkUrl'] ?? '';
$mono      = $attributes['monochrome'] ?? true;

$img = '';
if ($logo_id) {
	$img = wp_get_attachment_image($logo_id, 'medium', false, ['class' => 'aipilot-logo-item__img', 'style' => 'max-height:48px;width:auto;' . ($mono ? 'filter:grayscale(100%) opacity(0.7);' : '')]);
} elseif ($logo_url) {
	$img = '<img src="' . esc_url($logo_url) . '" alt="' . esc_attr($alt ?: $name) . '" class="aipilot-logo-item__img" style="max-height:48px;width:auto;' . ($mono ? 'filter:grayscale(100%) opacity(0.7);' : '') . '" loading="lazy" decoding="async">';
}

$tag = $link ? 'a' : 'span';
$attrs = $link ? ' href="' . esc_url($link) . '" target="_blank" rel="noopener"' : '';
?>
<<?php echo $tag; ?><?php echo $attrs; ?> <?php echo get_block_wrapper_attributes(['class' => 'aipilot-logo-item']); ?> style="flex-shrink:0;scroll-snap-align:start;">
	<?php if ($img): echo $img; else: ?><span class="aipilot-logo-item__fallback" style="font-size:0.875rem;color:var(--wp--preset--color--text-secondary);"><?php echo esc_html($name ?: 'Логотип'); ?></span><?php endif; ?>
</<?php echo $tag; ?>>
