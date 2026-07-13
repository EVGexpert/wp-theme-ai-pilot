# AIPilot Demo — WordPress Block Theme

Блочная FSE-тема для агентства коммерческой недвижимости. Полная сборка на Full Site Editing с 14 кастомными блоками, кастомным типом записей «Объекты» и формой обратной связи с AJAX.

- **Требования:** WordPress 6.6+, PHP 8.0+
- **Без jQuery и page builders** — чистый Gutenberg
- **apiVersion 3** для всех блоков
- **Серверный рендеринг** (`render.php`) + регистрация в JS-редакторе через `assets/js/blocks.js`

## Состав

### Структура темы `aipilot-demo`

```
aipilot-demo/
├── assets/
│   ├── css/      base.css, editor.css
│   ├── fonts/    Inter (regular, medium, semibold, bold)
│   └── js/       theme.js (frontend), editor.js, blocks.js (editor registration)
├── blocks/       14 кастомных блоков (каждый в своей папке)
│   ├── blocks.css     общий файл стилей блоков
│   ├── frontend.js    общий JS для фронта (карусели, форма)
│   └── <block>/       block.json + render.php
├── parts/        header.html, footer.html
├── patterns/     8 паттернов (hero, about, partners, catalog, process, testimonials, lead-form, front-page)
├── templates/    index, front-page, page, single, 404, archive, search, archive-property, single-property
├── functions.php  настройка темы, регистрация CPT/таксономий/блоков/категорий, AJAX-обработчик формы
├── theme.json     дизайн-система: палитра, типографика Inter, spacing, radius
└── style.css      заголовок темы
```

### Кастомный тип записей

- **CPT `property`** — объекты недвижимости (title, editor, thumbnail, excerpt, custom-fields, REST, archive)
- **Таксономии:** `property_type`, `property_location`, `property_status`
- **Мета-поля:** площадь, цена, адрес, этаж, класс, бейдж, приоритет, доступность

### 14 кастомных блоков

| Блок | Тип | Описание |
|---|---|---|
| `hero` | контейнер | Первый экран с фоновым изображением, overlay, CTA |
| `stats-grid` / `stat-item` | контейнер / дочерний | Сетка показателей |
| `logo-strip` / `logo-item` | контейнер / дочерний | Лента логотипов партнёров |
| `property-carousel` / `property-card` | контейнер / динамический | Карусель карточек объектов |
| `process-list` / `process-step` | контейнер / дочерний | Список этапов «Как мы работаем» |
| `process-media` | динамический | Изображение секции процесса |
| `consultation-badge` | динамический | Круглый бейдж «Бесплатная консультация» |
| `testimonial-slider` / `testimonial-card` | контейнер / дочерний | Слайдер отзывов |
| `lead-form` | динамический | Форма обратной связи (AJAX, nonce, honeypot, rate limit) |

## Активация

1. Скопируйте папку `aipilot-demo` в `wp-content/themes/`
2. Активируйте тему в **Внешний вид → Темы**
3. Включите ЧПУ: **Настройки → Постоянные ссылки → Название записи**

## Использование

- Главная страница собирается из паттернов в **Редактор сайта → Шаблоны → Front Page**
- Все секции — отдельные паттерны, можно переставлять, скрывать, дублировать
- Каталог объектов: **Записи → Объекты → Добавить**
- Кастомные блоки доступны в инспектере под категорией **«AIPilot Demo»**

## Технические детали

- Шрифт **Inter** подключается через `theme.json` (fontFace) с локальными `.ttf`-файлами
- Стили блоков централизованы в `blocks/blocks.css` (пустых `style.css` в папках блоков нет)
- JS-регистрация блоков в редакторе — в `assets/js/blocks.js`
- Cache-busting ассетов через `filemtime()` (см. `aipilot_asset_version()` в `functions.php`)
- AJAX-форма использует `wp_mail()` — для работы нужен настроенный SMTP на сервере

## Заметки

- В паттернах используются placeholder-изображения (placehold.co) — замените на реальные фото
- Форма обратной связи отправляет письмо на `admin_email` (можно переопределить атрибутом `recipientEmail`)

