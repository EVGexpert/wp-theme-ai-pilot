<?php
$submit       = $attributes['submitText'] ?? 'Отправить заявку';
$success      = $attributes['successMessage'] ?? 'Спасибо! Заявка отправлена.';
$errorMsg     = $attributes['errorMessage'] ?? 'Ошибка. Попробуйте позже.';
$showPh       = $attributes['showPhone'] ?? true;
$showEm       = $attributes['showEmail'] ?? true;
$showMsg      = $attributes['showMessage'] ?? true;
$phone_req    = $attributes['phoneRequired'] ?? true;
$redirect_url = $attributes['redirectUrl'] ?? '';

$form_id = 'aipilot-form-' . wp_unique_id();
?>
<div <?php echo get_block_wrapper_attributes( array( 'class' => 'aipilot-lead-form' ) ); ?>>
	<form id="<?php echo esc_attr( $form_id ); ?>" class="aipilot-lead-form__form" method="post" novalidate
		data-success="<?php echo esc_attr( $success ); ?>"
		data-error="<?php echo esc_attr( $errorMsg ); ?>"<?php echo $redirect_url ? ' data-redirect="' . esc_url( $redirect_url ) . '"' : ''; ?>>
		<?php wp_nonce_field( 'aipilot_lead_form', 'nonce', false ); ?>
		<input type="hidden" name="action" value="aipilot_lead_form">
		<div class="aipilot-form-row">
			<div class="aipilot-form-field">
				<label for="<?php echo esc_attr( $form_id ); ?>-name" class="aipilot-form-label">Имя *</label>
				<input type="text" id="<?php echo esc_attr( $form_id ); ?>-name" name="name" required placeholder="Ваше имя">
			</div>
			<?php if ( $showPh ) : ?>
			<div class="aipilot-form-field">
				<label for="<?php echo esc_attr( $form_id ); ?>-phone" class="aipilot-form-label">Телефон<?php echo $phone_req ? ' *' : ''; ?></label>
				<input type="tel" id="<?php echo esc_attr( $form_id ); ?>-phone" name="phone"<?php echo $phone_req ? ' required' : ''; ?> placeholder="+7 (___) ___-__-__">
			</div>
			<?php endif; ?>
		</div>
		<?php if ( $showEm ) : ?>
		<div class="aipilot-form-field aipilot-form-field--full">
			<label for="<?php echo esc_attr( $form_id ); ?>-email" class="aipilot-form-label">Email</label>
			<input type="email" id="<?php echo esc_attr( $form_id ); ?>-email" name="email" placeholder="email@example.com">
		</div>
		<?php endif; ?>
		<?php if ( $showMsg ) : ?>
		<div class="aipilot-form-field aipilot-form-field--full">
			<label for="<?php echo esc_attr( $form_id ); ?>-message" class="aipilot-form-label">Сообщение</label>
			<textarea id="<?php echo esc_attr( $form_id ); ?>-message" name="message" rows="3" placeholder="Ваше сообщение"></textarea>
		</div>
		<?php endif; ?>
		<!-- Honeypot -->
		<div style="position:absolute;left:-9999px;" aria-hidden="true">
			<label for="<?php echo esc_attr( $form_id ); ?>-website">Website</label>
			<input type="text" id="<?php echo esc_attr( $form_id ); ?>-website" name="website" tabindex="-1" autocomplete="off">
		</div>
		<!-- Consent -->
		<div class="aipilot-form-consent">
			<input type="checkbox" id="<?php echo esc_attr( $form_id ); ?>-consent" name="consent" required>
			<label for="<?php echo esc_attr( $form_id ); ?>-consent">Я согласен на обработку персональных данных</label>
		</div>
		<button type="submit" class="aipilot-lead-form__submit"><?php echo esc_html( $submit ); ?></button>
		<div class="aipilot-form-message" aria-live="polite"></div>
	</form>
</div>
