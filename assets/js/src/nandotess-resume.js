/**
 * @requires ../../../bower_components/bootstrap-sass/assets/javascripts/bootstrap/transition.js
 * @requires ../../../bower_components/bootstrap-sass/assets/javascripts/bootstrap/collapse.js
 * @requires ../../../bower_components/bootstrap-sass/assets/javascripts/bootstrap/dropdown.js
 * @requires ../../../bower_components/bootstrap-sass/assets/javascripts/bootstrap/affix.js
 * @requires ../../../bower_components/bootstrap-sass/assets/javascripts/bootstrap/scrollspy.js
 * @requires skip-link-focus-fix.js
 */

/**
 * nandotess-resume.js
 *
 * @author   Fernando Tessmann
 * @since    1.0.0
 * @package  nandotess-resume
 */

(function($) {

	$(window).load(function() {

		$('body').scrollspy({
			target: '#navbar-main',
			offset: $('.navbar-main').outerHeight(true)
		});

		$('.navbar-main').affix({
			offset: {
				top: $('.navbar-contact-details').outerHeight(true)
			}
		});

	});

	$(document).on('affixed.bs.affix', '.navbar-main', function() {
		$('body').addClass('navbar-main-affixed');
	});

	$(document).on('affixed-top.bs.affix', '.navbar-main', function() {
		$('body').removeClass('navbar-main-affixed');
	});

	$(document).on('click', '.navbar-main a[href*=#]:not([href=#])', function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			
			if (target.length) {
				$('html,body').animate({
					scrollTop: target.offset().top - 80
				}, 500);

				return false;
			}
		}
	});

})(jQuery);
