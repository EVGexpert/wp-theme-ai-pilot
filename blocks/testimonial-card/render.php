<?php
$quote     = $attributes['quote'] ?? '';
$author    = $attributes['authorName'] ?? '';
$role      = $attributes['authorRole'] ?? '';
$avatar_id = $attributes['avatarId'] ?? 0;
$avatar    = $attributes['avatarUrl'] ?? '';
$show_mark = $attributes['showQuoteMark'] ?? true;
?>
<div <?php echo get_block_wrapper_attributes( array( 'class' => 'aipilot-testimonial-card' ) ); ?>>
	<?php if ( $show_mark ) : ?>
	<div class="aipilot-testimonial-card__quote-mark" aria-hidden="true">&ldquo;</div>
	<?php endif; ?>
	<blockquote class="aipilot-testimonial-card__quote"><?php echo esc_html( $quote ); ?></blockquote>
	<div class="aipilot-testimonial-card__author">
		<?php
		$avatar_html = '';
		if ( $avatar_id ) {
			$avatar_html = wp_get_attachment_image( $avatar_id, array( 40, 40 ), false, array(
				'class'    => 'aipilot-testimonial-card__avatar',
				'loading'  => 'lazy',
				'decoding' => 'async',
			) );
		} elseif ( $avatar ) {
			$avatar_html = '<img src="' . esc_url( $avatar ) . '" alt="' . esc_attr( $author ) . '" class="aipilot-testimonial-card__avatar" loading="lazy" decoding="async">';
		}
		?>
		<?php if ( $avatar_html ) : ?>
			<?php echo $avatar_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<?php else : ?>
			<span class="aipilot-testimonial-card__avatar-fallback" aria-hidden="true"><?php echo esc_html( mb_substr( $author, 0, 1 ) ); ?></span>
		<?php endif; ?>
		<div>
			<cite class="aipilot-testimonial-card__name"><?php echo esc_html( $author ); ?></cite>
			<?php if ( $role ) : ?><span class="aipilot-testimonial-card__role"><?php echo esc_html( $role ); ?></span><?php endif; ?>
		</div>
	</div>
</div>
