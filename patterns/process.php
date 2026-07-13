<?php
/**
 * Title: Process / How We Work
 * Slug: aipilot-demo/process
 * Categories: aipilot-demo
 * Description: Секция «Как мы работаем» с изображением и шагами.
 */
$process_img = get_template_directory_uri() . '/assets/images/process-office.svg';
?>
<!-- wp:group {"align":"wide","className":"site-section","anchor":"process","style":{"spacing":{"padding":{"top":"var:preset|spacing|4xl","bottom":"var:preset|spacing|4xl","left":"var:preset|spacing|lg","right":"var:preset|spacing|lg"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide site-section" id="process" style="padding-top:var(--wp--preset--spacing--4xl);padding-bottom:var(--wp--preset--spacing--4xl);padding-left:var(--wp--preset--spacing--lg);padding-right:var(--wp--preset--spacing--lg)">
	<!-- wp:columns {"verticalAlignment":"top","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|2xl","left":"var:preset|spacing|3xl"}}}} -->
	<div class="wp-block-columns are-vertically-aligned-top">
		<!-- wp:column {"width":"40%","verticalAlignment":"top"} -->
		<div class="wp-block-column" style="flex-basis:40%">
			<!-- wp:group {"className":"process-visual","layout":{"type":"default"}} -->
			<div class="wp-block-group process-visual">
				<!-- wp:aipilot-demo-blocks/process-media {"desktopImageUrl":"<?php echo esc_url( $process_img ); ?>","aspectRatio":"3/4","showOnMobile":false} /-->
				<!-- wp:aipilot-demo-blocks/consultation-badge {"text":"Бесплатная консультация","subText":"Онлайн / Офлайн"} /-->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->
		<!-- wp:column {"width":"60%","verticalAlignment":"top"} -->
		<div class="wp-block-column" style="flex-basis:60%">
			<!-- wp:heading {"level":2} -->
			<h2 class="wp-block-heading">Как мы работаем</h2>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"textColor":"text-secondary","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|xl"}}}} -->
			<p class="has-text-secondary-color has-text-color" style="margin-bottom:var(--wp--preset--spacing--xl)">Прозрачный процесс от первой консультации до подписания договора.</p>
			<!-- /wp:paragraph -->
			<!-- wp:aipilot-demo-blocks/process-list {"showDividers":true,"showNumbers":true,"gap":"28px"} -->
			<!-- wp:aipilot-demo-blocks/process-step {"stepNumber":1,"title":"Консультация и анализ потребностей","description":"Обсуждаем ваши задачи, бюджет, локацию и сроки. Формируем портрет идеального объекта."} /-->
			<!-- wp:aipilot-demo-blocks/process-step {"stepNumber":2,"title":"Поиск и подбор объектов","description":"Анализируем рынок, отбираем подходящие варианты, организуем просмотры."} /-->
			<!-- wp:aipilot-demo-blocks/process-step {"stepNumber":3,"title":"Просмотр и оценка недвижимости","description":"Выезжаем на объекты, оцениваем состояние, инфраструктуру и перспективы."} /-->
			<!-- wp:aipilot-demo-blocks/process-step {"stepNumber":4,"title":"Проверка и подготовка документов","description":"Юридическая экспертиза, проверка обременений, подготовка полного пакета документов."} /-->
			<!-- wp:aipilot-demo-blocks/process-step {"stepNumber":5,"title":"Сопровождение сделки","description":"Организуем подписание, регистрацию и передачу объекта. Остаёмся на связи после сделки."} /-->
			<!-- /wp:aipilot-demo-blocks/process-list -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
