/**
 * AIPilot Blocks — Frontend JavaScript
 */
(function() {
	'use strict';

	var ajaxUrl = (typeof aipilotFrontend !== 'undefined' && aipilotFrontend.ajaxUrl) ? aipilotFrontend.ajaxUrl : '/wp-admin/admin-ajax.php';

	// ── Carousel / Slider ──
	function initCarousel(el) {
		if (el.dataset.carouselInit) return;
		el.dataset.carouselInit = '1';

		var track = el.querySelector('.aipilot-carousel__track, .aipilot-testimonial__track');
		var prev = el.querySelector('.aipilot-carousel__prev, .aipilot-testimonial__prev');
		var next = el.querySelector('.aipilot-carousel__next, .aipilot-testimonial__next');
		var dotsContainer = el.querySelector('.aipilot-carousel__dots, .aipilot-testimonial__dots');
		if (!track) return;

		var cards = parseInt(el.dataset.cards || track.dataset.cards || '2', 10);
		var autoplay = el.dataset.autoplay === 'true';
		var loop = el.dataset.loop === 'true';
		var slides = Array.prototype.slice.call(track.children);
		if (slides.length === 0) return;

		var index = 0;
		var maxIndex = Math.max(0, slides.length - cards);
		var autoplayTimer = null;

		function currentCards() {
			// Determine responsive cards count from data attributes
			var w = window.innerWidth;
			if (w <= 782 && el.dataset.cardsMobile) return parseInt(el.dataset.cardsMobile, 10) || 1;
			if (w <= 1024 && el.dataset.cardsTablet) return parseInt(el.dataset.cardsTablet, 10) || cards;
			return cards;
		}

		function update() {
			var cc = currentCards();
			var mi = Math.max(0, slides.length - cc);
			if (index > mi) index = mi;
			if (index < 0) index = 0;

			var slideWidth = slides[0].offsetWidth;
			var gap = parseInt(getComputedStyle(track).gap || '24', 10);
			var offset = -index * (slideWidth + gap);
			track.style.transform = 'translateX(' + offset + 'px)';

			if (prev) prev.disabled = (!loop && index === 0);
			if (next) next.disabled = (!loop && index >= mi);
			updateDots(mi);
		}

		function updateDots(mi) {
			if (!dotsContainer) return;
			dotsContainer.innerHTML = '';
			for (var i = 0; i <= mi; i++) {
				(function(i) {
					var dot = document.createElement('button');
					dot.className = (i === index ? 'aipilot-carousel__dot is-active' : 'aipilot-carousel__dot');
					if (el.classList.contains('aipilot-testimonial-slider')) {
						dot.className = (i === index ? 'aipilot-testimonial__dot is-active' : 'aipilot-testimonial__dot');
					}
					dot.setAttribute('role', 'tab');
					dot.setAttribute('aria-label', 'Слайд ' + (i + 1));
					dot.addEventListener('click', function() { index = i; update(); restartAutoplay(); });
					dotsContainer.appendChild(dot);
				})(i);
			}
		}

		function goTo(i) {
			var cc = currentCards();
			var mi = Math.max(0, slides.length - cc);
			if (loop) {
				if (i < 0) i = mi;
				if (i > mi) i = 0;
			} else {
				i = Math.max(0, Math.min(mi, i));
			}
			index = i;
			update();
		}

		if (prev) prev.addEventListener('click', function() { goTo(index - 1); restartAutoplay(); });
		if (next) next.addEventListener('click', function() { goTo(index + 1); restartAutoplay(); });

		// Touch swipe
		var startX = 0;
		var dragging = false;
		track.addEventListener('touchstart', function(e) { startX = e.touches[0].clientX; dragging = true; }, {passive:true});
		track.addEventListener('touchend', function(e) {
			if (!dragging) return;
			dragging = false;
			var diff = startX - e.changedTouches[0].clientX;
			if (diff > 40) goTo(index + 1);
			if (diff < -40) goTo(index - 1);
			restartAutoplay();
		});

		// Autoplay
		function startAutoplay() {
			if (!autoplay) return;
			autoplayTimer = setInterval(function() {
				if (loop || index < maxIndex) goTo(index + 1);
			}, 5000);
		}
		function stopAutoplay() { if (autoplayTimer) { clearInterval(autoplayTimer); autoplayTimer = null; } }
		function restartAutoplay() { stopAutoplay(); startAutoplay(); }

		// Pause on hover (desktop)
		if (autoplay) {
			el.addEventListener('mouseenter', stopAutoplay);
			el.addEventListener('mouseleave', startAutoplay);
		}

		// Pause when out of viewport
		if ('IntersectionObserver' in window) {
			var io = new IntersectionObserver(function(entries) {
				entries.forEach(function(entry) {
					if (entry.isIntersecting) startAutoplay();
					else stopAutoplay();
				});
			}, { threshold: 0.2 });
			io.observe(el);
		} else {
			startAutoplay();
		}

		var resizeTimer;
		window.addEventListener('resize', function() {
			clearTimeout(resizeTimer);
			resizeTimer = setTimeout(update, 150);
		});

		update();
	}

	document.querySelectorAll('.aipilot-carousel, .aipilot-testimonial-slider').forEach(initCarousel);

	// ── Stats counter animation ──
	function initStatsCounter() {
		var grids = document.querySelectorAll('.aipilot-stats-grid.has-animation');
		if (!grids.length) return;

		function animateNumber(el) {
			var target = parseInt(el.getAttribute('data-count-target'), 10) || 0;
			if (isNaN(target)) { el.style.opacity = '1'; return; }
			var duration = 1200;
			var startTime = null;
			function step(ts) {
				if (!startTime) startTime = ts;
				var progress = Math.min((ts - startTime) / duration, 1);
				var eased = 1 - Math.pow(1 - progress, 3);
				el.textContent = Math.floor(eased * target).toString();
				if (progress < 1) requestAnimationFrame(step);
				else el.textContent = target.toString();
			}
			requestAnimationFrame(step);
		}

		if (!('IntersectionObserver' in window)) {
			grids.forEach(function(g) { g.classList.add('is-in-view'); g.querySelectorAll('[data-count-target]').forEach(animateNumber); });
			return;
		}

		var io = new IntersectionObserver(function(entries) {
			entries.forEach(function(entry) {
				if (entry.isIntersecting) {
					entry.target.classList.add('is-in-view');
					entry.target.querySelectorAll('[data-count-target]').forEach(animateNumber);
					io.unobserve(entry.target);
				}
			});
		}, { threshold: 0.4 });

		grids.forEach(function(g) { io.observe(g); });
	}

	initStatsCounter();

	// ── Lead form AJAX ──
	document.querySelectorAll('.aipilot-lead-form__form').forEach(function(form) {
		form.addEventListener('submit', function(e) {
			e.preventDefault();
			var btn = form.querySelector('.aipilot-lead-form__submit');
			var msg = form.querySelector('.aipilot-form-message');
			if (!btn) return;
			var originalText = btn.textContent;
			btn.disabled = true;
			btn.textContent = 'Отправка...';
			if (msg) { msg.classList.remove('is-visible', 'aipilot-form-success', 'aipilot-form-error'); }

			var data = new FormData(form);
			// action field already included as hidden input, but ensure for legacy forms
			if (!data.get('action')) data.append('action', 'aipilot_lead_form');

			fetch(ajaxUrl, { method:'POST', body:data, credentials: 'same-origin' })
				.then(function(r) { return r.json(); })
				.then(function(json) {
					var message = (json && json.data && json.data.message) ? json.data.message : 'Ошибка.';
					if (msg) {
						msg.classList.add('is-visible', json.success ? 'aipilot-form-success' : 'aipilot-form-error');
						msg.textContent = message;
					}
					if (json.success) {
						form.reset();
						var redirect = (json.data && json.data.redirect) ? json.data.redirect : '';
						if (redirect) window.location.href = redirect;
					}
					btn.disabled = false;
					btn.textContent = originalText;
				})
				.catch(function() {
					if (msg) {
						msg.classList.add('is-visible', 'aipilot-form-error');
						msg.textContent = 'Ошибка сети. Попробуйте позже.';
					}
					btn.disabled = false;
					btn.textContent = originalText;
				});
		});
	});
})();
