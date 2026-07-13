/**
 * AIPilot Blocks — Frontend JavaScript
 */
(function() {
	'use strict';

	// Carousel init
	function initCarousel(el) {
		if (el.dataset.carouselInit) return;
		el.dataset.carouselInit = '1';

		var track = el.querySelector('.aipilot-carousel__track, .aipilot-testimonial__track');
		var prev = el.querySelector('.aipilot-carousel__prev, .aipilot-testimonial__prev');
		var next = el.querySelector('.aipilot-carousel__next, .aipilot-testimonial__next');
		if (!track) return;

		var cards = parseInt(track.dataset.cards || '2', 10);
		var slides = track.children;
		if (slides.length <= cards) return;

		var index = 0;
		var maxIndex = slides.length - cards;

		function update() {
			var slideWidth = slides[0].offsetWidth;
			var gap = parseInt(getComputedStyle(track).gap || '24', 10);
			var offset = -index * (slideWidth + gap);
			track.style.transform = 'translateX(' + offset + 'px)';
		}

		if (prev) prev.addEventListener('click', function() { index = Math.max(0, index - 1); update(); });
		if (next) next.addEventListener('click', function() { index = Math.min(maxIndex, index + 1); update(); });

		// Touch swipe
		var startX = 0;
		track.addEventListener('touchstart', function(e) { startX = e.touches[0].clientX; }, {passive:true});
		track.addEventListener('touchend', function(e) {
			var diff = startX - e.changedTouches[0].clientX;
			if (diff > 40 && index < maxIndex) { index++; update(); }
			if (diff < -40 && index > 0) { index--; update(); }
		});

		window.addEventListener('resize', update);
		update();
	}

	document.querySelectorAll('.aipilot-carousel, .aipilot-testimonial-slider').forEach(initCarousel);

	// Lead form AJAX
	document.querySelectorAll('.aipilot-lead-form__form').forEach(function(form) {
		form.addEventListener('submit', function(e) {
			e.preventDefault();
			var btn = form.querySelector('.aipilot-lead-form__submit');
			var msg = form.querySelector('.aipilot-form-message');
			if (!btn) return;
			btn.disabled = true;
			btn.textContent = 'Отправка...';
			if (msg) { msg.style.display = 'none'; msg.className = 'aipilot-form-message'; }

			var data = new FormData(form);
			data.append('action', 'aipilot_lead_form');

			fetch('/wp-admin/admin-ajax.php', { method:'POST', body:data })
				.then(function(r) { return r.json(); })
				.then(function(json) {
					if (msg) {
						msg.style.display = 'block';
						msg.className = 'aipilot-form-message ' + (json.success ? 'aipilot-form-success' : 'aipilot-form-error');
						msg.textContent = json.data.message;
					}
					if (json.success) form.reset();
					btn.disabled = false;
					btn.textContent = 'Отправить заявку';
				})
				.catch(function() {
					if (msg) { msg.style.display = 'block'; msg.className = 'aipilot-form-message aipilot-form-error'; msg.textContent = 'Ошибка сети. Попробуйте позже.'; }
					btn.disabled = false;
					btn.textContent = 'Отправить заявку';
				});
		});
	});
})();
