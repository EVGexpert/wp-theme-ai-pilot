<?php
$text    = $attributes['text'] ?? 'Бесплатная консультация';
$sub     = $attributes['subText'] ?? '';
$link    = $attributes['linkUrl'] ?? '';
$size    = $attributes['size'] ?? '160px';
$hideMob = $attributes['hideOnMobile'] ?? false;

$tag = $link ? 'a' : 'div';
$attrs = $link ? ' href="' . esc_url($link) . '"' : '';
?>
<<?php echo $tag; ?><?php echo $attrs; ?> <?php echo get_block_wrapper_attributes(['class' => 'aipilot-badge' . ($hideMob ? ' aipilot-badge--hide-mobile' : '')]); ?> style="width:<?php echo esc_attr($size); ?>;height:<?php echo esc_attr($size); ?>;border-radius:50%;background:var(--wp--preset--color--primary);color:var(--wp--preset--color--surface);display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;text-decoration:none;font-weight:600;padding:1rem;box-sizing:border-box;">
	<div class="aipilot-badge__text" style="font-size:0.8125rem;line-height:1.3;"><?php echo esc_html($text); ?></div>
	<?php if ($sub): ?><div class="aipilot-badge__sub" style="font-size:0.75rem;opacity:0.85;margin-top:0.25rem;"><?php echo esc_html($sub); ?></div><?php endif; ?>
</<?php echo $tag; ?>>
<style>
@media (max-width:782px) { .aipilot-badge--hide-mobile { display:none; } }
</style>
