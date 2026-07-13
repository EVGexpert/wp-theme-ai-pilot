<?php
$submit   = $attributes['submitText'] ?? 'Отправить заявку';
$success  = $attributes['successMessage'] ?? 'Спасибо! Заявка отправлена.';
$errorMsg = $attributes['errorMessage'] ?? 'Ошибка. Попробуйте позже.';
$showPh   = $attributes['showPhone'] ?? true;
$showEm   = $attributes['showEmail'] ?? true;
$showMsg  = $attributes['showMessage'] ?? true;

$form_id = 'aipilot-form-' . wp_unique_id();
?>
<div <?php echo get_block_wrapper_attributes(['class' => 'aipilot-lead-form']); ?>>
	<form id="<?php echo esc_attr($form_id); ?>" class="aipilot-lead-form__form" method="post" novalidate style="display:flex;flex-direction:column;gap:var(--wp--preset--spacing--md);">
		<?php wp_nonce_field('aipilot_lead_form', 'nonce', false); ?>
		<div class="aipilot-form-row" style="display:flex;gap:var(--wp--preset--spacing--md);flex-wrap:wrap;">
			<div class="aipilot-form-field" style="flex:1;min-width:200px;">
				<label for="<?php echo esc_attr($form_id); ?>-name" style="display:block;font-size:0.8125rem;margin-bottom:0.25rem;color:var(--wp--preset--color--dark-text);">Имя *</label>
				<input type="text" id="<?php echo esc_attr($form_id); ?>-name" name="name" required style="width:100%;padding:0.75rem 0;border:none;border-bottom:1px solid rgba(255,255,255,0.3);background:transparent;color:#fff;font-size:1rem;outline:none;" placeholder="Ваше имя">
			</div>
			<?php if ($showPh): ?>
			<div class="aipilot-form-field" style="flex:1;min-width:200px;">
				<label for="<?php echo esc_attr($form_id); ?>-phone" style="display:block;font-size:0.8125rem;margin-bottom:0.25rem;color:var(--wp--preset--color--dark-text);">Телефон *</label>
				<input type="tel" id="<?php echo esc_attr($form_id); ?>-phone" name="phone" required style="width:100%;padding:0.75rem 0;border:none;border-bottom:1px solid rgba(255,255,255,0.3);background:transparent;color:#fff;font-size:1rem;outline:none;" placeholder="+7 (___) ___-__-__">
			</div>
			<?php endif; ?>
		</div>
		<?php if ($showEm): ?>
		<div class="aipilot-form-field">
			<label for="<?php echo esc_attr($form_id); ?>-email" style="display:block;font-size:0.8125rem;margin-bottom:0.25rem;color:var(--wp--preset--color--dark-text);">Email</label>
			<input type="email" id="<?php echo esc_attr($form_id); ?>-email" name="email" style="width:100%;padding:0.75rem 0;border:none;border-bottom:1px solid rgba(255,255,255,0.3);background:transparent;color:#fff;font-size:1rem;outline:none;" placeholder="email@example.com">
		</div>
		<?php endif; ?>
		<?php if ($showMsg): ?>
		<div class="aipilot-form-field">
			<label for="<?php echo esc_attr($form_id); ?>-message" style="display:block;font-size:0.8125rem;margin-bottom:0.25rem;color:var(--wp--preset--color--dark-text);">Сообщение</label>
			<textarea id="<?php echo esc_attr($form_id); ?>-message" name="message" rows="3" style="width:100%;padding:0.75rem 0;border:none;border-bottom:1px solid rgba(255,255,255,0.3);background:transparent;color:#fff;font-size:1rem;outline:none;resize:vertical;" placeholder="Ваше сообщение"></textarea>
		</div>
		<?php endif; ?>
		<!-- Honeypot -->
		<div style="position:absolute;left:-9999px;" aria-hidden="true">
			<label for="<?php echo esc_attr($form_id); ?>-website">Website</label>
			<input type="text" id="<?php echo esc_attr($form_id); ?>-website" name="website" tabindex="-1" autocomplete="off">
		</div>
		<!-- Consent -->
		<div class="aipilot-form-consent" style="display:flex;align-items:flex-start;gap:0.5rem;font-size:0.75rem;color:var(--wp--preset--color--dark-text);">
			<input type="checkbox" id="<?php echo esc_attr($form_id); ?>-consent" name="consent" required style="margin-top:0.2rem;">
			<label for="<?php echo esc_attr($form_id); ?>-consent">Я согласен на обработку персональных данных</label>
		</div>
		<button type="submit" class="aipilot-lead-form__submit" style="display:inline-block;padding:0.75rem 2rem;border:none;border-radius:999px;background:var(--wp--preset--color--surface);color:var(--wp--preset--color--text);font-size:0.9375rem;font-weight:600;cursor:pointer;align-self:flex-start;transition:background 0.2s;"><?php echo esc_html($submit); ?></button>
		<div class="aipilot-form-message" aria-live="polite" style="font-size:0.875rem;display:none;"></div>
	</form>
</div>
