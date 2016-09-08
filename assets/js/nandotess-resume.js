/**
 * nandotess-resume.js
 */
( function($) {

	$('body').scrollspy({
		target: '#navbar-main',
		offset: 50
	});

	$('.navbar-main').affix({
		offset: {
			top: function () {
				return (this.top = $('.navbar-contact-details').outerHeight(true));
			}
		}
	});
	
	$(document).on('affixed.bs.affix', '.navbar-main', function() {
		$('body').addClass('navbar-main-affixed');
	});

	$(document).on('affixed-top.bs.affix', '.navbar-main', function() {
		$('body').removeClass('navbar-main-affixed');
	});

})(jQuery);
