<?php
/**
 * Header menu: Contact details (desktop)
 *
 * @package nandotess-resume
 */

$mail  = get_theme_mod( 'nandotess_resume_mail', 'mail@mail.com' );
$phone = get_theme_mod( 'nandotess_resume_phone', '+0000 0000 0000' );
$phone_numbers = preg_replace( '/\D/', '', $phone );

if ( $mail || $phone_numbers || is_customize_preview() ) :
	?>
	
	<nav class="navbar navbar-contact-details hidden-xs">
		<div class="container">
			<ul class="nav navbar-nav">
				<?php if ( $phone_numbers || is_customize_preview() ) : ?>
					<li><a class="phone" href="tel:<?php echo $phone_numbers; /* WPCS: xss ok. */ ?>"><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> <span class="text"><?php echo $phone; /* WPCS: xss ok. */ ?></span></a></li>
				<?php endif; ?>

				<?php if ( $mail || is_customize_preview() ) : ?>
					<li><a class="mail" href="mailto:<?php echo $mail; /* WPCS: xss ok. */ ?>"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> <span class="text"><?php echo $mail; /* WPCS: xss ok. */ ?></span></a></li>
				<?php endif; ?>
			</ul>
		</div>
	</nav>
	
	<?php
endif;
