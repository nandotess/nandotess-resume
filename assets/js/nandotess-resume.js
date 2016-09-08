/**
 * nandotess-resume.js
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

})(jQuery);
