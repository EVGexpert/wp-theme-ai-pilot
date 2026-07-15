<?php
/**
 * AIPilot Demo — FSE Block Theme
 * Все блоки, CPT и функциональность внутри темы.
 *
 * @package AIPilot_Demo
 */

if ( ! defined( 'ABSPATH' ) ) exit;
define( 'AIPILOT_DEMO_VERSION', '1.0.0' );

/**
 * Возвращает версию файла по времени его изменения (cache-busting).
 * Если файл не найден — fallback на версию темы.
 *
 * @param string $rel_path Относительный путь от корня темы (например '/assets/css/base.css').
 * @return string|int
 */
function aipilot_asset_version( $rel_path ) {
	$path = get_template_directory() . $rel_path;
	return file_exists( $path ) ? filemtime( $path ) : AIPILOT_DEMO_VERSION;
}

// ═══════════════════════════════════════════
// THEME SETUP
// ═══════════════════════════════════════════
function aipilot_demo_setup() {
	load_theme_textdomain( 'aipilot-demo', get_template_directory() . '/languages' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/css/editor.css' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' ) );
}

/**
 * Cache-busting для editor styles, подключённых через add_editor_style().
 * Добавляет ?ver=filemtime к URL editor.css, чтобы редактор всегда брал свежий файл.
 */
function aipilot_demo_editor_style_version( $mce_css ) {
	$rel  = '/assets/css/editor.css';
	$path = get_template_directory() . $rel;
	if ( file_exists( $path ) ) {
		$ver   = filemtime( $path );
		$uri   = get_template_directory_uri() . $rel . '?ver=' . $ver;
		$mce_css = str_replace( get_template_directory_uri() . $rel, $uri, $mce_css );
	}
	return $mce_css;
}
add_action( 'after_setup_theme', 'aipilot_demo_setup' );
add_filter( 'mce_css', 'aipilot_demo_editor_style_version' );

function aipilot_demo_enqueue_assets() {
	// Шрифты Inter подключаются автоматически через theme.json (fontFace).
	// Версия = filemtime файла → браузер всегда грузит свежую копию после правок.
	wp_enqueue_style( 'aipilot-demo-base', get_template_directory_uri() . '/assets/css/base.css', array(), aipilot_asset_version( '/assets/css/base.css' ) );
	wp_enqueue_style( 'aipilot-demo-blocks', get_template_directory_uri() . '/blocks/blocks.css', array(), aipilot_asset_version( '/blocks/blocks.css' ) );
	wp_enqueue_script( 'aipilot-demo-theme', get_template_directory_uri() . '/assets/js/theme.js', array(), aipilot_asset_version( '/assets/js/theme.js' ), true );
	wp_enqueue_script( 'aipilot-demo-frontend', get_template_directory_uri() . '/blocks/frontend.js', array(), aipilot_asset_version( '/blocks/frontend.js' ), true );
	wp_localize_script( 'aipilot-demo-frontend', 'aipilotFrontend', array(
		'ajaxUrl' => admin_url( 'admin-ajax.php' ),
		'nonce'   => wp_create_nonce( 'aipilot_lead_form' ),
	) );
}
add_action( 'wp_enqueue_scripts', 'aipilot_demo_enqueue_assets' );

/**
 * Регистрация категории блоков "aipilot-demo" в инспекторе Gutenberg.
 * Без этого блоки с "category": "aipilot-demo" не отображаются корректно.
 */
function aipilot_demo_block_categories( $categories ) {
	array_unshift( $categories, array(
		'slug'  => 'aipilot-demo',
		'title' => __( 'AIPilot Demo', 'aipilot-demo' ),
		'icon'  => 'building',
	) );
	return $categories;
}
add_filter( 'block_categories_all', 'aipilot_demo_block_categories' );

function aipilot_demo_editor_assets() {
	// Регистрация блоков в JS-стороне редактора (без этого Gutenberg считает блоки "unsupported").
	$deps = array( 'wp-blocks', 'wp-element', 'wp-block-editor', 'wp-components', 'wp-server-side-render', 'wp-i18n' );
	wp_enqueue_script( 'aipilot-demo-editor', get_template_directory_uri() . '/assets/js/editor.js', $deps, aipilot_asset_version( '/assets/js/editor.js' ), true );
	wp_enqueue_script( 'aipilot-demo-blocks', get_template_directory_uri() . '/assets/js/blocks.js', $deps, aipilot_asset_version( '/assets/js/blocks.js' ), true );
}
add_action( 'enqueue_block_editor_assets', 'aipilot_demo_editor_assets' );

function aipilot_demo_pattern_categories() {
	if ( function_exists( 'register_block_pattern_category' ) ) {
		register_block_pattern_category( 'aipilot-demo', array( 'label' => __( 'AIPilot Demo', 'aipilot-demo' ) ) );
	}
}
add_action( 'init', 'aipilot_demo_pattern_categories' );

// ═══════════════════════════════════════════
// CPT PROPERTY
// ═══════════════════════════════════════════
function aipilot_register_property_cpt() {
	$labels = array(
		'name'          => 'Объекты',
		'singular_name' => 'Объект',
		'menu_name'     => 'Объекты',
		'add_new'       => 'Добавить',
		'add_new_item'  => 'Добавить объект',
		'edit_item'     => 'Редактировать',
		'view_item'     => 'Просмотреть',
		'all_items'     => 'Все объекты',
		'search_items'  => 'Поиск объектов',
		'featured_image'=> 'Изображение объекта',
		'set_featured_image' => 'Установить изображение',
	);
	register_post_type( 'property', array(
		'labels'      => $labels,
		'public'      => true,
		'show_in_rest'=> true,
		'has_archive' => true,
		'menu_icon'   => 'dashicons-building',
		'menu_position'=> 20,
		'supports'    => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'custom-fields' ),
		'rewrite'     => array( 'slug' => 'property', 'with_front' => false ),
	) );

	// Taxonomies
	register_taxonomy( 'property_type', 'property', array(
		'label'        => 'Тип',
		'hierarchical' => true,
		'show_in_rest' => true,
		'rewrite'      => array( 'slug' => 'property-type' ),
	) );
	register_taxonomy( 'property_location', 'property', array(
		'label'        => 'Локация',
		'hierarchical' => true,
		'show_in_rest' => true,
		'rewrite'      => array( 'slug' => 'property-location' ),
	) );
	register_taxonomy( 'property_status', 'property', array(
		'label'        => 'Статус',
		'hierarchical' => false,
		'show_in_rest' => true,
		'rewrite'      => array( 'slug' => 'property-status' ),
	) );

	// Meta fields
	$meta = array(
		'property_area'       => 'Площадь',
		'property_area_unit'  => 'Ед. площади',
		'property_price'      => 'Цена',
		'property_price_unit' => 'Ед. цены',
		'property_address'    => 'Адрес',
		'property_floor'      => 'Этаж',
		'property_class'      => 'Класс',
		'property_available'  => 'Доступность',
		'property_badge'      => 'Бейдж',
		'property_priority'   => 'Приоритет',
	);
	foreach ( $meta as $key => $desc ) {
		register_post_meta( 'property', $key, array(
			'type'          => 'string',
			'description'   => $desc,
			'single'        => true,
			'show_in_rest'  => true,
			'auth_callback' => function() { return current_user_can( 'edit_posts' ); },
			'sanitize_callback' => 'sanitize_text_field',
		) );
	}
}
add_action( 'init', 'aipilot_register_property_cpt' );

// ═══════════════════════════════════════════
// BLOCK REGISTRATION
// ═══════════════════════════════════════════
function aipilot_register_blocks() {
	$blocks = array(
		'hero', 'stats-grid', 'stat-item', 'logo-strip', 'logo-item',
		'property-carousel', 'property-card', 'process-media', 'consultation-badge',
		'process-list', 'process-step', 'testimonial-slider', 'testimonial-card', 'lead-form'
	);
	foreach ( $blocks as $block ) {
		register_block_type( get_template_directory() . '/blocks/' . $block );
	}
}
add_action( 'init', 'aipilot_register_blocks' );

// ═══════════════════════════════════════════
// DYNAMIC RENDER HELPERS
// ═══════════════════════════════════════════
function aipilot_render_property_card( $post_id = null, $attrs = array() ) {
	if ( ! $post_id ) $post_id = get_the_ID();
	if ( ! $post_id || 'property' !== get_post_type( $post_id ) ) return '';

	$variant = $attrs['variant'] ?? 'detailed';
	$show_image   = $attrs['showImage'] ?? true;
	$show_badge   = $attrs['showBadge'] ?? true;
	$show_title   = $attrs['showTitle'] ?? true;
	$show_price   = $attrs['showPrice'] ?? true;
	$show_area    = $attrs['showArea'] ?? true;
	$show_address = $attrs['showAddress'] ?? true;
	$show_excerpt = $attrs['showExcerpt'] ?? false;

	$title  = get_the_title( $post_id );
	$url    = get_permalink( $post_id );
	$img_id = get_post_thumbnail_id( $post_id );
	$area   = get_post_meta( $post_id, 'property_area', true );
	$area_u = get_post_meta( $post_id, 'property_area_unit', true ) ?: 'м²';
	$price  = get_post_meta( $post_id, 'property_price', true );
	$price_u= get_post_meta( $post_id, 'property_price_unit', true ) ?: '₽';
	$addr   = get_post_meta( $post_id, 'property_address', true );
	$badge  = get_post_meta( $post_id, 'property_badge', true );
	$excerpt= get_the_excerpt( $post_id );

	$wrapper_attrs = get_block_wrapper_attributes( array(
		'class' => 'aipilot-property-card is-variant-' . sanitize_html_class( $variant ),
	) );

	ob_start(); ?>
	<div <?php echo $wrapper_attrs; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
		<a href="<?php echo esc_url( $url ); ?>" class="property-card-link" aria-label="<?php echo esc_attr( $title ); ?>">
			<?php if ( $show_image && $img_id ) : ?>
			<div class="property-card-image"><?php echo wp_get_attachment_image( $img_id, 'large', false, array( 'loading' => 'lazy', 'decoding' => 'async' ) ); ?></div>
			<?php endif; ?>
			<?php if ( $show_badge && $badge ) : ?>
			<span class="property-card-badge"><?php echo esc_html( $badge ); ?></span>
			<?php endif; ?>
			<div class="property-card-content">
				<?php if ( $show_title ) : ?>
				<h3><?php echo esc_html( $title ); ?></h3>
				<?php endif; ?>
				<?php if ( $show_price || $show_area || $show_address ) : ?>
				<div class="property-card-meta">
					<?php if ( $show_area && $area ) : ?><span><?php echo esc_html( $area . ' ' . $area_u ); ?></span><?php endif; ?>
					<?php if ( $show_price && $price ) : ?><span class="property-card-price"><?php echo esc_html( $price . ' ' . $price_u ); ?></span><?php endif; ?>
					<?php if ( $show_address && $addr ) : ?><span><?php echo esc_html( $addr ); ?></span><?php endif; ?>
				</div>
				<?php endif; ?>
				<?php if ( $show_excerpt && $excerpt ) : ?>
				<p class="property-card-excerpt"><?php echo esc_html( wp_trim_words( $excerpt, 15 ) ); ?></p>
				<?php endif; ?>
			</div>
		</a>
	</div><?php
	return ob_get_clean();
}

// ═══════════════════════════════════════════
// LEAD FORM AJAX HANDLER
// ═══════════════════════════════════════════
function aipilot_handle_lead_form() {
	if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'aipilot_lead_form' ) ) {
		wp_send_json_error( array( 'message' => 'Ошибка безопасности. Обновите страницу.' ), 403 );
	}
	if ( ! empty( $_POST['website'] ) ) {
		wp_send_json_error( array( 'message' => 'Спам.' ) );
	}
	$ip       = sanitize_text_field( $_SERVER['REMOTE_ADDR'] ?? '' );
	$rate_key = 'aipilot_form_' . md5( $ip );
	if ( get_transient( $rate_key ) ) {
		wp_send_json_error( array( 'message' => 'Слишком много попыток. Подождите минуту.' ), 429 );
	}
	set_transient( $rate_key, 1, 60 );

	$name    = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
	$phone   = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';
	$email   = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$message = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';
	$consent = ! empty( $_POST['consent'] );

	if ( empty( $name ) || empty( $phone ) || ! $consent ) {
		wp_send_json_error( array( 'message' => 'Имя, телефон и согласие обязательны.' ), 422 );
	}

	$to      = get_option( 'admin_email' );
	$subject = 'Заявка с сайта от ' . $name;
	$body    = "Имя: {$name}\nТелефон: {$phone}";
	// Build headers correctly BEFORE adding Reply-To.
	$headers = array( 'Content-Type: text/plain; charset=UTF-8' );
	if ( $email ) {
		$body     .= "\nEmail: {$email}";
		$headers[] = 'Reply-To: ' . $email;
	}
	if ( $message ) {
		$body .= "\nСообщение: {$message}";
	}

	$sent = wp_mail( $to, $subject, $body, $headers );
	if ( $sent ) {
		$redirect = isset( $_POST['redirect_url'] ) ? esc_url_raw( wp_unslash( $_POST['redirect_url'] ) ) : '';
		wp_send_json_success( array(
			'message'  => 'Спасибо! Ваша заявка отправлена. Мы свяжемся с вами в ближайшее время.',
			'redirect' => $redirect,
		) );
	} else {
		wp_send_json_error( array( 'message' => 'Ошибка отправки. Попробуйте позже.' ), 500 );
	}
}
add_action( 'wp_ajax_aipilot_lead_form', 'aipilot_handle_lead_form' );
add_action( 'wp_ajax_nopriv_aipilot_lead_form', 'aipilot_handle_lead_form' );

/**
 * Flush rewrite on theme switch.
 */
function aipilot_demo_after_switch() {
	aipilot_register_property_cpt();
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'aipilot_demo_after_switch' );
