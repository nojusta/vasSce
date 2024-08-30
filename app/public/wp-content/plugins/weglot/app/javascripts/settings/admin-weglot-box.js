const init_admin_weglot_box = function () {
	const $ = jQuery

	const execute = () => {
		$("#weglot-box-first-settings .weglot-btn-close").on("click", function (e) {
			e.preventDefault();
			$("#weglot-box-first-settings").hide();
		})

		$('a[href*="#"]')
			// Remove links that don't actually link to anything
			.not('[href="#"]')
			.not('[href="#0"]')
			.click(function (event) {
				// On-page links
				// Figure out element to scroll to
				var target = $(this.hash);
				target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
				// Does a scroll target exist?
				if (target.length) {
					// Only prevent default if animation is actually gonna happen
					event.preventDefault();
					$('html, body').animate({
						scrollTop: target.offset().top
					}, 1000, function () {
						// Callback after animation
						// Must change focus!
						var $target = $(target);
						$target.focus();
						if ($target.is(":focus")) { // Checking if the target was focused
							return false;
						} else {
							$target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
							$target.focus(); // Set focus again
						}
						;
					});
				}

			});
	}

	document.addEventListener('DOMContentLoaded', () => {
		execute();
	})
}

export default init_admin_weglot_box;

