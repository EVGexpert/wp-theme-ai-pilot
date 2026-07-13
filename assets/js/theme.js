/**
 * AIPilot Demo — Theme JavaScript
 */
(function() {
	'use strict';

	// Mobile menu toggle
	document.addEventListener('DOMContentLoaded', function() {
		var toggle = document.querySelector('.mobile-menu-toggle');
		var menu = document.querySelector('.wp-block-navigation__responsive-container');

		if (toggle && menu) {
			toggle.addEventListener('click', function() {
				var expanded = toggle.getAttribute('aria-expanded') === 'true';
				toggle.setAttribute('aria-expanded', !expanded);
				menu.classList.toggle('is-menu-open');
				document.body.classList.toggle('has-modal-open');
			});

			// Close on Escape
			document.addEventListener('keydown', function(e) {
				if (e.key === 'Escape' && menu.classList.contains('is-menu-open')) {
					menu.classList.remove('is-menu-open');
					toggle.setAttribute('aria-expanded', 'false');
					document.body.classList.remove('has-modal-open');
					toggle.focus();
				}
			});
		}
	});

})();
