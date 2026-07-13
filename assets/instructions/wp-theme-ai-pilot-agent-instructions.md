# Последовательные инструкции для ИИ-агентов по адаптации `wp-theme-ai-pilot`

**Репозиторий:** https://github.com/EVGexpert/wp-theme-ai-pilot  
**Проверенная ветка:** `main`  
**Дата проверки:** 14 июля 2026 года  
**Визуальный источник истины:** приложенный референс сайта агентства коммерческой недвижимости «Пространство».

## 1. Цель

Привести существующую WordPress FSE-тему к референсу, сохранив ее блочную архитектуру. Тема уже содержит 14 серверных Gutenberg-блоков, паттерны главной страницы, template parts, CPT `property`, таксономии и метаполя. Поэтому тему не нужно переписывать с нуля.

Нужно:

1. связать существующие блоки с секциями референса;
2. изменить композицию паттернов;
3. привести внешний вид desktop и mobile к макету;
4. сделать заявленные атрибуты блоков реально работающими;
5. синхронизировать Gutenberg editor, PHP renderer и frontend;
6. исправить функциональные ошибки каруселей и формы;
7. исключить регрессии архива и отдельных страниц объектов.

## 2. Обязательные правила для всех агентов

- Сохранять Full Site Editing, Gutenberg и серверный рендеринг.
- Не менять slug существующих блоков `aipilot-demo/*` без миграции.
- Не использовать Elementor, WPBakery, jQuery и внешние page builders.
- Не собирать главную одним большим PHP-шаблоном.
- Паттерн отвечает за композицию, блок — за повторно используемую функциональность.
- Глобальные токены хранить в `theme.json`.
- Общую оболочку сайта хранить в `assets/css/base.css`.
- Стили пользовательских блоков хранить в `blocks/blocks.css`.
- Стили редактора хранить в `assets/css/editor.css`.
- UI блоков Gutenberg хранить в `assets/js/blocks.js`.
- Интерактивность frontend хранить в `blocks/frontend.js`.
- Не добавлять inline CSS, кроме динамических CSS custom properties.
- Не использовать внешние изображения `placehold.co` в итоговой версии.
- Не использовать жестко заданные URL сайта или `/wp-admin/admin-ajax.php`.
- Каждый новый/измененный атрибут должен быть согласован в `block.json`, editor, renderer и frontend.
- Проверять 1440, 1280, 1024, 768, 390 и 360 px.
- Не допускать горизонтального скролла страницы.

## 3. Карта соответствия референса и темы

| Секция референса | Существующая сущность | Основные файлы | Что делать |
|---|---|---|---|
| Шапка | Template Part | `parts/header.html`, `assets/css/base.css` | Переработать существующую шапку |
| Первый экран | `aipilot-demo/hero` | `patterns/hero.php`, `blocks/hero/*` | Использовать существующий Hero |
| О нас | Core Columns + `stats-grid` + `stat-item` | `patterns/about.php`, `blocks/stats-grid/*`, `blocks/stat-item/*` | Сделать 2 колонки и статистику 2×2 |
| Логотипы | `logo-strip` + `logo-item` | `patterns/partners.php`, соответствующие блоки | Оставить существующие блоки |
| Каталог | `property-carousel` + `property-card` | `patterns/catalog.php`, блоки, `functions.php` | Добавить компактный вариант карточки |
| Как мы работаем | `process-media`, `consultation-badge`, `process-list`, `process-step` | `patterns/process.php`, соответствующие блоки | Добавить core Group-обертку и иконки |
| Отзывы | `testimonial-slider` + `testimonial-card` | `patterns/testimonials.php`, соответствующие блоки | Перестроить секцию и слайдер |
| Форма | `lead-form` | `patterns/lead-form.php`, блок, JS, `functions.php` | Сохранить блок, исправить AJAX |
| Футер | Template Part | `parts/footer.html`, `assets/css/base.css` | Сделать белым и компактным |
| Главная | Template + составной паттерн | `templates/front-page.html`, `patterns/front-page.php` | Подключить структуру один раз |

**Новый крупный блок не требуется.** Допустимы только расширения существующих блоков: вариант карточки, новые controls, дополнительные SVG-иконки, class names и data-атрибуты.

## 4. Проверенные расхождения

### Главная и навигация

- `patterns/front-page.php` уже содержит нужный порядок: Hero → About → Partners → Catalog → Process → Testimonials → Lead form.
- `templates/front-page.html` выводит `post-content`, поэтому полный паттерн не подключается автоматически.
- Для меню нужны стабильные якоря: `about`, `catalog`, `process`, `testimonials`, `contacts`.

### Hero

- Блок уже поддерживает desktop/mobile изображения, overlay, высоту и радиус.
- Паттерн использует внешний placeholder и другой текст.
- В renderer много inline-стилей.
- Image ID объявлен, но frontend в основном использует URL.

### Stats и Logos

- `stats-grid` объявляет desktop/tablet/mobile columns, dividers и animation, но renderer использует их не полностью.
- `stat-item.showCounter` объявлен, но не реализован.
- `logo-strip.autoplay` и `visibleItems` объявлены, но почти не влияют на renderer.

### Каталог

- Helper `aipilot_render_property_card()` всегда выводит доступные площадь, цену, адрес, excerpt и badge.
- Поэтому `showArea`, `showPrice`, `showAddress`, `showExcerpt`, `showBadge` блока не управляют результатом.
- Карточка сейчас горизонтальная 16:9, с рамкой и тенью; референс требует вертикальную плоскую карточку.
- Wrapper helper нужно формировать одним `get_block_wrapper_attributes()`, без конкурирующих `class`.

### Process

- Изображение и badge не имеют общей позиционируемой обертки.
- Паттерн показывает номера, референс — смысловые иконки.
- `iconSvg` уже поддерживается server-side, поэтому новый блок иконки не нужен.
- `process-list.showDividers` и `showNumbers` используются не полностью.

### Testimonials

- `autoplay`, `loop`, `showDots` объявлены, но frontend реализует их не полностью.
- `rating` карточки объявлен, но не выводится. Для референса он не нужен, однако удалять атрибут без миграции нельзя.

### Gutenberg

- Большинство блоков показывают только Placeholder, InnerBlocks или ServerSideRender.
- Полноценных Inspector Controls и Media Upload нет.
- В `edit()` встречается `useBlockProps.save()` вместо `useBlockProps()`.

### Lead Form

- AJAX URL жестко задан как `/wp-admin/admin-ajax.php`.
- Текст кнопки после отправки жестко возвращается к «Отправить заявку».
- `successMessage`, `errorMessage`, `recipientEmail` не работают как ожидается.
- PHP всегда требует телефон, даже при `showPhone=false`.
- `$headers` дополняется до инициализации, затем перезаписывается; `Reply-To` теряется.
- Email нужно проверять через `is_email()`.
- Recipient нельзя принимать из обычного изменяемого hidden field.

### Footer

Сейчас footer темный. В референсе темной является только секция формы, footer — белый.

---

# 5. Последовательность агентов

## Этап 0. Baseline Audit

**Роль:** технический аудитор WordPress FSE.  
**Цель:** зафиксировать состояние до изменений.

Проверить:

```text
theme.json
functions.php
templates/front-page.html
parts/header.html
parts/footer.html
patterns/*.php
blocks/*/block.json
blocks/*/render.php
assets/css/base.css
assets/css/editor.css
blocks/blocks.css
assets/js/blocks.js
blocks/frontend.js
```

Действия:

1. Создать ветку `feature/reference-alignment`.
2. Составить таблицу всех атрибутов: объявлен → есть в editor → используется в renderer → используется в frontend JS.
3. Сделать скриншоты 1440 и 390 px.
4. Выполнить:
   ```bash
   find . -name "*.php" -print0 | xargs -0 -n1 php -l
   ```
5. Проверить console errors.
6. Проверить CPT `property`, его архив и single.
7. На этом этапе не менять дизайн.

**Приемка:** есть воспроизводимая исходная точка и список реально работающих/неработающих атрибутов.

## Этап 1. Design System

**Роль:** frontend-архитектор.  
**Файлы:** `theme.json`, `assets/css/base.css`, `assets/css/editor.css`, `blocks/blocks.css`.

Сохранить:

- Inter;
- `wideSize` около 1180 px;
- основной голубой около `#86AEC8`;
- темный `#252525`;
- радиусы 8/14/22 px.

Добавить/нормализовать:

```css
:root {
  --aipilot-container: 1180px;
  --aipilot-gutter-desktop: 32px;
  --aipilot-gutter-tablet: 24px;
  --aipilot-gutter-mobile: 16px;
  --aipilot-section-space: 96px;
  --aipilot-section-space-tablet: 72px;
  --aipilot-section-space-mobile: 56px;
  --aipilot-radius-card: 14px;
  --aipilot-radius-large: 22px;
  --aipilot-text-muted: #707579;
  --aipilot-border: #e6e8ea;
}
```

Создать классы:

```text
.site-container
.site-section
.site-section__header
.site-section__title
.site-section__description
```

Требования:

- H1/H2 через `clamp()`;
- основной текст 16 px;
- вторичный 13–14 px;
- убрать тяжелые тени и чрезмерный hover-lift;
- не использовать серый фон всего каталога;
- editor должен повторять ширину и типографику frontend.

**Приемка:** один набор токенов без конфликтов между `theme.json`, `base.css`, `blocks.css`.

## Этап 2. Gutenberg Controls

**Роль:** разработчик Gutenberg.  
**Файлы:** `assets/js/blocks.js`, `assets/js/editor.js`, `assets/css/editor.css`, `blocks/*/block.json`, `functions.php`.

Общие требования:

- В `edit()` применять `useBlockProps()`.
- Добавить `InspectorControls`, `PanelBody`, `TextControl`, `TextareaControl`, `ToggleControl`, `RangeControl`, `SelectControl`, `ColorPalette`, `MediaUpload`, `RichText`.
- ServerSideRender оставлять только для динамических previews.
- Добавлять зависимости WordPress только по факту использования.
- Не ломать ранее сохраненный контент.

Controls:

- `hero`: desktop/mobile image, overlay, position, height, radius, object-position.
- `stats-grid`: desktop/tablet/mobile columns, gap, dividers, animation.
- `stat-item`: prefix, value, suffix, label, counter.
- `logo-strip`: visible items, gap, monochrome, autoplay.
- `logo-item`: image, alt, company, URL.
- `property-carousel`: source, count, taxonomy, term, cards, gap, arrows, dots, autoplay, loop, card variant, display flags.
- `property-card`: property, variant, show flags.
- `process-media`: images, alt, ratio, radius, mobile visibility.
- `consultation-badge`: texts, link, size, mobile visibility.
- `process-list`: dividers, numbers, gap.
- `process-step`: icon, number, hide number, title, description.
- `testimonial-slider`: cards, gap, arrows, dots, autoplay, loop.
- `testimonial-card`: quote, author, role, avatar, quote mark, optional rating.
- `lead-form`: button, messages, recipient, visible fields.

**Приемка:** изменение каждого значимого атрибута видно в editor и после сохранения; invalid blocks отсутствуют.


## Этап 3. Front Page, Header, Anchors, Footer

**Роль:** WordPress FSE-интегратор.  
**Файлы:** `templates/front-page.html`, `patterns/front-page.php`, `parts/header.html`, `parts/footer.html`, `assets/css/base.css`, секционные паттерны.

### Единственный источник главной

Предпочтительный вариант для готовой темы — подключить `aipilot-demo/front-page-full` в `templates/front-page.html` и исключить дублирующий `post-content`.

```html
<!-- wp:template-part {"slug":"header","tagName":"header","className":"site-header"} /-->

<!-- wp:group {"tagName":"main","className":"site-main","layout":{"type":"default"}} -->
<main class="wp-block-group site-main" id="wp--skip-link--target">
  <!-- wp:pattern {"slug":"aipilot-demo/front-page-full"} /-->
</main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","tagName":"footer","className":"site-footer"} /-->
```

Если проект должен хранить главную строго в содержимом страницы, оставить `post-content`, но обеспечить начальное заполнение и не подключать паттерн второй раз.

### Anchors

Добавить группам:

```text
about
catalog
process
testimonials
contacts
```

### Header

Состав:

- знак/логотип;
- название;
- подпись «Коммерческая недвижимость»;
- О нас;
- Каталог;
- Этапы работы;
- Отзывы;
- Контакты.

Desktop:

- высота около 72 px;
- белый фон;
- минимальная нижняя граница;
- компактное меню справа.

Mobile:

- бренд слева;
- нативная кнопка core Navigation справа;
- touch target минимум 44×44 px;
- Escape закрывает меню;
- focus возвращается на toggle;
- не создавать второй параллельный кастомный toggle.

### Footer

- белый фон;
- темный текст;
- тонкая верхняя линия;
- компактные контакты и ссылки;
- темная форма и белый footer визуально разделены.

Не использовать URL, предполагающие установку WordPress в корне.

**Приемка:** главная выводится один раз; все пункты меню ведут к существующим anchors; на mobile одно меню.

## Этап 4. Hero

**Роль:** frontend-разработчик Hero.  
**Файлы:** `patterns/hero.php`, `blocks/hero/block.json`, `blocks/hero/render.php`, `blocks/blocks.css`, `assets/js/blocks.js`.

Текст:

```text
Недвижимость
для бизнеса

Аренда, продажа и подбор объектов
от офисов до складов

Начать сотрудничество
```

CTA → `#contacts`.

Desktop:

- высота 500–520 px;
- radius 18–22 px;
- текст слева;
- текстовый контейнер до 440 px;
- белый H1 и белая pill-кнопка;
- мягкий голубой overlay/gradient;
- здание остается читаемым.

Mobile:

- высота 380–420 px;
- отдельное кадрирование;
- перенос H1 как в референсе;
- CTA не перекрывает важную часть изображения.

Технически:

1. Удалить внешний placeholder.
2. Использовать Media Library или локальное demo media.
3. При наличии ID использовать attachment API и `srcset`; URL оставить fallback.
4. Перенести inline CSS в `blocks/blocks.css`.
5. Сохранить `get_block_wrapper_attributes()`.
6. Указать размеры изображения для снижения CLS.
7. Hero/LCP не должен lazy-load; изображения ниже первого экрана — lazy.

**Приемка:** desktop и mobile могут иметь разные изображения; Hero редактируется; CTA ведет к форме.

## Этап 5. About, Stats, Logos

**Роль:** frontend-разработчик информационных блоков.  
**Файлы:** `patterns/about.php`, `patterns/partners.php`, блоки stats/logo, `blocks/blocks.css`.

### About

Desktop:

- колонки примерно 48/52;
- текст слева;
- stats справа;
- удалить кнопку «Подробнее о нас»;
- stats 2×2.

Значения:

```text
10+     лет на рынке
1000+   успешных сделок
4000+   объектов в нашей базе
95%     довольных клиентов
```

В паттерне:

```json
{
  "columnsDesktop": 2,
  "columnsTablet": 2,
  "columnsMobile": 2
}
```

Generic default блока можно оставить 4, чтобы не ломать другие места.

### Stats Grid renderer

Использовать desktop/tablet/mobile columns, gap, dividers и animation. Не генерировать отдельный `<style>` на каждый блок. Передавать динамику через CSS custom properties wrapper, а media queries держать в общем CSS.

Пример:

```php
get_block_wrapper_attributes([
  'class' => 'aipilot-stats-grid',
  'style' => sprintf(
    '--stats-cols-desktop:%d;--stats-cols-tablet:%d;--stats-cols-mobile:%d;',
    $desktop,
    $tablet,
    $mobile
  ),
])
```

Если `showCounter=true`, анимация:

- запускается при появлении в viewport;
- сохраняет значение без JS;
- учитывает `prefers-reduced-motion`;
- не теряет prefix/suffix.

### Logos

Desktop:

- 5 элементов;
- одна строка;
- одинаковая визуальная высота;
- monochrome;
- без рамок.

Mobile:

- horizontal scroll;
- scroll-snap;
- без horizontal overflow всей страницы.

Не использовать реальные бренды как фиктивных клиентов без подтверждения. Автопрокрутка по умолчанию не нужна. Если атрибут остается включаемым, реализовать pause on hover/focus и reduced motion.

**Приемка:** stats 2×2 на desktop/mobile; пять логотипов; все используемые grid settings работают.

## Этап 6. Каталог объектов

**Роль:** WordPress/PHP-разработчик динамического каталога.  
**Файлы:** `patterns/catalog.php`, оба property-блока, `functions.php`, `blocks/blocks.css`, `blocks/frontend.js`, editor JS.

### Вариант карточки

Добавить в `property-card`:

```json
"variant": {
  "type": "string",
  "default": "detailed"
}
```

Варианты:

- `catalog` — компактный референс;
- `detailed` — существующая расширенная карточка.

Default оставить `detailed` для обратной совместимости.

### Настройки карусели

Добавить/передать:

```text
cardVariant
showArea
showPrice
showAddress
showExcerpt
showBadge
```

Для главной:

```text
cardVariant: catalog
showArea: true
showPrice: false
showAddress: false
showExcerpt: false
showBadge: false
cardsPerView: 3
```

### Единый helper

Изменить:

```php
aipilot_render_property_card( $post_id = null, $options = array() )
```

`property-card/render.php` и `property-carousel/render.php` вызывают один helper с одинаковыми options.

Wrapper:

```php
$wrapper_attributes = get_block_wrapper_attributes([
  'class' => 'aipilot-property-card is-variant-' . $variant,
]);
```

Не добавлять второй независимый `class`.

### Вид `catalog`

- без рамки;
- без общей тени;
- без hover-lift;
- вертикальное изображение 3/4 или 4/5;
- radius 12–14 px;
- название;
- одна короткая характеристика;
- без excerpt, цены, адреса и badge.

### Композиция секции

Desktop:

- белый фон;
- левая колонка около 28%;
- правая около 72%;
- заголовок «Каталог объектов» в две строки;
- три карточки;
- стрелки снизу справа;
- кнопку «Все объекты» убрать из основной композиции, если она не утверждена отдельно.

Mobile:

- заголовок сверху;
- одна карточка + 10–20% следующей;
- native swipe и scroll-snap;
- стрелки можно скрыть.

### Query и данные

- сохранить CPT и taxonomy filter;
- сортировать по `property_priority` при наличии, затем по дате;
- корректно работать при 1–2 объектах;
- использовать локальную заглушку при отсутствии изображения.

### Доступность

- arrows — `<button>`;
- `aria-label`;
- `disabled` на границах при `loop=false`;
- keyboard navigation;
- видимый focus.

**Приемка:** три вертикальные карточки на desktop; mobile peek следующей карточки; `show*` реально меняют HTML; `detailed` остается доступным архиву/другим страницам.

## Этап 7. «Как мы работаем»

**Роль:** разработчик составных Gutenberg-паттернов.  
**Файлы:** `patterns/process.php`, все process-блоки, CSS, editor JS.

Desktop:

- колонки около 45/55;
- слева заголовок, текст и вертикальное изображение;
- справа 5 шагов;
- круглый badge перекрывает верхний правый угол изображения.

В паттерне использовать core Group:

```html
<!-- wp:group {"className":"process-visual","layout":{"type":"default"}} -->
<div class="wp-block-group process-visual">
  <!-- wp:aipilot-demo/process-media ... /-->
  <!-- wp:aipilot-demo/consultation-badge ... /-->
</div>
<!-- /wp:group -->
```

CSS:

```css
.process-visual {
  position: relative;
}

.process-visual .aipilot-consultation-badge {
  position: absolute;
  top: -20px;
  right: -30px;
}
```

На narrow viewport badge не выходит за экран.

Шаги:

1. консультация;
2. поиск;
3. просмотр;
4. документы;
5. сопровождение.

Для каждого `process-step`:

```json
{
  "hideNumber": true,
  "iconSvg": "..."
}
```

Если текущего whitelist недостаточно, добавить безопасные встроенные SVG. Не принимать произвольный SVG от пользователя.

`process-list` должен реально применять `showDividers`, `showNumbers`, `gap`. Editor preview показывает выбранную иконку.

Mobile:

- большое изображение можно скрыть через `showOnMobile=false`;
- badge переводится в безопасный компактный вид;
- список шагов остается.

**Приемка:** badge перекрывает image; иконки разные; номера скрыты; mobile без overflow.

## Этап 8. Testimonials

**Роль:** frontend-разработчик карточек и слайдеров.  
**Файлы:** `patterns/testimonials.php`, testimonial-блоки, CSS, frontend/editor JS.

Композиция:

- heading left;
- светлая карточка;
- крупная декоративная кавычка;
- текст;
- avatar, name, role;
- без тяжелой тени.

Desktop:

- 2 карточки при достаточной ширине;
- 1 карточка на меньшей ширине.

Mobile:

- строго 1 карточка;
- swipe;
- текст не обрезается.

Реализовать:

- cardsPerView;
- gap;
- arrows;
- dots;
- autoplay;
- loop.

`rating` сохранить для совместимости, но в паттерне не показывать. Quote mark пометить `aria-hidden="true"`.

**Приемка:** mobile соответствует референсу; controls выполняют настройки; reduced motion отключает autoplay.


## Этап 9. Lead Form и AJAX

**Роль:** WordPress backend + frontend developer.  
**Файлы:** `patterns/lead-form.php`, блок формы, `blocks/frontend.js`, `functions.php`, CSS.

### Внешний вид

- фон `#252525`;
- светлый heading и текст;
- поля с нижней линией, без белых input-контейнеров;
- белая pill-кнопка;
- на mobile кнопка на всю ширину;
- footer после формы белый.

Все inline-стили формы перенести в `blocks/blocks.css`.

### AJAX URL

Передавать через WordPress:

```php
wp_localize_script(
  'aipilot-blocks-frontend',
  'aipilotBlocks',
  [
    'ajaxUrl' => admin_url( 'admin-ajax.php' ),
  ]
);
```

В JS:

```js
fetch(aipilotBlocks.ajaxUrl, {
  method: 'POST',
  body: data,
});
```

### Тексты

В markup/data-атрибутах передавать:

- исходный submit text;
- loading text;
- success message;
- error message.

После завершения возвращать текст конкретного экземпляра блока, а не жестко заданное «Отправить заявку».

### Server validation

- имя обязательно;
- consent обязательно;
- если phone показан — phone обязателен;
- если phone скрыт — email должен быть показан и обязателен;
- заполненный email проверять `is_email()`;
- скрытые настройкой поля не требовать на server.

### Headers

Исправить порядок:

```php
$headers = [ 'Content-Type: text/plain; charset=UTF-8' ];

if ( $email && is_email( $email ) ) {
  $headers[] = 'Reply-To: ' . $email;
}
```

### Recipient

Нельзя доверять обычному hidden field с email получателя. Допустимо:

1. всегда использовать `admin_email`;
2. использовать whitelist;
3. передавать recipient + HMAC signature на основе `wp_salt()` и проверять подпись.

Обязательны `is_email()` и fallback на `admin_email`.

### Сохранить безопасность

- nonce;
- honeypot;
- rate limit;
- sanitization;
- отсутствие raw input в ответах.

### Accessibility

- labels;
- `aria-describedby` для ошибок;
- общий статус `aria-live="polite"`;
- focus на первое невалидное поле;
- видимое disabled-состояние.

**Приемка:** форма работает при WordPress в подкаталоге; `showPhone=false` не вызывает ошибку; Reply-To не теряется; recipient безопасен; нет PHP warning.

## Этап 10. Общая интерактивность каруселей

**Роль:** vanilla JS-разработчик.  
**Файлы:** `blocks/frontend.js`, renderers слайдеров, CSS.

Renderer передает через `data-*` или JSON:

```text
cardsPerView
autoplay
loop
showArrows
showDots/showPagination
interval
gap
```

Требования:

1. Cards per view пересчитываются по breakpoint.
2. При `loop=false` buttons disabled на границах.
3. При `loop=true` focus не теряется.
4. Autoplay:
   - pause on hover;
   - pause on focus;
   - pause on hidden tab;
   - off при reduced motion.
5. Keyboard: ArrowLeft/ArrowRight.
6. Touch не блокирует вертикальный scroll.
7. Resize пересчитывает ширину и индекс.
8. При недостатке slides controls скрываются/disabled.
9. Mobile-каталог может использовать native horizontal scroll + scroll-snap; JS не должен конфликтовать.

**Приемка:** property, testimonial и logo sliders используют согласованную механику; console errors отсутствуют.

## Этап 11. Очистка кода

**Роль:** refactoring engineer.  
**Файлы:** `blocks/*/render.php`, `functions.php`, CSS.

Действия:

1. Удалить повторяющиеся inline styles.
2. Удалить per-instance `<style>`.
3. Оставить в wrapper только необходимые CSS custom properties.
4. Нормализовать `get_block_wrapper_attributes()`.
5. Проверить `esc_html`, `esc_attr`, `esc_url`, `wp_kses_post`.
6. SVG брать только из whitelist.
7. Удалить внешние placeholders.
8. Локализовать пользовательские строки через text domain.
9. Не рефакторить несвязанные части CPT без необходимости.

**Приемка:** HTML валиден; нет duplicate class attributes; Gutenberg wrappers сохранены; visual regression отсутствует.

## Этап 12. Visual и Functional QA

**Роль:** QA WordPress + visual regression.

Проверить:

- главную;
- архив `property`;
- single `property`;
- обычную страницу;
- 404;
- Site Editor;
- редактор с каждым из 14 блоков.

### Матрица

| Ширина | Ключевые проверки |
|---:|---|
| 1440 | Hero, stats 2×2, 5 logos, 3 property cards |
| 1280 | arrows и колонки не обрезаются |
| 1024 | переходные состояния |
| 768 | menu, carousel, process |
| 390 | соответствие mobile reference |
| 360 | нет overflow |

### Сравнение с референсом

- белая шапка;
- крупный Hero;
- About + stats 2×2;
- logos row;
- вертикальные property cards;
- badge поверх process image;
- icon steps;
- testimonial card;
- темная форма;
- белый footer.

### Functional

- anchors;
- mobile menu;
- Hero CTA;
- CPT query;
- taxonomy filter;
- manual carousel mode;
- arrows/swipe/keyboard;
- form success/error;
- rate limit;
- email validation;
- subdirectory install;
- no-JS fallback.

### Gutenberg

Не допускается:

```text
This block contains unexpected or invalid content.
```

Проверить add/edit/save/reopen/duplicate/copy-paste каждого блока.

### Accessibility и performance

- один H1;
- правильные H2/H3;
- alt;
- focus-visible;
- touch target 44×44;
- contrast;
- aria-label;
- aria-live;
- reduced motion;
- image dimensions;
- responsive `srcset`;
- no CLS;
- no external placeholder requests.

**Итоговая приемка:**

- нет PHP/JS ошибок;
- нет invalid blocks;
- нет horizontal scroll;
- Lighthouse Accessibility ориентир 90+;
- главная повторяет композицию референса, а не только цвета;
- archive/single property не сломаны.

---

# 6. Очередность и владение файлами

| № | Агент | Главная зона |
|---:|---|---|
| 0 | Baseline Audit | Отчет и проверки |
| 1 | Design System | `theme.json`, global CSS |
| 2 | Gutenberg Editor | `assets/js/blocks.js`, editor CSS |
| 3 | FSE Layout | templates, parts, anchors |
| 4 | Hero | Hero pattern/block |
| 5 | About & Logos | stats/logo blocks |
| 6 | Catalog | property blocks/helper |
| 7 | Process | process blocks/pattern |
| 8 | Testimonials | testimonial blocks/pattern |
| 9 | Lead Form | form/AJAX |
| 10 | Carousels | shared frontend JS |
| 11 | Refactor | PHP markup/CSS cleanup |
| 12 | QA | проверки и точечные исправления |

Правила:

- Агент не меняет чужую зону без объяснения.
- Новый глобальный token согласуется с Design System.
- Новый атрибут меняется сразу во всех слоях.
- Нельзя оставлять атрибут реализованным только в editor или только на frontend.

# 7. Универсальный промпт для агента

```text
Ты работаешь с WordPress FSE-темой:
https://github.com/EVGexpert/wp-theme-ai-pilot

Визуальный источник истины — приложенный референс сайта коммерческой
недвижимости «Пространство».

Перед изменениями:
1. Прочитай README, theme.json, соответствующий pattern, block.json,
   render.php, editor JS, frontend JS и CSS.
2. Не создавай новый крупный блок, если задача решается существующим.
3. Не меняй slug существующих блоков.
4. Не используй page builders, jQuery и внешние placeholder-сервисы.
5. Сохраняй Full Site Editing и server rendering.
6. Каждый атрибут согласуй между block.json, editor, renderer и frontend.
7. Не добавляй inline CSS, кроме динамических CSS custom properties.
8. Сохраняй обратную совместимость.
9. Проверь PHP syntax, console, Gutenberg validation, 1440 и 390 px.
10. В отчете перечисли измененные файлы, результат, риски и проверки.
```

# 8. Definition of Done

- Главная выводится один раз.
- Порядок секций соответствует референсу.
- Существующие блоки применены по карте.
- Новые крупные блоки не созданы без необходимости.
- Header/Footer остаются template parts.
- Hero поддерживает desktop/mobile media.
- About — stats 2×2.
- Logo strip — пять элементов.
- Catalog — три вертикальные карточки на desktop.
- Mobile catalog — одна карточка и часть следующей.
- Process badge перекрывает image.
- Process steps используют icons.
- Testimonials адаптивны.
- Form использует корректный AJAX URL и безопасный recipient.
- Footer белый.
- Editor близок к frontend.
- Нет значимых ignored attributes.
- Нет invalid blocks.
- Нет внешних placeholders.
- Нет horizontal overflow.
- Archive/single property работают.
- Accessibility и reduced motion проверены.

# 9. Итоговая структура главной

```text
Header
└── Logo + navigation

Main
├── Hero
├── About
│   ├── Text
│   └── Stats Grid 2×2
├── Partner Logo Strip
├── Property Catalog
│   ├── Section intro
│   └── Dynamic Property Carousel
├── Process
│   ├── Image + Consultation Badge
│   └── Five Icon Steps
├── Testimonials
└── Lead Form

Footer
└── Logo + contacts + links + legal
```

Это целевая связь между приложенным референсом, паттернами темы и существующими Gutenberg-блоками.
